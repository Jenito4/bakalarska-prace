<?php
$jmeno = $_POST['jmeno'];
$email = $_POST['email'];
$zprava = $_POST['zprava'];
$telefon = $_POST['telefon'];

$formcontent="$jmeno \n \n Telefon: $telefon";
$recipient = "210049@vutbr.cz";
$subject = "Dotaz z webové stránky";
$formcontent = "<html><body>
      ".$jmeno."<br><br>Telefon: $telefon <br><br>Dotaz: $zprava
      </body></html>";
$headers = "From: $email\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=utf-8\r\n";
       
mail($recipient, $subject, $formcontent, $headers) or die("Chyba!");
header("location:/kontakt.php?ok=1");
echo "Thank You!";
?>  