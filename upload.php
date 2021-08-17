<?php
    require_once("includes/header.php");
    require_once("includes/classes/VideoDetailsFormProvider.php");
?>

<div class="column">
    <?php
        $formProvider = new VideoDetailsFormProvider($con); // $con variable comes from config.php>header.php
        echo $formProvider->createUploadForm();
    ?>
</div>

<?php require_once("includes/footer.php"); ?>
