<?php 
//start session 
session_start();

if (is_null($_SESSION['username'])){
//redirect to home page
    header("Location:login.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>My Bed Linen Ordering System : Home</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<style>


    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
  }

  /* Remove the navbar's default rounded borders and increase the bottom margin */ 
  .navbar{
    margin-bottom: 0;
}
.jumbotron {
   margin-top: 0;
   margin-bottom: 0;
   background-image: url('bedroom-cover.jpg');
   background-size: cover;
   background-repeat: no-repeat;
   background-position: center center;
   min-height: 400px;
}

footer {
  background-color: #f2f2f2;
  padding: 25px;
}

hr {
  border: 1px solid black;
}



</style>





<?php include_once 'nav_bar.php'; ?>
<body>

    <div class="jumbotron" id="jumbotron">
      <div class="container text-center">
        <br>
        <h1>SHOPLINEN</h1>     
        <hr>

       <p> <strong>We make sleeping a luxury you can afford</strong></p>
    </div>
</div>



<br>
<br>



<div class="container">    
    <div class="row">
        <div class="col-sm-4">
          <div class="panel panel-primary">
            <div class="panel-heading">CHRISTMAS DEAL</div>
            <div class="panel-body"><img src="bedroom6.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
            <div class="panel-footer">Buy 10 sets and get a gift card</div>
        </div>
    </div>
    <div class="col-sm-4"> 
        <div class="panel panel-danger">
            <div class="panel-heading">CHRISTMAS DEAL</div>
            <div class="panel-body"><img src="bedroom4.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
            <div class="panel-footer">Buy 10 sets and get a gift card</div>
        </div>
    </div>
    <div class="col-sm-4"> 
        <div class="panel panel-success">
            <div class="panel-heading">CHRISTMAS DEAL</div>
            <div class="panel-body"><img src="bedroom5.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
            <div class="panel-footer">Buy 10 sets and get a gift card</div>
        </div>
    </div>
</div>
</div><br>

<div class="container-fluid" style="background-color: #dddddd" id="contact">
    <h3 class="text-center">Contact Us</h3>
    <div class="row">
        <div class="col-sm-5">
          <p>Contact us and we will get back to you within 24 hours.</p>
          <p><span class="glyphicon glyphicon-map-marker"></span> Bangi, Selangor</p>
          <p><span class="glyphicon glyphicon-phone"></span> +011 234567</p>
          <p><span class="glyphicon glyphicon-envelope"></span>SHOPLINEN@gmail.com</p>
      </div>
      <div class="col-sm-7">
          <div class="row">
            <div class="col-sm-6 form-group">
              <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
          </div>
          <div class="col-sm-6 form-group">
              <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
          </div>
      </div>
      <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea><br>
      <div class="row">
        <div class="col-sm-12 form-group">
          <button class="btn btn-default pull-right" type="submit">Send</button>
      </div>
  </div>
</div>
</div>
</div>

<footer class="container-fluid bg4 text-center">

    <p>SHOPLINEN © 2019</p>
</footer>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>

</body>
</html>