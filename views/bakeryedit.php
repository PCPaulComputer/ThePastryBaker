<?php 
/**
 * @author Paul M
 * edit item page
 */
//imports
require_once 'templates/header.tpl.php';
require_once '../utilities/Connection.php';
require_once '../controllers/BakeryController.php';
require_once '../models/Bakery.php';

$connect = new Connection;
$db = $connect->connector();
$status = ''; 
$view = new BakeryController;

if(isset($_GET['id'])):
$records = $view->update($id);
$id = $_GET['id'];
global $name;
global $rating;
global $description;
global $picture;

    if(isset($_POST['name']) || isset($_POST['rating']) 
    || isset($_POST['description']) || isset($_POST['picture']) ){
      $name = $_POST['name'];
      $rating = $_POST['rating'];
      $description = $_POST['description'];
      $picture = $_POST['picture'];
    }

    if(isset($_POST['update']) && isset($_GET['id'])){
        $name = $_POST['name'];
        $rating = $_POST['rating'];
        $description = $_POST['description'];
        $picture = $_POST['picture'];
    }
?>
  <div class="container"> 
  <h2 class="display-4 text-center">Edit your votes</h2>
       <p class="text-center lead">Update your votes about The Pastry Baker products.</p>
       <p class="text-center">You have until the end of the month to cast your votes!</p>
       <div class="row">
          <div class="col-lg-3 col-md-1"></div>
          <div class="col-lg-6 col-md-10 col-sm-12 col-xs-12">
            <form action="" method="post" class="w-100 border border-dark">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="form-group m-4">
                  <label for="name">Name:</label><br>
                  <input type="text" name="name" class="w-100" value="<?php echo $name; ?>" placeholder="<?php echo $name; ?>" id="name" required>
                </div>
                <div class="form-group m-4">
                  <label for="age">Rating:</label><br>
                  <input type="number" name="rating" class="w-100" value="<?php echo $rating; ?>" placeholder="<?php echo $rating; ?>" id="rating" required>
                </div>
                <div class="form-group m-4">
                  <label for="description">Description:</label><br>
                  <textarea name="description" class="w-100" rows=10 value="<?php echo $description; ?>" placeholder="<?php echo $description ?>" id="description"></textarea>
                </div>
                <div class="form-group m-4">
                  <label for="picture">Picture:</label><br>
                  <?php
                  $bake = new Bakery;
                  $pictures = $bake->get_picture();
                  ?>
                  <select name="picture" id="picture" class="w-100">
                      <?php 
                      for($i = 0; $i < count($pictures); $i++){
                          $name = substr($pictures[$i], 0, -4);
                          $replace = preg_replace('/_/', '&nbsp;', $name);
                          $regular = ucwords($replace);
                          $picture = $pictures[$i];
                          echo "<option value='{$picture}' {$bake->get_selected($picture)}>{$regular}</option>";
                      }
                      ?>
                  </select>
              </div>
                <button type="submit" class="btn btn-primary text-center m-4 btn-lg btn-block w-75 text-center mx-auto" name='update'><span class="fa fa-plus"></span>&nbsp;Save Changes</button>
              </form>
            </div>             
          <div class="col-lg-3 col-md-1"></div>
      </div>
  </div>
  <br>
<?php endif; 
$view->update($id);?>
<?php require_once 'templates/footer.tpl.php'; ?>