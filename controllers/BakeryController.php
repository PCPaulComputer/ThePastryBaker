<?php
/**
 * @author Paul Madduma
 * Controller
 */

//imports
require_once '../utilities/Connection.php';
require_once '../utilities/Sanitizer.php';
class BakeryController extends Connection {

    /**
     * read function display the data from database
     */
    public function read(){
        //Putting the id in descending order because id auto-increments
        //The higher the number of the id, the more recent it was posted.
        $sql = "SELECT * FROM bakery ORDER BY id";
        $stmt = $this->connector()->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll();
        if(empty($records)){
          return '<div class="alert alert-info m-4 border border-info container">No product reviews available.</div>';
        }
        return $records;
    }

    /**
     * create method part of inputting review in the database
     * bind parameters to manage inputs in database to prevent sql injection
     */
    public function create(){
        $nameStatus = "";
        $ratingStatus = "";
        $descriptionStatus = "";
        $pictureStatus = "";
        $message = "";
        $status = "";
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          $name = $_POST['name'];
          $rating = $_POST['rating'];
          $description = $_POST['description'];
          $picture = $_POST['picture'];
          
          if(!empty($name) || !empty($rating) || !empty($description) 
          || !empty($description)){
            Sanitizer::some_name($name);
            Sanitizer::some_description($description);
            Sanitizer::some_rating($rating);
            $sql = "INSERT INTO `bakery`(`name`, `rating`, `description`, `picture`)".
            "VALUES(:name, :rating, :description, :picture)";
            $sql = $this->connector()->prepare($sql);
            $sql->bindValue(':name', $name);
            $sql->bindValue(':rating', $rating);
            $sql->bindValue(':description', $description);
            $sql->bindValue(':picture', $picture);
            $result = $sql->execute(); 
            if($result){
                $status = "<div class='alert alert-success m-4 border border-info container'><i class='fas fa-check-circle'></i> Your review has been entered successfully!</div>";
            } else {
                $status = "<div class='alert alert-danger m-4 border border-info container'><i class='fa fa-times-circle-o' aria-hidden='true'></i> Error: There are some problems processing your input. 
              \n Please try again answering all required information.</div>";
            }
          } else {
            $status = "<div class='alert alert-danger m-4 border border-info container'><i class='fa fa-times-circle-o' aria-hidden='true'></i> Error: There are some problems processing your input. 
            \n Please try again answering all required information.</div>";
          }
        }

        echo $status;
        
    }

    /**
     * update method part of editing the data content in the database
     * bind values to manage inputs in the database to prevent sql injection
     */
    public function update($id){
      if(isset($_GET['id'])){
        $id = $_GET['id'];
      }
      
      
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name = $_POST['name'];
        $rating = $_POST['rating'];
        $description = $_POST['description'];
        $picture = $_POST['picture'];
      
        if(!empty($name) || !empty($rating) || !empty($description) 
        || !empty($description)){
          Sanitizer::some_name($name);
          Sanitizer::some_description($description);
          Sanitizer::some_rating($rating);
          $query= 'UPDATE `bakery` SET `name`=:name, `rating`=:rating, `description`=:description, `picture`=:picture 
          WHERE `id` = :id';
          $stmt = $this->connector()->prepare($query);
          $stmt->bindValue(':name', $name);
          $stmt->bindValue(':rating', $rating);
          $stmt->bindValue(':description', $description);
          $stmt->bindValue(':picture', $picture);
          $stmt->bindValue(':id', $id);
          $result = $stmt->execute(); 
          if($result){
            $status = "<div class='alert alert-success m-4 border border-success container'><i class='fas fa-check-circle'> Your review has been entered successfully!</div>";
          } else {
              $status = "<div class='alert alert-danger m-4 border border-info container'><i class='fa fa-times-circle-o' aria-hidden='true'></i> Error: There are some problems processing your input. 
            \n Please try again answering all required information.</div>";
          }
          } else {
          $status = "<div class='alert alert-danger m-4 border border-info container'><i class='fa fa-times-circle-o' aria-hidden='true'></i> Error: There are some problems processing your input. 
          \n Please try again answering all required information.</div>";
          }
          
      }
      }
   
    /**
     * delete method, taking out only one record at a time by an onclick event
     * @param $id
     */
    public function delete($id) {
      if(isset($_POST['id'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM `bakery` WHERE id='${id}' LIMIT 1";
        $stmt = $this->connector()->prepare($sql);
        $stmt->execute();
        $this->read();
         }
    }

    /**
     * rate method additional method to display ratings using icons 
     * to help presenting information like a review site
     * @param $point
     * @return star font awesome icons 
     */
    public function rate($point){
      switch($point){
        case 1:
          return '<i class="fas fa-star text-warning"></i>
          <i class="far fa-star text-warning"></i>
          <i class="far fa-star text-warning"></i>
          <i class="far fa-star text-warning"></i>
          <i class="far fa-star text-warning"></i>';
          break;
        case 2:
          return '<i class="fas fa-star text-warning"></i>
          <i class="fas fa-star text-warning"></i>
          <i class="far fa-star text-warning"></i>
          <i class="far fa-star text-warning"></i>
          <i class="far fa-star text-warning"></i>';
          break;
        case 3:
          return '<i class="fas fa-star text-warning"></i>
          <i class="fas fa-star text-warning"></i>
          <i class="fas fa-star text-warning"></i>
          <i class="far fa-star text-warning"></i>
          <i class="far fa-star text-warning"></i>';
          break;
        case 4:
          return '<i class="fas fa-star text-warning"></i>
          <i class="fas fa-star text-warning"></i>
          <i class="fas fa-star text-warning"></i>
          <i class="fas fa-star text-warning"></i>
          <i class="far fa-star text-warning"></i>';
          break;
        case 5:
          return '<i class="fas fa-star text-warning"></i>
          <i class="fas fa-star text-warning"></i>
          <i class="fas fa-star text-warning"></i>
          <i class="fas fa-star text-warning"></i>
          <i class="fas fa-star text-warning"></i>';
          break;
        default:
          return '<i class="far fa-star text-warning"></i>
          <i class="far fa-star text-warning"></i>
          <i class="far fa-star text-warning"></i>
          <i class="far fa-star text-warning"></i>
          <i class="far fa-star text-warning"></i>';
      }
    }

} 

