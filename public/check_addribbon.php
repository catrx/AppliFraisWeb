<?php
session_start();
include '../private/php/config.php';

?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="refresh" content="2; URL=../admin/modifRibbon.php">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SATO France</title>
    <link rel="stylesheet" href="../private/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../private/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,500">
    <link rel="stylesheet" href="../private/css/Features-Boxed.css">
    <link rel="stylesheet" href="../private/css/Network-Particles-Hero.css">
    <link rel="stylesheet" href="../private/css/service-1.css">
    <link rel="stylesheet" href="../private/css/styles.css">

</head>

<body>
  <a href="/private/php/deconnexion.php">
    <br></br>
    <div class="col-sm-3 col-md-2 col-lg-5 pull-left">
    <a href="../public/home.php"><button type="button" class="pull-left btn btn-outline-primary">Return</button></a>
    </div>
    <div class="col-sm-4 col-md-3 col-lg-2 pull-right">
        <?php if (isset($_SESSION['email'])){?>
            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                <a href="../private/php/deconnexion.php"><button type="button" class="btn btn-outline-primary">Disconect</button></a>
            </div>
        <?php }else{?>
        <a href="../../index.php"><button type="button" class="btn btn-outline-primary btn-sm form-control">
                <span class="glyphicon glyphicon-user"></span>Connect
            </button>
        </a>

        <?php }?>
      </div>
    </a>
    <div class="features-boxed">
        <div class="container">
            <div class="intro">

                <h2 class="text-center"><img src="../private/img/sato.png" height="145"></h2>
                <h3 class="text-center"></B>Great ! Your have Successfully added Ribbon !</B></h3>
                <h2 class="text-center"><img src="../private/img/check.png" height="245"></h2>

</body>

</html>
