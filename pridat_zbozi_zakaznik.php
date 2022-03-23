<?php
  $title = "Technik | Potes";
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
      $emailZakaznik = $row["emailZakaznik"];
      $telefonZakaznik = $row["telefonZakaznik"];
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
        <form enctype="multipart/form-data" action="php/pridat_zbozi_zakaznik_skript.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id_zakaznik; ?>">
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
          <tr class="bolder">
          <label for="prirad">Zboží:* </label><br>

                 <select class="form-control" name="prirad" id="prirad" placeholder="Vyberte zboží" required>
                   <?php
                     $sql = "SELECT id_zbozi, nazevZbozi FROM zbozi";

                     if($query = mysqli_query($conn, $sql)){
                       while($row = mysqli_fetch_array($query)){
                         if($row["id_zbozi"] == $id_zbozi){
                           echo "<option value=".$row["id_zbozi"]." selected>".$row["nazevZbozi"]."</option>\n";
                         } else {
                           echo "<option value=".$row["id_zbozi"].">".$row["nazevZbozi"]."</option>\n";
                         }

                       }
                     } else {
                       echo "ERROR: ".mysqli_error($conn);
                     }

                   ?>
                 </select>
                 </tr>
                 <br />
                 
          <label for="nakupDatum">Datum nákupu:* </label><br>
                        <input type="date" class="form-control" name="nakupDatum" id="nakupDatum" required /><br />
          <label for="platnostDatum">Datum platnosti servisu:* </label><br>
                        <input type="date" class="form-control" name="platnostDatum" id="platnostDatum" required /><br />              
            
          
        </table>
             <input class="btn btn-primary" type="submit" value="Přidat zboží" /><br /><br />
        &emsp;
        &emsp;
      
      </div>


        </form>



      <div class="col-sm-1">
    </div>
  </div>
</div>
</div>

<?php
  include_once("footer.php");
?>
