<?php
include_once("../mysql_connect.php");

$error = false;

if(isset($_POST["jmenoAdmin"]) && strlen(trim($_POST["jmenoAdmin"])) > 0){
 $jmenoAdmin = mysqli_real_escape_string($conn, $_POST["jmenoAdmin"]);
} else {
  $error = true;
  echo 1;
}

if(isset($_POST["prijmeniAdmin"]) && strlen(trim($_POST["prijmeniAdmin"])) > 0){
 $prijmeniAdmin = mysqli_real_escape_string($conn, $_POST["prijmeniAdmin"]);
} else {
  $error = true;
  echo 2;
}

if(isset($_POST["emailAdmin"]) && filter_var($_POST["emailAdmin"], FILTER_VALIDATE_EMAIL)){
  $emailAdmin = mysqli_real_escape_string($conn, $_POST["emailAdmin"]);
} else {
  $error = true;
  echo 4;
}

if(isset($_POST["telefonAdmin"]) && strlen(trim($_POST["telefonAdmin"])) >= 9 && strlen(trim($_POST["telefonAdmin"])) <= 16){
  $telefonAdmin = mysqli_real_escape_string($conn, $_POST["telefonAdmin"]);
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
    VALUES('$username', SHA2('$password', 256), 'admin')";

  if($query = mysqli_query($conn, $sql)){
    $last_id2 = mysqli_insert_id($conn);
    
  $sql2 = "INSERT INTO admini(jmenoAdmin, prijmeniAdmin, emailAdmin, telefonAdmin, id_uzivatel)
    VALUES('$jmenoAdmin', '$prijmeniAdmin', '$emailAdmin', '$telefonAdmin', '$last_id2')";
    
    if($query = mysqli_query($conn, $sql2)){
      } else {
    echo mysqli_error($conn);
      }
      
    $to      = $emailAdmin;
    $subject = 'Registrace Admina - Potes s.r.o.';
    $message = "<html><body>
      Dobrý den,<br>Registrace proběhla úspěšně. <br />
      Vaše přihlašovací jméno je: <b>".$username."</b><br />
      Vaše heslo je: <b>".$password."</b><br />
      <br><br>Potes s.r.o.
      <br><br>E-mail je generován automaticky, neopovídejte na něj
      </body></html>";
    $headers = "From: potes@potes.cz\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";

    mail($to, $subject, $message, $headers);
      
    header("location: ../admini.php");
    die();
  } else {
    echo mysqli_error($conn);
  }
} else {
  header("location: ../vloz_admin.php?err=1");
  die();
}

?>   

