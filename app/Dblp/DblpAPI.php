<?php
/**
 * Created by PhpStorm.
 * User: alelu
 * Date: 13/08/2018
 * Time: 16:26
 */

namespace App;


class DblpAPI
{

    public static function getAllPublications(string $authorName , string $authorSurname){
        $url = "http://dblp.org/search/publ/api?q={$authorName}_{$authorSurname}&h=500&format=json";
        $jsonPublications = file_get_contents($url);
        $publications = json_decode($jsonPublications , true);
        $total = $publications['result']['hits']['@sent'];
        $publicationList = array();
        foreach($publications['result']['hits']['hit'] as $hit){
            $id = $hit['@id'];
            $title = $hit['info']['title'];
            $venue = $hit['info']['venue'];
            $pages = $hit['info']['pages'];
            $year = $hit['info']['year'];
            $type = $hit['info']['type'];
            $key = $hit['info']['key'];
            $doi = $hit['info']['doi'];
            $ee = $hit['info']['ee'];
            $url = $hit['info']['url'];
            $publication = new DblpPublication($id , $title , $year , $type , $key , $doi , $ee , $url);
            array_push($publicationList , $publication);
        }
        var_dump($publicationList);
        //$sent = $publications['result']['hits']['@sent'];
        //var_dump($publications);
    }

}