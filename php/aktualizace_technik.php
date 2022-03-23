<?php
include_once("../mysql_connect.php");

$error = false;

 if(isset($_POST["id"])){
 $id = mysqli_real_escape_string($conn, $_POST["id"]);
} else {
  $error = true;
}

if(isset($_POST["jmenoTechnik"]) && strlen(trim($_POST["jmenoTechnik"])) > 0){
 $jmenoTechnik = mysqli_real_escape_string($conn, $_POST["jmenoTechnik"]);
} else {
  $error = true;
}

if(isset($_POST["prijmeniTechnik"]) && strlen(trim($_POST["prijmeniTechnik"])) > 0){
 $prijmeniTechnik = mysqli_real_escape_string($conn, $_POST["prijmeniTechnik"]);
} else {
  $error = true;
}

if(isset($_POST["telefonTechnik"]) && strlen(trim($_POST["telefonTechnik"])) >= 9 && strlen(trim($_POST["telefonTechnik"])) <= 16){
  $telefonTechnik = mysqli_real_escape_string($conn, $_POST["telefonTechnik"]);
} else {
  $error = true;
}

if(isset($_POST["emailTechnik"]) && filter_var($_POST["emailTechnik"], FILTER_VALIDATE_EMAIL)){
  $emailTechnik = mysqli_real_escape_string($conn, $_POST["emailTechnik"]);
} else {
  $error = true;
}

if(!$error){

$sql= "UPDATE technici SET jmenoTechnik = '$jmenoTechnik', prijmeniTechnik = '$prijmeniTechnik', telefonTechnik = '$telefonTechnik', emailTechnik = '$emailTechnik' WHERE id_technik = $id";

if($query = mysqli_query($conn, $sql)){
    header("location: ../technik.php?id=".$id);
    die();
  }else{
    echo mysqli_error($conn);
  }
} else {
  header("location: ../aktualizovat_technik.php?err=1");
  die();
}
?>
