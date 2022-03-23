<?php
    $title = "Technici | Potes";
    include_once("header.php");
?>
 <link rel="stylesheet" href="stylesadmin.css">

<div class="container">
<div class="pagePadding">
  <div class="row">

    <div class="col-sm-14">

        <h1>Technici</h1>
        <a href="vloz_technik.php" class="btn btn-primary" alt="Vložit"><span class="glyphicon glyphicon-plus"></span> Přidat nový</a><br><br>
        <?php
        $sql = "SELECT * FROM technici
        ORDER BY prijmeniTechnik";
        if($query = mysqli_query($conn, $sql)){
          if(mysqli_num_rows($query) > 0){  
            echo "<table class='table'>\n
              <tr>
                <th>Jméno technika</th>
                <th>Telefon</th>
                <th>E-mail</th>
              </tr>\n";

              while($row = mysqli_fetch_array($query)){
                  ?>
                  <tr class='clickable-row alert alert-info' data-href='technik.php?id=<?php echo $row["id_technik"] ?>' style="cursor: pointer;">

                  <td><?php echo $row["jmenoTechnik"]." ".$row["prijmeniTechnik"]; ?></td>
                  <td><?php echo $row["telefonTechnik"]; ?></td>
                  <td><?php echo $row["emailTechnik"]; ?></td>
                </tr>
                <?php
              }

            echo "</table>\n";
          } else {
            echo "Žádní noví technici";
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
