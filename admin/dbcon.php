<?php
require_once '../private/php/config.php';
	try
	{
		$DBCon = new PDO("mysql:host={$hostname};dbname={$dbname}",$username,$password);
		$DBCon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e)
	{
		echo "ERROR : ".$e->getMessage();
	}
?>
