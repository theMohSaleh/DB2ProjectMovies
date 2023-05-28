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
          <th class = "col">'.$lang['VIEWA'].'</td>
          <th class = "col">'.$lang['EDIT'].'</td>
          <th class = "col">'.$lang['TITLE'].'</td>
          <th class = "col">'.$lang['DISC'].'</td>
          <th class = "col">'.$lang['ISPUB'].'</td>
          <th class = "col">'.$lang['PUBDATE'].'</td>
          <th class = "col">'.$lang['TOTALV'].'</td>
          <th class = "col">'.$lang['RATING'].'</td>';
//above is the header
//loop below adds the user details    
    //use the following to set alternate backgrounds 


    for ($i = 0; $i < count($row); $i++) {
        
        echo '<tr>
            <td style="text-align: center">'.(($row[$i]->isPublished=='1')?'<a href="view_article.php?id=' . $row[$i]->articleID . '">'.$lang['VIEWA'].'':"Not Published.").'</a></td>
            <td style="text-align: center">'.(($row[$i]->isPublished=='0')?'<a href="add_article.php?id=' . $row[$i]->articleID . '">'.$lang['EDIT'].'':"Cannot Edit Published Article.").'</a></td>
            <td>' . $row[$i]->title . '</td>
            <td>' . $row[$i]->description . '</td>
            <td style="text-align: center">'.(($row[$i]->isPublished=='1')?'Yes':"No").'</td>
            <td style="text-align: center">'.(($row[$i]->isPublished=='1')?''.$row[$i]->publishDate.'':"Not Published Yet.").'</td>
            <td style="text-align: center">' . $row[$i]->views . '</td>
            <td style="text-align: center">' . $row[$i]->rating . '</td>
            </tr>';
    }
    echo '</table>';
} else {
    echo '<p class="error">' . $q . '</p>';
    echo '<p class="error"> Oh dear. There was an error</p>';
    echo '<p class="error">' . mysqli_error($dbc) . '</p>';
}
?>

<a href="add_article.php"><input class = "btn btn-primary" type="submit" class ="DB4Button" name="submit" value="Create new Article" /><br><br><a/>
</div>
<?php include 'footer.html';?>
