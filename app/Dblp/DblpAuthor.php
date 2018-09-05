<?php
/**
 * Created by PhpStorm.
 * User: alelu
 * Date: 05/09/2018
 * Time: 09:56
 */

namespace App\Dblp;


class DblpAuthor
{

    private $author;
    private $url;

    /**
     * DblpAuthor constructor.
     * @param $author
     * @param $url
     */
    public function __construct($author, $url)
    {
        $this->author = $author;
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }




}