<?php
namespace Out_Off_Range_Products_Cart\Cart_Model;

require_once(dirname(__FILE__).'/utils.php');

use Out_Off_Range_Products_Cart\Utils\{Miscelanea, Region};

abstract class CartModel
{
    use Region;

    protected $cart;

    function __construct($cart, $region){
        $cart_items = array();

        foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) {
            if( $this->getRegion( $cart_item['data']->get_name() ) ==  $region){
                array_push( $cart_items, array(
                    'mercancia' => get_field('mercancia', $cart_item['product_id']),
                    'quantity'   => $cart_item['quantity']
                ) ); 
            }
        }

        $this->cart = $cart_items;
    }

    abstract function getCartItems();
}

class CartModelEcuador extends CartModel
{
    use Miscelanea;

    function __construct( $cart )
    {
        parent::__construct($cart, 'Ecuador');
    }

    function getCartItems()
    {
        if( false )
        {
            return false;
        } else {
            $carts = array(
                'miscelaneas'    => 0,
                'no miscelaneas' => 0
            );

            foreach ( $this->cart as $cart_item ) {
                if( $this->isMiscelaneas( $cart_item['mercancia'] ) ){
                    $carts['miscelaneas'] = $carts['miscelaneas'] + $cart_item['quantity'];
                }else {
                    $carts['no miscelaneas'] = $carts['no miscelaneas'] + $cart_item['quantity'];
                }
            }
            
            return $carts;
        }
    }
}

class CartModelPanama extends CartModel
{
    use Miscelanea;

    function __construct( $cart )
    {
        parent::__construct($cart, 'Panama');
    }

    function getCartItems()
    {
        if( false )
        {
            return false;
        } else {
            $carts = array(
                'miscelaneas'    => 0,
                'no miscelaneas' => 0
            );

            foreach ( $this->cart as $cart_item ) {
                if( $this->isMiscelaneas( $cart_item['mercancia'] ) ){
                    $carts['miscelaneas'] = $carts['miscelaneas'] + $cart_item['quantity'];
                }else {
                    $carts['no miscelaneas'] = $carts['no miscelaneas'] + $cart_item['quantity'];
                }
            }
            
            return $carts;
        }
    }
}

class CartModelMaritimo extends CartModel
{
    use Miscelanea;

    function __construct( $cart )
    {
        parent::__construct($cart, 'Maritimo');
    }

    function getCartItems()
    {
        if( false )
        {
            return false;
        } else {
            $carts = 0;

            foreach ( $this->cart as $cart_item ) {
                $carts = $carts + $cart_item['quantity'];
            }
            
            return $carts;
        }
    }
}