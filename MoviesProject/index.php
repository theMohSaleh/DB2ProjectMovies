<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>News Portal | Home Page</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="modern-business.css" rel="stylesheet">

  </head>

  <body>

    <!-- The Navigation Menu -->
   <?php include 'header.php';?>

    <!-- Whole Page Content -->
    <div class="container">
        
        <!-- Centering the Blog Posts -->
      <div class="row" style="margin-top: 4%">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

          <!-- Blog Post Card-->
          <div class="card mb-4">
                      <img class="card-img-top" src="images/heat.png">
            <div class="card-body">
              <h2 class="card-title"> This is a Post Title Text </h2>
              
              <!--category-->
              <p><a class="badge bg-secondary text-decoration-none link-light" href="" style="color:#fff"> This is the Category Text </a>
                  
              <!--Subcategory--->
              <a class="badge bg-secondary text-decoration-none link-light"  style="color:#fff"> This is a Sub-Category Text </a></p>
       
              <a href="index.php" class="btn btn-primary"> Read More Buttonish &rarr;</a>
            </div>
              
              <!-- Date Published -->
            <div class="card-footer text-muted">
              Posted on [Enter Date Here]
            </div>
          </div>  
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


    <!-- Bootstrap core JavaScript -->
    <script src="bootstrap/jquery/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

 
</head>
  </body>

</html>

