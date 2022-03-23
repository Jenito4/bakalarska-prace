<?php
  $title = "Zákazník | Potes";
  include_once("header.php");

  if(!isset($_GET["id"])){
    header("location: index.php");
    die();
  }

  $id_zakaznik = (int)$_GET["id"];

  $id_zakaznik = (int)$_GET["id"];
  $sql = "SELECT * FROM zakaznici WHERE zakaznici.id_zakaznik = $id_zakaznik";

  if($query = mysqli_query($conn, $sql)){
    while($row = mysqli_fetch_array($query)){
      $jmenoZakaznik = $row["jmenoZakaznik"];
      $prijmeniZakaznik = $row["prijmeniZakaznik"];
      $telefonZakaznik = $row["telefonZakaznik"];
      $emailZakaznik = $row["emailZakaznik"];

    }
  } else {
    echo mysqli_error($conn);
    die();
  }
?>
 <link rel="stylesheet" href="stylesadmin.css">

<div class="container">
  <div class="pagePadding">
    <div class="row">
      <div class="col-sm-1">
      </div>
       <form enctype="multipart/form-data" action="php/aktualizace_zakaznik.php" method="post">
       <input type="hidden" name="id" value="<?php echo $id_zakaznik; ?>">
      <div class="col-sm-5">
        <table class="table">
          <tr class="bolder">
            <td>Jméno:</td>
            <td><input name="jmenoZakaznik" class="form-control" type="text" id="jmenoZakaznik" value="<?php echo $jmenoZakaznik; ?>" size="15" required /></td>
          </tr>
          <tr class="bolder">
            <td>Příjmení:</td>
            <td><input name="prijmeniZakaznik" class="form-control" type="text" id="prijmeniZakaznik" value="<?php echo $prijmeniZakaznik; ?>" size="15" required /></td>
          </tr>
          <tr class="bolder">
            <td>Telefon:</td>
            <td><input name="telefonZakaznik" class="form-control" type="text" id="telefonZakaznik" value="<?php echo $telefonZakaznik; ?>" size="15" required /></td>
          </tr>
          <tr class="bolder">
            <td>E-mail</td>
            <td><input name="emailZakaznik" class="form-control" type="email" id="emailZakaznik" value="<?php echo $emailZakaznik; ?>" size="15" required /></td>
          </tr>
        </table>

        <input class="btn btn-primary" type="submit" value="Aktualizovat" /><br /><br />
        &emsp;
        &emsp;

          <br />
         <br />
      </div>
      </form>
      <div class="col-sm-1">
      </div>

      <div class="col-sm-4">

        <table class="table">
          <tr>
          </tr>
        </table>

      </div>



      <div class="col-sm-1">
    </div>
  </div>
</div>
</div>

<?php
  include_once("footer.php");
?>
