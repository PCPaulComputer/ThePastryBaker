<?php 
/**
 * @author Paul M
 * main page - view page with options to edit and delete record
 */
//This is the display for view item for Bakery
require_once './templates/header.tpl.php';
require '../controllers/BakeryController.php';
    //Database connection and controller setup
       $connect = new Connection;
       $db = $connect->connector();

       $view = new BakeryController;
       $records = $view->read();
       ?>
       <div class="container">
       <h2 class="display-4 text-center">The Pastry Baker Feedback Contest</h2>
       <p class="text-center lead">Here are the list of our product review votes!</p>
        <div class="row">
            <?php foreach($records as $record): 
                $id = $record['id']; ?>
            <div class="col-xs-5 col-sm-5 col-md-4 col-lg-4">
                <div class="card shadow-lg mb-2">
                    <img class="card-img-top" src="../views/images/<?php echo Sanitizer::htmlescape($record['picture'])?>" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo Sanitizer::htmlescape($record['name']); ?></h4>
                        <p class="card-text font-weight-bold">Rating: <?php echo $view->rate($record['rating']); ?></p>
                        <p class="card-text"><strong>Description:</strong><br /> <?php echo Sanitizer::htmlescape($record['description']); ?></p>
                        <form action="" method="post">
                            <a href="./bakeryedit.php?id=<?php echo $id?>" class="btn btn-primary btn-lg btn-block w-80 text-center mx-auto"><span class="fa fa-edit"></span>&nbsp;Edit</a>
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <?php 
                            //delete a selected record
                            if(isset($_POST['delete'])){
                                $id = $record['id'];
                                $view->delete($id);
                            }
                            ?>
                            <br>
                            <button type="submit" name="delete" class="btn btn-danger btn-lg btn-block w-80 text-center mx-auto"><span class="fa fa-trash"></span>&nbsp;Delete</button>
                        </form>
                    </div>
                </div>
            </div>        
                    
            <?php endforeach;  // end of foreach row ?> 
            </div>
       </div>
       
<?php require_once './templates/footer.tpl.php';?>