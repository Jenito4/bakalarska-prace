<?php
include_once("../mysql_connect.php");

$error = false;

 if(isset($_POST["id"])){
 $id = mysqli_real_escape_string($conn, $_POST["id"]);
} else {
  $error = true;
}

if(isset($_POST["PlatnostDatum"])){
 $PlatnostDatum = mysqli_real_escape_string($conn, $_POST["PlatnostDatum"]);
} else {
  $error = true;
  echo "err datum<br>";
}

if(!$error){
  $query = mysqli_query($conn, "SELECT id_zakoupene_zbozi FROM objednavky WHERE id_objednavky = $id");
    $rowsCount = mysqli_num_rows($query);
if($rowsCount == 1){
    $idZakoupeneZbozi = null;
    
    while($row = mysqli_fetch_array($query)) {
        $idZakoupeneZbozi = $row["id_zakoupene_zbozi"];
    }     
    
    if($idZakoupeneZbozi != null) {   
        
        $idResult = null;  
        
        $queryZbozi = mysqli_query($conn, "UPDATE zakoupene_zbozi SET datum_platnosti = '$PlatnostDatum' WHERE id_zakoupene_zbozi = $idZakoupeneZbozi");
          while($rowZbozi = mysqli_fetch_array($queryZbozi)) {
            $idResult = $rowZbozi["id_zakoupene_zbozi"];
          } 
                      
      header("location: ../objednavka.php?id=".$id);
      die();
    }
      
    $error = "Chyba";
}else{
      echo mysqli_error($conn);
    }
    
  } else {
    header("location: ../pridatDatumPlatnost.php?err=1");
    die();
}
?>

