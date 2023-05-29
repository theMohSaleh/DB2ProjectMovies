<?php include 'header.php';?>

<?php

ini_set('upload_tmp_dir', sys_get_temp_dir());

if (isset($_SESSION["userID"])){
    
    if (isset($_POST['submitted'])) {
    
    if (!empty($_FILES)) {
        $upload = new Upload();
        $upload->setUploadDir('images/');
        $msg = $upload->upload('image');

        if (empty($msg)) {
            $file = new Files();
            
            $file->setFileName($upload->getFilepath());
            
            $file->setFileLocation($upload->getUploadDir() . $upload->getFilepath());
            
            $file->setFileType($upload->getFileType());
            
            $file->setArticleID(1);
            
            $file->addFile();
        }else    print_r ($msg);
    }
    else
        echo '<p> try again';
    }
}



?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        <div class = "container">
            <h1> Upload Files </h1>
            <form action="upload_files.php" method="post" enctype="multipart/form-data">
           <p><h1>Upload Form</h1> 
        <p>
           <p>File   <input type="file" name="image" /></p>
        </p>
        <p><input type="submit" name="submit" value="Upload" /></p>
        
         <input type ="hidden" name="submitted" value="TRUE">
         </form>
        </div>
        
    </body>
</html>
