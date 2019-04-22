<?php
session_start();
/*session is started if you don't write this line can't use $_Session  global variable*/
$pageTitle=$_SESSION["pageTitle"]
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title><?php  echo $pageTitle; ?></title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="asset/css/bootstrap.min.css" 
        crossorigin="anonymous">
    <link rel="stylesheet" href="fontawesome/css/all.css" 
        crossorigin="anonymous">

    <style>
        .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

</head>

<body>
    <?php include('partials/menu.php') ; ?> 
   