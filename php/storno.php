<?php
include_once("../mysql_connect.php");

$id = (int)$_GET["id"];



$sqlSelect = "SELECT datum_kontroly, emailZakaznik, nazevZbozi FROM objednavky, zakoupene_zbozi, zbozi, zakaznici WHERE id_objednavky = $id AND zakaznici.id_zakaznik = zakoupene_zbozi.id_zakaznik AND zbozi.id_zbozi = zakoupene_zbozi.id_zbozi AND zakoupene_zbozi.id_zakoupene_zbozi = objednavky.id_zakoupene_zbozi";
if($querySelect = mysqli_query($conn, $sqlSelect)){
  while($row = mysqli_fetch_array($querySelect)){
    $emailZakaznik = $row["emailZakaznik"];
    $nazevZbozi = $row["nazevZbozi"];
    $datum_kontroly = date_format(date_create($row["datum_kontroly"]), "j. n. Y");
  }
} else {
  echo mysqli_error($conn);
  die();
}

$sql = "DELETE FROM objednavky WHERE id_objednavky = $id";
if($query = mysqli_query($conn, $sql)){

    $to      = $emailZakaznik;
    $subject = 'Storno objednávky - Potes s.r.o.';
    $message = "<html><body>
      Dobrý den,<br>stornovali jsme objednávku servisu Vaší techniky <b>".$nazevZbozi."</b>, která měla proběhnout dne <b>".$datum_kontroly."</b>.
      <br><br>Potes s.r.o.
      <br><br>E-mail je generován automaticky, neopovídejte na něj
      </body></html>";
    $headers = "From: potes@pottes.cz\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";

    mail($to, $subject, $message, $headers);



  header("location: ../objednavky.php?del=1");
} else {
  echo mysqli_error($conn);
  die();
}
?>