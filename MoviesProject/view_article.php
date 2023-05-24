<?php
// Gets current URL address for Share feature
$currenturl = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>News Portal | Article Page</title>

        <!-- Bootstrap core CSS -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="bootstrap/css/modern-business.css" rel="stylesheet">

    </head>

    <body>

        <!-- Navigation -->
        <?php include('header.php'); ?>

        <!-- Page Content -->
        <div class="container">
            <div class="row" style="margin-top: 4%">
                
                <!-- Blog Entries Column -->
                <div class="col-md-8">
                    
                    <!-- Blog Post -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h2 class="card-title">Post Title</h2>
                            
                            <!--category-->
                            <a class="badge bg-secondary text-decoration-none link-light" style="color:#fff"> [Category] </a>
                            <p>
                                <b>Posted by </b> <b>[Author Name] on </b> [Insert Date Here] <b> Views: </b></p>
                            <p><strong>Share:</strong> <a href="http://www.facebook.com/share.php?u=<?php echo $currenturl; ?>" target="_blank">Facebook</a> | 
                                <a href="https://twitter.com/share?url=<?php echo $currenturl; ?>" target="_blank">Twitter</a>                                    
                            </p>
                            <hr />

                            <img class="img-fluid rounded" src="images/heat.png">

                            <p class="card-text">Article Content text</p>

                        </div>
                        <div class="card-footer text-muted">


                        </div>
                    </div>
                </div>

                <!-- Sidebar Widgets Column -->
                <?php include('includes/sidebar.php'); ?>
            </div>
            
            <!---Comment Section --->
            <div class="row" style="margin-top: -8%">
                <div class="col-md-8">
                    <div class="card my-4">
                        <h5 class="card-header">Leave a Comment:</h5>
                        <div class="card-body">
                            <form name="Comment" method="post">
                                <input type="hidden" name="csrftoken" value="" />
                                <div class="form-group">
                                    <div class="form-group">
                                        <textarea class="form-control" name="comment" rows="3" placeholder="Comment" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            </form>
                        </div>
                    </div>

                    <!---Comment Display Section --->
                    <div class="media mb-4">
                        <img class="d-flex mr-3 rounded-circle" src="images/usericon.png" alt="">
                        <div class="media-body">
                            <h5 class="mt-0"> <br />
                                <span style="font-size:11px;"><b>Post date of a comment here</b></span>
                            </h5>

                        </div>
                    </div>


                </div>
            </div>
        </div>


        <?php include('includes/footer.php'); ?>


        <!-- Bootstrap core JavaScript -->
        <script src="bootstrap/jquery/jquery.min.js"></script>
        <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

    </body>

</html>
