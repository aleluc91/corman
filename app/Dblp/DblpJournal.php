<?php
/**
 * Created by PhpStorm.
 * User: alelu
 * Date: 13/08/2018
 * Time: 21:18
 */

namespace App\Dblp;


class DblpJournal extends DblpType
{

    const TYPE_NAME = "Journal";
    private $volume;

    /**
     * DblpJournal constructor.
     * @param $volume
     */
    public function __construct($venue , $pages , $volume)
    {
        parent::__construct($venue , $pages);
        $this->volume = $volume;
    }

    /**
     * @return string
     */
    public function getTypeName(): string
    {
        return self::TYPE_NAME;
    }

    /**
     * @return mixed
     */
    public function getVolume()
    {
        return $this->volume;
    }


}