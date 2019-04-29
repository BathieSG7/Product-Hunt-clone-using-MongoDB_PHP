<!-- Navigation -->
<body>
  <header>
      <div class="container">
          <nav class="navbar navbar-expand-lg navbar-light bg-light">
              <a class="navbar-brand" href="/index"><i class="fab fa-product-hunt" style="color:goldenrod; font-size: 27px;"></i>
                  Product Hunt</a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                  aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                  <ul class="navbar-nav ml-auto">
                <?php
                        if (isset($_SESSION['authentificated']) && $_SESSION['authentificated']==TRUE){
                ?>        
                    <li class="nav-item <?php if(isset($HomePageActive)) echo "active" ?>">
                        <a class="nav-link" href="/index.php"><i class="fas fa-home"></i>
                            Homepage</a>
                    </li>
                    <li class="nav-item <?php if(isset($MyProductsActive)) echo "active" ?>">
                        <a class="nav-link" href="/views/account/index.view.php"><i class="fas fa-list-ul"></i>
                            My products</a>
                    </li>
                    <li class="nav-item <?php if(isset($AddProductActive)) echo "active" ?>">
                        <a class="nav-link" href="/views/product/add.view.php"><i class="fas fa-plus"></i>
                            add product</a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link" href="/views/account/logout.php"><i class="fas fa-sign-in-alt"></i>
                            Logout</a>
                    </li> 
                <?php
                     }else{                         
                ?>           
                        <li class="nav-item <?php if(isset($SignUpActive)) echo "active" ?>">
                            <a class="nav-link" href="/views/account/signup.php"><i class="fas fa-user-plus"></i>
                                Sign Up</a>
                        </li>
                        <li class="nav-item <?php if(isset($LoginActive)) echo "active" ?>">
                            <a class="nav-link" href="/views/account/signin.php"><i class="fas fa-user"></i></i>
                                Login</a>
                        </li>                                                  
                <?php
                    } 
                ?> 
                  </ul>
              </div>
          </nav>
      </div>
  </header>

  <main role="main">