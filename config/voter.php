<?php
    class Voter {

        function __construct($ProductID)
        {
            $this->collection=( new MongoDB\Client)->producthuntprojectdb->voter;
            # Check if the product id's class is correct 
            if (get_class($this->ProductID)!="MongoDB\BSON\ObjectId" ){
                $this->ProductID =  new MongoDB\BSON\ObjectId($ProductID);
            }else{
                $this->ProductID=$ProductID;
            }
           
            $this->db=( new MongoDB\Client)->producthuntprojectdb;;
        }


        public function upvote(){          
            # if POST isset -- A REVOIR
            #testing if the user already voted for a specific product

            $result = $this->collection->findOne(
            ['userID' => $_SESSION['userID'] ,
             'ProductID' => $this->ProductID
            ] );
           
            if(isset($result)) {
                return false;
            }else{
                # Taking the current  value of votes correponding to the product
                $SelectResult = $this->db->Products->findOne(['_id' => $this->ProductID]);
                #incremation
                $votesAdd = $SelectResult['votes']+1;

                # UPGRADING votes value of the current Product
                $updateResult = $this->db->Products->updateOne(
                    ['_id' => $this->ProductID],
                    ['$set' => ['votes' => $votesAdd]]
                );
                
                # UPGRADING voter collection
                $InsertionResult = $this->collection->insertOne(
                    ['userID' => $_SESSION['userID'],
                     'ProductID' =>   $this->ProductID,
                    ]);

                return true;
            }
        }

        public function DropUserVote(){
            $deleteResult = $this->collection->deleteOne(['ProductID' =>  $this->ProductID ]);
            
            if (isset($deleteResult))
                return true;
            else
                return false;
        }

    }

