<?php include 'header.php';?>

<?php
if (isset($_POST['submitted'])) {
    $imageName = $_FILES["image"]["tmp_name"];
    echo $imageName;
    
    $imageDest = 'images//'.$_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], $imageDest);
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
