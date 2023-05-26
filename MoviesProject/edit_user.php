<?php

include 'header.php';

session_start();

?>

<head>
<title>Edit User</title>
</head>



<?php

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

// create user object and pass ID to get related user information
$user = new Users();
$user->initWithUid($id);

//perfrom the following if the user has submitted the form 
if (isset($_POST['submitted'])) {

    $oldName = $user->getUserName();

//populate the user object member variables from values on the form
    $user->setUserName($_POST['userName']);
    $user->setFirstName($_POST['FName']);
    $user->setLastName($_POST['LName']);
    $user->setDOB($_POST['DOB']);
    $user->setRoleID($_POST['roleID']);


    if (!$user->initWithUsername()) {// check if username exists
        // inform user the desired username is not available and undo username change
        echo "<h2> The username </h2><p>".$user->getUserName()." already exists</p>";
        $user->setUserName($oldName);
        
    }else {

        //$errors = $user->isValid();

        if (empty($errors)) {
            //update the user 
            $user->updateDB();
            // redirect user to users list after 5 seconds
            header( "refresh:5;url=view_users.php" );
            // inform user of successful edit
            echo '<h2> Successful </h2><p>'.$user->getUserName().' is updated</p>';
            echo '<p>You will be redirected shortly...</p>';
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
} // end if submitted conditional

echo '<h1>Edit User</h1>';


//create a new user data object and populate it using the get() method
//this will show the form with the fields already populated with values from the $user object created above 
//see the CSS file to see what effect the id="stylized" properties have on the form 
echo '<div id="stylized" class="myform"> 
         <form action="edit_user.php" method="post">
        <br />
        <h3>Edit User: ' . $user->getUserName() . '</h3>
        <br />
            <label>Username</label>    <input type="text" name="userName" value="' . $user->getUserName() . '" /><br><br>
            <label>First Name</label> <input type="text" name="FName" value="' . $user->getFirstName() . '"/><br><br>
            <label>Last Name</label> <input type="text" name="LName" value="' . $user->getLastName() . '"/><br><br>
            <label>Date of Birth</label> <input type="date" name="DOB" value="' . $user->getDOB() . '"/><br><br>
            <label>Registered Date</label> <input type="date" name="RegDate" value="' . $user->getRegDate() . '" readonly/><br><br>
                <label for="roleID">User Role</label>
                <select id="roleID" name="roleID">
                    <option value="0"'.(($user->getRoleID()=='0')?'selected="selected"':"").'>Administrator</option> 
                    <option value="1"'.(($user->getRoleID()=='1')?'selected="selected"':"").'>Author</option> 
                    <option value="2"'.(($user->getRoleID()=='2')?'selected="selected"':"").'>Viewer</option> 
                </select><br><br>
                <input type="submit" class ="DB4Button" onclick="redirect()" name="submit" value="Update" />
        
        <input type ="hidden" name="submitted" value="TRUE">
        <input type ="hidden" name="id" value="' . $id . '"/>
        </form>
        <a href="view_users.php"><input type="button" value="Return to Users" /></a>
        <div class="spacer"></div>
        </div>';





include 'footer.html';
?>
