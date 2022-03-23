<?php
include_once("../mysql_connect.php");

$id = (int)$_GET["id"];

$sql = "UPDATE objednavky SET status = 'paid' WHERE id_objednavky = $id";

if($query = mysqli_query($conn, $sql)){
  $sqlSelect = "SELECT nazevZbozi, emailZakaznik FROM zakaznici, objednavky, zakoupene_zbozi, zbozi WHERE id_objednavky = $id AND zbozi.id_zbozi = zakoupene_zbozi.id_zbozi AND zakoupene_zbozi.id_zakoupene_zbozi = zakoupene_zbozi.id_zakoupene_zbozi";
  if($querySelect = mysqli_query($conn, $sqlSelect)){
    while($row = mysqli_fetch_array($querySelect)){     
      $emailZakaznik = $row["emailZakaznik"];
      $nazevZbozi = $row["nazevZbozi"];
      $datum_kontroly = date_format(date_create($row["datum_kontroly"]), "j. n. Y");
    }

    $to      = $emailZakaznik;
    $subject = 'Potvrzení platby - Potes s.r.o.';
    $message = "<html><body>Dobrý den,<br>
      potvrzujeme Vaši platbu za kontrolu techniky <b>".$nazevZbozi."</b> ze dne <b>".$datum_kontroly."</b>.
      <br><br>Potes s.r.o.
      <br><br>E-mail je generován automaticky, neopovídejte na něj
      </body></html>";
    $headers = "From: potes@pottes.cz\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";

    mail($to, $subject, $message, $headers);

  } else {
    echo mysqli_error($conn);
    die();
  }

  header("location: ../objednavka.php?id=".$id);
} else {
  echo mysqli_error($conn);
  die();
}
?>
