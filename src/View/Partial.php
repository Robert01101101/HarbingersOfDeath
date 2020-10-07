<?php


namespace View;

// TODO: make sure that $partialName isn't overridden by extract
class Partial
{
    public static function build($partialName, $arguements = []){

        if (is_array($arguements)){
            extract($arguements);
        }
        require('template/partials/' . $partialName . '.php');
    }
}