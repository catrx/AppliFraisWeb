<?php
  use Symfony\Component\Yaml\Yaml;
  require __DIR__.'./../vendor/autoload.php';
  $connectionParams = Yaml::parseFile(__DIR__.'./../config/db.yml');
  $config = new \Doctrine\DBAL\Configuration();
  $bdd = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);
  session_start();

  $req = $bdd->prepare('SELECT id, login ,mdp, nom, prenom, ifComptable FROM visiteur  WHERE login = :login');
  var_dump($req);
  $req->execute(array(
      'login' => $_POST['login']));
  $resultat = $req->fetch();


  // Comparaison du pass envoyé via le formulaire avec la base
  if($_POST['mdp'] == $resultat['mdp']){
      $isPasswordCorrect = true;
  }
  else{
      $isPasswordCorrect = false;
  }

  if (!$resultat)
  {
      $_SESSION['msg'] = '* Mauvais identifiant ou mot de passe !';

      header('Location: /index.php');
  }
  else
  {
      if ($isPasswordCorrect == true) {

          $_SESSION['id'] = $resultat['id'];
          $_SESSION['login'] = $resultat['login'];
          $_SESSION['ifComptable'] = $resultat['ifComptable'];
          $_SESSION['nom'] = $resultat['nom'];
          $_SESSION['prenom'] = $resultat['prenom'];
          $_SESSION['admin'] = $resultat['admin'];



          header('Location: ../../public/home.php');
      }
      else {
          $_SESSION['msg'] =  '* Mauvais identifiant ou mot de passe !';

          header('Location: /index.php');
      }
  }

  ?>
