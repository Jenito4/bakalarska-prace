<?php
  $title = "Zakazník | Potes";
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

      <div class="col-sm-6">
        <table class="table">
          <tr>
            <td>Jméno:</td>
            <td><?php echo $jmenoZakaznik." ".$prijmeniZakaznik; ?></td>
          </tr>
          <tr class="bolder">
            <td>Telefon:</td>
            <td><?php echo $telefonZakaznik; ?></td>
          </tr>
          <tr class="bolder">
            <td>E-mail</td>
            <td><?php echo $emailZakaznik; ?></td>
          </tr>
    
        <?php
        $sql = "SELECT id_objednavky, ico, nazevZbozi, datum_objednani, status, jmenoZakaznik FROM objednavky, zbozi, technici, zakaznici, zakoupene_zbozi
          WHERE zbozi.id_zbozi = zakoupene_zbozi.id_zbozi AND zakaznici.id_zakaznik = zakoupene_zbozi.id_zakaznik AND technici.id_technik = objednavky.id_technik AND zakoupene_zbozi.id_zakoupene_zbozi = objednavky.id_zakoupene_zbozi AND zakaznici.id_zakaznik = $id_zakaznik
          ORDER BY id_objednavky DESC";
        if($query = mysqli_query($conn, $sql)){
          if(mysqli_num_rows($query) > 0){
            echo "<table class='table'>\n
              <tr>
                <th>Variabilní symbol</th>
                <th>Stav</th>
                <th>Zboží</th>
                <th>Datum objednání</th>
              </tr>\n";

              while($row = mysqli_fetch_array($query)){
              if($row["status"] == "new"){
                ?>
                <tr class='clickable-row alert alert-success' data-href='objednavka.php?id=<?php echo $row["id_objednavky"] ?>' style="cursor: pointer;">
              <?php
                } elseif($row["status"] == "paid"){
              ?>
                <tr class='clickable-row alert alert-info' data-href='objednavka.php?id=<?php echo $row["id_objednavky"] ?>' style="cursor: pointer;">
              <?php
                } else {
              ?>
                 <tr class='clickable-row alert alert-warning' data-href='objednavka.php?id=<?php echo $row["id_objednavky"] ?>' style="cursor: pointer;">
              <?php
                }
              ?>

                  <td><?php echo $row["ico"]; ?></td>
                  <td>
                    <?php
                      if($row["status"] == "new") {
                        echo "nová";
                      } else {
                        if ($row["status"] == "paid") {
                        echo "zaplacená";
                        } else {
                        echo "hotově";
                        }
                      }

                    ?>
                  </td>
                  <td><?php echo $row["nazevZbozi"]; ?></td>
                  <td><?php echo date_format(date_create($row["datum_objednani"]), "j. n. Y"); ?></td>
                </tr>
                <?php
              }

            echo "</table>\n";
          } else {
            echo "Žádné objednávky";
          }
        } else {
          echo mysqli_error($conn);
        }
        ?>
       </table>
        <a href="aktualizovat_zakaznik.php?id=<?php echo $id_zakaznik; ?>" class="btn btn-success" alt="Aktualizovat zákazníka">Aktualizovat zákazníka</a>
        &emsp;
        &emsp;
        <a href="pridat_zbozi_zakaznik.php?id=<?php echo $id_zakaznik; ?>" class="btn btn-primary" alt="Přidat zboží">Přidat zboží</a>
        &emsp;
        &emsp;
        <?php
        
         $sql = "SELECT COUNT(id_zakoupene_zbozi) AS pocet FROM zakoupene_zbozi WHERE id_zakaznik = $id_zakaznik";
          if($q = mysqli_query($conn, $sql)){
            while($r = mysqli_fetch_array($q)){
              $pocet = $r["pocet"];
            }
            if($pocet == 0) {
            
              ?>
              <a href="php/smazat_zakaznik.php?id=<?php echo $id_zakaznik; ?>" class="btn btn-danger" alt="Smazat zákazníka" onclick="return confirm('Smaazat tohoto zákazníka?')">Smazat zákazníka</a>
              <?php
              
            }
          } else {
            echo mysqli_error($conn);
          }
          
        ?>


          <br />
         <br />
      </div>

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

<script>
jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});      
</script>

<?php
  include_once("footer.php");
?>
