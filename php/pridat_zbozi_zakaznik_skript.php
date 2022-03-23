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

if(isset($_POST["nakupDatum"])){
 $nakupDatum = mysqli_real_escape_string($conn, $_POST["nakupDatum"]);
} else {
  $error = true;
  echo "err datum nakup<br>";
}

if(isset($_POST["platnostDatum"])){
 $platnostDatum = mysqli_real_escape_string($conn, $_POST["platnostDatum"]);
} else {
  $error = true;
  echo "err datum platnost<br>";
}

if(!$error){
$sql= "INSERT INTO zakoupene_zbozi(id_zbozi, id_zakaznik, datum_nakup, datum_platnosti)
    VALUES('$prirad', '$id', '$nakupDatum', '$platnostDatum')";

if($query = mysqli_query($conn, $sql)){
    header("location: ../zakaznici.php");
    die();
  }else{
    echo mysqli_error($conn);
  }
} else {
  header("location: ../pridat_zbozi_zakaznik.php?err=1");
  die();
}
?>
