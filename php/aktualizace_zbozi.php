<?php
include_once("../mysql_connect.php");

$error = false;

if(isset($_POST["id"])){
 $id = mysqli_real_escape_string($conn, $_POST["id"]);
} else {
  $error = true;
}

if(isset($_POST["nazevZbozi"]) && strlen(trim($_POST["nazevZbozi"])) > 0){
 $nazevZbozi = mysqli_real_escape_string($conn, $_POST["nazevZbozi"]);
} else {
  $error = true;
}

if(isset($_POST["nazevKategorie"])){
 $nazevKategorie = mysqli_real_escape_string($conn, $_POST["nazevKategorie"]);
} else {
  $error = true;
}

if(isset($_POST["ZboziText"]) && strlen(trim($_POST["ZboziText"])) > 0){
 $ZboziText = mysqli_real_escape_string($conn, $_POST["ZboziText"]);
} else {
  $error = true;
}

if(isset($_POST["ZboziCena"])){
 $ZboziCena = mysqli_real_escape_string($conn, $_POST["ZboziCena"]);
} else {
  $error = true;
}

// pøidání ilustraèní fotky
if(!$error && !empty($_FILES['SemPhoto']['name'])){
  if(file_exists("../foto_zbozi/".$_FILES['SemPhoto']['name'])){
      $length = (int)"20";
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      $newName = $randomString."".$_FILES['SemPhoto']['name'];
      $_FILES['SemPhoto']['name'] = $newName;
  }

  $error = addIfPhoto();

}


if(!$error){
  $photoName = "";

  if(!empty($_FILES['SemPhoto']['name'])){
    $photoName = $_FILES['SemPhoto']['name'];
  }

  if(empty($_FILES['SemPhoto']['name'])){
    $sql= "UPDATE zbozi SET nazevZbozi = '$nazevZbozi', id_kategorie = '$nazevKategorie', popis = '$ZboziText', cena = '$ZboziCena' WHERE id_zbozi = $id";
  } else {
    $sql= "UPDATE zbozi SET nazevZbozi = '$nazevZbozi', id_kategorie = '$nazevKategorie', popis = '$ZboziText', cena = '$ZboziCena', foto = '$photoName' WHERE id_zbozi = $id";
   }  
if($query = mysqli_query($conn, $sql)){
    header("location: ../zbozi.php?id=".$id);
    die();
  }else{
    echo mysqli_error($conn);
  }
} else {
  header("location: ../aktualizovat_zbozi.php?err=1");
  die();
}

function addIfPhoto(){
  $valid_formats = array("jpg", "png", "bmp", "PNG", "JPG", "jpeg", "JPEG");
   $max_file_size = 6000*6000;
   $path =  $_SERVER["DOCUMENT_ROOT"]."/foto_zbozi/";

   if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
    $name = $_FILES['SemPhoto']['name'];
     if ($_FILES['SemPhoto']['error'] == 4) {
      
     }
     if ($_FILES['SemPhoto']['error'] == 0) {
         if ($_FILES['SemPhoto']['size'] > $max_file_size) {
             // fotka pøíliš velká
            
         }
     elseif( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
       // formát není validní
      
     }
         else{
             if(move_uploaded_file($_FILES["SemPhoto"]["tmp_name"], $path.$name))
               return false; //nahráno úspìšnì. error = false
         }
     }
   }
   return true; // error = true --> nenahráno
}
?>
