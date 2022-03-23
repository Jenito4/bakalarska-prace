<?php
  $title = "Katalog zboží | Potes";
  include_once("header.php");

  if(!isset($_GET["id"])){
    header("location: index.php");
    die();
  }

  $id_zbozi = (int)$_GET["id"];

  $id_zbozi = (int)$_GET["id"];
  $sql = "SELECT * FROM zbozi, kategorie WHERE id_zbozi = $id_zbozi AND kategorie.id_kategorie = zbozi.id_kategorie";

  if($query = mysqli_query($conn, $sql)){
    while($row = mysqli_fetch_array($query)){
      $ico = $row["ico"];
      $nazevZbozi = $row["nazevZbozi"];
      $nazevKategorie = $row["nazevKategorie"];
      $popis = $row["popis"];
      $cena = $row["cena"];
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

      <div class="col-sm-5">
        <table class="table">  
        <div class="panel-body">
                          <figure><img src="/foto_zbozi/<?php echo $foto; ?>" class="img-responsive" alt="<?php echo $nazevZbozi; ?>"></figure>
                      </div>    
          <tr>
            <td>Číslo Zboží:</td>
            <td><?php echo $ico; ?></td>
          </tr>
          <tr>
            <td>Název zboží:</td>
            <td><?php echo $nazevZbozi; ?></td>          
          </tr>
          <tr>
            <td>Kategorie:</td>
            <td><?php echo $nazevKategorie; ?></td>
          </tr>
          <tr class="bolder">
            <td>Cena: </td>
            <td><?php echo $cena; ?> Kč</td>
          </tr>
        </table>

        <?php
        switch($_SESSION["role"]) {
            case "admin":
             ?> 
        <a href="aktualizovat_zbozi.php?id=<?php echo $id_zbozi; ?>" class="btn btn-success" alt="Aktualizovat zboží">Aktualizovat zboží</a>
        &emsp;
        &emsp;
             
             <?php
          $sql = "SELECT COUNT(id_zbozi) AS pocet FROM zakoupene_zbozi WHERE id_zbozi = $id_zbozi";
          if($q = mysqli_query($conn, $sql)){
            while($r = mysqli_fetch_array($q)){
              $pocet = $r["pocet"];
            }
            if($pocet == 0) {
              ?>
              <a href="php/smazat_zbozi.php?id=<?php echo $id_zbozi; ?>" class="btn btn-danger" alt="Smazat zboží" onclick="return confirm('Smaazat toto zboží?')">Smazat zboží</a>
           
              <?php
            }
          } else {
            echo mysqli_error($conn);
          }
             break;
             }
      
             ?>  

        <br />
        <br />
      </div>

      <div class="col-sm-1">
      </div>
      
      <div class="col-sm-4">

        <?php
          if(!empty($popis)){
        ?>
            <div class="alert alert-info" role="alert">
              <?php echo "<strong>Program: </strong>".$popis; ?>
            </div>
        <?php
          }
        ?>
      </div>      
                


      <div class="col-sm-1">
    </div>
  </div>
</div>
</div>

<?php
  include_once("footer.php");
?>
