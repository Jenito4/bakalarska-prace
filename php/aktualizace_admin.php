<?php
include_once("../mysql_connect.php");

$error = false;

 if(isset($_POST["id"])){
 $id = mysqli_real_escape_string($conn, $_POST["id"]);
} else {
  $error = true;
}

if(isset($_POST["jmenoAdmin"]) && strlen(trim($_POST["jmenoAdmin"])) > 0){
 $jmenoAdmin = mysqli_real_escape_string($conn, $_POST["jmenoAdmin"]);
} else {
  $error = true;
}

if(isset($_POST["prijmeniAdmin"]) && strlen(trim($_POST["prijmeniAdmin"])) > 0){
 $prijmeniAdmin = mysqli_real_escape_string($conn, $_POST["prijmeniAdmin"]);
} else {
  $error = true;
}

if(isset($_POST["telefonAdmin"]) && strlen(trim($_POST["telefonAdmin"])) >= 9 && strlen(trim($_POST["telefonAdmin"])) <= 16){
  $telefonAdmin = mysqli_real_escape_string($conn, $_POST["telefonAdmin"]);
} else {
  $error = true;
}

if(isset($_POST["emailAdmin"]) && filter_var($_POST["emailAdmin"], FILTER_VALIDATE_EMAIL)){
  $emailAdmin = mysqli_real_escape_string($conn, $_POST["emailAdmin"]);
} else {
  $error = true;
}

if(!$error){

$sql= "UPDATE admini SET jmenoAdmin = '$jmenoAdmin', prijmeniAdmin = '$prijmeniAdmin', telefonAdmin = '$telefonAdmin', emailAdmin = '$emailAdmin' WHERE id_admin = $id";

if($query = mysqli_query($conn, $sql)){
    header("location: ../admin.php?id=".$id);
    die();
  }else{
    echo mysqli_error($conn);
  }
} else {
  header("location: ../aktualizovat_admin.php?err=1");
  die();
}
?>
