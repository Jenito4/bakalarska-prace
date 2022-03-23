<?php
include_once("../mysql_connect.php");

$error = false;

 if(isset($_POST["id"])){
 $id = mysqli_real_escape_string($conn, $_POST["id"]);
} else {
  $error = true;
}

if(isset($_POST["umisteniTechniky"])){
  $umisteniTechniky = mysqli_real_escape_string($conn, $_POST["umisteniTechniky"]);
} else {
    $umisteniTechniky = "";
}

if(!$error){
$sql= "UPDATE zakoupene_zbozi SET umisteni = '$umisteniTechniky' WHERE id_zakoupene_zbozi = $id";

if($query = mysqli_query($conn, $sql)){
    header("location: ../zakoupeneZbozi.php?id=".$id);
    die();
  }else{
    echo mysqli_error($conn);
  }
} else {
  header("location: ../pridatUmisteni.php?err=1");
  die();
}
?>
