<html>
<head>
<title>insert data in database using PDO(php data object)</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div id="main">
<h1>Insert data into database using PDO</h1>
<div id="login">
<h2>Student's Form</h2>
<hr/>
<form action="" method="post">
<label>Client Code :</label>
<input type="text" name="ccode" id="name" required="required" placeholder="Please Enter Name"/><br /><br />
<label>Identifiant :</label>
<input type="text" name="identifiant" id="email" required="required" placeholder="john123@gmail.com"/><br/><br />
<label>Name :</label>
<input type="text" name="name" id="city" required="required" placeholder="Please Enter Your City"/><br/><br />
<label>Surname :</label>
<input type="text" name="surname" id="city" required="required" placeholder="Please Enter Your City"/><br/><br />
<label>Password :</label>
<input type="password" name="password" id="city" required="required" placeholder="Please Enter Your City"/><br/><br />
<label>Company :</label>
<input type="text" name="company" id="city" required="required" placeholder="Please Enter Your City"/><br/><br />
<label>Email :</label>
<input type="email" name="email" id="city" required="required" placeholder="Please Enter Your City"/><br/><br />
<input type="submit" value=" Submit " name="submit"/><br />
</form>
</div>


</div>
<?php
if(isset($_POST["submit"])){
$hostname='localhost';
$username='root';
$password='Momolabanane123';

try {
$dbh = new PDO("mysql:host=$hostname;dbname=sato",$username,$password);

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // <== add this line
$sql = "INSERT INTO users (ccode, identifiant, name, surname, password, company, email)
VALUES ('".$_POST["ccode"]."','".$_POST["identifiant"]."','".$_POST["name"]."','".$_POST["surname"]."','".$_POST["password"]."','".$_POST["company"]."','".$_POST["email"]."')";
if ($dbh->query($sql)) {
  header('Location: check_addaccount.php');
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
