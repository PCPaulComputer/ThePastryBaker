<?php
/**
 * @author Paul M
 * Sanitizing inputs
 */
class Sanitizer {
  //Use regular expression to filter what values 
  //are allowed in a given input from string, number or picture
  public $status = '';
  public static function htmlescape($name) {
    $charset = mb_convert_encoding($name, 'UTF-8', 'UTF-8');
    $encode = htmlspecialchars($charset, ENT_QUOTES, 'UTF-8');
    return $encode;
  }

  public static function some_name($value){
    if(strlen($value) >= 255 || !preg_match("/^[a-zA-Z-'\s]+$/", $value)){
      $status =  "<div class='m-4'>Enter a valid input for the name.</div>";
    } 
  }

  public static function some_description($value){
    if(!preg_match("/^[a-zA-Z-'\s\.\,]+$/", $value)){
      $status =  "<div class='m-4'>Enter a valid input for the description.</div>";
    } 
  }

  public static function some_rating($value){
    $filter_int = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
    if(!preg_match("/^[0-9]+$/", $value)){
      $status = "<div class='m-4'>Enter a valid input for the rating.</div>";
    }
    return (int) $filter_int;
  }
}