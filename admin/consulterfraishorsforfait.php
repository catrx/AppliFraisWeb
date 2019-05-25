<?php
require_once 'crudRibbon.php';
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
    <link rel="stylesheet" href="../private/css/Network-Particles-Hero.css">
    <link rel="stylesheet" href="../private/css/service-1.css">
    <link rel="stylesheet" href="../private/css/styles.css">

</head>

<body>
  <a href="/private/php/deconnexion.php">
    <br></br>
    <div class="col-sm-3 col-md-2 col-lg-5 pull-left">
    <a href="../public/home.php"><button type="button" class="pull-left btn btn-outline-primary"><?php echo $_SESSION['nom'];?> <?php echo $_SESSION['prenom'];?></button></a>
    </div>
    <div style="margin-right: 15px;" class="col-1 pull-right">
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


 <div class="container">
   <center><h1><strong>Consulter les Frais Hors Forfait :</strong> </h1></center><br/>

   <div class="col-sm-3 col-md-2 col-lg-5 pull-left">
   <a href="../public/ajouterfraishorsforfait.php"><button type="button" class="pull-left btn btn-outline-primary">Ajouter un frais hors forfait</button></a>
 </div></br></br>
</br><h5>Synthèse du mois :</h5>
<form action="" method="post">
<input type="month" id="start" name="start" value="<?php echo date('Y') ?>-<?php echo date('m')?>" placeholder="<?php echo $date ?>">
<input type="submit" class="text-center btn btn-outline-primary" value=" Submit " name="submit"/><br/>

</form>

<?php
$_POST['start'] = preg_replace('/-/s', '', $_POST['start']);

  $text = $_POST['start'];
  $newtext = wordwrap($text, 4, "-", true);
?>
<?php
$date = date('Ym');
$stmt3 = $DBCon->prepare("SELECT montant*quantite AS montantTotal FROM fraisforfait, lignefraisforfait WHERE fraisforfait.id = lignefraisforfait.idFraisForfait AND idVisiteur = ? AND mois = ?");
$stmt3->execute(array($_SESSION['id'], $_POST['start']));
?>
<?php
$stmt35 = $DBCon->prepare("SELECT montant*quantite AS montantTotal FROM fraisforfait, lignefraisforfait WHERE fraisforfait.id = lignefraisforfait.idFraisForfait AND idVisiteur = ? AND mois = ?");
$stmt35->execute(array($_SESSION['id'], $_POST['start']));
?>


<br />

<?php
$stmt5 = $DBCon->prepare("SELECT SUM(quantite) AS quantiteTotale FROM lignefraisforfait WHERE idVisiteur = ? AND mois = ? GROUP BY lignefraisforfait.idFraisForfait");
$stmt5->execute(array($_SESSION['id'], $_POST['start']));

$stmt45 = $DBCon->prepare("SELECT * FROM fraisforfait, lignefraisforfait WHERE fraisforfait.id = lignefraisforfait.idFraisForfait AND mois = ? ORDER BY fraisforfait.id");
$stmt45->execute(array($_POST['start']));


$stmt35 = $DBCon->prepare("SELECT fraisforfait.libelle AS libelle FROM fraisforfait, lignefraisforfait WHERE lignefraisforfait.idVisiteur = ? AND lignefraisforfait.mois = ? AND lignefraisforfait.idFraisForfait = fraisforfait.id ORDER BY fraisforfait.id");
$stmt35->execute(array($_SESSION['id'], $_POST['start']));

?>

<?php
if(isset($_GET['delete_id_ribbon']))
{
	$id = $_GET['delete_id_ribbon'];
	$stmt = $DBCon->prepare("DELETE FROM lignefraishorsforfait WHERE id=:id");
	$stmt->execute(array(':id' => $id));
}
?>
<h5>Détail du mois :</br></h5>
<?php
$stmt = $DBCon->prepare("SELECT * FROM lignefraishorsforfait WHERE idVisiteur = ? AND mois = ?");
$stmt->execute(array($_SESSION['id'], $_POST['start']));
?>
<table class="table">
<tr>
<th scope="col" >Date</th>
<th scope="col" >Libelle</th>
<th scope="col" >Montant</th>
<th scope="col"  colspan="2">Edit options</th>
</tr>
<?php
if($stmt->rowCount() > 0)
{
	while($row=$stmt->FETCH(PDO::FETCH_ASSOC))
	{
		?>
    	<tr>
      <td><?php echo "$newtext\n";?></td>

      <td><?php print($row['libelle']); ?></td>
    	<td><?php print($row['montant']); ?></td>
        <td><a onclick="return confirm('Souhaitez vous vraiment supprimer ce frais ?');" href="consulterfraishorsforfait.php?delete_id_ribbon=<?php print($row['id']); ?>">SUPRIMER</a></td>
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
</table>
</div><!--    End container-->
</div>
</div>
</body>
</html>
