<?php

/**
 *
 * @author   Ahmed Sakr <prog.sakr@gmail.com>
 */

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Controllers\CartController;
use App\Http\Services\Currency as CurrencyService;
use App\Http\Services\Products as ProductService;
use App\Http\Services\Tax;
class ProcessCartTest extends TestCase
{
    use Tax;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testProcessWithExistInputs()
    {

        $curr = "USD";
        $products = ["T-shirt","T-shirt","Shoes","Jacket"];
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

    }

    public function testCheckMainPage()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    
    public function testProcessWithEmptyInputs()
    {
        $response = $this->post('/cart');

        $response->assertStatus(500);
    }
}
