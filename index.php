<?php
    $title = "Hlavní stránka | Potes";
    include_once("header.php");
?>
 <link rel="stylesheet" href="stylesadmin.css">

<div class="container">
<div class="pagePadding">
  <div class="row">

    <div class="col-sm-12">

        <h1>Nové objednávky</h1>

        <?php
        $sql="";
        switch($_SESSION["role"]) {
            case "zakaznik":
                $id_zakaznik = $_SESSION['id'];
                $sql = "SELECT id_objednavky, ico, nazevZbozi, datum_nakup, datum_objednani, datum_kontroly, datum_platnosti, status, jmenoZakaznik, prijmeniZakaznik FROM objednavky, zbozi, zakaznici, zakoupene_zbozi
          WHERE status <> 'paid' AND zbozi.id_zbozi = zakoupene_zbozi.id_zbozi AND zakaznici.id_zakaznik = zakoupene_zbozi.id_zakaznik AND zakoupene_zbozi.id_zakoupene_zbozi = objednavky.id_zakoupene_zbozi AND zakoupene_zbozi.id_zakaznik = $id_zakaznik
          ORDER BY id_objednavky DESC";
                break;
            case "technik":
                $id_technik = $_SESSION['id'];
                $sql = "SELECT id_objednavky, ico, nazevZbozi, datum_nakup, datum_objednani, datum_kontroly, datum_platnosti, status, jmenoZakaznik, prijmeniZakaznik, jmenoTechnik, prijmeniTechnik FROM objednavky, zbozi, zakaznici, zakoupene_zbozi, technici
          WHERE status <> 'paid' AND zbozi.id_zbozi = zakoupene_zbozi.id_zbozi AND zakaznici.id_zakaznik = zakoupene_zbozi.id_zakaznik AND zakoupene_zbozi.id_zakoupene_zbozi = objednavky.id_zakoupene_zbozi AND technici.id_technik = objednavky.id_technik AND objednavky.id_technik = $id_technik
          ORDER BY id_objednavky DESC";
                break;
            case "admin":
                $sql = "SELECT id_objednavky, ico, nazevZbozi, datum_nakup, datum_objednani, datum_kontroly, datum_platnosti, status, jmenoZakaznik, prijmeniZakaznik FROM objednavky, zbozi, zakaznici, zakoupene_zbozi
          WHERE status <> 'paid' AND zbozi.id_zbozi = zakoupene_zbozi.id_zbozi AND zakaznici.id_zakaznik = zakoupene_zbozi.id_zakaznik AND zakoupene_zbozi.id_zakoupene_zbozi = objednavky.id_zakoupene_zbozi
          ORDER BY id_objednavky DESC";
                break;
        }
        
        if($query = mysqli_query($conn, $sql)){
          if(mysqli_num_rows($query) > 0){
            echo "<table class='table'>\n
              <tr>
                <th>Variabilní symbol</th>
                <th>Stav</th>
                <th>Zboží</th>
                <th>Datum nákupu</th>
                <th>Datum objednání</th>
                <th>Datum kontroly</th>
                <th>Datum platnosti</th>
                <th>Jméno zákazníka</th>
              </tr>\n";

              while($row = mysqli_fetch_array($query)){
                if($row["status"] == "new"){
                  ?>
                  <tr class='clickable-row alert alert-success' data-href='objednavka.php?id=<?php echo $row["id_objednavky"] ?>' style="cursor: pointer;">
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
                  <td><?php echo date_format(date_create($row["datum_nakup"]), "j. n. Y"); ?></td>
                  <td><?php echo date_format(date_create($row["datum_objednani"]), "j. n. Y"); ?></td>
                  <td><?php echo date_format(date_create($row["datum_kontroly"]), "j. n. Y"); ?></td>
                  <td><?php echo date_format(date_create($row["datum_platnosti"]), "j. n. Y"); ?></td>
                  <td><?php echo $row["jmenoZakaznik"]." ".$row["prijmeniZakaznik"]; ?></td>
                </tr>
                <?php
              }

            echo "</table>\n";
          } else {
            echo "Žádné nové objednávky";
          }
        } else {
          echo mysqli_error($conn);
        }
        ?>

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
