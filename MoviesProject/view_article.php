<?php include_once('header.php'); ?>

<?php
if (!isset($_GET["artID"])) {
    header('Location: index.php');
}
$id = $_GET["artID"];
$article = new Articles();
$article->initWithArticleid($id);
// Check if user visited the article once, then run view update once
if(!isset($_SESSION['first_run'])){
    $_SESSION['first_run'] = 1;
    $article->updateViewCount();
    echo "<meta http-equiv='refresh' content='0'>";
}
$title = $article->getTitle();

// Save article ID to a session variable
$_SESSION['sessionArticleID']=$id;
$sessionArticleID = $_SESSION[sessionArticleID];

$uid = $article->getUserID();
$author = new Users();
$author->initWithUid($uid);

$category = new Categories();
$category->initWithCatID($article->getCatID());

$filesObj = new Files();
$files = $filesObj->getArticleFiles($id);

$commentObj = new Comments();
$comments = $commentObj->getAllCommentsForArticle($id);

$currenturl = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

if (isset($_POST['like'])) {
    if (!isset($_SESSION['first_likeDislike'])) {
        $_SESSION['first_likeDislike'] = 1;
        $article->like();
        echo "<meta http-equiv='refresh' content='0'>";
    }
}

if (isset($_POST['dislike'])) {
    if (!isset($_SESSION['first_likeDislike'])) {
        $_SESSION['first_likeDislike'] = 1;
        $article->dislike();
        echo "<meta http-equiv='refresh' content='0'>";
    } 
}

if (isset($_POST['commentPosted'])) {
    $commentObj = new Comments();
    $commentObj->setArticleID($id);
    $commentObj->setCommentText($_POST['comment']);
    $commentObj->setUserID($_SESSION['userID']);
    date_default_timezone_set("Asia/Bahrain");
    $commentObj->setCreationDate(date('Y-m-d h:i:s'));    
   
    $idTest = $id;
    $textTest = ($_POST['comment']);
    $userIDTest = ($_SESSION['userID']);
    $dateTest = (date('Y-m-d h:i:s'));
    

    if ($commentObj->addComment()) {
        echo "<meta http-equiv='refresh' content='0'>";
    } else {
        echo "<script>alert('Error');</script>";
    }

    // redirect user to removed_article page if article was removed by an admin
    if ($article->getTitle() == "*this article was removed by an administrator*") {
        header('Location: removed_article.php');
    }

    // redirect user to home page if article is not published
    if ($article->getIsPublished() == 0) {
        header('Location: index.php');
    }
}
?>    
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title><?php echo $article->getTitle();?></title>

        <!-- Bootstrap core CSS -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="bootstrap/css/modern-business.css" rel="stylesheet">
        <link href="style.css" rel="stylesheet">


    </head>
    <body>

        <!-- Navigation -->
        <?php include('header.php'); ?>


        <!-- Page Content -->
        <div class="container">
            <div class="row" style="margin-top: 4%">

                <!-- Blog Entries Column -->
                <div class="col-md-8 my-5">

                    <!-- Blog Post -->
                    <div class="card mb-4">
                        <div class="card-body ">
                            <h2 class="card-title"><?php echo $article->getTitle(); ?></h2>

                            <!--category-->
                            <a class="badge bg-secondary text-decoration-none link-light" style="color:#fff">Category: <?php echo $category->getCatName(); ?></a>
                            <p>
                                <b>Posted by </b> <b><?php echo $author->getFirstName() . ' ' . $author->getLastName() ?> on </b> <?php echo $article->getPublishDate() ?> <b>  </b></p>
                            <p><strong>Share:</strong> <a href="http://www.facebook.com/share.php?u=<?php echo $currenturl; ?>" target="_blank">Facebook</a> | 
                                <a href="https://twitter.com/share?url=<?php echo $currenturl; ?>" target="_blank">Twitter</a>                                    
                            </p>
                            <hr />

                            <p class="card-text"><?php echo $article->getContent(); ?></p>

                        </div>
                        <div class="card-footer text-muted">
                            <div class="d-flex justify-content-between">
                                Views: <?php echo $article->getViews() ?> 
                                <form name="likeButton" method="post"><input type="submit" name="like" value="Like"> <?php echo $article->getLikes(); ?> </form> 
                                <form name="dislikeButton" method="post"><input type="submit" name="dislike" value="Dislike"> <?php echo $article->getDislikes(); ?> </form> 
                                <?php
                                if($_SESSION['roleID'] == 0){
                                    echo '<a href="delete_article.php?artID='. $article->getArticleID()  .'" class="link-grey">Delete Post</a>';
                                }
                                ?>
                            </div>

                        </div>
                    </div>

                    <!--- Media Section --->
                    <div id = "mediaCarousel" class="carousel slide" data-bs-ride="true">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#mediaCarousel" data-bs-slide-to="0" class="active" aria-current="true"></button>
                            <button type="button" data-bs-target="#mediaCarousel" data-bs-slide-to="1"></button>
                            <button type="button" data-bs-target="#mediaCarousel" data-bs-slide-to="2"></button>
                        </div>
                        
                        <div class="carousel-inner ratio ratio-4x3 w-100 ">
                        <?php for($i = 0; $i < count($files); $i++){
                            echo '<div class="carousel-item active">
                                <img class = "img-fluid border rounded" src='.$files[$i]->fileLocation.' class="d-block w-100" alt="...">
                            </div>';
                            } 
                        ?>    
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#mediaCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#mediaCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>

                <!-- Sidebar Widgets Column -->
                <?php include('sidebar.php'); ?>
            </div>

            <div class = "row">
                <div class="col-md-8 my-5">
                    <h3>Download Content</h3>
                    <?php
                        for($i = 0; $i < count($files); $i++){
                            echo '<a href="download_file.php?fileID='.$files[$i]->fileID.'">'.$files[$i]->fileName.'</a><br>';
                        }
                    ?>
                </div>
            </div>

            <!---Comment Section --->
            <div class="row">
                <div class="col-md-8">
                    <?php
            if ($_SESSION['userName'] == "") {
                echo '<div class="card">
                        <h5 class="card-header"><a href="loginPage.php"> Login </a> or <a href="register.php">Register</a> to comment</h5>
                        <div class="card-body">
                            <form name="Comment" method="post">
                                <div class="form-group">
                                </div>
                            </form>
                        </div>
                    </div>';
            } else {
                echo '<div class="card">
                        <h5 class="card-header">Leave a Comment:</h5>
                        <div class="card-body">
                            <form name="Comment" method="post">
                                <div class="form-group">
                                    <textarea class="form-control" style="resize: none" name="comment" rows="3" placeholder="Comment" required></textarea>
                                    <button type="submit" class="btn btn-primary my-2" name="commentPosted">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>';
            }
            ?>

                    <!---Comment Display Section --->
                    <?php
                    for ($i = 0; $i < count($comments); $i++) {
                        $commentUserID = $comments[$i]->userID;
                        $commentUser = new Users();
                        $commentUser->initWithUid($commentUserID);
                        if (isset($_SESSION['roleID']) && $_SESSION['roleID'] == '0') {
                            echo '<div class="card mb-3 my-2">
                    <div class="card-body">
                      <div class="d-flex flex-start">
                        <div class="w-100">
                          <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="text-primary fw-bold mb-0">
                              ' . $commentUser->getUserName() . '
                              <span class="text-dark fw-normal ms-2">' . $comments[$i]->commentText . '</span>
                            </h6>
                          </div>
                            <div class="d-flex justify-content-between align-items-center">
                                ' . $comments[$i]->creationDate . '
                                <p class="small mb-0" style="color: #aaa;">
                                <a href="delete_comment.php?id='. $comments[$i]->commentID .'">Remove Comment</a> 
                                </p>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
                        } else {
                            echo '<div class="card mb-3 my-2">
                    <div class="card-body">
                      <div class="d-flex flex-start">
                        <div class="w-100">
                          <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="text-primary fw-bold mb-0">
                              ' . $commentUser->getUserName() . '
                              <span class="text-dark fw-normal ms-2">' . $comments[$i]->commentText . '</span>
                            </h6>
                          </div>
                            <div class="d-flex justify-content-between align-items-center">
                                ' . $comments[$i]->creationDate . '
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
                        }
                    }
                    ?>
                </div>
            </div>                
        </div>


        <?php include('footer.html'); ?>


        <!-- Bootstrap core JavaScript -->
        <script src="bootstrap/jquery/jquery.min.js"></script>
        <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>

</html>
