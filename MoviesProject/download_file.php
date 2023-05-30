<?php

include 'header.php';

if(isset($_GET['fileID'])){
    
    $id = $_GET['fileID'];
    $fileObj = new Files();
    $fileObj->initWithFileID($id);
    
    $file = trim($fileObj->getFileLocation());
    $filename = trim($fileObj->getFileName());
    $filetype = trim($fileObj->getFileType());
    
    header("Content-Type: $filetype");
    header('Content-Transfer-Encoding: Binary');
    header("Content-disposition: attachment; filename=\"$filename\"");

// Read the file and output its contents
    readfile($file);
} else {
    header("Location: index.php");
}




