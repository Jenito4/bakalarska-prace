<?php
include_once("../mysql_connect.php");

$id = (int)$_GET["id"];

$sqlSelect = "SELECT id_uzivatel FROM zakaznici WHERE id_zakaznik = $id";
         if($query = mysqli_query($conn, $sqlSelect)){
    
        $sql = "DELETE FROM uzivatele WHERE id_uzivatel = $sqlSelect";
          if($query = mysqli_query($conn, $sql)){
          } 
            $sqlDelete = "DELETE FROM zakaznici WHERE id_zakaznik = $id";
    if($query = mysqli_query($conn, $sqlDelete)){
         } else {
    echo mysqli_error($conn);
      }
  header("location: ../zakaznici.php?del=1");
} else {
  echo mysqli_error($conn);
  die();
}
?>