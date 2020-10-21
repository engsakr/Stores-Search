<?php

namespace App\Http\Services;

class Products 
{

    public $available_products; 
    



    public function __construct()
    {

      // method_of_discount accept two enums , 1 refers to percentage and 2 refers to fixed amount
      $this->available_products = [
                                    ["id"=>"1","name"=>"T-shirt","amount"=>"10.99","currency" => "USD","has_sale"=>false,"discount"=>null,"method_of_discount"=>null],
                                    ["id"=>"2","name"=>"Pants","amount"=>"14.99","currency" => "USD","has_sale"=>false,"discount"=>null,"method_of_discount"=>null],
                                    ["id"=>"3","name"=>"Jacket","amount"=>"19.99","currency" => "USD","has_sale"=>false,"discount"=>null,"method_of_discount"=>null],
                                    ["id"=>"4","name"=>"Shoes","amount"=>"24.99","currency" => "USD","has_sale"=>true,"discount"=>10,"method_of_discount"=>1],
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



}
