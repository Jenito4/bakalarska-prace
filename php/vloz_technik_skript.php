<?php
include_once("../mysql_connect.php");

$error = false;

if(isset($_POST["jmenoTechnik"]) && strlen(trim($_POST["jmenoTechnik"])) > 0){
 $jmenoTechnik = mysqli_real_escape_string($conn, $_POST["jmenoTechnik"]);
} else {
  $error = true;
  echo 1;
}

if(isset($_POST["prijmeniTechnik"]) && strlen(trim($_POST["prijmeniTechnik"])) > 0){
 $prijmeniTechnik = mysqli_real_escape_string($conn, $_POST["prijmeniTechnik"]);
} else {
  $error = true;
  echo 2;
}

if(isset($_POST["emailTechnik"]) && filter_var($_POST["emailTechnik"], FILTER_VALIDATE_EMAIL)){
  $emailTechnik = mysqli_real_escape_string($conn, $_POST["emailTechnik"]);
} else {
  $error = true;
  echo 4;
}

if(isset($_POST["telefonTechnik"]) && strlen(trim($_POST["telefonTechnik"])) >= 9 && strlen(trim($_POST["telefonTechnik"])) <= 16){
  $telefonTechnik = mysqli_real_escape_string($conn, $_POST["telefonTechnik"]);
} else {
  $error = true;
  echo 5;
}

  // variabiln� symbol
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
    VALUES('$username', SHA2('$password', 256), 'technik')";

  if($query = mysqli_query($conn, $sql)){
    $last_id2 = mysqli_insert_id($conn);
    
  $sql2 = "INSERT INTO technici(jmenoTechnik, prijmeniTechnik, emailTechnik, telefonTechnik, id_uzivatel)
    VALUES('$jmenoTechnik', '$prijmeniTechnik', '$emailTechnik', '$telefonTechnik', '$last_id2')";
    
    if($query = mysqli_query($conn, $sql2)){
      } else {
    echo mysqli_error($conn);
      }
      
    $to      = $emailTechnik;
    $subject = 'Registrace Technika - Potes s.r.o.';
    $message = "<html><body>
      Dobr� den,<br>Registrace prob�hla �sp�n�. <br />
      Va�e p�ihla�ovac� jm�no je: <b>".$username."</b><br />
      Va�e heslo je: <b>".$password."</b><br />
      <br><br>Potes s.r.o.
      <br><br>E-mail je generov�n automaticky, neopov�dejte na n�j
      </body></html>";
    $headers = "From: potes@potes.cz\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";

    mail($to, $subject, $message, $headers);
      
    header("location: ../technici.php");
    die();
  } else {
    echo mysqli_error($conn);
  }
} else {
  header("location: ../vloz_technik.php?err=1");
  die();
}

?>   

