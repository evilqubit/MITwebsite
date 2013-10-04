<?php

/**
 * String Helper Class
 *
 * @author     AB
 * @version    2-20120312
 */
class StringHelper{

    /**
     * Generate random string
     *
     * @param   string  length of string generated
     * @return  string
     */
    public static function generateString($length=10){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $string = '';
        for($p = 0; $p < $length; $p++){
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }
        return $string;
    }

    /**
     * Ellipsize String
     *
     * This function will strip tags from a string, split it at its max_length and ellipsize
     *
     * @param	string		string to ellipsize
     * @param	integer		max length of string
     * @param	mixed		int (1|0) or float, .5, .2, etc for position to split
     * @param	string		ellipsis ; Default '...'
     * @return	string		ellipsized string
     * @filesource  CodeIgniter
     */
    function ellipsize($str, $max_length, $position = 1, $ellipsis = '&hellip;'){
        // Strip tags
        $str = trim(strip_tags($str));

        // Is the string long enough to ellipsize?
        if(strlen($str) <= $max_length){
            return $str;
        }

        $beg = substr($str, 0, floor($max_length * $position));

        $position = ($position > 1) ? 1 : $position;

        if($position === 1){
            $end = substr($str, 0, -($max_length - strlen($beg)));
        }
        else{
            $end = substr($str, -($max_length - strlen($beg)));
        }

        return $beg.$ellipsis.$end;
    }

}

