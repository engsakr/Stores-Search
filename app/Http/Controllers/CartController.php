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
use App\Http\Services\Tax;


class CartController extends Controller
{
    use Tax;

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
        //dd($currObject->getPriceAccordingCurrentCurrency($curr,50));
        // dd(Tax::getTax());
        $subTotal=0.00;$taxes=0.00;$discounts=[];$total=0.00;
        $i = 0;
        $len = count($products);
        foreach($products as $key => $product){
            $prodObject = new ProductService();
            $mainProduct = $prodObject->getProduct($product);
            $subTotal += $mainProduct['amount'];
            if ($i == $len - 1) {//check if last iteration
                $taxes = ($subTotal * Tax::getTax());
            }

            //$currObject->getPriceAccordingCurrentCurrency($curr,50);
            echo "<pre>";
            print_r($mainProduct);
            echo "</pre>";
            $i++;
        }
        echo "<br>".$subTotal;
        echo "<br>".$taxes;
        
    }


}
