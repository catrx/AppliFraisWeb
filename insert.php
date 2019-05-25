<?php
$server = "localhost";
$user = "root";
$pass = "Momolabanane123";
$dbname = "gsb_frais";

//Creating connection for mysqli

$conn = new mysqli($server, $user, $pass, $dbname);

//Checking connection

if($conn->connect_error){
 die("Connection failed:" . $conn->connect_error);
}

$name = mysqli_real_escape_string($conn, $_POST['ccode']);
$name = mysqli_real_escape_string($conn, $_POST['identifiant']);
$name = mysqli_real_escape_string($conn, $_POST['name']);
$name = mysqli_real_escape_string($conn, $_POST['surname']);
$name = mysqli_real_escape_string($conn, $_POST['password']);
$name = mysqli_real_escape_string($conn, $_POST['company']);
$name = mysqli_real_escape_string($conn, $_POST['email']);


$sql = "INSERT INTO users(ccode, identifiant, name, surname, password, company, email) VALUES ('".$ccode."', '".$identifiant."', '".$name."', '".$surname."', '".$password."', '".$company."', '".$email."')";

if($conn->query($sql) === TRUE){
 echo "Record Added Sucessfully";
}
else
{
 echo "Error" . $sql . "<br/>" . $conn->error;
}
$conn->close();
?>
