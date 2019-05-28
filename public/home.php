<?php
session_start();
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

    <link rel="stylesheet" href="../private/css/service-1.css">
    <link rel="stylesheet" href="../private/css/styles.css">

</head>

<body>
<div class="btn-group btn-group-sm pull-left" style="margin-left: 2em; margin-top: 3em" role="group" aria-label="Basic example">
    <a href="../private/img/apk-local.apk"><button type="button" class="btn btn-outline-primary">Télécharger l'application Android</button></a>
</div>
  <a href="../private/php/deconnexion.php">
    <br>
    <div class="col-sm-4 col-md-3 col-lg-2 pull-right">
        <?php if (isset($_SESSION['login'])){?>
            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                <a href="../private/php/deconnexion.php"><button type="button" class="btn btn-outline-primary">Se déconnecter</button></a>
            </div>
        <?php }else{?>
        <a href="./../index.php"><button type="button" class="btn btn-outline-primary btn-sm form-control">
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
                <p class="text-center">Bienvenue sur votre Panel de gestion des frais !</p></br>
                <h1 class="text-center">Catégorie Visiteur :</h1>
            </div>

            <div class="row justify-content-center features">
              <div class="col-sm-5 col-md-4 col-lg-3 item">
                <div class="border">
                  <div class="box"><i class="fa fa-address-card icon"></i>
                      <h3 class="name">Mon Profil </h3>
                      <p class="description">Vous pouvez ici consulter votre Profil. </p><a href="../public/myprofil.php" class="learn-more"><br>Accèder à mon profil<br><br></a></div>
              </div>
              </div>
                <div class="col-sm-5 col-md-4 col-lg-3 item">
                  <div class="border">
                    <div class="box"><i class="fa fa-area-chart icon"></i>
                        <h3 class="name">Consulter mes frais</h3>
                        <p class="description">Vous pouvez consulter vos frais ici.</p><a href="../admin/modifRibbon.php" class="learn-more"><br>Accèder à l'outil<br><br></a></div>
                </div>
              </div>
              <div class="col-sm-5 col-md-4 col-lg-3 item">
                <div class="border">
                  <div class="box"><i class="fa fa-area-chart icon"></i>
                      <h3 class="name">Mes frais Hors Forfait</h3>
                      <p class="description">Vous pouvez consulter vos frais hors forfait ici.</p><a href="../admin/consulterfraishorsforfait.php" class="learn-more"><br>Accèder à l'outil<br><br></a></div>
              </div>
              </div>

          </div>
      </div>
<?php if($_SESSION['ifComptable'] == 1){
?>
      <div class="features-boxed">
          <div class="container">
            <div class="intro">
                <h1 class="text-center">Comptable catégorie :</h1>
            </div>
              <div class="row justify-content-center features">

                <div class="col-sm-5 col-md-4 col-lg-3 item">
                  <div class="border">
                    <div class="box"><i class="fa fa-send icon"></i>
                        <h3 class="name">Consulter les frais de tous les visiteurs</h3>
                        <p class="description">Ici vous pouvez consulter les frais de tous les visiteurs </p><a href="../admin/validerfiche.php" class="learn-more"><br>Accèder à l'outil<br><br></a></div>
                </div>
                </div>

            </div>
        </div>
    </div>
    <div class="features-boxed">
        <div class="container">
            <div class="intro">
                <h1 class="text-center">Gestion Cabinet</h1>
            </div>
            <div class="row justify-content-center features">

                <div class="col-sm-5 col-md-4 col-lg-3 item">
                    <div class="border">
                        <div class="box"><i class="fa fa-send icon"></i>
                            <h3 class="name">Gestion des cabinet</h3>
                            <p class="description">Ici vous pouvez modifier, supprimer, ajouter des cabinet </p><a href="../public/listcabinet.php" class="learn-more"><br>Acceder a l'outil<br><br></a></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php } ?>
<?php if($_SESSION['ifComptable'] == 2){
?>
    <div class="features-boxed">
        <div class="container">
          <div class="intro">
              <h1 class="text-center">Admin Categories :</h1>
          </div>
            <div class="row justify-content-center features">

              <div class="col-sm-5 col-md-4 col-lg-3 item">
                <div class="border">
                  <div class="box"><i class="fa fa-send icon"></i>
                      <h3 class="name">Gestion des Frais</h3>
                      <p class="description">Ici vous pouvez modifier, supprimer, ajouter des frais. </p><a href="../public/editfrais.php" class="learn-more"><br>Acceder a l'outil<br><br></a></div>
              </div>
              </div>

          </div>
      </div>
  </div>
<?php } ?>
<script src="../private/js/jquery.min.js"></script>
    <script src="../private/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
