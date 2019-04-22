<?php include('partials/header.php') ; ?> 
{% block title %}User Login{% endblock title %}

{% block content %}
<br><br>
<div class="container col-md-4">
    <h4>Login</h4>
    <hr>
    <pre class="bg-warning">{{ error_message }}</pre>
    <form action="{% url 'account:signin' %}" method="POST">
        {% csrf_token %}
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
<br><br><br><br>
{% endblock content %}