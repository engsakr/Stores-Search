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
     * 
     * 
     */
    public function process(Request $request)
    {
    
        $curr = $request->all()['currency_code'];//"USD";
        $products = $request->all()['products'];//["T-shirt","T-shirt","Shoes","Jacket"];
        $currObject = new CurrencyService();
        $subTotal=0.00;$taxes=0.00;$discounts=[];$discountsAmount=0.00;$total=0.00;
        $i = 0;
        $len = count($products);
        foreach($products as $key => $product){
            
            //initialising new object for ProductService Class
            $prodObject = new ProductService();

            //Match(Find) The Product
            $mainProduct = $prodObject->getProduct($product);
            
            //calculate subTotal
            $subTotal += $currObject->getPriceAccordingCurrentCurrency($curr,$mainProduct['amount']);//$mainProduct['amount'];
            
        
            // calculate discounts
            $proc = $prodObject->processProductDiscount($product,array_count_values($products));
            $discounts[] = $proc['query'];
            $discountsAmount += $proc['discount'];

            

            //calculate taxes
            if ($i == $len - 1) {//check if last iteration to add the taxes
                $taxes = ($subTotal * Tax::getTax());
                $totalAmount = (($subTotal + $taxes) - $discountsAmount) ;
            }

            $i++;
        }

        return response()->json([
            'subTotal' => $subTotal . " " . $curr,
            'taxes' => $taxes . " " . $curr ,
            'discounts' => implode("    &   ",array_values(array_filter( $discounts, 'strlen' ))),
            'totalAmount' => number_format($totalAmount, 2) . " " . $curr
        ]);

        
    }


}
