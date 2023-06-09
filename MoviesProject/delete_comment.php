<?php
include 'header.php';

session_start();
echo '<head>';
echo '<title>Delete Comment</title>';
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

$page_title = 'Delete Comment';


$id=0;

//the first time the page is displayed it is because it is from a hyper link so we use $_GET to 
//retrieve the parameter from the link
//Any time the page is shown after that it is because it has been submitted using the form
//so we then use $_POST to get the form data
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

$articleID = $_SESSION['sessionArticleID']; 
 

echo '<br><br><br><h1>Delete Comment</h1>';
//create a comment object 
$commentObj = new Comments();
$commentObj->initWithCommentId($id);


if(isset($_POST['submitted']))
{
//test the value of the radio button    
    if(isset($_POST['sure']) && ($_POST['sure'] == 'Yes') ) //delete the record   
    {  
       if($commentObj->deleteComment())
       header( "refresh:2;url=view_article.php?artID='$articleID'" );
            echo '<p>You will be redirected shortly...</p>';
            unset($_SESSION['sessionArticleID']);
    }//no confirmation
     else
       echo '<p> Comment deletion not confirmed</p>'; 
}
else //show form
{
    echo '<div id="stylized" class="myform"> 
        <form action="delete_comment.php" method="post">
        <br />
        <h3>Comment text: '.$commentObj->getCommentText() . '</h3></br>
        <label>Delete this comment?</label> <br/><br/>
          <input type="radio" name="sure" value="Yes" /><label>Yes</label>
          <input type="radio" name="sure" value="No" checked="checked" /> <label>No</label>
          <input type="submit" class ="DB4Button" name="submit" value="Delete" />
        
         <input type ="hidden" name="submitted" value="TRUE">
         <input type ="hidden" name="id" value="' . $id . '"/>
         </form>
         <a href="index.php"><input type="button" value="Return to Homepage" /></a>
         <div class="spacer"></div>
         </div>';   

}

include 'footer.html';
?>
