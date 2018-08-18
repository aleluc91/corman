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

    public static function getAllPublications(string $authorName, string $authorSurname)
    {
        $url = "http://dblp.org/search/publ/api?q={$authorName}_{$authorSurname}&format=json&h=100";
        $jsonPublications = file_get_contents($url);
        $publications = json_decode($jsonPublications, true);
        $publicationList = array();
        foreach ($publications['result']['hits']['hit'] as $hit) {
            $publication = new DblpPublication();
            $id = $hit['@id'];
            $publication->setId($id);
            $info = $hit['info'];
            array_push($publicationList, self::filterInfo($info, $publication));
        }
        return $publicationList;
    }


    public static function getAuthorId($author)
    {
        $url = "http://dblp.org/search/author/api?q=";
        $completeNamePart = explode(" ", $author);
        foreach ($completeNamePart as $part) {
            $url = $url . $part . "_";
        }
        $url = $url . "&format=json";
        $dblpAuthor = file_get_contents($url);
        $author = json_decode($dblpAuthor, true);
        $dblpId = null;
        foreach ($author['result']['hits']['hit'] as $value) {
            $dblpId = $value['@id'];
        }
        return $dblpId;
    }

    private static function filterInfo($info, $publication)
    {
        foreach ($info as $key => $value) {
            switch ($key) {
                case 'authors':
                    if(is_array($info[$key]['author']))
                        $publication->setAuthors($info[$key]['author']);
                    else
                        $publication->setAuthors(array($info[$key]['author']));
                    break;
                case 'title' :
                    $publication->setTitle($value);
                    break;
                case 'venue' :
                    if(is_array($value)){
                        $venues = "";
                        $arrayKeys = array_keys($value);
                        $lastArrayKey = end($arrayKeys);
                        foreach($value as $key => $value) {
                            $venues = $venues . $value;
                            if($key !== $lastArrayKey)
                                $venues = $venues . ",";
                        }
                        $publication->setVenue($venues);
                    }else{
                        $publication->setVenue($value);
                    }
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