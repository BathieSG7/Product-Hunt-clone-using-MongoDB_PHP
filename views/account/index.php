<?php 
    session_start();
    include('../../partials/header.php') ; 
    # importing the mongodb class 
    require_once('../../vendor/autoload.php');
    require_once('../../config/MongoDB.php');
    require_once('../../config/Products.php');
    require_once('../../config/voter.php');

    # Here we drop all Product dependencies 
    $Products = (new Products())->DropUserProducts($_GET['id']);
    $vote = (new voter($_GET['id']))->DropUserVote();
    if($Products && $vote )
        $_SESSION['successMessage']['dropStatus'] = " You've Successfully delete your Product ";
       # echo "You'd Successfully delete your Product ";
    else
        $_SESSION['errorMessage']['dropStatus'] = " An error occured while deleting your Product ";
     # echo  "An error occured while deleting your Product ";

    header('location:index.view.php');