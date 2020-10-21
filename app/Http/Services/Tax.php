<?php

namespace App\Http\Services;


trait Tax 
{



    private static $tax = 0.14;
    


    // Getter of Tax
    public static function getTax() {
      return self::$tax;
    }
  
    // Setter of Tax
    public static function setTax($tax) {
      self::$tax = $tax;
    }




}
