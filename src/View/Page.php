<?php


namespace View;


class Page
{
    public static function build($pageName, $arguments = []){
        extract($arguments);

        if (is_array($arguments)) extract($arguments);

        $pagePath = 'templates/pages/' . $pageName . 'php';
        if (file_exists($pagePath)) require($pagePath);

       // require ('template/pages/' . $page . '.php');
        require('template/layouts/layout.php');

    }

}
