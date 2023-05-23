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
   <?php include 'header.php';?>

    <?php
    
    session_start();
    
    $articlesObj = new Articles();
    $msg = null; // used to inform user of search results
    
    if(isset($_GET["catID"])){
        $catID = $_GET["catID"];
        $articles = $articlesObj->getAllArticlesCat($catID);
    } else {
        $articles = $articlesObj->getAllArticles();
    }
    
    // check if user searched for articles
    if (isset($_GET['searchtitle'])) {
        $msg = "Displaying search results for ".$_GET['searchtitle'];
        $search = trim($_GET['searchtitle']);
        $articles = $articlesObj->ShowArticles($search);
}
    ?>
    
    <!-- Whole Page Content -->
    <div class="container">
        
        <!-- Centering the Blog Posts -->
      <div class="row" style="margin-top: 4%">
        <!-- Blog Entries Column -->
        <div class="col-md-8 my-5">
            <?php
            // display message to user showing search results
            if (isset($_GET['searchtitle'])) {
                echo "<h2>$msg</h2><br>";
            }
            ?>
          <!-- Blog Post Card-->
          <?php 
          
          if(!empty($articles)){
              for($i =0; $i < count($articles); $i++){  
            $catObj = new Categories();
            $catObj->initWithCatID($articles[$i]->catID);
            
            echo '<div class="card mb-4">
            <img class="card-img-top" src="images/heat.png">
            
            <div class="card-body">
            <!--category-->
              <p><a class="badge bg-secondary text-decoration-none link-light" href="index.php?catID='.$catObj->getCatID().'" style="color:#fff">'.$catObj->getCatName().'</a>
            
            <!--Title-->            
                <h2 class="card-title">'.$articles[$i]->title.'</h2>
                  <a href="view_article?artID='.$articles[$i]->articleID.'.php" class="btn btn-primary">Read Article!</a>
                </div>
              
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

