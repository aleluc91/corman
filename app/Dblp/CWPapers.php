<?php
/**
 * Created by PhpStorm.
 * User: alelu
 * Date: 13/08/2018
 * Time: 21:24
 */

namespace App\Dblp;


use App\DblpType;

class CWPapers extends DblpType
{

    const TYPE_NAME = "Conference and Workshop Paper";

    public function getTypeName() : string{
        return self::TYPE_NAME;
    }

}