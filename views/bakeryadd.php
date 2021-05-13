<?php
/**
 * @author Paul M
 * add item page
 */ 
require_once './templates/header.tpl.php'; 
require_once '../utilities/Connection.php';
require_once '../utilities/Sanitizer.php'; 
require '../controllers/BakeryController.php';
require '../models/Bakery.php';

$object = new Connection;
$object->connector();

?>
<div class="container">
<h2 class="display-4 text-center">Add a Review Vote</h2>
<p class="text-center lead">Have your voice heard</p>
<p class="text-center">Here at The Pastry Baker, we value every review and we take these feedback seriously.<br />
We'll do our best to offer products that are high quality, safe and ensuring that we have great customer service. <br />
We'll review these comments and implement changes for the better. <br />By the end of the month, the voting period, we'll announce the product winner. Yay!</p>
<div class="row">
    <div class="col-lg-3 col-md-1"></div>
    <div class="col-lg-6 col-md-10 col-sm-12 col-xs-12">
        <form action ="bakeryadd.php" method ="POST" class="w-100 border border-dark">
        <div class="form-group m-4">
            <label for="name">Name:</label><br/>
            <input type="text" name="name" value="" class="w-100 border border-dark" id="name">
            <span><? $nameStatus ?></span>
        </div>
            
        <div class="form-group m-4">
            <label for="rating">Rating:</label><br/>
            <input type="number" name="rating" value="" class="w-100 border border-dark" id="rating" min=1 max=5 >
            <span><? $ratingStatus ?></span>
        </div>
            
        <div class="form-group m-4">
            <label for="description">Description:</label><br/>
            <textarea name="description" value="" id="description" row=5 class="w-100 border border-dark"></textarea>
            <span><? $descriptionStatus ?></span>
        </div>
            
        <div class="form-group m-4">
            <label for="Picture">Picture:</label><br/>
            <?php
            $view = new Bakery;
            $pictures = $view->get_picture();
            ?>
            <select name="picture" id="picture" class="w-100 border border-dark">
                <?php 
                for($i = 0; $i < count($pictures); $i++){
                    $name = substr($pictures[$i], 0, -4);
                    $replace = preg_replace('/_/', '&nbsp;', $name);
                    $regular = ucwords($replace);
                    $picture = $pictures[$i];
                    echo "<option value='{$picture}'>{$regular}</option>";
                }
                ?>
            </select>
            </div>
            
            <br />
            <br />
            <button type="submit" class="btn btn-primary text-center m-4 btn-lg btn-block w-75 text-center mx-auto"><span class="fa fa-plus"></span>&nbsp;Add Entry</button>
            </div>
        
<?php
//transferring data in database
$baker = new BakeryController;
$baker->create();
?>
        </form>
        </div>
        <div class="col-lg-3 col-md-1"></div>
</div>
<br />
    <?php require_once './templates/footer.tpl.php'; ?>