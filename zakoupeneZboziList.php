<?php
    $title = "Zakoupené zboží | Potes";
    include_once("header.php");
?>
 <link rel="stylesheet" href="stylesadmin.css">

<div class="container">
<div class="pagePadding">
  <div class="row">

    <div class="col-sm-12">

        <h1>Seznam zakoupeného zboží</h1>

        <?php
          if(isset($_GET["del"])){
          ?>
          <div class="alert alert-danger" role="alert">
            Storno provedeno
          </div>
          <?php
          }
        ?>   
        

        <?php
        $sql="";
        switch($_SESSION["role"]) {
            case "zakaznik":
                $id_zakaznik = $_SESSION['id'];
         $sql = "SELECT id_zakoupene_zbozi, ico, nazevZbozi, datum_nakup, datum_platnosti, jmenoZakaznik, prijmeniZakaznik, emailZakaznik, umisteni FROM zakoupene_zbozi, zbozi, zakaznici
          WHERE zbozi.id_zbozi = zakoupene_zbozi.id_zbozi AND zakaznici.id_zakaznik = zakoupene_zbozi.id_zakaznik AND zakoupene_zbozi.id_zakaznik = $id_zakaznik
          ORDER BY datum_platnosti ASC";
                break;
        }
        if($query = mysqli_query($conn, $sql)){
          if(mysqli_num_rows($query) > 0){
            echo "<table class='table'>\n
              <tr>
                <th>IČO</th>          
                <th>Zboží</th>
                <th>Datum nákupu</th>
                <th>Datum platnosti servisu</th>
                <th>Jméno zákazníka</th>
                <th>Umístění techniky</th>
              </tr>\n";
                
           while($row = mysqli_fetch_array($query)){
             $datum_platnosti = $row["datum_platnosti"];
 
             $datumPlatnosti30 = new DateTime($datum_platnosti);            
             $dnes = new DateTime();
             $dnes = $dnes->modify('+1 month');
             if($datumPlatnosti30 <= $dnes) {
               // TODO: méně jak 30 dnů

                ?>
                  <tr class='clickable-row alert alert-danger' data-href='zakoupeneZbozi.php?id=<?php echo $row["id_zakoupene_zbozi"] ?>' style="cursor: pointer;">
                 <?php

                     } else {
                
                ?>
                  <tr class='clickable-row alert alert-info' data-href='zakoupeneZbozi.php?id=<?php echo $row["id_zakoupene_zbozi"] ?>' style="cursor: pointer;">
                  <?php
                  }
              ?>
                <td><?php echo $row["ico"]; ?></td>  
                <td><?php echo $row["nazevZbozi"]; ?></td>
                <td><?php echo date_format(date_create($row["datum_nakup"]), "j. n. Y"); ?></td>
                <td><?php echo date_format(date_create($row["datum_platnosti"]), "j. n. Y"); ?></td>
                <td><?php echo $row["jmenoZakaznik"]." ".$row["prijmeniZakaznik"]; ?></td>
                <td><?php echo $row["umisteni"]; ?></td>
              </tr>
              <?php
            }

            echo "</table>\n";
          } else {
            echo "Žádné zakoupené zboží";
          }
        } else {
          echo mysqli_error($conn);
          die ();
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
