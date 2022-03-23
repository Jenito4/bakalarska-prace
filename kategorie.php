<?php
  $title = "Kategorie | Potes";
  include_once("header.php");

  if(!isset($_GET["id"])){
    header("location: index.php");
    die();
  }

  $id_kategorie = (int)$_GET["id"];

  $id_technik = (int)$_GET["id"];
  $sql = "SELECT * FROM kategorie";

  if($query = mysqli_query($conn, $sql)){
    while($row = mysqli_fetch_array($query)){
      $nazevKategorie = $row["nazevKategorie"];

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
            <td>Název:</td>
            <td><?php echo $nazevKategorie; ?></td>
          </tr>
        
        </table>

        <a href="aktualizovat_kategorie.php?id=<?php echo $id_kategorie; ?>" class="btn btn-success" alt="Aktualizovat kategorii">Aktualizovat kategorii</a>
        &emsp;
        &emsp;
     
       <?php
       
          $sql = "SELECT COUNT(id_zbozi) AS pocet FROM zbozi WHERE id_kategorie = $id_kategorie";
          if($q = mysqli_query($conn, $sql)){
            while($r = mysqli_fetch_array($q)){
              $pocet = $r["pocet"];
            }
            if($pocet == 0) {
         
          ?>
             
              <a href="php/smazat_kategorie.php?id=<?php echo $id_kategorie; ?>" class="btn btn-danger" alt="Smazat kategorii" onclick="return confirm('Smaazat tuto kategorii?')">Smazat kategorii</a>
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

<?php
  include_once("footer.php");
?>
