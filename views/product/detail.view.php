<?php 
    $pageTitle = "Product Details";
    include('../../partials/header.php') ;
    # importing the mongodb class 
    require_once('../../vendor/autoload.php');
    require_once('../../config/MongoDB.php');
    require_once('../../config/voter.php');
    require_once('../../config/Products.php');
    
    // GETTING the id from /index.php page
    if(isset($_GET['id'])){
        # SAving the product ID before unsetting it
        $ProductID = $_GET['id'];
        unset($_GET['id']);
    }

    // Vote management
    if(isset($_POST['vote'])){
        # SAving the product ID before unsetting it
        $ProductID = $_SESSION['ProductID'];
        unset($_SESSION['ProductID']);
     
        #VOte effectif
        $resultVote = (new voter($ProductID))->upvote();
    }

    $product = (new Products())->GetProduct( $ProductID );       
    # Getting the username      
    $userGot = (new MongoDB )->getUserByID($product['user']);
    $userName = $userGot['username'];

?> 

<br><br><br>
<div class="container">
    <div class="row">
        <div class="col-2">
            <img src="<?php echo $product['icon'] ?>" class="img-fluid" />
        </div>

        <div class="col-10">
            <h1><?php echo $product['title'] ?></h1>
        </div>
    </div>
    <br />

    <div class="row">
        <div class="col-8">
            <img src="<?php echo $product['image'] ?>" class="img-fluid" />
        </div>

        <div class="col-4">
            <form action=<?php /*The htmlentities() function encodes the HTML entities.Now if the user tries to exploit the PHP_SELF variable, the attempt will fail*/ 
                        #if the user is logged in
                        if (isset($_SESSION['authentificated']) && $_SESSION['authentificated']==TRUE){
                            echo  htmlentities($_SERVER['PHP_SELF']);
                            $_SESSION['ProductID']=$product['_id'];
                        }else{
                            echo '/views/account/signup.php';
                        }                       
                         ?> 
            method="POST" id='upvote'>
                <button class="btn btn-primary btn-lg btn-block"><i class="fa fa-caret-up">
                    </i> Upvote  <?php echo $product['votes'] ?> </button>
                <input type="hidden" name='vote'>   
            </form>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-4">
            <h4><i class="fa fa-search"></i> Hunted by  <?php echo $userName ?></h4>
        </div>

        <div class="col-4 text-right">
            <h4><i class="far fa-clock"></i> <?php echo $product['pub_date'] ?></h4>
        </div>

    </div>
    <br />
    <div class="row">

        <div class="col-8">
            <p> <?php echo $product['body'] ?></p>
        </div>

    </div>
</div>


<?php 
    include('../../partials/footer.php'); 
?> 