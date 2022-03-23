<?php
include_once("../mysql_connect.php");

$id = (int)$_GET["id"];

$sql = "DELETE FROM kategorie WHERE id_kategorie = $id";
if($query = mysqli_query($conn, $sql)){
  header("location: ../listKategorie.php?del=1");
} else {
  echo mysqli_error($conn);
  die();
}
?>