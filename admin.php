<?php
  $title = "Admin | Potes";
  include_once("header.php");

  if(!isset($_GET["id"])){
    header("location: index.php");
    die();
  }

  $id_admin = (int)$_GET["id"];

  $id_admin = (int)$_GET["id"];
  $sql = "SELECT * FROM admini WHERE admini.id_admin = $id_admin";

  if($query = mysqli_query($conn, $sql)){
    while($row = mysqli_fetch_array($query)){
      $jmenoAdmin = $row["jmenoAdmin"];
      $prijmeniAdmin = $row["prijmeniAdmin"];
      $telefonAdmin = $row["telefonAdmin"];
      $emailAdmin = $row["emailAdmin"];

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
            <td><?php echo $jmenoAdmin." ".$prijmeniAdmin; ?></td>
          </tr>
          <tr class="bolder">
            <td>Telefon:</td>
            <td><?php echo $telefonAdmin; ?></td>
          </tr>
          <tr class="bolder">
            <td>E-mail</td>
            <td><?php echo $emailAdmin; ?></td>
          </tr>
     
        
        </table>

        <a href="aktualizovat_admin.php?id=<?php echo $id_admin; ?>" class="btn btn-success" alt="Aktualizovat admina">Aktualizovat admina</a>
        &emsp;
        &emsp;
     
        <?php
       
          $sql = "SELECT COUNT(id_admin) AS pocet FROM admini";
          if($q = mysqli_query($conn, $sql)){
            while($r = mysqli_fetch_array($q)){
              $pocet = $r["pocet"];
            }
            if($pocet != 1) {
         
          ?>
             
              <a href="php/smazat_admin.php?id=<?php echo $id_admin; ?>" class="btn btn-danger" alt="Smazat admina" onclick="return confirm('Smaazat tohoto admina?')">Smazat admina</a>
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
