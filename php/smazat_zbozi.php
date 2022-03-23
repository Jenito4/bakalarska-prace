<?php
include_once("../mysql_connect.php");

$id = (int)$_GET["id"];

$sql = "DELETE FROM zbozi WHERE id_zbozi = $id";
if($query = mysqli_query($conn, $sql)){
  header("location: ../katalogZbozi.php?del=1");
} else {
  echo mysqli_error($conn);
  die();
}
?>