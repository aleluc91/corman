<?php
/**
 * Created by PhpStorm.
 * User: alelu
 * Date: 13/08/2018
 * Time: 17:49
 */

namespace App;


class DblpPublication
{
    private $id;
    private $title;
    private $year;
    private $type;
    private $key;
    private $doi;
    private $ee;
    private $url;

    /**
     * DblpPublication constructor.
     * @param $id
     * @param $title
     * @param $venue
     * @param $pages
     * @param $year
     * @param $type
     * @param $key
     * @param $doi
     * @param $ee
     * @param $url
     */
    public function __construct($id, $title, $year, $type, $key, $doi, $ee, $url)
    {
        $this->id = $id;
        $this->title = $title;
        $this->year = $year;
        $this->type = $type;
        $this->key = $key;
        $this->doi = $doi;
        $this->ee = $ee;
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return mixed
     */
    public function getDoi()
    {
        return $this->doi;
    }

    /**
     * @return mixed
     */
    public function getEe()
    {
        return $this->ee;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }




}