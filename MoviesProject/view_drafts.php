<?php include 'header.php'; ?>

<?php
session_start();
?>

<head>
<title>Drafts</title>
</head>

<?php
// redirect user to home page if not logged in
if (empty($_SESSION['userID'])) {
    header('Location: index.php');
    die();
}
// if user is a viewer, redirect to home page
if ($_SESSION['roleID'] == '2') {
    header('Location: index.php');
    die();
}

$articles = new Articles();
$row = $articles->getAllArticlesAuthor($_SESSION['userID']);

    ?>
<div class ="container">
<br>
<br>
<br>
<br>

<h1> <?php echo $lang['ARTICLES']; ?> </h1>    

<?php 
    if (!empty($row)) {
    //display a table of results
    echo '<table class ="table table-striped table-hover my-5 border rounded rounded-3 overflow-hidden" align="center" cellspacing = "2" cellpadding = "4" width="75%">';
    echo '<tr>
          <th style="text-align: center" class = "col">'.$lang['VIEWA'].'</td>
          <th style="text-align: center" class = "col">'.$lang['EDIT'].'</td>
          <th style="text-align: center" class = "col">'.$lang['TITLE'].'</td>
          <th style="text-align: center" class = "col">'.$lang['DISC'].'</td>
          <th style="text-align: center" class = "col">'.$lang['PUBDATE'].'</td>
          <th style="text-align: center" class = "col">'.$lang['TOTALV'].'</td>
          <th style="text-align: center" class = "col">'.$lang['RATING'].'</td>';
//above is the header
//loop below adds the user details    
    //use the following to set alternate backgrounds 


    for ($i = 0; $i < count($row); $i++) {
        
        echo '<tr>
            <td style="text-align: center">'.(($row[$i]->isPublished=='1')?'<a href="view_article.php?artID=' . $row[$i]->articleID . '">'.$lang['VIEWA'].'</a>':"Not Published.").'</td>
            <td style="text-align: center">'.(($row[$i]->isPublished=='0')?'<a href="add_article.php?artID=' . $row[$i]->articleID . '">'.$lang['EDIT'].'</a>':"Cannot Edit Published Article.").'</td>
            <td style="text-align: center" >' . $row[$i]->title . '</td>
            <td style="text-align: center" >' . $row[$i]->description . '</td>
            <td style="text-align: center">'.(($row[$i]->isPublished=='1')?''.$row[$i]->publishDate.'':"Not Published Yet.").'</td>
            <td style="text-align: center">' . $row[$i]->views . '</td>
            <td style="text-align: center">' . $row[$i]->rating . '</td>
            </tr>';
    }
    echo '</table>';
} else {
    echo '<p class="error">' . $q . '</p>';
    echo '<p class="error"> Your articles will be displayed here.</p>';
    echo '<p class="error">' . mysqli_error($dbc) . '</p>';
}
?>

<a href="add_article.php"><input class = "btn btn-primary" type="submit" class ="DB4Button" name="submit" value="Create new Article" /><br><br><a/>
</div>
<?php include 'footer.html';?>
