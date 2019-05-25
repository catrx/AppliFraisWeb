<?php
use Symfony\Component\Yaml\Yaml;
require __DIR__.'/../vendor/autoload.php';
$connectionParams = Yaml::parseFile(__DIR__.'/../config/db.yml');
$config = new \Doctrine\DBAL\Configuration();
$bdd = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);

$error = 0;
$controle_extensions_autorisees = array('csv');
$fichier_upload_nom = $_FILES['spareparts']['name'];
$fichier_extension =  strtolower(pathinfo($fichier_upload_nom, PATHINFO_EXTENSION));
if(!in_array($fichier_extension, $controle_extensions_autorisees)){
  echo 'L\'extension du fichier n\'est pas autorisée';
  $error = 1;
}
$controle_type_mime_autorises = array('text/plain', 'text/csv');
$fichier_upload_source = $_FILES['spareparts']['tmp_name'];
$fichier_mime_type = mime_content_type($fichier_upload_source);
if(!in_array($fichier_mime_type, $controle_type_mime_autorises)){
  echo 'Le type du fichier n\'est pas autorisée';
  $error = 1;
}
$controle_taille_maximum = 10000000;
$fichier_upload_taille = $_FILES['spareparts']['size'];
if($fichier_upload_taille > $controle_taille_maximum){
   echo 'La taille du fichier est de '.$fichier_upload_taille.' et dépasse la taille autorisée de '.$controle_taille_maximum;
   $error = 1;
}
if ($error == 0) {
  $fichier_extension = "csv";
  $nouveau_nom = hash('sha256', (microtime().$fichier_upload_nom)).'.'.$fichier_extension;
  $nouveau_nom = bin2hex(random_bytes(16)).'.'.$fichier_extension;
  $fichier_upload_destination= "var".DIRECTORY_SEPARATOR."www".DIRECTORY_SEPARATOR."html".DIRECTORY_SEPARATOR."private".DIRECTORY_SEPARATOR."upload".DIRECTORY_SEPARATOR.$nouveau_nom;
  move_uploaded_file($fichier_upload_source, $fichier_upload_destination);
  echo "L'upload s'est bien déroulé";

  if (($handle = fopen($fichier_upload_destination, "r")) !== FALSE) {
    $sql = "DELETE FROM printer_model_spare_parts_list";
    $sth = $bdd -> prepare($sql);
    $sth -> execute();
    $sql = "DELETE FROM spare_parts_list";
    $sth = $bdd -> prepare($sql);
    $sth -> execute();
    $sql = "INSERT INTO printer_model (model) VALUES (?)";
    $sth = $bdd -> prepare($sql);
    $sql2 = "SELECT id_type, model FROM printer_model WHERE model = ?";
    $sth2 = $bdd -> prepare($sql2);
    $sql3 = "INSERT INTO spare_parts_list (reference, category_1, category_2, description) VALUES (?, ?, ?, ?)";
    $sth3 = $bdd -> prepare($sql3);
    $sql4 = "INSERT INTO printer_model_spare_parts_list (reference, id_model) VALUES (?, ?)";
    $sth4 = $bdd -> prepare($sql4);
    while (($data = fgetcsv($handle, 0, ";", "|")) !== FALSE) {
      $num = count($data);
      if (($data[0] == "Ccode") || ($data[1] == "CName") || ($data[2] == "SN") || ($data[3] == "PName") || ($data[4] == "Purpose") || ($data[5] == "Date") ||
       ($data[6] == "LifeCounter") || ($data[7] == "PrintHeadCounter") || ($data[8] == "NumberLabels") || ($data[9] == "From") || ($data[10] == "To") || ($data[11] == "Subject")  ||
       ($data[12] == "DateTimeSent") || ($data[13] == "DateTimeReceived") || ($data[14] == "StartDate") || ($data[15] == "EndDate")) {

        $printer = $data;
        for ($c=16; $c < $num; $c++) {
          $sth2 -> execute(array($data[$c]));
          $test= $sth2 -> fetch();
          if ($test['model'] != $data[$c]) {
            $sth -> execute(array($data[$c]));
          }
        }
      }
      else {
        $sth3 -> execute(array($data[0], $data[1], $data[2], $data[3]$data[4], $data[5], $data[6], $data[7] $data[8], $data[9], $data[10], $data[11] $data[12],
         $data[13], $data[14], $data[15] ));
        for ($c=16; $c < $num; $c++) {
          if ($data[$c] == "?") {
            $sth2 -> execute(array($printer[$c]));
            $test= $sth2 -> fetch();
            $sth4 -> execute(array($data[0], $test['id_type']));
          }
        }
      }
    }
    fclose($handle);
  }
}
echo '<a href="/../sato/public/admin.php">Return to menu</a>';
