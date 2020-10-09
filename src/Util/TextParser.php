<?php


namespace Util\TextParser;


/**
 * Class TextParser
 * @package Util\TextParser
 *
 * source: http://www.justin-cook.com/2006/03/31/php-parse-a-string-between-two-strings/
 */
class TextParser
{

    /**
     * @param $string The search string
     * @param $start  The
     * @param $end
     * @return string
     *
     * This method returns the value of each key
     * (by checking for the string between key & newline)
     */
    public static function get_string_between($string, $start, $end) : string
    {
        $string = " " . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return "";

        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }
}