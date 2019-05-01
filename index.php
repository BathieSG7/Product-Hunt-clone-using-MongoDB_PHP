<?php 
    $pageTitle = "Home-Product Hunt";
    $HomePageActive="";
    include('./partials/header.php') ;
    # importing the mongodb class 
    require_once('./vendor/autoload.php');
    require_once('./config/MongoDB.php');
    require_once('./config/voter.php');
    require_once('./config/Products.php');

    if(isset($_POST['vote'])){
        $voter=new voter($_SESSION['ProductID']);
        unset($_SESSION['ProductID']);
        #VOte effectif
        $result=$voter->upvote();
    }
?> 



<div class="container">
    <br>

<?php 

$Products = (new Products())->GetAllProducts();
foreach($Products as $product ){
?> 
    <div class="row pt-5">
        <div class="col-md-2">
            <img src=<?php echo $product['icon'] ?> class="img-fluid" />
        </div>
        <div class="col-md-7">
            <a href=<?php echo '/views/product/detail.view.php?id='.$product['_id'] ?>>
                <h2> <?php echo $product['title'] ?> </h2>
            </a>
            <p><?php echo substr($product['body'],0, 150) ?></p>
        </div>
        <div class="col-md-3">
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
<?php 
}
?> 

</div>
<div class="pb-5"></div>


<?php 
    include('./partials/footer.php'); 
?> 