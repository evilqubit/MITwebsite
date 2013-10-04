<?php
/**
 * Multibyte Helper Class
 *
 * @lastUpdate 7-10-11
 */
class MultibyteHelper {
        
        /** 
         * Converts a multibyte character string
         * to the decimal value of the character
         * 
         * @author CakePHP(tm)
         * @param multibyte string $string
         * @return array
         */
        public static function utf8($string) {
		$map = array();

		$values = array();
		$find = 1;
		$length = strlen($string);

		for ($i = 0; $i < $length; $i++) {
			$value = ord($string[$i]);

			if ($value < 128) {
				$map[] = $value;
			} else {
				if (empty($values)) {
					$find = ($value < 224) ? 2 : 3;
				}
				$values[] = $value;

				if (count($values) === $find) {
					if ($find == 3) {
						$map[] = (($values[0] % 16) * 4096) + (($values[1] % 64) * 64) + ($values[2] % 64);
					} else {
						$map[] = (($values[0] % 32) * 64) + ($values[1] % 64);
					}
					$values = array();
					$find = 1;
				}
			}
		}
		return $map;
	}
        
        /**
         * Get string length.
         *  
         * @author CakePHP(tm)
         * @param string $string The string being checked for length.
         * @return integer $string The number of characters in string 
         */
	public static function strlen($string) {
		if (MultibyteHelper::checkMultibyte($string)) {
			$string = MultibyteHelper::utf8($string);
			return count($string);
		}
		return strlen($string);
	}
        
        /**
         * Check the $string for multibyte characters
         * 
         * @author CakePHP(tm)
         * @param string $string value to test
         * @return boolean
         */
	public static function checkMultibyte($string) {
		$length = strlen($string);

		for ($i = 0; $i < $length; $i++ ) {
			$value = ord(($string[$i]));
			if ($value > 128) {
				return true;
			}
		}
		return false;
	}
	

} 