<?php include 'header.php';?>

<?php
if (isset($_POST['submitted'])) {
    
    if (!empty($_FILES)) {
        $upload = new Upload();
        $upload->setUploadDir('images/');
        $msg = $upload->upload('image');
        
        if (empty($msg)) {
            $file = new Files();
            $file->setArticleID(1);
            $file->setFileName($upload->getFilepath());
            $file->setFileLocation($upload->getUploadDir() . $upload->getFilepath());
            $file->setFileType($upload->getFileType());
            $file->addFile();
        }else { 
            print_r ($msg);
        }
    }
    else
        echo '<p> try again';
}
?>

<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        echo '<h1> Upload Files </h1>';

        echo '<div><form action="upload_files.php" method="post" enctype="multipart/form-data">
           <p><h1>Upload From</h1> 
        <p>
           <p>File   <input type="file" name="image" /></p>
        </p>
        <p><input type="submit" name="submit" value="Upload" /></p>
        
         <input type ="hidden" name="submitted" value="TRUE">
         </form></div>';
        ?>
    </body>
</html>
