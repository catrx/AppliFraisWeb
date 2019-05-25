<?php
require_once '../private/php/config.php';

$fiche = preg_replace('/-/s', '', $_GET['fiche']);

$stmt = $dbh->prepare("UPDATE fichefrais SET idEtat = 'VA' WHERE idVisiteur = ? AND mois = ?");
$stmt->execute(array($_GET['id'], $fiche));


header('Location: ../admin/validerfiche.php');
