<?php
$hostname='localhost';
$username='root';
$password='Sio062019CatrixSoulaques';
$dbname='gsb_frais';

try {
        $dbh = new PDO("mysql:host=$hostname;dbname=$dbname",$username,$password);

        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // <== add this line
}catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

?>
