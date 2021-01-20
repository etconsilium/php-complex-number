<?php

use Math\Complex;

if (!function_exists('is_complex')) {

    function is_complex($param) {
        return ($param instanceof \Math\Complex);
    }

}

if (!function_exists('complex')) {

    /**
     * 
     * @param float $noname real part
     * @param float $noname imaginary part
     * 
     * @param OR array $noname [real, imaginary]
     * @return Math\Complex 
     */
    function complex() {
        return call_user_func_array(['Math\Complex', 'new'], func_get_args());
    }

}
