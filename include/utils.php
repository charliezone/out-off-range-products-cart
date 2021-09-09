<?php
namespace Out_Off_Range_Products_Cart\Utils;

trait Miscelanea
{
    function isMiscelaneas($description)
    {
        if( trim(strtolower($description)) == 'miscelaneas' || $description == null ){
            return true;
        } else {
            return false;
        }
    }
}

trait Region
{
    function getRegion($product)
    {
        $product_name = trim( preg_replace('/^COMBO ||COMBO-||COMBO\s/', '', $product) );

        $firs_letter = substr($product_name, 0, 1);

        if( strtolower($firs_letter) == 'm' || strtolower($firs_letter) == 'b') {
            return 'Maritimo';
        }elseif( strtolower($firs_letter) == 'e' ) {
            return 'Ecuador';
        }else {
            return 'Panama';
        }
    }
}