<?php
require_once './templates/header.tpl.php';
require_once '../models/Bakery.php'; ?>
<?php 
$view = new Bakery;
$images = $view->get_picture();

?>
<div class="jumbotron jumbotron-fluid" style="background-image: url('./images/pastry.png'); background-size: cover; background-repeat: no-repeat;">
  <div class="container">
    <h1 class="display-4 text-light font-weight-bold">Welcome to LaLa Pâtisserie</h1>
    <p class="lead text-light font-weight-bold">Sweet almighty goodness treats!</p>
  </div>
</div>
<h2 class="display-4 text-center">Our Products</h2>
<div id="carouselExampleCaptions" class="carousel slide container" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner bg bg-dark">  
    <?php 
        
        for($i=0; $i < count($images); $i++){
            $name = substr($images[$i], 0, -4);
            $replace = preg_replace('/_/', '&nbsp;', $name);
            $regular = ucwords($replace);
            if($i == 1){ //active page
                echo "            
                    <div class='carousel-item active text-center'>
                        <img src='./images/{$images[$i]}' height='350px' class='d-block img-fluid w-60 mx-auto' alt='{$regular}'>
                        <div class='carousel-caption d-none d-md-block'>
                        <h5><span class='bg bg-dark p-2'>{$regular}</span></h5>
                        </div>
                    </div>
                ";
            }else{
                echo "

                    <div class='carousel-item text-center'>
                        <img src='./images/{$images[$i]}' height='350px' class='d-block img-fluid w-60 mx-auto' alt='{$regular}'>
                        <div class='carousel-caption d-none d-md-block'>
                        <h5?<span class='bg bg-dark p-2'>{$regular}</span></h5>
                        </div>
                    </div>
                ";
            }
        }
    ?>
    </div>
      <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<br>

<h2 class="display-4 text-center">What We Offer</h2>
<div class="container">
  <div class="row d-flex justify-content-center">
  <?php 
    $feature_cards = $view->get_features();
      foreach($feature_cards as $card => $feature){
        echo '
        <div class="col-xs-5 col-sm-5 col-md-4 col-lg-4">
          <div class="card shadow-lg mb-2">
              <img class="card-img-top img-fluid w-100" src="./images/'.$feature_cards[$card]['picture'].'" alt="'.$feature_cards[$card]['alt'].'">
              <div class="card-body">
                <h3 class="text-center">'.$feature_cards[$card]['title'].'</h3>
                <p class="card-text">'.$feature_cards[$card]['description'].'</p>
              </div>
          </div>
        </div>';
      }
    ?>
  </div>
</div>
<br>

<?php
require_once './templates/footer.tpl.php'; ?>