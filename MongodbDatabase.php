<?php
    require_once( './vendor/autoload.php');
    class MongodbDatabase {

        function __construct()
        {
            $this->db=( new MongoDB\Client)-> videoPLaylist->videos;
        }

        public function insertNewItem( $itemInfo = [])
        {
            if( empty( $itemInfo ) ){
                return false;
            }
            // we have some data, so insert them all
            $insertable = $this->db->insertOne([
                'videoTitle' => $itemInfo['videoTitle'],
                'videoLink'  => $itemInfo['videoLink'],
                'videoID'  => $itemInfo['videoID'],
                'videoArtist' => $itemInfo['videoArtist']
            ]);
            // return this inserted documents mongodb id
            return $insertable->getInsertedId(); 
        }
    }


?>