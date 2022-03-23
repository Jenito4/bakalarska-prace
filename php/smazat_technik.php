<?php
include_once("../mysql_connect.php");

$id = (int)$_GET["id"];         
                             
$sql = "DELETE FROM technici WHERE id_technik = $id";
if($query = mysqli_query($conn, $sql)){        
  header("location: ../technici.php?del=1");
  
} else {
  echo mysqli_error($conn);
  die();
}
?>