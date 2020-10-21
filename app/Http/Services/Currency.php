<?php

namespace App\Http\Services;

class Currency 
{

    public $available_curencies; 
    
    public $default_currency;

    private $currency;

    private $amount;

    public function __construct()
    {
      $this->available_curencies = [
                                    ["id"=>"1","currency_code"=>"USD","rate"=>"16","symbol" => "$","is_default" =>true],
                                    ["id"=>"2","currency_code"=>"EGP","rate"=>"0.0625","symbol" => "e£" , "is_default" =>false]
                                   ];
      $this->default_currency = $this->getAvailableCurrencies()[$this->getArrayKeyByValue($this->getAvailableCurrencies(),"is_default",true)]['currency_code'];
      $this->currency = $this->default_currency;
    }


    

    // Getter of Currency
    public function getCurrency() {
      return $this->currency;
    }
  
    // Setter of Currency
    public function setCurrency($currency) {
      $this->currency = $currency;
    }

    // Getter of Amount
    public function getAmount() {
      return $this->amount;
    }
  
    // Setter of Amount
    public function setAmount($amount) {
      $this->amount = $amount;
    }
    
    // Getter of AvailableCurrencies (the setter was done inside the constructor)
    public function getAvailableCurrencies() {
      return $this->available_curencies;
    }

    public function getPriceAccordingCurrentCurrency($currency,$amount){
      // return $this->default_currency;
      if($this->getAvailableCurrencies()[$this->getArrayKeyByValue($this->getAvailableCurrencies(),"is_default",true)]['currency_code'] == $currency){//default currency
         return $amount;
      }else{//new currency
        return ($amount * $this->getAvailableCurrencies()[$this->getArrayKeyByValue($this->getAvailableCurrencies(),"is_default",true)]['rate']);
      }
    }

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
