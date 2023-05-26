<?php
    $categoryObj = new Categories();
    $categories = $categoryObj->getAllCategories();
    $users = new Users();
    $authors = $users->getAllUsersRole(1);
?>


<head>
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
        })
    
    </script>
</head>
<!-- Sidebar Content -->
<div class="col-md-4 my-5">

  <!-- Search Widget -->
  <div class="card mb-4">
    <h5 class="card-header">Search</h5>
    <div class="card-body">
      <form name="search" action="index.php" method="get">
        <div class="input-group">

          <input type="text" name="searchtitle" class="form-control" placeholder="Search title..." value="<?php echo $_GET['searchtitle'] ?>" required>
          <span class="input-group-btn">
            <button class="btn btn-secondary" type="submit">Go!</button>
          </span>
      </form>
    </div>
          <button class="btn btn-secondary" id="advanceBTN" name="advanceBTN" type="button">Show Advanced Search</button>
          <div class="input-group" id="advanceDiv">
              <form id="advancedSearch" name="advancedSearch" action="index.php" method="post">
                  <hr> 
                  <input type="text" name="searchtitle" class="form-control" placeholder="Search title..." value="<?php echo $_POST['searchtitle'] ?>"> <br>
                <select id="author" name="authorID">
                    <option value="" disabled selected>--Select an Author--</option>
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
            </form>
          </div>
  </div>
</div>

<!-- Categories Widget -->
<div class="card my-4">
  <h5 class="card-header">Categories</h5>
  <div class="card-body">
    <div class="row">
      <div class="flex justify-content-between">
            <form name="category" action="index.php" method="get">
                <select id="category" name="catID">
                    <option value="" disabled selected>--Select a Category--</option>
                    <?php 
                    // loop through list of all categories
                        for($i =0; $i < count($categories); $i++){
                            $selected = $_GET['catID']; // used to check if user already selected a category
                            // check category id to retain selected value after submit
                            if ($categories[$i]->catID == $selected) {
                            echo '<option value="'.$categories[$i]->catID.'" selected="selected">'.$categories[$i]->catName.'</option>'; // insert category in dropdown list
                            } else {
                                echo '<option value="'.$categories[$i]->catID.'">'.$categories[$i]->catName.'</option>'; // insert category in dropdown list
                            }
                        }
                    ?>
                </select>
                <button class="btn btn-secondary" type="submit">Go!</button>
            </form>
      </div>

    </div>
  </div>
</div>

<!-- Side Widget -->
<div class="card my-4">
  <h5 class="card-header">Recent News</h5>
  <div class="card-body">
    <ul class="mb-0">
      Placeholder for Recent News
        <li>
          Placeholder for Recent News Link
        </li>
    </ul>
  </div>
</div>


<!-- Side Widget -->
<div class="card my-4">
  <h5 class="card-header">Popular News</h5>
  <div class="card-body">
    <ul>
      Placeholder for Popular news
        <li>
          Placeholder for Popular news link
        </li>
    </ul>
  </div>
</div>

</div>
