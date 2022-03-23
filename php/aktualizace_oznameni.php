<?php
include_once("../mysql_connect.php");

$error = false;

 if(isset($_POST["id"])){
 $id = mysqli_real_escape_string($conn, $_POST["id"]);
} else {
  $error = true;
}

if(isset($_POST["nazev"]) && strlen(trim($_POST["nazev"])) > 0){
 $nazev = mysqli_real_escape_string($conn, $_POST["nazev"]);
} else {
  $error = true;
}

if(isset($_POST["obsah"]) && strlen(trim($_POST["obsah"])) > 0){
  $obsah = mysqli_real_escape_string($conn, $_POST["obsah"]);
} else {
  $error = true;
}

if(!$error){

$sql= "UPDATE oznameni SET nazev = '$nazev', obsah = '$obsah' WHERE id_oznameni = $id";

if($query = mysqli_query($conn, $sql)){
    header("location: ../oznameni.php?id=".$id);
    die();
  }else{
    echo mysqli_error($conn);
  }
} else {
  header("location: ../aktualizovat_oznameni.php?err=1");
  die();
}
?>
