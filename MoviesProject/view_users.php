<?php

include_once 'header.php';

session_start();

// redirect user to home page if not logged in
if (empty($_SESSION['userID'])) {
    header('Location: index.php');
    die();
}

if ($_SESSION['roleID'] != '0') {
    header('Location: index.php');
    die();
}


include 'header.html';

echo '<h1> Users </h1>';

$users = new Users();
$row = $users->getAllusers();

if (!empty($row)) {
    echo '<br />';
    //display a table of results
    echo '<table align="center" cellspacing = "2" cellpadding = "4" width="75%">';
    echo '<tr bgcolor="#87CEEB">
          <td><b>Edit</b></td>
          <td><b>Delete</b></td>
          <td><b><a href="view_users.php">Username</a></b></td>
          <td><b><a href="view_users.php">First Name</a></b></td>
          <td><b><a href="view_users.php">Last Name</a></b></td>
          <td><b><a href="view_users.php">Date of Birth</a></b></td>
          <td><b><a href="view_users.php">Registered Date</a></b></td>
          <td><b><a href="view_users.php">User Role</a></b></td>
          <td><b><a href="view_users.php">UserID</a></b></td></tr>';

//above is the header
//loop below adds the user details    
    //use the following to set alternate backgrounds 
    $bg = '#eeeeee';

    for ($i = 0; $i < count($row); $i++) {
        $bg = ($bg == '#eeeeee' ? '#ffffff' : '#eeeeee');
        $roleTitle = null;
        if ($row[$i]->roleID == 0) {
            $roleTitle = "Administrator";
        } else if ($row[$i]->roleID == 1) {
            $roleTitle = "Author";
        } else if ($row[$i]->roleID == 2) {
            $roleTitle = "Viewer";
        }
        echo '<tr bgcolor="' . $bg . '">
            <td><a href="edit_user.php?id=' . $row[$i]->userID . '">Edit</a></td>
            <td><a href="delete_user.php?id=' . $row[$i]->userID . '">Delete</a></td>
            <td>' . $row[$i]->userName . '</td>
            <td>' . $row[$i]->firstName . '</td>
            <td>' . $row[$i]->lastName . '</td>
            <td>' . $row[$i]->DOB . '</td>
            <td>' . $row[$i]->regDate . '</td>
            <td>' . $roleTitle . '</td>
                <td>' . $row[$i]->userID . '</td>
              </tr>';
    }
    echo '</table>';
} else {
    echo '<p class="error">' . $q . '</p>';
    echo '<p class="error"> Oh dear. There was an error</p>';
    echo '<p class="error">' . mysqli_error($dbc) . '</p>';
}


include 'footer.html';
?>
