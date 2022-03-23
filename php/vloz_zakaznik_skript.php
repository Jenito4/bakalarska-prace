<?php
include_once("../mysql_connect.php");

$error = false;

if(isset($_POST["jmenoZakaznik"]) && strlen(trim($_POST["jmenoZakaznik"])) > 0){
 $jmenoZakaznik = mysqli_real_escape_string($conn, $_POST["jmenoZakaznik"]);
} else {
  $error = true;
  echo 1;
}

if(isset($_POST["prijmeniZakaznik"]) && strlen(trim($_POST["prijmeniZakaznik"])) > 0){
 $prijmeniZakaznik = mysqli_real_escape_string($conn, $_POST["prijmeniZakaznik"]);
} else {
  $error = true;
  echo 2;
}

if(isset($_POST["emailZakaznik"]) && filter_var($_POST["emailZakaznik"], FILTER_VALIDATE_EMAIL)){
  $emailZakaznik = mysqli_real_escape_string($conn, $_POST["emailZakaznik"]);
} else {
  $error = true;
  echo 4;
}

if(isset($_POST["telefonZakaznik"]) && strlen(trim($_POST["telefonZakaznik"])) >= 9 && strlen(trim($_POST["telefonZakaznik"])) <= 16){
  $telefonZakaznik = mysqli_real_escape_string($conn, $_POST["telefonZakaznik"]);
} else {
  $error = true;
  echo 5;
}

// variabilní symbol
  $sqlSelect = "SELECT username FROM uzivatele ORDER BY id_uzivatel DESC LIMIT 1";
  if($query = mysqli_query($conn, $sqlSelect)){
    if(mysqli_num_rows($query) == 1){
      while($row = mysqli_fetch_array($query)){
        $username = (int)$row["username"];
      }
      $username++;
    } else {
      $username = date("y")."001";
    }
  } else {
    echo mysqli_error($conn);
    die();
  }

  //heslo
$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
$password = substr( str_shuffle( $chars ), 0, 8 );

if(!$error){
  $sql = "INSERT INTO uzivatele(username, password, role)
    VALUES('$username', SHA2('$password', 256), 'zakaznik')";

  if($query = mysqli_query($conn, $sql)){
    $last_id = mysqli_insert_id($conn);
    
  $sql2 = "INSERT INTO zakaznici(jmenoZakaznik, prijmeniZakaznik, emailZakaznik, telefonZakaznik, id_uzivatel)
    VALUES('$jmenoZakaznik', '$prijmeniZakaznik', '$emailZakaznik', '$telefonZakaznik', '$last_id')";
    
    if($query = mysqli_query($conn, $sql2)){
      } else {
    echo mysqli_error($conn);
      }
      
    $to      = $emailZakaznik;
    $subject = 'Registrace Zákazníka - Potes s.r.o.';
    $message = "<html><body>
      Dobrý den,<br>Registrace probìhla úspìšnì. <br />
      Vaše pøihlašovací jméno je: <b>".$username."</b><br />
      Vaše heslo je: <b>".$password."</b><br />
      <br><br>Potes s.r.o.
      <br><br>E-mail je generován automaticky, neopovídejte na nìj
      </body></html>";
    $headers = "From: potes@potes.cz\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";

    mail($to, $subject, $message, $headers);
      
    header("location: ../zakaznici.php");
    die();
  } else {
    echo mysqli_error($conn);
  }
} else {
  header("location: ../vloz_zakaznik.php?err=1");
  die();
}
?>   
