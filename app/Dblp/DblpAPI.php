<?php
/**
 * Created by PhpStorm.
 * User: alelu
 * Date: 13/08/2018
 * Time: 16:26
 */

namespace App\Dblp;


use App\Dblp\DblpPublication;

class DblpAPI
{

    public static function getAllPublications(string $authorName , string $authorSurname){
        $url = "http://dblp.org/search/publ/api?q={$authorName}_{$authorSurname}&format=json&h=100";
        $jsonPublications = file_get_contents($url);
        $publications = json_decode($jsonPublications , true);
        //$total = $publications['result']['hits']['@sent'];
        $publicationList = array();
        foreach($publications['result']['hits']['hit'] as $hit ){
            $publication = new DblpPublication();
            $id = $hit['@id'];
            $publication->setId($id);
            $info = $hit['info'];
            array_push($publicationList , self::filterInfo($info , $publication));
        }
        return $publicationList;
    }

    private static function filterInfo($info , $publication){
        foreach($info as $key => $value){
            switch ($key) {
                case 'authors':
                    $publication->setAuthors($info['authors']['author']);
                    var_dump($info['authors']['author']);
                    break;
                case 'title' :
                    $publication->setTitle($value);
                    break;
                case 'venue' :
                    $publication->setVenue($value);
                    break;
                case 'publisher' :
                    $publication->setPublisher($value);
                    break;
                case 'volume' :
                    $publication->setVolume($value);
                    break;
                case 'number' :
                    $publication->setNumber($value);
                    break;
                case 'pages' :
                    $publication->setPages($value);
                    break;
                case 'year' :
                    $publication->setYear($value);
                    break;
                case 'type' :
                    $publication->setType($value);
                    break;
                case 'key' :
                    $publication->setKey($value);
                    break;
                case 'doi' :
                    $publication->setDoi($value);
                    break;
                case 'ee' :
                    $publication->setEe($value);
                    break;
                case 'url' :
                    $publication->setUrl($value);
                    break;
            }
        }
        return $publication;
    }

}