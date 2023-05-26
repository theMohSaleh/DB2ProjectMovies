<?php include 'header.php'; ?>

<?php
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

?>





<?php
$articles = new Articles();
$row = $articles->getAllArticles();
?>

<div class ="container">
<br>
<br>
<br>
<br>

<h1> Articles </h1>    
<?php 
    if (!empty($row)) {
    //display a table of results
    echo '<table class ="table table-striped table-hover my-5 border rounded rounded-3 overflow-hidden" align="center" cellspacing = "2" cellpadding = "4" width="75%">';
    echo '<tr>
          <th class = "col">View Article</td>
          <th class = "col">Edit</td>
          <th class = "col">Delete</td>
          <th class = "col">Title</td>
          <th class = "col">Description</td>
          <th class = "col">Is Published?</td>
          <th class = "col">Publish Date</td>
          <th class = "col">Total Views</td>
          <th class = "col">Rating</td>
          <th class = "col">ID of User</td></tr>';
//above is the header
//loop below adds the user details    
    //use the following to set alternate backgrounds 


    for ($i = 0; $i < count($row); $i++) {
        
        echo '<tr>
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
?>
    

</div>
<?php include 'footer.html';?>
