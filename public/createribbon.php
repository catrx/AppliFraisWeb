  <?php
session_start();
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

<?php $mois = date('Ym'); ?>
  <a href="/private/php/deconnexion.php">
    <br></br>
    <div class="col-sm-3 col-md-2 col-lg-5 pull-left">
    <a href="../admin/modifRibbon.php"><button type="button" class="pull-left btn btn-outline-primary">Return</button></a>
    </div>
    <div class="col-sm-4 col-md-3 col-lg-2 pull-right">
        <?php if (isset($_SESSION['email'])){?>
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
                        <div class="box"><i class="fa fa-bookmark icon"></i>
                          <h1><u>Ajouter un Frais :</u></h1>
                            <div class="row justify-content-center features">
                                <div class="col-sm-8 col-md-7 col-lg-6 item">
                                  <form action="" method="post">
                                  <label>Quel est le type de frais ?</label>
                                  <select class="form-control" name="typefrais">
                                    <?php
                                    $stmtSelectTypeFrais = $DBcon->prepare("SELECT * FROM fraisforfait");
                                    $stmtSelectTypeFrais->execute(array());
                                    ?>
                                    <?php

                                    if($stmtSelectTypeFrais->rowCount() > 0)
                                      {
                                      	while($rowSelectTypeFrais=$stmtSelectTypeFrais->FETCH(PDO::FETCH_ASSOC))
                                      	{
                                      		?>
                                          <option value="<?php echo $rowSelectTypeFrais['id'] ?>"><?php echo $rowSelectTypeFrais['libelle']?></option>
                                          	<?php
                                      	}
                                      }?>
                                  </select>
                                  <label>Quantite</label>
                                  <input type="text" class="form-control" name="quantite" id="width" required="required" placeholder=" Quantite"/><br/>
                                  <label>Description</label>
                                  <input type="text" class="form-control" name="description" id="gap" required="required" placeholder=" Description"/><br/>
                                  <input type="submit" class="text-center btn btn-outline-primary" value=" Submit " name="submit"/><br />
                                  </form>
                        </div>
                        </div>
                        </div>



                </div>
            </div>
          </div>
        </div>
        </div>
<?php
if(isset($_POST["submit"])){
$hostname='localhost';
$username='root';
$password='Momolabanane123';

try {
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // <== add this line
  $sql = "INSERT INTO lignefraisforfait (idVisiteur, mois, idFraisForfait, quantite, description) VALUES ('".$_SESSION["id"]."','".$mois."','".$_POST["typefrais"]."','".$_POST["quantite"]."','".$_POST["description"]."')";
if ($dbh->query($sql)) {
  header('Location: check_addribbon.php');
  exit();
}
else{
echo "<script type= 'text/javascript'>alert('Data not successfully Inserted.');</script>";
}

$dbh = null;
}
catch(PDOException $e)
{
echo $e->getMessage();
}

}
?>
</body>
</html>
