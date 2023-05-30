<?php

include 'header.php';

session_start();

?>

<head>
<title>Add Article</title>
</head>



<?php
$article = new Articles();
$id = 0;


// redirect user to home page if not logged in
if (empty($_SESSION['userID'])) {
    header('Location: index.php');
    die();
}

include 'header.html';

// check if current user is admin or author
if ($_SESSION['roleID'] == '0' || $_SESSION['roleID'] == '1') {
    // check if article is draft or a completely new article
    if (isset($_GET['artID'])) {
        $id = $_GET['artID'];
        $_SESSION['artID'] = $id;
            // create article object and pass ID to get related article information
            $article->initWithArticleid($_SESSION['artID']);
            // check if current user is not the writer of the article
            if ($article->getUserID() != $_SESSION['userID']) {
                // redirect to home page
                header('Location: index.php');
                // if article is published, redirect user to home page to avoid making any changes
            } else if ($article->getIsPublished() == 1) {
                header('Location: index.php');
            }
   }
} else {
    // redirect to home page
    header('Location: index.php');
}

$categoryObj = new Categories();
$categories = $categoryObj->getAllCategories();


//perfrom the following if the user has submitted the form 
if (isset($_POST['save'])) {
    //save action
    $article->initWithArticleid($_SESSION['artID']);
    //populate the user object member variables from values on the form
    $article->setTitle($_POST['title']);
    $article->setDescription($_POST['desc']);
    $article->setContent($_POST['content']);
    $article->setPublishDate(null);
    $article->setIsPublished(0);
    $article->setCatID($_POST['category']);
    // check if article is not an edit
    if ($_SESSION['artID'] == "") {
        // create new article
        $article->addArticle($_SESSION['userID']);
        
        
        if (!empty($_FILES)) {
        $upload = new Upload();
        $upload->setUploadDir('images/');
        $msg = $upload->upload('image');

        if (empty($msg)) {
            $file = new Files();
            
            $file->setFileName($upload->getFilepath());
            
            $file->setFileLocation($upload->getUploadDir() . $upload->getFilepath());
            
            $file->setFileType($upload->getFileType());
           
            $file->setArticleID($article->getArticleID());
            
            $file->addFile();
        } else {
            print_r ($msg);
        }
    }
    else {
        echo '<p> try again';
    }
        echo '<br><br><br>';
        echo '<h2> Successful! </h2><p>Article changes has been saved.</p>';
        $_SESSION['artID'] = "";
        echo '<p>You will be redirected shortly...</p>';
        header( "refresh:5;url=view_drafts.php" );
        echo '<a href="view_drafts.php"><input type="button" value="Return to My Articles" /></a>';
        return true;
    } else {
    
    if (empty($errors)) {
        //update the user 
        $article->updateDB();
        
        if (!empty($_FILES['image'])) {
        $upload = new Upload();
        $upload->setUploadDir('images/');
        $msg = $upload->upload('image');

        if (empty($msg)) {
            $file = new Files();
            
            $file->setFileName($upload->getFilepath());
            
            $file->setFileLocation($upload->getUploadDir() . $upload->getFilepath());
            
            $file->setFileType($upload->getFileType());
            
            $file->setArticleID($id);
            
            $file->addFile();
        } else {
            print_r ($msg);
        }
    }
    else {
        echo '<p> try again';
    }
        // inform user of successful publish
        echo '<p>'.$q.'</p>';
        echo '<br><br><br>';
        echo '<h2> Successful! </h2><p>Article changes has been saved.</p>';
        $_SESSION['artID'] = "";
        echo '<p>You will be redirected shortly...</p>';
        header( "refresh:5;url=view_drafts.php" );
        echo '<a href="view_drafts.php"><input type="button" value="Return to My Articles" /></a>';
        return true;
        } else {
            echo '<div style="width:50%; background:#FFFFFF; margin:0 auto;">
                <p class="error"> The following errors occurred: <br/>';
            foreach ($errors as $err) {
                echo "$err <br/>";
            }
            echo '</p></div>';
        }
    }
} else if (isset($_POST['publish'])) {
    //publish action
    $article->initWithArticleid($_SESSION['artID']);
    //populate the user object member variables from values on the form
    $article->setTitle($_POST['title']);
    $article->setDescription($_POST['desc']);
    $article->setContent($_POST['content']);
    $article->setIsPublished(1);
    $article->setCatID($_POST['category']);
    // check if article is not an edit
    if ($_SESSION['artID'] == "") {
        // create new article
        $article->addArticle($_SESSION['userID']);
        $_SESSION['artID'] = $newArtID->articleID;
        $article->publishArticle(0);
        
        if (!empty($_FILES)) {
        $upload = new Upload();
        $upload->setUploadDir('images/');
        $msg = $upload->upload('image');

        if (empty($msg)) {
            $file = new Files();
            
            $file->setFileName($upload->getFilepath());
            
            $file->setFileLocation($upload->getUploadDir() . $upload->getFilepath());
            
            $file->setFileType($upload->getFileType());
            
            $file->setArticleID($article->getArticleID());
            
            $file->addFile();
        } else {
            print_r ($msg);
        }
    }
    else {
        echo '<p> try again';
    }
    
        echo '<br><br><br>';
        echo '<h2> Published! </h2><p>Article has been successfully published.</p>';
        $_SESSION['artID'] = "";
        echo '<p>You will be redirected shortly...</p>';
        header( "refresh:5;url=view_drafts.php" );
        echo '<a href="view_drafts.php"><input type="button" value="Return to My Articles" /></a>';
        return true;
        
        
    } else {
    
    if (empty($errors)) {
        //update the user 
        $article->updateDB();
        $article->publishArticle($_SESSION['artID']);
        
        if (!empty($_FILES)) {
        $upload = new Upload();
        $upload->setUploadDir('images/');
        $msg = $upload->upload('image');

        if (empty($msg)) {
            $file = new Files();
            
            $file->setFileName($upload->getFilepath());
            
            $file->setFileLocation($upload->getUploadDir() . $upload->getFilepath());
            
            $file->setFileType($upload->getFileType());
            
            $file->setArticleID($id);
            
            $file->addFile();
        } else {
            print_r ($msg);
        }
    }
    else {
        echo '<p> try again';
    }
        
        $_SESSION['artID'] = "";
        // inform user of successful publish
        echo '<p>'.$q.'</p>';
        echo '<br><br><br>';
        echo '<h2> Published! </h2><p>Article has been successfully published.</p>';
        header( "refresh:5;url=view_drafts.php" );
        echo '<p>You will be redirected shortly...</p>';
        echo '<a href="view_drafts.php"><input type="button" value="Return to My Articles" /></a>';
        return true;
        } else {
            echo '<div style="width:50%; background:#FFFFFF; margin:0 auto;">
                <p class="error"> The following errors occurred: <br/>';
            foreach ($errors as $err) {
                echo "$err <br/>";
            }
            echo '</p></div>';
        }
    }
} else if (isset($_POST['delete'])) {
    $article->initWithArticleid($_SESSION['artID']);
    if ($article->deleteArticle($_SESSION['userID'])){
    echo '<br><br><br><br>';
    echo '<h2> Deleted. </h2><p>Article has been deleted successfully.</p>';
    header( "refresh:5;url=view_drafts.php" );
    echo '<p>You will be redirected shortly...</p>';
    echo '<a href="view_drafts.php"><input type="button" value="Return to My Articles" /></a>';
    return true;
    } else {
        echo 'unexpected error.';
    }
} // end if submitted conditional
echo '<br><br><br><br>';
echo '<h1>Add Article</h1>';


echo '<div class ="container" id="stylized" class="myform"> 
        <form action="add_article.php" method="post" enctype="multipart/form-data" >
        <br />
        <br />
        <h3>Publish new Article</h3>
        <br />
            <div class = "mb-3">
                <label class = "form-label"><b>Title</b></label>    <input class = "form-control" type="text" name="title" value="' . $article->getTitle() . '" /><br><br>
            </div>
            <div class = "mb-3">
            <label class = "form-label"><b>Description</b></label>
            <textarea class = "form-control" type="text" name="desc"  rows="2">'.$article->getDescription().'</textarea><br><br>
            </div>
            <div class = "mb-3">
            <label class = "form-label"><b>Content</b></label> <textarea class = "form-control" name="content" rows="10" cols="70">' . $article->getContent() . '</textarea><br><br>
            </div>
            <label class = "form-label"><b>Category</b></label> <select class = "form-control" id="category" name="category" name="catID">';
// loop through list of all categories
                        for($i =0; $i < count($categories); $i++){
                            // check category id to retain selected value after submit
                            if ($categories[$i]->catID == $article->getCatID()) {
                            echo '<option value="'.$categories[$i]->catID.'" selected="selected">'.$categories[$i]->catName.'</option>'; // insert category in dropdown list
                            } else {
                                echo '<option value="'.$categories[$i]->catID.'">'.$categories[$i]->catName.'</option>'; // insert category in dropdown list
                            }
                        }
                        echo '<div class = "container">
            
             
        
           <p>File   <input type="file" name="image" /></p>
        </p>
        
         <input type ="hidden" name="submitted" value="TRUE">
         
        </div>';
                echo '</select><br><br>
                <input class = "btn btn-primary" type="submit" class ="DB4Button" name="publish" value="Publish" />
                <input class = "btn btn-primary" type="submit" class ="DB4Button" name="save" value="Save" />
                <input class = "btn btn-primary" type="submit" class ="DB4Button" name="delete" value="Delete" />
        
        <input type ="hidden" name="submitted" value="TRUE">
        <input type ="hidden" name="id" value="' . $id . '"/>
        </form>
        <div class="spacer"></div>
        </div>';

include 'footer.html';
?>
