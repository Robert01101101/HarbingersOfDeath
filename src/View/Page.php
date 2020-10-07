<?php


namespace Page;


class Page
{
    public static function build($page, $arguments = []){
        extract($arguments);

        if (is_array($arguments)) {
            extract($arguments);
        }
        require ('template/pages/' . $page . '.php');
        require('template/layouts/layout.php');

    }

}
