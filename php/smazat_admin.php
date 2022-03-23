<?php
include_once("../mysql_connect.php");

$id = (int)$_GET["id"];         
                             
$sql = "DELETE FROM admini WHERE id_admin = $id";
if($query = mysqli_query($conn, $sql)){        
  header("location: ../admini.php?del=1");
  
} else {
  echo mysqli_error($conn);
  die();
}
?>