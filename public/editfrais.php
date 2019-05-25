<?php session_start();
include '../private/php/config.php';
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
    <a href="./home.php"><button type="button" class="pull-left btn btn-outline-primary"><?php echo $_SESSION['nom'];?> <?php echo $_SESSION['prenom'];?></button></a>
    </div>
    <div class="col-sm-4 col-md-3 col-lg-2 pull-right">
        <?php if (isset($_SESSION['login'])){?>
            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                <a href="../private/php/deconnexion.php"><button type="button" class="btn btn-outline-primary">Déconnexion</button></a>

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
                          <h1><u>Liste frais forfaitisé :</u></h1>
                </div>
            </div>
          </div>
        </div>
  <?php
  	try
  	{
  		$DBcon = new PDO("mysql:host={$hostname};dbname={$dbname}",$username,$password);
  		$DBcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  	}
  	catch(PDOException $e)
  	{
  		echo "ERROR : ".$e->getMessage();
  	}
  ?>
  <?php
  if(isset($_POST['maj']))
  {
    $stmt5 = $DBcon->prepare("UPDATE fraisforfait SET fraisforfait.id = ?, fraisforfait.libelle = ?, fraisforfait.montant = ? WHERE fraisforfait.id = ?");
    $stmt5->execute(array($_POST['idfrais'], $_POST['libelle'], $_POST['montant'], $_POST['idfrais']));
    header("Location: ./editfrais.php");
  }
  ?>

  <?php
  $stmt5 = $DBcon->prepare("SELECT * FROM fraisforfait");
  $stmt5->execute(array());
  ?>
  <table class="table">
  <tr>
  <th scope="col" >ID Frais</th>
  <th scope="col" >Libelle</th>
  <th scope="col" >Montant</th>
  </tr>
  <form method="POST" action="" enctype="multipart/form-data">
  <?php

  if($stmt5->rowCount() > 0)
  {
  	while($row5=$stmt5->FETCH(PDO::FETCH_ASSOC))
  	{

  		?>
         <tr>
         <td><input type="text" name="idfrais" class="form-control" placeholder="ID Frais" value="<?php echo $row5['id'] ?>" /></td>
         <td><input type="text" class="form-control" name="libelle" placeholder="Libelle" value="<?php echo $row5['libelle']?>"/></td>
         <td><input type="text" class="form-control" name="montant" placeholder="Montant" value="<?php echo $row5['montant']?>" /></td>
         <td><input type="submit" class="text-center btn btn-outline-primary" name="maj" value="Mettre a Jour" />
         </tr>
      	<?php
  	}
  }
  else
  {
  	?>
      <tr>
      <td colspan="6"><?php print("nothing here...");  ?></td>
      </tr>
      <?php
  }
  ?>
  </form>
</table>
<div class="features-boxed">
    <div class="container">

        <div class="row justify-content-center features">
            <div class="col-sm-10  col-md-9 col-lg-8 item">
                  <h1><u>Ajouter un frais forfaitisé :</u></h1>
        </div>
    </div>
  </div>
</div>
  <?php
  if(isset($_POST['addFrais']))
  {
    $stmtAddFrais = $DBcon->prepare("INSERT INTO fraisforfait(fraisforfait.id, fraisforfait.libelle, fraisforfait.montant) VALUES(?, ?, ?)");
    $stmtAddFrais->execute(array($_POST['idfraisAdd'], $_POST['libelleAdd'], $_POST['montantAdd']));
    header("Location: ./editfrais.php");
  }
  ?>

  <table class="table">
  <tr>
  <th scope="col" >ID Frais</th>
  <th scope="col" >Libelle</th>
  <th scope="col" >Montant</th>
  </tr>
  <form method="POST" action="" enctype="multipart/form-data">
         <tr>
         <td><input type="text" name="idfraisAdd" class="form-control" placeholder="ID Frais"/></td>
         <td><input type="text" class="form-control" name="libelleAdd" placeholder="Libelle"/></td>
         <td><input type="text" class="form-control" name="montantAdd" placeholder="Montant" /></td>
         <td><input type="submit" class="text-center btn btn-outline-primary" name="addFrais" value="Ajouter un Frais" />
         </tr>
  </form>

  </table>






<script src="../private/js/jquery.min.js"></script>
<script src="../private/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
