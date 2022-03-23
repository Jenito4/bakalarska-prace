<?php
include_once("../mysql_connect.php");

$error = false;

if(isset($_POST["id"])){
 $id = mysqli_real_escape_string($conn, $_POST["id"]);
} else {
  $error = true;
  echo "err id<br>";
}

if(isset($_POST["ObjednatDatum"])){
 $ObjednatDatum = mysqli_real_escape_string($conn, $_POST["ObjednatDatum"]);
} else {
  $error = true;
  echo "err datum<br>";
}

if(isset($_POST["ObjednatZprava"])){
  $ObjednatZprava = mysqli_real_escape_string($conn, $_POST["ObjednatZprava"]);
} else {
    $ObjednatZprava = "";
}



if(!$error){
    $sql = "INSERT INTO objednavky(id_zakoupene_zbozi, zprava, datum_kontroly, id_technik)
    VALUES('$id', '$ObjednatZprava', '$ObjednatDatum', '1')";
    
  if($query = mysqli_query($conn, $sql)){
   $id_objednavky = mysqli_insert_id($conn);





// Mailer ---------------------------------------------------------------------------------------
$sqlMailMess = "SELECT emailZakaznik, nazevZbozi FROM zbozi, zakoupene_zbozi, zakaznici WHERE id_zakoupene_zbozi = $id AND zakaznici.id_zakaznik = zakoupene_zbozi.id_zakaznik AND zbozi.id_zbozi = zakoupene_zbozi.id_zbozi";

if($queryMail = mysqli_query($conn, $sqlMailMess)){
  while($rowMail = mysqli_fetch_array($queryMail)){
    $nazevZbozi = $rowMail["nazevZbozi"];
    $emailZakaznik = $rowMail["emailZakaznik"];
    $ObjednatDatum = date("j. n. Y", strtotime($ObjednatDatum)); 
  }
 


  $mess = "<html><body>Dobrý den,<br>
  potvrzujeme Vaši objednávku servisu zboží <b>".$nazevZbozi."</b>.<br>
  Techniku vyzvedneme dne <b>".$ObjednatDatum."</b>.<br>
  <br><br>
  Potes s.r.o.
  <br><br>E-mail je generován automaticky, neopovídejte na něj
  </body></html>";



} else {
  echo mysqli_error($conn);
  die();
}
//------------------------------------------------------------



    $to      = $emailZakaznik;
    $subject = 'Objednávka servisu - Potes s.r.o.';

    $message = $mess;

    $headers = "From: potes@pottes.cz\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";

    mail($to, $subject, $message, $headers);

    header("location: ../objednavky.php");
    
    die();
  } else {
    echo mysqli_error($conn);
  }
} else {
    header("location: ../objednaniServisu.php?id=".$id."&err=1");
    die();
}

  

?>
