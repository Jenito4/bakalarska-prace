<?php
include_once("../mysql_connect.php");

$error = false;

 if(isset($_POST["id"])){
 $id = mysqli_real_escape_string($conn, $_POST["id"]);
} else {
  $error = true;
}

if(isset($_POST["nazevKategorie"]) && strlen(trim($_POST["nazevKategorie"])) > 0){
 $nazevKategorie = mysqli_real_escape_string($conn, $_POST["nazevKategorie"]);
} else {
  $error = true;
}

if(!$error){

$sql= "UPDATE kategorie SET nazevKategorie = '$nazevKategorie' WHERE id_kategorie = $id";

if($query = mysqli_query($conn, $sql)){
    header("location: ../kategorie.php?id=".$id);
    die();
  }else{
    echo mysqli_error($conn);
  }
} else {
  header("location: ../aktualizovat_kategorie.php?err=1");
  die();
}
?>
