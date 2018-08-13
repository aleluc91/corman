<?php
/**
 * Created by PhpStorm.
 * User: alelu
 * Date: 13/08/2018
 * Time: 21:01
 */

namespace App;


class DblpAuthors
{

    private $name;
    private $surname;

    /**
     * DblpAuthors constructor.
     * @param $name
     * @param $surname
     */
    public function __construct($name, $surname)
    {
        $this->name = $name;
        $this->surname = $surname;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

}