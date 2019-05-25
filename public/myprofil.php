<?php

                session_start();
                include '../private/php/config.php';
                ?>

                <?php
                $userid = $_SESSION['login'];
                $sql = "SELECT * FROM visiteur WHERE login= ?";
                $sth = $dbh->prepare($sql);
                $sth -> execute(array($userid));
                while ($mail = $sth->fetch()) {



                }
?>


<!DOCTYPE html>
<html>

<head>
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
        <?php if (isset($_SESSION['login'])){?>
            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                <a href="../private/php/deconnexion.php"><button type="button" class="btn btn-outline-primary">Disconect</button></a>

            </div>
        <?php }else{?>
        <a href="../../index.php"><button type="button" class="btn btn-outline-primary btn-sm form-control">
                <span class="glyphicon glyphicon-user"></span>Connexion
            </button>
        </a>

        <?php }?>
      </div>
    </a>
    <div class="features-boxed">
        <div class="container">
            <div class="intro">
                <h2 class="text-center"><img src="../private/img/sato.png" height="145"></h2>

            </div>
          </div>
        </div>




        <div class="features-boxed">
            <div class="container">

                <div class="row justify-content-center features">
                    <div class="col-sm-10  col-md-9 col-lg-8 item">
                      <div class="border">
                        <div class="box"><i class="fa fa-address-card icon"></i>
                          <h1><u>Mon Profil :</u></h1>
                            <div class="row justify-content-center features">
                                <div class="col-sm-8 col-md-7 col-lg-6 item">
                                        <h4>Mon ID Utilisateur : <?php
                                        $userid = $_SESSION['login'];
                                        $sql = "SELECT * FROM visiteur WHERE login= ?";
                                        $sth = $dbh->prepare($sql);
                                        $sth -> execute(array($userid));
                                        while ($mail = $sth->fetch()) {
                                        echo $mail['id'];


                                        }
                                      ?></h4>

                                      <h4>Nom / Prénom : <?php
                                      $userid = $_SESSION['login'];
                                      $sql = "SELECT * FROM visiteur WHERE login= ?";
                                      $sth = $dbh->prepare($sql);
                                      $sth -> execute(array($userid));
                                      while ($mail = $sth->fetch()) {
                                      echo $mail['nom']; ?>   <?php
                                      echo $mail['prenom'];


                                      }
                                      ?></h4>

                                      <h4>Login Connexion : <?php
                                      $userid = $_SESSION['login'];
                                      $sql = "SELECT * FROM visiteur WHERE login= ?";
                                      $sth = $dbh->prepare($sql);
                                      $sth -> execute(array($userid));
                                      while ($mail = $sth->fetch()) {
                                      echo $mail['login'];


                                      }
                                      ?></h4>

                                      <h4>Suis-je un comptable ? <?php
                                      $userid = $_SESSION['login'];
                                      $sql = "SELECT * FROM visiteur WHERE login= ?";
                                      $sth = $dbh->prepare($sql);
                                      $sth -> execute(array($userid));
                                      while ($mail = $sth->fetch()) {
                                      if($mail['ifComptable']==1){
                                        echo "Oui";
                                      }else{
                                        echo "Non";
                                      }


                                      }
                                      ?></h4>
                        </div>
                        </div>
                        <hr/>
                                <div class="box"><i class="fa fa-pencil icon"></i>
                                <a href="editprofil.php" class="learn-more"><br>Editer mon Profil<br><br></a>
                    </div>


                  </div>
                </div>
            </div>


</body>

</html>
