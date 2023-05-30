<?php include 'header.php';?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>News Portal | Home Page</title>

    <!-- Bootstrap core -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="modern-business.css" rel="stylesheet">

  </head>

  <body>

    <!-- The Navigation Menu -->
   <?php include 'header.php';
   
   $current = 0;
   $increment = 10;
   $articleObj = new Articles();
   $count = $articleObj->getPublishedArticlesCount();
   $maxPage = $count/$increment;
   
   if(isset($_GET['pageno'])){
       
    $current = (int) $_GET['pageno'];
    
    if($current < 0){
        echo "<script>window.top.location='index.php'</script>";
    }
    
    if($maxPage < 1 and $maxPage > 0){
        echo "<script>window.top.location='index.php?'</script>";
    }
    
    if($current > floor($maxPage)){
        echo '<script>window.top.location="index.php?pageno='.ceil($maxPage).'"</script>';
    }
    
    $start = $current * $increment;
    echo $start;
   }else{
        $start = 0;
    }
   ?>

    
    
    <?php
    
    $articlesObj = new Articles();
    $search = new Search();
    $msg = null; // used to inform user of search results
    
    if(isset($_GET["catID"])){
        $catID = $_GET["catID"];
        $articles = $articlesObj->getAllArticlesCat($catID);
    } else {
        $articles = $articlesObj->getAllPublishedArticles($start,$increment);
    }
    
    // check if user searched for articles

    if (isset($_GET['searchtitle'])) {
        $msg = "Displaying search results for ".$_GET['searchtitle'];
        $search = trim($_GET['searchtitle']);
        $articles = $articlesObj->ShowArticles($search);
        }
        
    // if form is subbmited
    if (isset($_POST['submitted'])) {
        $title = $_POST['advTitle'];
        $authorID = $_POST['authorID'];
        $popular = $_POST['popular'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        if ($title != "") {
            $msg = "Displaying advanced search results for ".$title;
        } else {
            $msg = "Displaying advanced search results";
        }
        $articles = $search->ShowAdvancedArticles($title, $authorID, $popular, $startDate, $endDate);
        }
    ?>
    
    
    <!-- Whole Page Content -->
    <div class="container">
        <?php echo $_SERVER['REQUEST_URI']; ?>
        <!-- Centering the Blog Posts -->
      <div class="row" style="margin-top: 4%">
        <!-- Blog Entries Column -->
        <div class="col-md-8 my-5">
            <?php
            // display message to user showing search results
            if (isset($_GET['searchtitle']) || isset($_POST['submitted'])) {
                echo "<h2>$msg</h2><br>";
            }
            ?>
          <!-- Blog Post Card-->
          <?php 
          
          if(!empty($articles)){
              
              for($i =0; $i < count($articles); $i++){  
                $id = $articles[$i]->articleID;
                
                $catObj = new Categories();
                $catObj->initWithCatID($articles[$i]->catID);
                
                $filesObj = new Files();
                $filesObj->getArticleFiles($id);
                $firstImagePath = $filesObj->getFirstArticleImage($id);
                
            echo '<div class="card mb-4">
            <img class="card-img-left" src='.$firstImagePath.'>
            
            <div class="card-body">
            <!--category-->
              <p><a class="badge bg-secondary text-decoration-none link-light" href="index.php?catID='.$catObj->getCatID().'" style="color:#fff">'.$catObj->getCatName().'</a>
            
            <!--Title-->            
                <h2 class="card-title">'.$articles[$i]->title.'</h2>
                <p class="card-text text-muted">'.$articles[$i]->description.'</p>                
                <a href="view_article.php?artID='.$articles[$i]->articleID.'" class="btn btn-primary">Read Article!</a>
            </div>
                
            <!--Description-->
                
              
            
            <!-- Date Published -->
                <div class="card-footer text-muted">
                  Posted on '.$articles[$i]->publishDate.'
                </div>
          </div>  ';
              
          }
        } else {
            echo "<h1>There are no articles to display!</h1>";
        }
          
          ?>
          
          <!-- Pagination Section for later -->
          <div>
              <a class="btn btn-outline-dark <?php if($current == 0) echo 'disabled' ?>" role ="button" href="index.php?pageno=<?php echo $current - 1; ?>">Previous Page</a>
              <a class="btn btn-outline-dark <?php if($current == floor($maxPage)) echo 'disabled'?>" role ="button"href="index.php?pageno=<?php echo $current + 1; ?>">Next Page</a>
          </div>
          <?php echo $current . ' ' . $maxPage; ?>
        </div>

        <!-- Sidebar Widgets Column -->
      <?php include 'sidebar.php';?>
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
      <?php include 'footer.html';?>

</html>

