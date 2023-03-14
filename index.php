<?php
require_once("vendor/autoload.php");
require_once("views/form.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploader = createB2FileUploader();
    $fileData = $_FILES['file'];
    try {
        $file = $uploader->uploadFile($fileData);
        echo 'File uploaded successfully.';
    } catch (Exception $e) {
        echo 'Error uploading file: ' . $e->getMessage();
    }
}

?>


