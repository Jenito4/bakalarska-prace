<?php
include_once("../mysql_connect.php");

$error = false;

 if(isset($_POST["id"])){
 $id = mysqli_real_escape_string($conn, $_POST["id"]);
} else {
  $error = true;
}

if(isset($_POST["jmenoZakaznik"]) && strlen(trim($_POST["jmenoZakaznik"])) > 0){
 $jmenoZakaznik = mysqli_real_escape_string($conn, $_POST["jmenoZakaznik"]);
} else {
  $error = true;
}

if(isset($_POST["prijmeniZakaznik"]) && strlen(trim($_POST["prijmeniZakaznik"])) > 0){
 $prijmeniZakaznik = mysqli_real_escape_string($conn, $_POST["prijmeniZakaznik"]);
} else {
  $error = true;
}

if(isset($_POST["telefonZakaznik"]) && strlen(trim($_POST["telefonZakaznik"])) >= 9 && strlen(trim($_POST["telefonZakaznik"])) <= 16){
  $telefonZakaznik = mysqli_real_escape_string($conn, $_POST["telefonZakaznik"]);
} else {
  $error = true;
}

if(isset($_POST["emailZakaznik"]) && filter_var($_POST["emailZakaznik"], FILTER_VALIDATE_EMAIL)){
  $emailZakaznik = mysqli_real_escape_string($conn, $_POST["emailZakaznik"]);
} else {
  $error = true;
}

if(!$error){

$sql= "UPDATE zakaznici SET jmenoZakaznik = '$jmenoZakaznik', prijmeniZakaznik = '$prijmeniZakaznik', telefonZakaznik = '$telefonZakaznik', emailZakaznik = '$emailZakaznik' WHERE id_zakaznik = $id";

if($query = mysqli_query($conn, $sql)){
    header("location: ../zakaznik.php?id=".$id);
    die();
  }else{
    echo mysqli_error($conn);
  }
} else {
  header("location: ../aktualizovat_zakaznik.php?err=1");
  die();
}
?>
