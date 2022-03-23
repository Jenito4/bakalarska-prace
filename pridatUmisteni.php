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
      $umisteni = $row["umisteni"];
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
      <form enctype="multipart/form-data" action="php/umisteniTechniky_skript.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id_zakoupene_zbozi; ?>">
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
            <td>Umístění techniky:</td>
            <td><?php echo $umisteni; ?></td>
          </tr>
          </table>
          <tr class="bolder">
          <label for="umisteniTechniky">Umístění techniky: </label><br>
                          <textarea class="form-control" name="umisteniTechniky" placeholder="Kde je technika umístěna" maxlength="200" style="height:8em;"></textarea><br />                                               
                 </tr>
                 <br />
                 
        
             <input class="btn btn-primary" type="submit" value="Přidat umístění" /><br /><br />
        &emsp;
        &emsp;
      
  </div>
  </form> 
</div>
</div>
</div>

<?php
  include_once("footer.php");
?>
