<?php
session_start();
echo '<head>';
echo '<title>Manage Users</title>';
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


include 'header.php';
?>

<h1> Users </h1>

<?php
    $users = new Users();
    $row = $users->getAllusers();
?>

<div class ="container">
<br>
<br>
<br>
<br>

<h1> Users </h1>    
    <?php
if (!empty($row)) {
    echo '<br />';
    //display a table of results
    echo '<table class = "table table-striped table-hover my-5 border rounded rounded-3 overflow-hidden" align="center" cellspacing = "2" cellpadding = "4" width="75%">';
    echo '<tr >
          <th class = "col" style="text-align: center">Edit</td>
          <th class = "col" style="text-align: center">Delete</td>
          <th class = "col" style="text-align: center">Username</td>
          <th class = "col" style="text-align: center">First Name</td>
          <th class = "col" style="text-align: center">Last Name</td>
          <th class = "col" style="text-align: center">Date of Birth</td>
          <th class = "col" style="text-align: center">Registered Date</td>
          <th class = "col" style="text-align: center">User Role</td>
          <th class = "col" style="text-align: center">UserID</td>
          </tr>';

//above is the header
//loop below adds the user details    
    //use the following to set alternate backgrounds 

    for ($i = 0; $i < count($row); $i++) {
        $roleTitle = null;
        if ($row[$i]->roleID == 0) {
            $roleTitle = "Administrator";
        } else if ($row[$i]->roleID == 1) {
            $roleTitle = "Author";
        } else if ($row[$i]->roleID == 2) {
            $roleTitle = "Viewer";
        }
        echo '<tr bgcolor="' . $bg . '">
            <td  style="text-align: center"><a href="edit_user.php?id=' . $row[$i]->userID . '">Edit</a></td>
            <td  style="text-align: center"><a href="delete_user.php?id=' . $row[$i]->userID . '">Delete</a></td>
            <td  style="text-align: center">' . $row[$i]->userName . '</td>
            <td  style="text-align: center">' . $row[$i]->firstName . '</td>
            <td  style="text-align: center">' . $row[$i]->lastName . '</td>
            <td  style="text-align: center">' . $row[$i]->DOB . '</td>
            <td  style="text-align: center">' . $row[$i]->regDate . '</td>
            <td  style="text-align: center">' . $roleTitle . '</td>
                <td  style="text-align: center">' . $row[$i]->userID . '</td>
              </tr>';
    }
    echo '</table>';
} else {
    echo '<p class="error">' . $q . '</p>';
    echo '<p class="error"> Oh dear. There was an error</p>';
    echo '<p class="error">' . mysqli_error($dbc) . '</p>';
}



?>
</div>

<?php include 'footer.html'; ?>

