<?php
namespace Data;

use Entity\Omen\Omen;
use Taxonomy\Term;

/**
 * Class PageData
 * @package Data
 *
 * THIS IS A WORK IN PROGRESS
 * The goal is to build a container that will hold
 * the base information required to build a page.
 * Is this necessary for a 3 page app? No.
 *
 */
class PageData
{
    private string $title;
    private string $slug;
    private string $absoluteURL;
    private ?object $object;
    private string $base_path;

    public static function buildPageFromOmen(Omen $omen){
        $pageData = new self;
        $pageData->title = $omen->getTitle();
        $pageData->slug = $omen->getSlug();
        $pageData->absoluteURL = "/omen/" . $omen->getSlug();
        $pageData->object = $omen;
    }


}