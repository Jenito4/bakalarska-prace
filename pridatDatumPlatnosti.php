<?php
  $title = "Datum platnosti servisu | Potes";
  include_once("header.php");

  if(!isset($_GET["id"])){
    header("location: index.php");
    die();
  }

  $id_objednavky = (int)$_GET["id"];

  $id_objednavky = (int)$_GET["id"];
  $sql = "SELECT * FROM objednavky, zbozi, zakaznici, technici, zakoupene_zbozi, kategorie WHERE objednavky.id_objednavky = $id_objednavky AND zbozi.id_zbozi = zakoupene_zbozi.id_zbozi AND kategorie.id_kategorie = zbozi.id_kategorie AND zakaznici.id_zakaznik = zakoupene_zbozi.id_zakaznik AND zakoupene_zbozi.id_zakoupene_zbozi = objednavky.id_zakoupene_zbozi AND technici.id_technik = objednavky.id_technik";

  if($query = mysqli_query($conn, $sql)){
    while($row = mysqli_fetch_array($query)){
      $cena = $row["cena"];
      $nazevZbozi = $row["nazevZbozi"];
      $nazevKategorie = $row["nazevKategorie"];
      $datum_nakup = date_format(date_create($row["datum_nakup"]), "j. n. Y");
      $datum_objednani = date_format(date_create($row["datum_objednani"]), "j. n. Y");    
      $datum_kontroly = date_format(date_create($row["datum_kontroly"]), "j. n. Y");  
      $datum_platnosti = date_format(date_create($row["datum_platnosti"]), "j. n. Y");  
      $ico = $row["ico"];
      $status = $row["status"];
      $jmenoZakaznik = $row["jmenoZakaznik"];
      $prijmeniZakaznik = $row["prijmeniZakaznik"];
      $jmenoTechnik = $row["jmenoTechnik"];
      $prijmeniTechnik = $row["prijmeniTechnik"];
      $emailZakaznik = $row["emailZakaznik"];
      $telefonZakaznik = $row["telefonZakaznik"];
      $nazev_spolecnosti = $row["nazev_spolecnosti"];
      $zprava = $row["zprava"];
 
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
        <form enctype="multipart/form-data" action="php/pridatPlatnostSkript.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id_objednavky; ?>">
      <div class="col-sm-5">
        <table class="table">
          <tr>
            <td>Jméno zákazníka:</td>
            <td><?php echo $jmenoZakaznik." ".$prijmeniZakaznik; ?></td>
          </tr>
          <tr class="bolder">
            <td>E-mail:</td>
            <td><?php echo $emailZakaznik; ?></td>
          </tr>
          <tr class="bolder">
            <td>Telefon:</td>
            <td><?php echo $telefonZakaznik; ?></td>
          </tr>
          <tr>
            <td>Jméno technika:</td>
            <td><?php echo $jmenoTechnik." ".$prijmeniTechnik; ?></td>
          </tr>
                 <br />                 
        </table>    
     

          <label for="PlatnostDatum">Datum nové platnosti servisu:* </label><br>
                        <input type="date" class="form-control" name="PlatnostDatum" id="PlatnostDatum" required /><br />
            
          
    
             <input class="btn btn-primary" type="submit" value="Přidat datum platnosti" /><br /><br />
            </div>     
        </form>


      <div class="col-sm-1">
      </div>




      <div class="col-sm-4">
        
        <table class="table">
          <tr>
            <td>Číslo zboží:</td>
            <td><?php echo $ico; ?></td>
          </tr>
          <tr>
            <td>Název zboží:</td>
            <td><?php echo $nazevZbozi; ?></td>
          </tr>
          <tr>
            <td>Kategorie:</td>
            <td><?php echo $nazevKategorie; ?></td>
          </tr>
          <tr class="bolder">
            <td>Datum nákupu: </td>
            <td><?php echo $datum_nakup; ?></td>
          </tr>
          <tr class="bolder">
            <td>Datum platnosti servisu: </td>
            <td><?php echo $datum_platnosti; ?></td>
          </tr>
          <tr class="bolder">
            <td>Datum objednání: </td>
            <td><?php echo $datum_objednani; ?></td>
          </tr>
          <tr class="bolder">
            <td>Datum kontroly: </td>
            <td><?php echo $datum_kontroly; ?></td>
          </tr>          
          <tr class="bolder">
            <td>Cena celkem: </td>
            <td><?php echo $cena; ?> Kč</td>
          </tr>
          <?php
            if($status != "on_spot"){
           ?>
          <?php
           }
           ?>          
          <tr>
            <td>Status</td>
            <td>
              <?php
                if($status == "new") {
                  echo "nová";
                } else if ($status == "paid") {
                  echo "zaplacená";
                } else {
                  echo "hotově";
                }
              ?>
          </td>
          </tr>
        </table>

        <?php
          if(!empty($zprava)){
        ?>
            <div class="alert alert-info" role="alert">
              <?php echo "<strong>Zpráva: </strong>".$zprava; ?>
            </div>
        <?php
          }
        ?>
        
      </div>



      <div class="col-sm-1">
    </div>
  </div>
</div>
</div>

<?php
  include_once("footer.php");
?>
