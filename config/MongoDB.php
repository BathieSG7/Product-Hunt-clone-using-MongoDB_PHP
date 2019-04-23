<?php
    class MongoDB {

        function __construct()
        {
            $this->db=( new MongoDB\Client)->producthuntprojectdb;
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
        
        public function getUser($username){ 
            #This function returns a object(MongoDB\Model\BSONDocument)  which contains user information     
            $result = $this->db->users->findOne(['username' => $username ]);
            if($result!=null){
                return $result["_id"];
            }
        }

        public function addUser($usercredentials){
            extract($usercredentials);
            $password_hash = password_hash($password1,PASSWORD_BCRYPT);
            $result = $this->db->users->insertOne(
                ['username' => $username ,
                'password' => $password_hash]);
            return $result->getInsertedId();
        }

        public function passwordMatch($password) {
            # Check if the password is correct
            $userID=$_SESSION['userID'];

            #getting the user's data
            $result = $this->db->users->findOne(['_id' => $userID ]);
            
            if (password_verify (  $password , $result["password"])){
                return true;
            }else{
                return false;
            }          
        }
    }
?>

