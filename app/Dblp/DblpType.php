<?php
/**
 * Created by PhpStorm.
 * User: alelu
 * Date: 13/08/2018
 * Time: 21:16
 */

namespace App\Dblp;


class DblpType
{

    private $venue;
    private $pages;

    /**
     * DblpType constructor.
     * @param $venue
     * @param $pages
     */
    public function __construct($venue, $pages)
    {
        $this->venue = $venue;
        $this->pages = $pages;
    }

    /**
     * @return mixed
     */
    public function getVenue()
    {
        return $this->venue;
    }

    /**
     * @return mixed
     */
    public function getPages()
    {
        return $this->pages;
    }




}