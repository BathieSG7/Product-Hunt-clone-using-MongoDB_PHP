<?php 
    $pageTitle="User-Home";
    include('../../partials/header.php') ; 
    # importing the mongodb class 
    require_once('../../vendor/autoload.php');
    require_once('../../config/MongoDB.php');
    
    $db= new MongoDB;

    
?> 


<div class="container">
    <br>
    {% for product in products %}
    <div class="row pt-5">
        <div class="col-md-2">
            <img src="{{ product.icon.url }}" class="img-fluid" />
        </div>
        <div class="col-md-6">
            <a href="{% url 'product:detail' product.id %}">
                <h2>{{ product.title }}</h2>
            </a>
            <p>{{ product.summary }}</p>
        </div>
        <div class="col-md-2">
            <button class="btn btn-info btn-lg btn-block" disabled=><i class="fa fa-info-circle"></i> Votes:
                {{product.votes}}</button>
        </div>
        <div class="col-md-2">
            <a href="{% url 'account:delete_product' product.id %}"><button class="btn btn-danger btn-lg btn-block"><i
                        class="fa fa-trash-alt"></i> Delete</button></a>
        </div>
    </div>
    {% endfor %}
</div>
<div class="pb-5"></div>


<?php 
    include('../../partials/footer.php'); 
?> 