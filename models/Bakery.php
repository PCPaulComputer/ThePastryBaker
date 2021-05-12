<?php 
/**
 * @author Paul M
 *  Model of the Bakery Web Application to start with building the website
 */



class Bakery {
  /**
   * properties in protected method
   */
  protected $name;
  protected $description;
  protected $rating;
  protected $picture;
  protected $picture_files;
  protected $features;
  /**
   * constructor method setting input values
   * @param array_values
   */
  public function __construct() {
    $this->name = '';
    $this->description = '';
    $this->rating = '';
    $this->picture = '';
    $this->picture_files = [];
    $this->features = [];
  }

  /**
   * getter and setter methods
   */
  public function __get($property) {
    if (property_exists($this, $property)) {
      return $this->$property; // Our $property was missing the dollar sign - that's all it took to break our code.
    }
  }

  public function get_picture(){
    $this->picture_files = [
      'brownies.png',
      'choco_muffins.png',
      'cinnamon_rolls.png',
      'cookies.png',
      'danish_pastry.png',
      'fruit_muffins.png',
      'macaroons.png',
      'pancakes.png',
      'sweet_bread.png',
      'waffles.png'
    ];
    return $this->picture_files;
  }

  public function get_features(){
    $this->features = [
      1 => [
        'title' => 'Affordable',
        'description' => 'Our sweets are affordable so everyone can enjoy. Plus we offer discounts and coupons. Stay tuned!',
        'picture' => 'savings.png',
        'alt' => 'Afford food'
      ],
      2 => [
        'title' => 'High Quality',
        'description' => 'We use state of the art resources to make our products safe and high quality of goodness.',
        'picture' => 'food-handling.png',
        'alt' => 'Safety of food'
      ],
      3 => [
        'title' => 'Variety',
        'description' => 'We take your feedback seriously so we offer a variety of baked goods. Plenty of goodness sweets.',
        'picture' => 'variety.png',
        'alt' => 'Many choices in the menu'
      ]
    ];
    return $this->features;
  }

  public function get_image(){
    return $this->picture;
  }

  public function get_selected($image){
    $temp = $this->get_image();
    if ($image == $temp):
       echo 'selected';
    endif;
  }

  public function set_name(string $value) {
    $this->name = Sanitizer::format_name($value);
  }

  public function set_description(string $value) {
    $this->description = Sanitizer::format_name($value);
  }

  public function set_rating($value) {
    $this->rating = Sanitizer::filter_number($value);
  }

  public function set_picture(string $value) {
    $this->picture = Sanitizer::filter_file($value, $this->picture);

    if (empty($this->picture)) {
      $this->picture = $this->picture_files[0];
    }

  }

}

?>