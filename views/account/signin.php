<?php 
    $pageTitle="User Login";
    $LoginActive="";
    include('../../partials/header.php') ; 
    
    $db= new MongoDB;

    # SIGNING In
    if(isset($_POST['signin'])){
        #extracting user informations
        extract($_POST);
        # getting the user id
        $userID = $db->getUser($username);
        # saving the user's id in the SESSION variable
        $_SESSION['userID']= $userID ;
        # Checking if the password is correct and the user exist
        if($db->passwordMatch($password) && isset($userID) ){                
            $_SESSION['authentificated']=TRUE;
            header('location: index.view.php');
        }else{
            $_SESSION['authentificated']=FALSE;
        }
    }
?> 

<br><br>
<div class="container col-md-4">
    <h4>Login</h4>
    <hr>
    <?php 
        if(isset($_SESSION['authentificated']) && $_SESSION['authentificated']==FALSE ){
            echo '
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert">
                         <span>&times;</span>
                    </button>
                    <strong>Warning:</strong> username or password is incorrect
                </div>';
            # remove the false value of $_SESSION['authentificated'] For another check
            unset($_SESSION['authentificated']);
        }
    ?> 
    <form action="signin.php"  method="POST">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-primary" name=signin >Login</button>
    </form>
</div>
<br><br><br><br>

<?php 
    include('../../partials/footer.php'); 
?> 