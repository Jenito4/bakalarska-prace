<?php
include_once("../../mysql_connect.php");

if(isset($_GET['id_seminare'])){
$sql = "SELECT * FROM seminar, lektori, mista WHERE seminar.id_seminare = $id_seminare AND lektori.id_lektora = seminar.id_lektora AND mista.id_mista = seminar.id_mista";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
}
//Update Information
if(isset($_POST['aktualizovat'])){
      $symbol = $row["symbol"];
      $nazevSeminare = $row["nazev"];
      $jmeno = $row["jmeno"];
      $prijmeni = $row["prijmeni"];
      $mesto = $row["mesto"];
      $ulice = $row["ulice"];
      $psc = $row["psc"];
      $datum = $row["datum"];
      $zahajeni = $row["zahajeni"];
      $registrace = $row["registrace"];
      $ukonceni = $row["ukonceni"];
      $popis = $row["popis"];
      $cena = $row["cena"];
    $update = "UPDATE seminar SET cena='$cena', popis='$popis', nazev='$nazevSeminare', datum='$datum', zahajeni='$zahajeni', registrace='$registrace', ukonceni='$ukonceni', jmeno='$jmeno', mesto='$mesto', ulice='$ulice', popisek='$popisek' WHERE seminar.id_seminare = $id_seminare";
    $up = mysqli_query($conn, $update);
if(!isset($sql)){
  die ("Chyba $sql" .mysqli_connect_error());
}
else
{
  header("location: ../index.php");
}
}

?>

<form method="post">
<br />
<h1>Aktualizace semináře</h1>
<label>Jméno:</label><input type="text" name="jmeno" placeholder="jmeno" value="<?php echo $row['jmeno']; ?>"><br/><br/>
<label>Název:</label><input type="text" name="nazev" placeholder="nazev" value="<?php echo $row['nazev']; ?>"><br/><br/>
<label>Město:</label><input type="text" name="mesto" placeholder="mesto" value="<?php echo $row['mesto']; ?>"><br/><br/>
<label>Datum:</label><input type="date" name="datum" placeholder="datum" value="<?php echo $row['datum']; ?>"><br/><br/>
<label>Zahájení:</label><input type="time" name="zahajeni" placeholder="zahajeni" value="<?php echo $row['zahajeni']; ?>"><br/><br/>
<label>Registrace:</label><input type="time" name="registrace" placeholder="registrace" value="<?php echo $row['registrace']; ?>"><br/><br/>
<label>Ukončení:</label><input type="time" name="ukonceni" placeholder="ukonceni" value="<?php echo $row['ukonceni']; ?>"><br/><br/>
<label>Popis:</label><input type="text" name="popis" placeholder="popis" value="<?php echo $row['popis']; ?>"><br/><br/>
<label>Cena:</label><input type="number" name="cena" placeholder="cena" value="<?php echo $row['cena']; ?>"><br/><br/>
<button type="submit" name="aktualizovat" id="aktualizovat" onClick="update()"><strong>Aktualizovat</strong></button>
<a href="../index.php"><button type="button" value="button">Zrušit</button></a>
</form>

<script>
function update(){
var x;
if(confirm("Updated data Sucessfully") == true){
x= "update";
}
}
</script>

<?php
include_once("../footer.php");
?>