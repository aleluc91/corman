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
        $url = "http://dblp.org/search/publ/api?q={$authorName}_{$authorSurname}&h=500&format=json";
        $jsonPublications = file_get_contents($url);
        $publications = json_decode($jsonPublications , true);
        $total = $publications['result']['hits']['@sent'];
        $publicationList = array();
        foreach($publications['result']['hits']['hit'] as $hit){
            $publication = new DblpPublication();
            $id = $hit['@id'];
            $publication->setId($id);
            $info = $hit['info'];
            $authors = array();
            foreach($hit['info']['authors'] as $author){
                array_push($authors , $author);
            }
            $publication->setAuthors($authors);
            switch($info){
                case in_array('title' , $info) :
                    $publication->setTitle($info['title']);
                    break;
                case in_array('venue' , $info) :
                    $venues = array();
                    if(count(venue) > 1){
                        foreach($info['venue'] as $venue)
                            array_push($venues , $venue);
                        $publication->setVenue($venues);
                    }else{
                        $publication->setVenue($info['venue']);
                    }
                    break;
                case in_array('publisher' , $info) :
                    $publication->setPublisher($info['publisher']);
                    break;
                case in_array('volume' , $info) :
                    $publication->setVolume($info['volume']);
                    break;
                case in_array('number' , $info) :
                    $publication->setNumber($info['number']);
                    break;
                case in_array('pages' , $info) :
                    $publication->setPages($info['pages']);
                    break;
                case in_array('year' , $info) :
                    $publication->setYear($info['year']);
                    break;
                case in_array('type' , $info) :
                    $publication->setType($info['type']);
                    break;
                case in_array('key' , $info) :
                    $publication->setKey($info['key']);
                    break;
                case in_array('doi' , $info) :
                    $publication->setDoi($info['doi']);
                    break;
                case in_array('ee' , $info) :
                    $publication->setEe($info['ee']);
                    break;
                case in_array('url' , $info) :
                    $publication->setUrl($info['url']);
                    break;
            }
            array_push($publicationList , $publication);
        }
        var_dump($publicationList);
        //$sent = $publications['result']['hits']['@sent'];
        //var_dump($publications);
    }

}