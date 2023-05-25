<?php
    $categoryObj = new Categories();
    $categories = $categoryObj->getAllCategories();
?>

<!-- Sidebar Content -->
<div class="col-md-4 my-5">

  <!-- Search Widget -->
  <div class="card mb-4">
    <h5 class="card-header">Search</h5>
    <div class="card-body">
      <form name="search" action="index.php" method="get">
        <div class="input-group">

          <input type="text" name="searchtitle" class="form-control" placeholder="Search for..." value="<?php echo $_GET['searchtitle'] ?>" required>
          <span class="input-group-btn">
            <button class="btn btn-secondary" type="submit">Go!</button>
          </span>
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
                        for($i =0; $i < count($categories); $i++){
                            $selected = $_GET['catID'];
                            if ($categories[$i]->catID == $selected) {
                            echo '<option value="'.$categories[$i]->catID.'" selected="selected">'.$categories[$i]->catName.'</option>';
                            } else {
                                echo '<option value="'.$categories[$i]->catID.'">'.$categories[$i]->catName.'</option>';
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