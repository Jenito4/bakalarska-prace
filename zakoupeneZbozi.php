<?php
  $title = "Zakoupené zboží | Potes";
  include_once("header.php");

  if(!isset($_GET["id"])){
    header("location: index.php");
    die();
  }

  $id_zakoupene_zbozi = (int)$_GET["id"];

  $id_zakoupene_zbozi = (int)$_GET["id"];
  $sql = "SELECT * FROM zakoupene_zbozi, zbozi, zakaznici WHERE zakoupene_zbozi.id_zakoupene_zbozi = $id_zakoupene_zbozi AND zbozi.id_zbozi = zakoupene_zbozi.id_zbozi AND zakaznici.id_zakaznik = zakoupene_zbozi.id_zakaznik";

  if($query = mysqli_query($conn, $sql)){
    while($row = mysqli_fetch_array($query)){
      $ico = $row["ico"];
      $nazevZbozi = $row["nazevZbozi"];
      $datum_nakup = date_format(date_create($row["datum_nakup"]), "j. n. Y"); 
      $datum_platnosti = date_format(date_create($row["datum_platnosti"]), "j. n. Y");  
      $umisteni = $row["umisteni"];
      if(strlen($row["foto"]) > 0){
                  $foto = $row["foto"];
                } else {
                  $foto = "default.JPG";
                }
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
            <td>IČO:</td>
            <td><?php echo $ico; ?></td>
          </tr>
          <tr>
            <td>Zboží:</td>
            <td><?php echo $nazevZbozi; ?></td>
          </tr>
          <tr class="bolder">
            <td>Datum nákupu:</td>
            <td><?php echo $datum_nakup; ?></td>
          </tr>
           <tr class="bolder">
            <td>Datum platnosti servisu:</td>
            <td><?php echo $datum_platnosti; ?></td>
          </tr>
          <tr class="bolder">
            <td>Úmistění techniky:</td>
            <td><?php echo $umisteni; ?></td>
          </tr>
        </table>
        
              
              <a href="objednaniServisu.php?id=<?php echo $id_zakoupene_zbozi; ?>" class="btn btn-success" alt="Objednat servis">Objednat servis</a>
        &emsp;
        &emsp;
       
        <a href="pridatUmisteni.php?id=<?php echo $id_zakoupene_zbozi; ?>" class="btn btn-primary" alt="Přidat umístění">Přidat / změnit umístění</a>
        &emsp;
        &emsp;
        
         <br>
        <br>
  </div>       
  <div class="panel-body">
                          <figure><img src="/foto_zbozi/<?php echo $foto; ?>" class="img-responsive" alt="<?php echo $nazevZbozi; ?>"></figure>
                      </div> 
 <?php
        $sql = "SELECT id_objednavky, ico, nazevZbozi, datum_objednani, datum_kontroly, status FROM objednavky, zbozi, zakoupene_zbozi
          WHERE zbozi.id_zbozi = zakoupene_zbozi.id_zbozi AND zakoupene_zbozi.id_zakoupene_zbozi = objednavky.id_zakoupene_zbozi AND zakoupene_zbozi.id_zakoupene_zbozi = $id_zakoupene_zbozi
          ORDER BY id_objednavky DESC";
        if($query = mysqli_query($conn, $sql)){
          if(mysqli_num_rows($query) > 0){
            echo "<table class='table'>\n
              <tr>
                <th>Variabilní symbol</th>
                <th>Stav</th>
                <th>Zboží</th>
                <th>Datum objednání</th>
                <th>Datum kontorly</th>
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
                  <td><?php echo date_format(date_create($row["datum_kontroly"]), "j. n. Y"); ?></td>
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

</div>
</div>
</div>

<?php
  include_once("footer.php");
?>
