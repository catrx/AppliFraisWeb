<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

mysqli_select_db($conn,'sato');

if(isset($_POST['submit'])){
  if($_FILES['csv_data']['name']){

    $arrFileName = explode('.',$_FILES['csv_data']['name']);
    if($arrFileName[1] == 'csv'){
      $handle = fopen($_FILES['csv_data']['tmp_name'], "r");
      while (($data = fgetcsv($handle, 0, ";")) !== FALSE) {

      if ($data[0] == "Ccode") {
        // code...
      }
      else {
        $item1 = mysqli_real_escape_string($conn,$data[0]);
       $item2 = mysqli_real_escape_string($conn,$data[1]);
       $item3 = mysqli_real_escape_string($conn,$data[2]);
       $item4 = mysqli_real_escape_string($conn,$data[3]);
       $item5 = mysqli_real_escape_string($conn,$data[4]);
       $item6 = mysqli_real_escape_string($conn,$data[5]);
       $item7 = mysqli_real_escape_string($conn,$data[6]);
       $item8 = mysqli_real_escape_string($conn,$data[7]);
       $item9 = mysqli_real_escape_string($conn,$data[8]);
       $item10 = mysqli_real_escape_string($conn,$data[9]);
       $item11 = mysqli_real_escape_string($conn,$data[10]);
       $item12 = mysqli_real_escape_string($conn,$data[11]);
       $item13 = mysqli_real_escape_string($conn,$data[12]);
       $item14 = mysqli_real_escape_string($conn,$data[13]);
       $item15 = mysqli_real_escape_string($conn,$data[14]);
       $item16 = mysqli_real_escape_string($conn,$data[15]);
       $import="INSERT into emailparser(ccode,cname,sn,pname,purpose,datee,LifeCounter,printheadcounter,numberlabels,received_by,send_by,subject,datetimesent,datetimereceived,startdate,enddate) values('$item1','$item2','$item3','$item4','$item5','$item6','$item7','$item8','$item9','$item10','$item11','$item12','$item13','$item14','$item15','$item16')";
       mysqli_query($conn,$import);
      }
      }
      fclose($handle);
      header('Location: check.php');
      exit();

    }
  }
}
?>
