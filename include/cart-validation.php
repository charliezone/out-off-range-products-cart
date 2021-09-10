<?php
namespace Out_Off_Range_Products_Cart\Validator;

require_once(dirname(__FILE__).'/cart-model.php');
require_once(dirname(__FILE__).'/utils.php');

use Out_Off_Range_Products_Cart\Cart_Model\{CartModelEcuador, CartModelPanama, CartModelMaritimo};

use Out_Off_Range_Products_Cart\Utils\{Miscelanea, Region};

Class CartValidation
{
    use Miscelanea, Region;
    protected $cart;

    public function __construct($cart)
    {
        $this->cart = $cart;
    }

    public function validateEcuador( $product_id, $quantity )
    {
        $product = wc_get_product( $product_id );
        $region = $this->getRegion( $product->get_name() );
        $tipo_mercancia = get_field( 'mercancia', $product_id );

        if( $region == 'Ecuador' ) {
            $ecuador = new CartModelEcuador($this->cart);

            if( $this->isMiscelaneas( $tipo_mercancia ) ){
                return $ecuador->getCartItems()['miscelaneas'] + $quantity <= 10;
            }else {
                return $ecuador->getCartItems()['no miscelaneas'] + $quantity <= 2;
            }
        }else{
            return true;
        }
    }

    public function validatePanama($product_id, $quantity)
    {
        $product = wc_get_product( $product_id );
        $region = $this->getRegion( $product->get_name() );
        $tipo_mercancia = get_field( 'mercancia', $product_id );

        if( $region == 'Panama' ) {
            $panama = new CartModelPanama($this->cart);

            if( $this->isMiscelaneas( $tipo_mercancia ) ){
                return $panama->getCartItems()['miscelaneas'] + $quantity <= 9;
            }else {
                return $panama->getCartItems()['no miscelaneas'] + $quantity <= 2;
            }
        }else{
            return true;
        }
    }

    public function validateMaritimo($product_id, $quantity)
    {
        $product = wc_get_product( $product_id );
        $region = $this->getRegion( $product->get_name() );

        if( $region == 'Maritimo' ) {
            $maritimo = new CartModelMaritimo($this->cart);

            return $maritimo->getCartItems() + $quantity <= 2;
        }else{
            return true;
        }
    }
}