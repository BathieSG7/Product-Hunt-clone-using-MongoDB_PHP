<?php
    class MongoDB {

        function __construct()
        {
            $this->db=( new MongoDB\Client)->producthuntprojectdb;
        }

   
        public function getUser($username){ 
            #This function returns the ID of the user if found     
            $result = $this->db->users->findOne(['username' => $username ]);
            if($result!=null){
                return $result["_id"];
            }
        }

        public function getUserByID($userID){ 
            #This function returns the ID of the user if found     
            $result = $this->db->users->findOne(['_id' => $userID]);
           
            if($result!=null){
                return $result;
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

