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

<h1> <?php echo $lang['USERS']; ?> </h1>

<?php
    $users = new Users();
    $row = $users->getAllusers();
?>

<div class ="container">
<br>
<br>
<br>
<br>

<h1> <?php echo $lang['USERS']; ?> </h1>    
    <?php
if (!empty($row)) {
    echo '<br />';
    //display a table of results
    echo '<table class = "table table-striped table-hover my-5 border rounded rounded-3 overflow-hidden" align="center" cellspacing = "2" cellpadding = "4" width="75%">';
    echo '<tr >
          <th class = "col" style="text-align: center">'.$lang['EDIT'].'</td>
          <th class = "col" style="text-align: center">'.$lang['DELETE'].'</td>
          <th class = "col" style="text-align: center">'.$lang['USERNAME'].'</td>
          <th class = "col" style="text-align: center">'.$lang['FIRSTNAME'].'</td>
          <th class = "col" style="text-align: center">'.$lang['LASTNAME'].'</td>
          <th class = "col" style="text-align: center">'.$lang['DOB'].'</td>
          <th class = "col" style="text-align: center">'.$lang['REGDATE'].'</td>
          <th class = "col" style="text-align: center">'.$lang['USERROLE'].'</td>
          <th class = "col" style="text-align: center">'.$lang['USERID'].'</td>
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
            <td  style="text-align: center"><a href="edit_user.php?id=' . $row[$i]->userID . '">'.$lang['EDIT'].'</a></td>
            <td  style="text-align: center"><a href="delete_user.php?id=' . $row[$i]->userID . '">'.$lang['DELETE'].'</a></td>
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
    echo '<p class="error"> '.$lang['ERROR'].'</p>';
    echo '<p class="error">' . mysqli_error($dbc) . '</p>';
}



?>
</div>

<?php include 'footer.html'; ?>

