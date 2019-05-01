<?php 
    $pageTitle="User Registration";
    $SignUpActive="";
    include('../../partials/header.php') ; 
    
    $db= new MongoDB;

    # SIGNING UP
    if(isset($_POST['signup'])){
        extract($_POST);
        if(isset($password1)){
            $userDB = $db->getUser($username);
            if($password1==$password2 && isset($userDB)==FALSE ){
                #saving user's ID
                $_SESSION['userID']= $db->addUser($_POST);
                # saving the user's state
                $_SESSION['authentificated']=TRUE;
                header('location: index.view.php');
            }else{
                $_SESSION['authentificated']=FALSE;
            }
        }
    }
    
?> 


<br><br>
<div class="container col-md-4">
    <h4>Sign Up</h4>
    <hr>
    <?php 
        if(isset($_SESSION['authentificated']) && $_SESSION['authentificated']==FALSE ){
            echo '
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                        </button>
                    <strong>Warning:</strong> Password doesn\'t matched
                </div>';
                
            # remove the false value of $_SESSION['authentificated'] For another check
            unset($_SESSION['authentificated']);
        }
        if(isset($userDB)){
            echo '
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                    </button>
                    <strong>Warning:</strong> user '.$_POST['username'].' already exist
                </div>';
        }
    ?>  
    <form action="<?php echo  htmlentities($_SERVER['PHP_SELF']); ?> " method="POST">
    
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
        </div>
        <div class="form-group">
            <label for="password1">Password</label>
            <input type="password" class="form-control" name="password1" id="password1" placeholder="Password" required>
        </div>
        <div class="form-group">
            <label for="password2">Confirm Password</label>
            <input type="password" class="form-control" name="password2" id="password2" placeholder="Confirm Password"
                required>
        </div>
        <input type="submit" name="signup" value="Sign Up!" class="btn btn-primary">
        <button type="reset" class="btn btn-danger"> Reset </button>


    </form>
</div>
<br><br><br><br>

<?php 
    include('../../partials/footer.php'); 
?> 