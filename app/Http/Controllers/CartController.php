<?php

/**
 * CartController : a php class to handle (control) processes of cart
 *
 * @author   Ahmed Sakr <prog.sakr@gmail.com>
 */


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Currency as CurrencyService;
use App\Http\Services\Products as ProductService;

class CartController extends Controller
{
    

    /**
     * __construct function to identify the constants
     */
    public function __construct(){

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function process(Request $request)
    {
    
        $curr = "USD";
        $products = ["T-shirt","T-shirt","Shoes"];
        $currObject = new CurrencyService();
        dd($currObject->getPriceAccordingCurrentCurrency($curr,50));
        
        foreach($products as $key => $product){
            $prodObject = new ProductService();
            $currObject->getPriceAccordingCurrentCurrency($curr,50);
        }
        
    }


}
