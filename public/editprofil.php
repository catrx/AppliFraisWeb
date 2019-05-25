<?php
include_once '../private/php/connection.php';
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
    <a href="../public/myprofil.php"><button type="button" class="pull-left btn btn-outline-primary">Return</button></a>
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
                <div class="box"><i class="fa fa-pencil icon"></i>
                  <h1><u>Editer mon Profil :</u></h1>
                    <div class="row justify-content-center features">
                        <div class="col-sm-8 col-md-7 col-lg-6 item">
                          <?php

                          if(isset($_SESSION['login'])) {
                             $requser = $dbh->prepare("SELECT * FROM visiteur WHERE login = ?");
                             $requser->execute(array($_SESSION['login']));
                             $user = $requser->fetch();
                             if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['login']) {
                                $newpseudo = htmlspecialchars($_POST['newpseudo']);
                                $insertpseudo = $dbh->prepare("UPDATE visiteur SET login = ? WHERE login = ?");
                                $insertpseudo->execute(array($newpseudo, $_SESSION['login']));
                                header('Location: ./myprofil.php');
                             }
                             if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['login']) {
                                $newmail = htmlspecialchars($_POST['newmail']);
                                $insertmail = $dbh->prepare("UPDATE visiteur SET login = ? WHERE login = ?");
                                $insertmail->execute(array($newmail, $_SESSION['login']));
                                header('Location: ../index.php');
                             }
                             if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
                                $mdp1 = ($_POST['newmdp1']);
                                $mdp2 = ($_POST['newmdp2']);
                                if($mdp1 == $mdp2) {
                                   $insertmdp = $dbh->prepare("UPDATE visiteur SET mdp = ? WHERE login = ?");
                                   $insertmdp->execute(array($mdp1, $_SESSION['login']));
                                   header('Location: ./myprofil.php');
                                } else {
                                   $msg = "Les deux mots de passes ne correspondent pas !";
                                }
                             }
                          ?>

                                <div align="center">
                                   <div align="left">
                                      <form method="POST" action="" enctype="multipart/form-data">
                                         <label>Nouveau Login :</label>
                                         <input type="text" name="newmail" class="form-control" placeholder="Nouveau Login" value="<?php echo $user['login']; ?>" /><br />
                                         <label>Nouveau mot de Passe :</label>
                                         <input type="password" class="form-control" name="newmdp1" placeholder="mot de passe" value="<?php echo $user['mdp']?>"/><br />
                                         <label>Confirmer le mot de passe :</label>
                                         <input type="password" class="form-control" name="newmdp2" placeholder="confirmer mot de passe" value="<?php echo $user['mdp']?>" /><br />
                                         <input type="submit" class="text-center btn btn-outline-primary" value="Update !" />
                                      </form>
                                      <?php if(isset($msg)) { echo $msg; } ?>
                                   </div>
                                </div>
                          <?php
                          }
                          else {
                             header("Location: ../index.php");
                          }
                          ?>
                </div>
                </div>
            </div>


        </div>
    </div>
</div>
</div>
<script src="../private/js/jquery.min.js"></script>
<script src="../private/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
