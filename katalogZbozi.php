<?php
    $title = "Katalog zboží | Potes";
    include_once("header.php");
?>
 <link rel="stylesheet" href="stylesadmin.css">

<div class="container">
<div class="pagePadding">
  <div class="row">

    <div class="col-sm-12">

        <h1>Technika</h1>
        <a href="vloz_zbozi.php" class="btn btn-primary" alt="Vložit"><span class="glyphicon glyphicon-plus"></span> Přidat nový</a><br><br>
        <?php
        $sql = "SELECT * FROM zbozi, kategorie WHERE kategorie.id_kategorie = zbozi.id_kategorie
        ORDER BY ico";
        if($query = mysqli_query($conn, $sql)){
          if(mysqli_num_rows($query) > 0){
            echo "<table class='table'>\n
              <tr>
                <th>Číslo</th>
                <th>Název</th>
                <th>Kategorie</th>
                <th>Cena za kus</th>
              </tr>\n";

              while($row = mysqli_fetch_array($query)){
                  ?>
                  <tr class='clickable-row alert alert-info' data-href='zbozi.php?id=<?php echo $row["id_zbozi"] ?>' style="cursor: pointer;">
                  
                  <td><?php echo $row["ico"]; ?></td>
                  <td><?php echo $row["nazevZbozi"]; ?></td>
                  <td><?php echo $row["nazevKategorie"]; ?></td>
                  <td><?php echo $row["cena"]; ?></td>
                </tr>
                <?php
              }

            echo "</table>\n";
          } else {
            echo "Žádná nová technika";
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
