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
    <br>
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
   <center><h1><strong>Saisie des Frais Forfaitisés :</strong> </h1></center><br/>
<?php
$stmtUtilisateurActuel = $DBCon->prepare("SELECT * FROM visiteur WHERE visiteur.id = ?");
$stmtUtilisateurActuel->execute(array($_POST['startUtilisateur']));
$rowUtilisateurActuel=$stmtUtilisateurActuel->FETCH(PDO::FETCH_ASSOC);
?>
   <div class="col-sm-3 col-md-2 col-lg-5 pull-left">
   <a href="../public/validerfrais.php?id=<?php echo $_POST['startUtilisateur'] ?>&amp;fiche=<?php echo $_POST['start'] ?>"><button type="button" class="pull-left btn btn-outline-primary">Valider fiche frais de <?php echo $rowUtilisateurActuel['nom']?> <?php echo $rowUtilisateurActuel['prenom']?></button></a>
 </div></br></br>
</br><h5>Synthèse du mois :</h5>
<?php

$stmtDateFrais = $DBCon->prepare("SELECT * FROM fichefrais ORDER BY mois");
$stmtDateFrais->execute(array());
$stmtListeUtilisateur = $DBCon->prepare("SELECT * FROM visiteur");
$stmtListeUtilisateur->execute(array());
?>
<div class="row">
<form action="" method="post">
  <select class="form-control col-12" name="startUtilisateur">
  <?php

  if($stmtListeUtilisateur->rowCount() > 0)
    {
    	while($rowListeUtilisateur=$stmtListeUtilisateur->FETCH(PDO::FETCH_ASSOC))
    	{
    		?>
        <option value="<?php echo $rowListeUtilisateur['id'] ?>"><?php echo $rowListeUtilisateur['nom']?> <?php echo $rowListeUtilisateur['prenom']?></option>
        	<?php
    	}
    }?>
  </select>
  <select class="form-control col-12" name="start">
  <?php

  if($stmtDateFrais->rowCount() > 0)
    {
      while($rowDateFrais=$stmtDateFrais->FETCH(PDO::FETCH_ASSOC))
      {
        ?>
        <option value="<?php
        $rowDateFrais['mois'] = preg_replace('/-/s', '', $rowDateFrais['mois']);

          $textDateFrais = $rowDateFrais['mois'];
          $newtextDateFrais = wordwrap($textDateFrais, 4, "-", true);


        echo $newtextDateFrais ?>"><?php echo $newtextDateFrais?></option>
          <?php
      }
    }?>
  </select>
<input type="submit" style="margin-top: 15px;" class="text-center col-12 btn btn-outline-primary" value=" Envoyer " name="submit"/><br />
</form>

<?php

?>

</div>





<?php
$_POST['start'] = preg_replace('/-/s', '', $_POST['start']);

  $text = $_POST['start'];
  $newtext = wordwrap($text, 4, "-", true);
?>
<?php
$date = date('Ym');
$stmt3 = $DBCon->prepare("SELECT montant*quantite AS montantTotal FROM fraisforfait, lignefraisforfait WHERE fraisforfait.id = lignefraisforfait.idFraisForfait AND idVisiteur = ? AND mois = ?");
$stmt3->execute(array($_POST['startUtilisateur'], $_POST['start']));
?>
<?php
$stmt35 = $DBCon->prepare("SELECT montant*quantite AS montantTotal FROM fraisforfait, lignefraisforfait WHERE fraisforfait.id = lignefraisforfait.idFraisForfait AND idVisiteur = ? AND mois = ?");
$stmt35->execute(array($_POST['startUtilisateur'], $_POST['start']));
?>
<?php
if(isset($_GET['edit_id_ribbon']))
  {
?>
<form method="post">
<div class="row justify-content-center features">
    <div class="col-sm-10  col-md-9 col-lg-8 item">
            <div class="row justify-content-center features">
                <div class="col-sm-8 col-md-7 col-lg-6 item">
                  <form action="" method="post">
                    <label>Name :</label>
                    <input type="text" class="form-control" name="ribbon_name" id="ribbon_name" value="<?php if(isset($_GET['edit_id_ribbon'])){ print($editRow['ribbon_name']); } ?>" required="required" placeholder=" Name"/><br />
                  <label>Ribbon Price :</label>
                  <input type="text" class="form-control" name="ribbon_price" id="ribbon_price" value="<?php if(isset($_GET['edit_id_ribbon'])){ print($editRow['ribbon_price']); } ?>" required="required" placeholder=" Surname"/><br />
                  <label>Ribbon Width :</label>
                  <input type="text" class="form-control" name="ribbon_wdth" id="ribbon_wdth" value="<?php if(isset($_GET['edit_id_ribbon'])){ print($editRow['ribbon_wdth']); } ?>" required="required" placeholder=" Email"/><br/>
                  <label>Ribbon Lenght :</label>
                  <input type="text" class="form-control" name="ribbon_lenght" id="ribbon_lenght" value="<?php if(isset($_GET['edit_id_ribbon'])){ print($editRow['ribbon_lenght']); } ?>" required="required" placeholder=" Company"/><br/>
                  <label>Product Code Ribbon :</label>
                  <input type="text" class="form-control" name="product_code_ribbon" id="product_code_ribbon" value="<?php if(isset($_GET['edit_id_ribbon'])){ print($editRow['product_code_ribbon']); } ?>" placeholder=" Password"/><br/>

                  </form>
        </div>
        </div>



</div>
<?php
}
?>
<tr>
<td>
<?php
if(isset($_GET['edit_id_ribbon']))
{
	?>
    <button type="submit" class="btn btn-outline-primary btn-sm form-control" name="update">Update</button>
    <?php
}
?>
</td>
</tr>
</form>

<br />

<?php
$stmt5 = $DBCon->prepare("SELECT SUM(quantite) AS quantiteTotale FROM lignefraisforfait WHERE idVisiteur = ? AND mois = ? GROUP BY lignefraisforfait.idFraisForfait");
$stmt5->execute(array($_POST['startUtilisateur'], $_POST['start']));

$stmt45 = $DBCon->prepare("SELECT * FROM fraisforfait, lignefraisforfait WHERE fraisforfait.id = lignefraisforfait.idFraisForfait AND mois = ? ORDER BY fraisforfait.id");
$stmt45->execute(array($_POST['start']));


$stmt35 = $DBCon->prepare("SELECT fraisforfait.libelle AS libelle FROM fraisforfait, lignefraisforfait WHERE lignefraisforfait.idVisiteur = ? AND lignefraisforfait.mois = ? AND lignefraisforfait.idFraisForfait = fraisforfait.id ORDER BY fraisforfait.id");
$stmt35->execute(array($_POST['startUtilisateur'], $_POST['start']));

echo $_POST['startUtilisateur'];
echo $_POST['start'];

?>

<table class="table">
<tr>
<th scope="col" >Type de Frais</th>
<th scope="col" >Quantité Totale</th>
<th scope="col" >Montant Total</th>
<th scope="col" >Date</th>
</tr>
<?php
$addition= "0";
if($stmt5->rowCount() > 0)
{
	while(($row5=$stmt5->FETCH(PDO::FETCH_ASSOC)) && ($row25=$stmt35->FETCH(PDO::FETCH_ASSOC)) && ($row35=$stmt45->FETCH(PDO::FETCH_ASSOC)))
	{

    $addition=$row5['quantiteTotale']*$row35['montant'] + $addition;

		?>
    	<tr>
      <td><?php print($row25['libelle']); ?></td>
    	<td><?php print($row5['quantiteTotale']); ?></td>
      <td><?php print($row5['quantiteTotale']*$row35['montant']); ?>€</td>
      <td><?php echo "$newtext\n";?></td>
    	</tr>
    	<?php
	}
}
else
{
	?>
    <tr>
    <td colspan="6"><?php print("Il n'y a aucune fiche pour cet utilisateur à ce mois...");  ?></td>
    </tr>
    <?php
}
?>
</table>

<?php
      ?><div>Total des frais forfaitisés engagés pour le mois : <?php echo $addition;?>€</div><?php
	while(($row5=$stmt5->FETCH(PDO::FETCH_ASSOC)) && ($row25=$stmt35->FETCH(PDO::FETCH_ASSOC)) && ($row35=$stmt45->FETCH(PDO::FETCH_ASSOC)))
	{
  }
?>
<h5></br></br>Détail du mois :</br></h5>
<?php
$stmt = $DBCon->prepare("SELECT * FROM lignefraisforfait WHERE idVisiteur = ? AND mois = ?");
$stmt->execute(array($_POST['startUtilisateur'], $_POST['start']));
?>
<table class="table">
<tr>
<th scope="col" >Date</th>
<th scope="col" >Type de Frais</th>
<th scope="col" >Description</th>
<th scope="col" >Quantité</th>
<th scope="col" >Montant Total</th>
<th scope="col"  colspan="2">Edit options</th>
</tr>
<?php
if($stmt->rowCount() > 0)
{
	while(($row=$stmt->FETCH(PDO::FETCH_ASSOC)) && ($row2=$stmt3->FETCH(PDO::FETCH_ASSOC)))
	{
		?>
    	<tr>
      <td><?php echo "$newtext\n";?></td>
    	<td><?php print($row['idFraisForfait']); ?></td>
      <td><?php print($row['description']); ?></td>
    	<td><?php print($row['quantite']); ?></td>
      <td><?php print($row2['montantTotal']); ?>€</td>
        <td><a onclick="return confirm('Souhaitez vous vraiment supprimer ce frais ?');" href="modifRibbon.php?delete_id_ribbon=<?php print($row['id']); ?>">SUPRIMER</a></td>
    	</tr>
    	<?php
	}
}
else
{
	?>
    <tr>
    <td colspan="6"><?php print("Il n'y a aucune fiche pour cet utilisateur à ce mois...");  ?></td>
    </tr>
    <?php
}
?>
</table>
</div><!--    End container-->
</body>
</html>
