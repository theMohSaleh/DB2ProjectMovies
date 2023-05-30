<?php
include 'header.php';

session_start();
echo '<head>';
echo '<title>Delete Article</title>';
echo '</head>';
// redirect user to home page if not logged in
if (empty($_SESSION['userID'])) {
    header('Location: index.php');
    die();
}
// if user is not an admin, redirect to home page
if ($_SESSION['roleID'] != '0') {
    header('Location: index.php');
    die();
}

$page_title = 'Delete User';

include 'header.html';

$id=0;

if( isset($_GET['id']) )
{
    $id=$_GET['id'];  
}
elseif(isset($_POST['id']))
{
    $id=$_POST['id'];    
}
else
{
     echo '<p class="error"> Error has occured</p>';    
}

echo '<br><br><br><br>';
echo '<h1>Delete Article</h1>';
//create a user object 
$article = new Articles();
$article->initWithArticleid($id);


if(isset($_POST['submitted']))
{
//test the value of the radio button    
    if(isset($_POST['sure']) && ($_POST['sure'] == 'Yes') ) //delete the record   
    {  
        $articleName = $article->getTitle();
       if($article->deleteArticle())
           // inform user of successful delete and redirect
            echo '<p> Article: ' .$articleName. ' was deleted</p>'; 
            header( "refresh:5;url=view_articles.php" );
            echo '<p>You will be redirected shortly...</p>';
    }//no confirmation
     else
       echo '<p> Article '. $article->getTitle(). '  deletion not confirmed</p>';
        echo '<a href="view_articles.php" <button id="back" type="button">Return to Articles</button></a>';
}
else //show form
{
    echo '<div id="stylized" class="myform"> 
        <form action="delete_article.php" method="post">
        <br />
        <h3>Name: '.$article->getTitle() . '</h3></br>
        <label>Delete this article?</label> <br/><br/>
          <input type="radio" name="sure" value="Yes" /><label>Yes</label>
          <input type="radio" name="sure" value="No" checked="checked" /> <label>No</label>
          <input type="submit" class ="DB4Button" name="submit" value="Delete" />
        
         <input type ="hidden" name="submitted" value="TRUE">
         <input type ="hidden" name="id" value="' . $id . '"/>
         </form>
         <a href="view_articles.php"><input type="button" value="Return to Articles" /></a>
         <div class="spacer"></div>
         </div>';   

}

include 'footer.html';
?>
