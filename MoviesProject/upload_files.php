<?php include 'header.php';?>

<?php

ini_set('upload_tmp_dir', sys_get_temp_dir());

if (isset($_SESSION["userID"])){
    
    if (isset($_POST['submitted'])) {
    
        
    if (!empty($_FILES)) {
        $files = array_filter($_FILES['image']['tmp_name']);
        
        echo $files[0];
        echo $files[1];
        
        $files[0] = "HELLO1";
        $files[1] = "HELLO2";
        
        echo $files[0];
        echo $files[1];
        
        }else    print_r ($msg);
    }
    else
        echo '<p> try again';
    
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
           <p>File   <input type="file" name="image[]" multiple = "multiple"/></p>
        </p>
        <p><input type="submit" name="submit" value="Upload" /></p>
        
         <input type ="hidden" name="submitted" value="TRUE">
         </form>
        </div>
        
    </body>
</html>
