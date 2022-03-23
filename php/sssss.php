<?php
include_once("../mysql_connect.php");

$error = false;

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
if(!$error && !empty($_FILES['zbozifoto']['name'])){
  if(file_exists("../foto_zbozi/".$_FILES['zbozifoto']['name'])){
      $length = (int)"20";
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      $newName = $randomString."".$_FILES['zbozifoto']['name'];
      $_FILES['zbozifoto']['name'] = $newName;
  }

  $error = addIfPhoto();

}


if(!$error){
  $photojmeno = "";

  if(!empty($_FILES['zbozifoto']['name'])){
    $photojmeno = $_FILES['zbozifoto']['name'];
  }
    
   // variabilní symbol
  $sqlSelect = "SELECT ico FROM zbozi ORDER BY id_zbozi DESC LIMIT 1";
  if($query = mysqli_query($conn, $sqlSelect)){
    if(mysqli_num_rows($query) == 1){
      while($row = mysqli_fetch_array($query)){
        $ico = (int)$row["ico"];
      }
      $ico++;
    } else {
      $ico = date("y")."01";
    }
  } else {
    echo mysqli_error($conn);
    die();
  }
    

 
  $sql = "INSERT INTO zbozi(ico, nazevZbozi, id_kategorie, popis, cena, foto)
    VALUES('$ico', '$nazevZbozi', '$nazevKategorie', '$ZboziText', '$ZboziCena', '$photojmeno')";

  if($query = mysqli_query($conn, $sql)){
    header("location: ../katalogZbozi.php");
    die();
  }else{
    echo mysqli_error($conn);
  }
} else {
  header("location: ../vloz_zbozi.php?err=1");
  die();
}



function addIfPhoto(){
  $valid_formats = array("jpg", "png", "bmp", "PNG", "JPG", "jpeg", "JPEG");
   $max_file_size = 6000*6000;
   $path =  $_SERVER["DOCUMENT_ROOT"]."/foto_zbozi/";

   if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
    $name = $_FILES['zbozifoto']['name'];
     if ($_FILES['zbozifoto']['error'] == 4) {
         continue;
     }
     if ($_FILES['zbozifoto']['error'] == 0) {
         if ($_FILES['zbozifoto']['size'] > $max_file_size) {
             // fotka pøíliš velká
             continue;
         }
     elseif( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
       // formát není validní
       continue;
     }
         else{
             if(move_uploaded_file($_FILES["zbozifoto"]["tmp_name"], $path.$name))
               return false; //nahráno úspìšnì. error = false
         }
     }
   }
   return true; // error = true --> nenahráno
}

?>
