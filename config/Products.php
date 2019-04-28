<?php
    class Products {

        function __construct()
        {
            $this->collection=( new MongoDB\Client)->producthuntprojectdb->Products;
        }

        public function __toString(){
            #getting the user's title
            $result = $this->collection->findOne(['_id' => $ProductID ]);
            $title=$result['title'];
           return $title;
        }

        public function addProduct($productDetails){
            extract($productDetails);
             # $this->title=$title;
            $result = $this->collection->insertOne(
                ['title' => $title ,
                'pub_date' => date('d-m-Y H:i:s'),
                'icon' => $icon,              
                'image' => $image,
                'votes' => (int)0,
                'body' => $body ,
                'product_url' => $url,
                'user' => $_SESSION['userID']
                ]);

            #Saving the product id
            $this->$ProductID=$result;
            return $result->getInsertedId();
        }

        public function summary(){
            #getting the body 
            $result = $this->collection->findOne(['_id' => $this->$ProductID ]);
            #A rendre plus robuste
            $bodySummary=substr($result['body'], 0, 100);
            return $bodySummary; 
        }
    }
?>

