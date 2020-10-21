<?php

namespace App\Http\Helpers;

trait General 
{

  public function getArrayKeyByValue($array,$key,$value,$iWant="key"){
    foreach($array as $k => $val){
      if($val[$key] == $value){
        if($iWant == "key"){
          return $k;
        }elseif($iWant == "check"){
          return true;
        }
      }
    }
  }



}
