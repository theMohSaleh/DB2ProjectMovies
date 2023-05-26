<?php

include_once 'header.php';

session_start();
echo '<head>';
echo '<title>Manage Articles</title>';
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


include 'header.html';

echo '<h1> Articles </h1>';

$articles = new Articles();
$row = $articles->getAllArticles();

if (!empty($row)) {
    echo '<br />';
    //display a table of results
    echo '<table align="center" cellspacing = "2" cellpadding = "4" width="75%">';
    echo '<tr bgcolor="#87CEEB">
          <td><b>View Article</b></td>
          <td><b>Edit</b></td>
          <td><b>Delete</b></td>
          <td><b>Title</b></td>
          <td><b>Description</b></td>
          <td><b>Is Published?</b></td>
          <td><b>Publish Date</b></td>
          <td><b>Total Views</b></td>
          <td><b>Rating</b></td>
          <td><b>ID of User</b></td></tr>';

//above is the header
//loop below adds the user details    
    //use the following to set alternate backgrounds 
    $bg = '#eeeeee';

    for ($i = 0; $i < count($row); $i++) {
        $bg = ($bg == '#eeeeee' ? '#ffffff' : '#eeeeee');
        
        echo '<tr bgcolor="' . $bg . '">
            <td style="text-align: center"><a href="view_article.php?artID=' . $row[$i]->articleID . '">View</a></td>
            <td style="text-align: center"><a href="edit_article.php?id=' . $row[$i]->articleID . '">Edit</a></td>
            <td style="text-align: center"><a href="delete_article.php?id=' . $row[$i]->articleID . '">Delete</a></td>
            <td>' . $row[$i]->title . '</td>
            <td>' . $row[$i]->description . '</td>
            <td style="text-align: center">'.(($row[$i]->isPublished=='1')?'Yes':"No").'</td>
            <td style="text-align: center">' . $row[$i]->publishDate . '</td>
            <td style="text-align: center">' . $row[$i]->views . '</td>
            <td style="text-align: center">' . $row[$i]->rating . '</td>
                <td style="text-align: center"><a href="edit_user.php?id=' . $row[$i]->userID . '">' . $row[$i]->userID . '</td>
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
