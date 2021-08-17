<?php

class VideoProcessor {

    private $con;
    private $sizeLimit = 500000000;
    private $allowedTypes = array("mp4", "flv", "webm", "mkv", "vob", "ogv", "ogg", "avi", "wmv", "mov", "mpeg", "mpg");
    private $ffmpegPath;

    public function __construct($con) {
        $this->con = $con;
        // Gets the relative path and makes it absolute path
        $this->ffmpegPath = realpath("ffmpeg/windows/ffmpeg.exe");
    }

    public function upload($videoUploadData) {

        $targetDir = "uploads/videos/";
        $videoData = $videoUploadData->videoDataArray;

        $tempFilePath = $targetDir . uniqid() . basename($videoData["name"]);
        $tempFilePath = str_replace("", "_", $tempFilePath);

        $isValidData = $this->processData($videoData, $tempFilePath);

        if(!$isValidData) {
            return false;
        }

        if (move_uploaded_file($videoData["tmp_name"], $tempFilePath)) {

            $finalFilePath = $targetDir . uniqid() . ".mp4";

            if (!$this->insertVideoData($videoUploadData, $finalFilePath)) {
                echo "Insert query failed.";
                return false;
            }

            if (!$this->convertVideoToMp4($tempFilePath, $finalFilePath)) {
                echo "Upload failed";
                return false;
            }

        }
    }

    private function processData($videoData, $filePath) {

        $videoType = pathInfo($filePath, PATHINFO_EXTENSION);

        if (!$this->isValidSize($videoData)) {
            echo "File too large. Can't be more than " . $this->sizeLimit . " bytes";
            return false;
        } else if (!$this->isValidType($videoType)) {
            echo "Invalid file type";
            return false;
        } else if ($this->hasError($videoData)) {
            echo "Error code: " . $videoData["error"];
            return false;
        }

        return true;

    }

    private function isValidSize($data) {
        return $data["size"] <= $this->sizeLimit;
    }

    private function isValidType($type) {
        $lowercased = strtolower($type);

        // Check if there is specified type in the given array
        return in_array($lowercased, $this->allowedTypes);
    }

    private function hasError($data) {
        return $data["error"] != 0;
    }

    private function insertVideoData($uploadData, $filePath) {

        $query = $this->con->prepare("INSERT INTO videos
            (title, uploadedBy, description, privacy, category, filePath)
            VALUES
            (:title, :uploadedBy, :description, :privacy, :category, :filePath)
        ");

        $query->bindParam(":title", $uploadData->title);
        $query->bindParam(":uploadedBy", $uploadData->uploadedBy);
        $query->bindParam(":description", $uploadData->description);
        $query->bindParam(":privacy", $uploadData->privacy);
        $query->bindParam(":category", $uploadData->category);
        $query->bindParam(":filePath", $filePath);

        return $query->execute();

    }

    public function convertVideoToMp4($tempFilePath, $finalFilePath) {

        // 2>&1 expression outputs error to the screen
        $cmd = "$this->ffmpegPath -i $tempFilePath $finalFilePath 2>&1";
        $outputLog = array();

        exec($cmd, $outputLog, $returnCode);

        if ($returnCode != 0) {
            // Command failed
            foreach ($outputLog as $line) {
                echo $line . "<br />";
            }
            return false;
        }

        return true;

    }

}

?>
