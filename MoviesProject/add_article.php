<?php

include 'header.php';

session_start();

?>

<head>
<title>Add Article</title>
</head>



<?php

// redirect user to home page if not logged in
if (empty($_SESSION['userID'])) {
    header('Location: index.php');
    die();
}
$id = null;
include 'header.html';
$article = new Articles();
// check if current user is admin or author
if ($_SESSION['roleID'] == '0' || $_SESSION['roleID'] = '1') {
    // check if article is draft or a completely new article
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
            // create article object and pass ID to get related article information
            $article->initWithArticleid($id);
            // check if current user is not the writer of the article
            if ($article->getUserID() != $_SESSION['userID']) {
                // redirect to home page
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
    //populate the user object member variables from values on the form
    $article->setTitle($_POST['title']);
    $article->setDescription($_POST['desc']);
    $article->setContent($_POST['content']);
    $article->setIsPublished(0);
    $article->setCatID($_POST['category']);
    
    // check if article is not an edit
    if ($_GET['id'] == null) {
        // create new article
        $article->addArticle($_SESSION['userID']);
    } else {
    
    if (empty($errors)) {
        //update the user 
        $q = $article->updateDB();
        echo $q;
        // inform user of successful publish
        echo '<p>'.$q.'</p>';
        echo '<h2> Successful! </h2><p>Article changes has been saved.</p>';
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
} else if (isset($_POST['publish'])) {
    //delete action


    //populate the user object member variables from values on the form
    $article->setTitle($_POST['title']);
    $article->setDescription($_POST['desc']);
    $article->setContent($_POST['content']);
    $article->setIsPublished(1);
    $article->setCatID($_POST['category']);
    
    if (empty($errors)) {
        //update the user 
        $q = $article->updateDB();
        // inform user of successful publish
        echo '<p>'.$q.'</p>';
        echo '<h2> Successful! </h2><p>Article: '.$article->getTitle().' has been published.</p>';
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
} else if (isset($_POST['delete'])) {
    $article->deleteArticle($_SESSION['userID']);
    header('Location: view_drafts.php');
} // end if submitted conditional
echo '<br><br><br><br>';
echo '<h1>Add Article</h1>';


echo '<div class ="container" id="stylized" class="myform"> 
        <form action="add_article.php" method="post">
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
