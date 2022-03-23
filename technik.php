<?php
  $title = "Technik | Potes";
  include_once("header.php");

  if(!isset($_GET["id"])){
    header("location: index.php");
    die();
  }

  $id_technik = (int)$_GET["id"];

  $id_technik = (int)$_GET["id"];
  $sql = "SELECT * FROM technici WHERE technici.id_technik = $id_technik";

  if($query = mysqli_query($conn, $sql)){
    while($row = mysqli_fetch_array($query)){
      $jmenoTechnik = $row["jmenoTechnik"];
      $prijmeniTechnik = $row["prijmeniTechnik"];
      $telefonTechnik = $row["telefonTechnik"];
      $emailTechnik = $row["emailTechnik"];

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
            <td><?php echo $jmenoTechnik." ".$prijmeniTechnik; ?></td>
          </tr>
          <tr class="bolder">
            <td>Telefon:</td>
            <td><?php echo $telefonTechnik; ?></td>
          </tr>
          <tr class="bolder">
            <td>E-mail</td>
            <td><?php echo $emailTechnik; ?></td>
          </tr>
          
          <?php
        $sql = "SELECT id_objednavky, ico, nazevZbozi, datum_objednani, status, jmenoZakaznik, prijmeniZakaznik FROM objednavky, zbozi, technici, zakaznici, zakoupene_zbozi
          WHERE zbozi.id_zbozi = zakoupene_zbozi.id_zbozi AND zakaznici.id_zakaznik = zakoupene_zbozi.id_zakaznik AND technici.id_technik = objednavky.id_technik AND zakoupene_zbozi.id_zakoupene_zbozi = objednavky.id_zakoupene_zbozi AND technici.id_technik = $id_technik
          ORDER BY id_objednavky DESC";
        if($query = mysqli_query($conn, $sql)){
          if(mysqli_num_rows($query) > 0){
            echo "<table class='table'>\n
              <tr>
                <th>Variabilní symbol</th>
                <th>Stav</th>
                <th>Zboží</th>
                <th>Datum objednání</th>
                <th>Jméno zákazníka</th>
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
                        }
                      }

                    ?>
                  </td>
                  <td><?php echo $row["nazevZbozi"]; ?></td>
                  <td><?php echo date_format(date_create($row["datum_objednani"]), "j. n. Y"); ?></td>
                  <td><?php echo $row["jmenoZakaznik"]." ".$row["prijmeniZakaznik"]; ?></td>
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

        <a href="aktualizovat_technik.php?id=<?php echo $id_technik; ?>" class="btn btn-success" alt="Aktualizovat technika">Aktualizovat technika</a>
        &emsp;
        &emsp;
     
       <?php
       
          $sql = "SELECT COUNT(id_objednavky) AS pocet FROM objednavky WHERE id_technik = $id_technik";
          if($q = mysqli_query($conn, $sql)){
            while($r = mysqli_fetch_array($q)){
              $pocet = $r["pocet"];
            }
            if($pocet == 0) {
         
          ?>
             
              <a href="php/smazat_technik.php?id=<?php echo $id_technik; ?>" class="btn btn-danger" alt="Smazat technika" onclick="return confirm('Smaazat tohoto technika?')">Smazat technika</a>
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
