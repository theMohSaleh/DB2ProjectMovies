<?php include 'header.php'; ?>

<?php
session_start();
?>

<head>
<title>Manage Articles</title>
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#advanceDiv").hide();
            $("#advanceBTN").click(function() {
                if ($("#advanceDiv").is(":visible")) {
                    $("#advanceDiv").fadeOut();
                } else {
                    $("#advanceDiv").fadeIn();
                }
            });
            $("#clear").click(function() {
                $("#advTitle").val('');
                $("#author").val('').change();
                $('#popular').prop('checked', false);
                $("#dateMsg").html('');
                $("#startDate").val('');
                $("#endDate").val('');
            });
            $("#advancedSearch").submit(function(e) {
                var startDate = $("#startDate").val();
                var endDate = $("#endDate").val();
                // check if start or end date is picked
                if(startDate != "" || endDate != ""){
                    // check if one of the dates was not selected to prevent form submission
                    if (startDate == "" || endDate == "") {
                        // prompt user to enter date for both fields and prevent form submission
                        $("#dateMsg").html('Please select start and end date. <br>');
                        e.preventDefault();
                    }
                }
            });
        });
    
    </script>
</head>
<?php
$search = new Search();
$articles = new Articles();
$row = $articles->getAllArticles();
?>

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
$users = new Users();
$authors = $users->getAllUsersRole(1);

// if form is subbmited
    if (isset($_POST['submitted'])) {
        $authorID = $_POST['authorID'];
        $popular = $_POST['popular'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        $admin = true;
        $row = $search->ShowAdvancedArticles($title, $authorID, $popular, $startDate, $endDate, $admin);
        }
    ?>
?>


<div class ="container">
<br>
<br>
<br>
<br>

<div class = "flex justify-content-between"><h1> Articles </h1>
                <form id="advancedSearch" name="advancedSearch" action="view_articles.php" method="post">         
                <select id="author" name="authorID">
                    <option value="" disabled selected hidden>--Select an Author--</option>
                    <?php 
                    // loop through list of all authors
                        for($i =0; $i < count($authors); $i++){
                            $selected = $_POST['authorID']; // used to check if user already selected an author
                            // check author id to retain selected value after submit
                            if ($authors[$i]->userID == $selected) {
                            echo '<option value="'.$authors[$i]->userID.'" selected="selected">'.$authors[$i]->firstName.' '.$authors[$i]->lastName.'</option>'; // insert category in dropdown list
                            } else {
                                echo '<option value="'.$authors[$i]->userID.'">'.$authors[$i]->firstName.' '.$authors[$i]->lastName.'</option>'; // insert category in dropdown list
                            }
                        }
                    ?>
                </select>
                  <br>
                  <input type="checkbox" id="popular" name="popular" <?php if(!empty($_POST['popular'])) echo 'checked' ?>>
                  <label for="popular"> Most Popular</label><br>
                  <span id="dateMsg" style="color:#ff3333;"></span>
                  <label for="startDate"> Between Date</label><br>
                  <input type="date" id="startDate" name="startDate" value="<?php echo $_POST['startDate'] ?>"><br>
                  <label for="endDate"> And Date</label><br>
                  <input type="date" id="endDate" name="endDate" value="<?php echo $_POST['endDate'] ?>"><br><br>
                <button class="btn btn-secondary" name="submitted" type="submit">Go!</button>
                <button class="btn btn-secondary" style="background-color:#999999" id="clear" type="button">Clear</button>
            </form>
</div>
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
