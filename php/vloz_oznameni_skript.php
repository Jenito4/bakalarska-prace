<?php
include_once("../mysql_connect.php");

$error = false;

if(isset($_POST["OznameniNazev"]) && strlen(trim($_POST["OznameniNazev"])) > 0){
 $OznameniNazev = mysqli_real_escape_string($conn, $_POST["OznameniNazev"]);
} else {
  $error = true;
}

if(isset($_POST["OznameniObsah"]) && strlen(trim($_POST["OznameniObsah"])) > 0){
 $OznameniObsah = mysqli_real_escape_string($conn, $_POST["OznameniObsah"]);
} else {
  $error = true;
}

if(!$error){
  $sql = "INSERT INTO oznameni(nazev, obsah) VALUES('$OznameniNazev', '$OznameniObsah')";

  if($query = mysqli_query($conn, $sql)){
    header("location: ../oznameni_seznam.php");
    die();
  } else {
    echo mysqli_error($conn);
  }
} else {
  header("location: ../vloz_oznameni.php?err=1");
  die();
}
?>
