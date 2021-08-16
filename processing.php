<?php
    require_once("includes/header.php");
    require_once("includes/classes/VideoUploadData.php");
    require_once("includes/classes/VideoProcessor.php");

    if (!isset($_POST["uploadButton"])) {
        echo "No file sent to page.";
        exit();
    }

    $VideoUploadData = new VideoUploadData(
        $_POST["fileInput"],
        $_POST["titleInput"],
        $_POST["descriptionInput"],
        $_POST["privacyInput"],
        $_POST["categoryInput"],
        "REPLACE_THIS"
    );
?>
