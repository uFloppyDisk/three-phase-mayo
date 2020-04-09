<?php

class Page  {

  public static $title = "Please set the Title";
  public static $currencyRates = array();
  public static $errors = [];
 
 


  //Display msg Status
  static function showLastActionStatus($lastActionStatus){ 
    ?>
    <?php
      if ($lastActionStatus == LAST_ACTION_OK)  {
        echo '<p class="msgOk">Action performed OK!</p>';
      } else if ($lastActionStatus == LAST_ACTION_NOK) {
        echo '<p class="msgError">ERROR performing last action!</p>';
        foreach(self::$errors as $e) {
          echo '<span class="msgError">'.$e.'<br /></span>';
        }
      }
    
    ?>
   <?php
  }

} 

?>