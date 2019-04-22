  <!-- Page Header -->
  <header class="masthead" style="background-image: url('asset/image/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
              <?php
            session_start();
            if(isset($_SESSION['username'])) {
                echo ' <h2 class="mt-5" align="center"> Welcome ' .$_SESSION["username"]. '</h2>' ; 
            }else{
                echo '
                    <a  class=" btn btn-outline-success mr-3" href="login.php">Login </a>
                    <a  class=" btn btn-outline-success mr-3" href="register.php">Register </a>
                    '; 
                echo ' <h3  class="mt-5" align="center"> Bienvenue !! <br> Veuillez creer un compte pour faire des publications  </h3>' ;
            }
        ?>
            <h1>Galsen Medium</h1>
            <span class="subheading">Permet l'echange des connaissances dans tous les domaines </span>
          </div>
        </div>
      </div>
    </div>
  </header>

  