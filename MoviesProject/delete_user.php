<?php
include 'header.php';

session_start();
echo '<head>';
echo '<title>Delete User</title>';
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


echo '<h1>Delete User</h1>';
//create a user object 
$user = new Users();
$user->initWithUid($id);


if(isset($_POST['submitted']))
{
//test the value of the radio button    
    if(isset($_POST['sure']) && ($_POST['sure'] == 'Yes') ) //delete the record   
    {  
       if($user->deleteuser())
           echo '<p> User ' .$user->getUserName(). ' was deleted</p>'; 
    }//no confirmation
     else
       echo '<p> User '. $user->getUserName(). '  deletion not confirmed</p>'; 
}
else //show form
{
    echo '<div id="stylized" class="myform"> 
        <form action="delete_user.php" method="post">
        <br />
        <h3>Name: '.$user->getUserName() . '</h3></br>
        <label>Delete this user?</label> <br/><br/>
          <input type="radio" name="sure" value="Yes" /><label>Yes</label>
          <input type="radio" name="sure" value="No" checked="checked" /> <label>No</label>
          <input type="submit" class ="DB4Button" name="submit" value="Delete" />
        
         <input type ="hidden" name="submitted" value="TRUE">
         <input type ="hidden" name="id" value="' . $id . '"/>
         </form>
         <div class="spacer"></div>
         </div>';   

}

include 'footer.html';
?>
