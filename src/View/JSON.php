<?php


namespace View;


class JSON
{
    public static function generate($pageName, $arguments = []){
        // extract variable
        if (is_array($arguments)) extract($arguments);


        // TODO: proper error detection
        $pagePath = 'template/JSON/' . $pageName . '.php';
        if (isset($pagePath) && file_exists($pagePath)) {
            require($pagePath);
        } else {
            echo "Template: " . $pagePath . " not found";
        }

    }
}