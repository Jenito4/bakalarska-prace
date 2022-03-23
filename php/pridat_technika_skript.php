<?php
include_once("../mysql_connect.php");

$error = false;

 if(isset($_POST["id"])){
 $id = mysqli_real_escape_string($conn, $_POST["id"]);
} else {
  $error = true;
}

if ($_POST['prirad']!=" "){
    $prirad=$_POST['prirad'];
    } else {
  $error = true;
}

if(!$error){
$sql= "UPDATE objednavky SET id_technik = '$prirad' WHERE id_objednavky = $id";

if($query = mysqli_query($conn, $sql)){
    header("location: ../objednavka.php?id=".$id);
    die();
  }else{
    echo mysqli_error($conn);
  }
} else {
  header("location: ../pridat_technika.php?err=1");
  die();
}
?>
