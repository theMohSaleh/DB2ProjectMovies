<?php

include 'header.php';

session_start();

?>

<head>
<title>Edit Article</title>
</head>



<?php

// redirect user to home page if not logged in
if (empty($_SESSION['userID'])) {
    header('Location: index.php');
    die();
}


include 'header.html';

$id = 0;

//the id of the user is first passed to the form as a parameter so we retrieve it from the $_GET global array
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
//after the page is first submitted the id is stored in a hidden field on the page so we get it frm the $_POST array
elseif (isset($_POST['id'])) {
    $id = $_POST['id'];
} else {
    //no id parameter is present so we do not go any further
    echo '<p class="error">No User id Parameter</p>';

    include 'footer.html';

    exit();
}

// create article object and pass ID to get related article information
$article = new Articles();
$article->initWithArticleid($id);

// create article object get all articles
$categoryObj = new Categories();
$categories = $categoryObj->getAllCategories();

// if user is not the writer of this article or an admin, redirect to home page
if ($_SESSION['userID'] != $article->getUserID()) {
    if ($_SESSION['roleID'] != '0') {
        header('Location: index.php');
        die();
    }
}

//perfrom the following if the user has submitted the form 
if (isset($_POST['submitted'])) {

    $oldName = $article->getTitle();

    //populate the user object member variables from values on the form
    $article->setTitle($_POST['title']);
    $article->setDescription($_POST['desc']);
    $article->setContent($_POST['content']);
    if ($_POST['isPublished']) {
        $article->setIsPublished(1);
    } else {
        $article->setIsPublished(0);
    }
    $article->setCatID($_POST['category']);
    
    if (empty($errors)) {
        //update the user 
        $q = $article->updateDB();
        // inform user of successful edit
        echo '<p>'.$q.'</p>';
        echo '<h2> Successful! </h2><p>Article: '.$oldName.' has been updated.</p>';
        echo '<p>You will be redirected shortly...</p>';
        // redirect user to relative page after 5 seconds
        if ($_SESSION['roleID'] == '0' && $_SESSION['userID'] != $article->getUserID()){
            header( "refresh:5;url=view_articles.php" );
        } else {
            header( "refresh:5;url=index.php" );
        }
            echo '<a href="view_articles.php"><input type="button" value="Return to Articles" /></a>';
            return true;
        } else {
            echo '<div style="width:50%; background:#FFFFFF; margin:0 auto;">
                <p class="error"> The following errors occurred: <br/>';
            foreach ($errors as $err) {
                echo "$err <br/>";
            }
            echo '</p></div>';
        }
} // end if submitted conditional
echo '<br><br><br><br>';
echo '<h1>Edit Article</h1>';


//create a new user data object and populate it using the get() method
//this will show the form with the fields already populated with values from the $user object created above 
//see the CSS file to see what effect the id="stylized" properties have on the form 
echo '<div class ="container" id="stylized" class="myform"> 
        <form action="edit_article.php" method="post">
        <br />
        <br />
        <h3>Edit Article: ' . $article->getTitle() . '</h3>
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
            <div class = "mb-3">
            <input form-check-input type="checkbox" name="isPublished" '.(($article->getIsPublished()=='1')?'checked':"") .'/> <label class = "form-label"><b>Published</b></label> <br><br>
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
                <input class = "btn btn-primary" type="submit" class ="DB4Button" name="submit" value="Update" />
        
        <input type ="hidden" name="submitted" value="TRUE">
        <input type ="hidden" name="id" value="' . $id . '"/>
        </form>
        <div class="spacer"></div>
        </div>';





include 'footer.html';
?>
