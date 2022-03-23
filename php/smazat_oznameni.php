<?php
include_once("../mysql_connect.php");

$id = (int)$_GET["id"];

$sql = "DELETE FROM oznameni WHERE id_oznameni = $id";
if($query = mysqli_query($conn, $sql)){
  header("location: ../oznameni_seznam.php?del=1");
} else {
  echo mysqli_error($conn);
  die();
}
?>