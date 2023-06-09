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
<!-- Sidebar Content -->
<div class="col-md-4 my-5">

  <!-- Search Widget -->
  <div class="card mb-4">
    <h5 class="card-header"><?php echo $lang['SEARCH']; ?></h5>
    <div class="card-body">
      <form name="search" action="index.php" method="get">
        <div class="input-group">

          <input type="text" name="searchtitle" class="form-control" placeholder="<?php echo $lang['SEARCHT']; ?>" value="<?php echo $_GET['searchtitle'] ?>" required>
          <span class="input-group-btn">
            <button class="btn btn-secondary" type="submit"><?php echo $lang['GO']; ?></button>
          </span>
      </form>
    </div>
          <button class="btn btn-secondary" id="advanceBTN" name="advanceBTN" type="button"><?php echo $lang['SEARCHA']; ?></button>
          <div class="input-group" id="advanceDiv">
              <form id="advancedSearch" name="advancedSearch" action="index.php" method="post">
                  <hr> 
                  <input type="text" id="advTitle" name="advTitle" class="form-control" placeholder="<?php echo $lang['SEARCHT']; ?>" value="<?php echo $_POST['advTitle'] ?>"> <br>
                <select id="author" name="authorID">
                    <option value="" disabled selected hidden><?php echo $lang['AUTHORS']; ?></option>
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
                  <label for="popular"> <?php echo $lang['MOSTP']; ?></label><br>
                  <span id="dateMsg" style="color:#ff3333;"></span>
                  <label for="startDate"> <?php echo $lang['BETWEEND']; ?></label><br>
                  <input type="date" id="startDate" name="startDate" value="<?php echo $_POST['startDate'] ?>"><br>
                  <label for="endDate"> <?php echo $lang['ANDD']; ?></label><br>
                  <input type="date" id="endDate" name="endDate" value="<?php echo $_POST['endDate'] ?>"><br><br>
                <button class="btn btn-secondary" name="submitted" type="submit">Go!</button>
                <button class="btn btn-secondary" style="background-color:#999999" id="clear" type="button">Clear</button>
            </form>
          </div>
  </div>
</div>

<!-- Categories Widget -->
<div class="card my-4">
  <h5 class="card-header"><?php echo $lang['CAT']; ?></h5>
  <div class="card-body">
    <div class="row">
      <div class="flex justify-content-between">
            <form name="category" action="index.php" method="get">
                <select id="category" name="catID">
                    <option value="" disabled selected hidden><?php echo $lang['CATS']; ?></option>
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
                <button class="btn btn-secondary" type="submit"><?php echo $lang['GO']; ?></button>
            </form>
      </div>

    </div>
  </div>
</div>

</div>
