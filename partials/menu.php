
<!-- Navigation -->
<body>
  <header>
      <div class="container">
          <nav class="navbar navbar-expand-lg navbar-light bg-light">
              <a class="navbar-brand" href="{% url 'product:index' %}"><i class="fab fa-product-hunt" style="color:goldenrod; font-size: 27px;"></i>
                  Product Hunt</a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                  aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                  <ul class="navbar-nav ml-auto">
                      {% if user.is_authenticated %}
                      <li class="nav-item">
                          <a class="nav-link" href="{% url 'product:index' %}"><i class="fas fa-home"></i>
                              Homepage</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="{% url 'account:index' %}"><i class="fas fa-list-ul"></i>
                              My products</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="{% url 'product:add_product' %}"><i class="fas fa-plus"></i>
                              add product</a>
                      </li>

                      <li class="nav-item">
                          <a class="nav-link" href="javascript:{document.getElementById('logout').submit()}"><i class="fas fa-sign-in-alt"></i>
                              Logout</a>
                          <form action="{% url 'account:logout' %}" method="POST" id="logout">{% csrf_token %}
                              <input type="hidden">
                          </form>
                      </li>

                      {% else %}

                      <li class="nav-item">
                          <a class="nav-link" href="{% url 'account:signup' %}"><i class="fas fa-user-plus"></i>
                              Sign Up</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="{% url 'account:signin' %}"><i class="fas fa-user"></i></i>
                              Login</a>
                      </li>
                      {% endif %}

                  </ul>
              </div>
          </nav>
      </div>
  </header>
