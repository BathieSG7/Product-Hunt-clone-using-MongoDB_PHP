<?php
    class Products {

        # Directory where we save uploaded files
        private $target_dir = "../../uploads/";
        #The product ID
        private $ProductID;
        function __construct()
        {
            $this->collection=( new MongoDB\Client)->producthuntprojectdb->Products;
        }

        public function __toString(){
            #getting the user's title
            $result = $this->collection->findOne(['_id' => new MongoDB\BSON\ObjectId($this->ProductID) ]);
            $title=$result['title'];
           return $title;
        }

        public function addProduct($productPost,$productFiles){
            /* Do not use extract() on untrusted data, like user input (i.e. $_GET, $_FILES, etc.). 
                If you do, for example if you want to temporarily run old code that relied on register_globals, 
                make sure you use one of the non-overwriting flags values such as EXTR_SKIP and be aware that 
                you should extract in the same order that's defined in variables_order within the php.ini. 
            */
            //EXTR_SKIP - If there is a collision, don't overwrite the existing variable. 
            extract($productPost,EXTR_SKIP);
            extract($productFiles,EXTR_SKIP);

            global $target_dir; 
            # Defining the directories of image and icons
            $iconDir = $target_dir.basename($_FILES['icon']["name"]);
            $imgDir = $target_dir.basename($_FILES['image']["name"]);
             # $this->title=$title;
            $result = $this->collection->insertOne(
                ['title' => $title ,
                'pub_date' => date('d-m-Y H:i:s'),
                'icon' => $iconDir,              
                'image' =>  $imgDir,
                'votes' => (int)0,
                'body' => $body ,
                'product_url' => $url,
                'user' => $_SESSION['userID']
                ]);

            #Saving the product id 
            $this->ProductID=$result;

            return $result->getInsertedId();
        }

        /*
        public function summary(){
            #getting the body 
            $result = $this->collection->findOne(['_id' => $this->$ProductID ]);
            #A rendre plus robuste
            $bodySummary=substr($result['body'], 0, 100);
            return $bodySummary; 
        }*/

        public function GetAllProducts(){
            #getting the products
            return  $this->collection->find(
                [],
                [
                    'limit' => 5,
                    'sort' => ['votes' => -1],
                ]
            ); 
        }

        public function GetProduct($ProductID){
            #getting the product           
            $result = $this->collection->findOne(['_id' =>  new MongoDB\BSON\ObjectId($ProductID) ]);
            return  $result; 
        }

        public function GetUserProducts($userID){
            # TEST IF THE USERID'S CLASS IS MongoDB\BSON\ObjectId
            if (get_class($userID)!="MongoDB\BSON\ObjectId" ){
                $NewUserID =  new MongoDB\BSON\ObjectId($ProductID);
            }else{
                $NewUserID = $userID;
            }
            $result = $this->collection->find(
                ['user' =>  $NewUserID ],            
                [
                    'limit' => 5,
                    'sort' => ['votes' => -1],
                ]
            );
            return  $result; 
        }

        public function DropUserProducts($ProductID){
            $deleteResult = $this->collection->deleteOne(['_id' =>  new MongoDB\BSON\ObjectId($ProductID) ]);
            
            if (isset($deleteResult))
                return true;
            else
                return false;
        }
    }
?>

