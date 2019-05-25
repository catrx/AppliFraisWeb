<?php

require_once 'dbcon.php';

if(isset($_POST['save']))
{
	$name = $_POST['name'];
	$email = $_POST['email'];


	$stmt = $DBCon->prepare("INSERT INTO users(name,email) VALUES(:name, :email)");

	$stmt->bindparam(':name', $name);
	$stmt->bindparam(':email', $email);
	$stmt->execute();

}


if(isset($_GET['delete_id_ribbon']))
{
	$id = $_GET['delete_id_ribbon'];
	$stmt = $DBCon->prepare("DELETE FROM lignefraisforfait WHERE id=:id");
	$stmt->execute(array(':id' => $id));
}

if(isset($_GET['edit_id_ribbon']))
{
	$stmt = $DBCon->prepare("SELECT * FROM ribbon WHERE id_ribbon=:id_ribbon");
	$stmt->execute(array(':id_ribbon' => $_GET['edit_id_ribbon']));
	$editRow=$stmt->FETCH(PDO::FETCH_ASSOC);

}

if(isset($_POST['update']))
{
	$ribbon_name = $_POST['ribbon_name'];
	$ribbon_price = $_POST['ribbon_price'];
	$ribbon_wdth = $_POST['ribbon_wdth'];
	$ribbon_lenght = $_POST['ribbon_lenght'];
	$product_code_ribbon = $_POST['product_code_ribbon'];
	$id_ribbon = $_GET['edit_id_ribbon'];

	$stmt = $DBCon->prepare("UPDATE ribbon SET ribbon_name=:ribbon_name, ribbon_price=:ribbon_price, ribbon_wdth=:ribbon_wdth, ribbon_lenght=:ribbon_lenght, product_code_ribbon=:product_code_ribbon WHERE id_ribbon=:id_ribbon");
	$stmt->bindparam(':ribbon_name', $ribbon_name);
	$stmt->bindparam(':ribbon_price', $ribbon_price);
	$stmt->bindparam(':ribbon_wdth', $ribbon_wdth);
	$stmt->bindparam(':ribbon_lenght', $ribbon_lenght);
	$stmt->bindparam(':product_code_ribbon', $product_code_ribbon);
	$stmt->bindparam(':id_ribbon', $id_ribbon);
	$stmt->execute();
	header("Location: modifRibbon.php");
}


?>
