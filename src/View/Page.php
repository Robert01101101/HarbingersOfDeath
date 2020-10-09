<?php


namespace View;

// TODO: make sure that $pageName isn't overridden by extract

class Page
{
    public static function build($pageName, $arguments = []){

        // extract variable
        if (is_array($arguments)) extract($arguments);

        // TODO: proper error detection
        $pagePath = 'template/pages/' . $pageName . '.php';
        if (isset($pagePath) && file_exists($pagePath)) {
            require($pagePath);
        } else {
            echo "Template: " . $pagePath . " not found";
        }

    }

}
