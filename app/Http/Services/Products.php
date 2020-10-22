<?php

/**
 * Products : a php class to process products of cart
 *
 * @author   Ahmed Sakr <prog.sakr@gmail.com>
 */

namespace App\Http\Services;
use App\Http\Helpers\General as GeneralHelper;


class Products 
{

    use GeneralHelper;

    public $available_products; 
    



    public function __construct()
    {

      // method_of_discount accept two enums , 1 refers to percentage and 2 refers to fixed amount
      $this->available_products = [
                                    ["id"=>"1","name"=>"T-shirt","amount"=>"10.99","currency" => "USD","has_sale"=>false,"discount"=>null,"method_of_discount"=>null],
                                    ["id"=>"2","name"=>"Pants","amount"=>"14.99","currency" => "USD","has_sale"=>false,"discount"=>null,"method_of_discount"=>null],
                                    ["id"=>"3","name"=>"Jacket","amount"=>"19.99","currency" => "USD","has_sale"=>true,"discount"=>"2/T-shirt/0.50/Jacket","method_of_discount"=>2],
                                    ["id"=>"4","name"=>"Shoes","amount"=>"24.99","currency" => "USD","has_sale"=>true,"discount"=>"Shoes/0.10","method_of_discount"=>1],
                                  ];
        /** 
        * I CONSIDERED THAT SYSTEM ACCEPT ONLY ONE LANGUAGE BECAUSE IT IS NOT MENTIONED IN THE DECUMENTATIOIN
        * SO I ASSUMES THAT THE CURRENCY IS USD AND THEN WE CAN GET THE EQUIVELANT WHILE PROCESSING THE ORDER                                
        */ 
    }

    
    // Getter of AvailableProducts (the setter was done inside the constructor)
    public function getAvailableProducts() {
      return $this->available_products;
    }
    
    //get Product
    public function getProduct($productName) {
      return $this->getAvailableProducts()[$this->getArrayKeyByValue($this->getAvailableProducts(),"name",$productName)];
    }

    //process discounts
    /**
     * discount roles follows two criterias as mentioned in documentation of task
     * 
     *  1 - (item)/(percentage)
     *    e.g. 
     *    Shoes/0.10
     * 
     *    That Achieves The Rule  "Shoes are on 10% off."
     * 
     * 
     * 
     *  2 - (number of items) from (item) gives discount (percentage) of (the sale item)
     *      (number of items)/(item)/(percentage)(the sale item)
     *    e.g.
     *    2 from T-shirt gives discount 10% of 
     *    That Achieves The Rule  "Buy two t-shirts and get a jacket half its price."
     *   
     */
    public function processProductDiscount($productName,$productChecker) {
      $product = $this->getProduct($productName);
      if($product['has_sale'] == true && $product['method_of_discount'] == 1 ){ // apply the first algorithm of '(item)/(percentage)'
          $getThings = explode("/",$product['discount']);
          $productName = $getThings[0];
          $percentage = (float) $getThings[1];
          $amountOfPercentage = ($product['amount'] * $percentage);//10% off shoes: -$2.499
          return ["discount"=>$amountOfPercentage,"query" => "$percentage off $productName : $amountOfPercentage"];
      
        }elseif($product['has_sale'] == true && $product['method_of_discount'] == 2 ){ // apply the second algorithm of '(number of items)/(item)/(percentage)(the sale item)'
          $getThings = explode("/",$product['discount']);
          $condition = (int) $getThings[0];
          $productName = $getThings[1];
          $percentage = (float) $getThings[2];
          $target = $getThings[3];
          $ch = isset($productChecker[$productName]) ? $productChecker[$productName] : '';
          if($ch == $condition){
            $productToBeDisounted = $this->getProduct($target);
          }else{
            $productToBeDisounted['amount'] = 0.00;
          }
       
          $amountOfPercentage = ($productToBeDisounted['amount'] * $percentage);
          return ["discount"=>$amountOfPercentage,"query" => "$percentage off $productName : $amountOfPercentage"];
      }
      return ["discount"=>0.0,"query" => ""];
    }



}
