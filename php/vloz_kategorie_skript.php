<?php
include_once("../mysql_connect.php");

$error = false;

if(isset($_POST["nazevKategorie"]) && strlen(trim($_POST["nazevKategorie"])) > 0){
 $nazevKategorie = mysqli_real_escape_string($conn, $_POST["nazevKategorie"]);
} else {
  $error = true;
  echo 1;
}

if(!$error){
  $sql = "INSERT INTO kategorie(nazevKategorie)
    VALUES('$nazevKategorie')";

  if($query = mysqli_query($conn, $sql)){
    header("location: ../listKategorie.php");
    die();
  } else {
    echo mysqli_error($conn);
  }
} else {
  header("location: ../vloz_kategorie.php?err=1");
  die();
}
?>   
