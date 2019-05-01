<?php 
    $pageTitle="User-Home";
    $MyProductsActive="active";
    
    include('../../partials/header.php') ; 
    # importing the mongodb class 
    require_once('../../vendor/autoload.php');
    require_once('../../config/Products.php');
    
?> 


<div class="container">
    <br>
<?php 
// ERROR CHECK
if(isset($_SESSION['errorMessage']['dropStatus']) ){
    echo '
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
                </button>
            <strong>Warning:</strong>'.$_SESSION['errorMessage']['dropStatus'].' 
        </div>';

    # Unset the error for another attempt
    unset($_SESSION['errorMessage']['dropStatus']);
}
 // SUCCESS CHECK
if(isset($_SESSION['successMessage']['dropStatus']) ){
    echo '
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
                </button>
            <strong>info:</strong>'.$_SESSION['successMessage']['dropStatus'].' 
        </div>';
    # Unset the error for another attempt
    unset($_SESSION['successMessage']['dropStatus']);
}
// Fetching user's Products
$Products = (new Products())->GetUserProducts($_SESSION['userID']);

foreach($Products as $product ){

?> 
    <div class="row pt-5">
        <div class="col-md-2">
            <img src="<?php echo $product['icon'] ?>" class="img-fluid" />
        </div>
        <div class="col-md-6">
            <a href="<?php echo '/views/product/detail.view.php?id='.$product['_id'] ?>">
                <h2><?php echo $product['title'] ?></h2>
            </a>
            <p><?php echo substr($product['body'],0, 150) ?></p>
        </div>
        <div class="col-md-2">
            <button class="btn btn-info btn-lg btn-block" disabled=><i class="fa fa-info-circle"></i> Votes:
            <?php echo $product['votes'] ?></button>
        </div>
        <div class="col-md-2">
            <a href="<?php echo '/views/account/index.php?id='.$product['_id'] ?>"><button class="btn btn-danger btn-lg btn-block"><i
                        class="fa fa-trash-alt"></i> Delete</button></a>
        </div>
    </div>
<?php 
} 
?> 
</div>
<div class="pb-5"></div>


<?php 
    include('../../partials/footer.php'); 
?> 