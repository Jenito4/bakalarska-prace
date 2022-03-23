<?php
  $title = "Objednání servisu | Potes";
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
      $cena = $row["cena"];
      $nazevZbozi = $row["nazevZbozi"];  
      $datum_nakup = date_format(date_create($row["datum_nakup"]), "j. n. Y"); 
      $datum_platnosti = date_format(date_create($row["datum_platnosti"]), "j. n. Y"); 
      $ico = $row["ico"];
      $umisteni = $row["umisteni"];
      $emailZakaznik = $row["emailZakaznik"];
      $zprava = $row["zprava"]; 
      
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
        <form enctype="multipart/form-data" action="php/vytvoritObjednavku.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id_zakoupene_zbozi; ?>">
      <div class="col-sm-5">
        <table class="table">
          <tr>
            <td>Název zboží:</td>
            <td><?php echo $nazevZbozi; ?></td>
          </tr>
          <tr class="bolder">
            <td>IČO:</td>
            <td><?php echo $ico; ?></td>
          </tr>
          <tr>
            <td>Umístění techniky:</td>
            <td><?php echo $umisteni; ?></td>
          </tr>         
                 <br />
           <tr class="bolder">
            <td>Datum nákupu: </td>
            <td><?php echo $datum_nakup; ?></td>
          </tr>
          <tr class="bolder">
            <td>Datum platnosti servisu: </td>
            <td><?php echo $datum_platnosti; ?></td>
          </tr>
          <tr class="bolder">
            <td><strong>Cena za servis: </strong></td>
            <td><strong><?php echo $cena; ?> Kč</strong></td>
          </tr>                       
        </table>
         <div class="form-group">
            <label for="ObjednatDatum">Datum servisu:* </label><br>
                        <input type="date" class="form-control" name="ObjednatDatum" id="ObjednatDatum" required /><br />
            
            <label  for="ObjednatZprava">Zpráva k objednávce servisu: </label><br>
                          <textarea class="form-control" name="ObjednatZprava" placeholder="Máte nějaké přání?" maxlength="200" style="height:8em;"></textarea><br />                      
          </div>
             <input class="btn btn-primary" type="submit" value="Objednat servis" /><br /><br />
        &emsp;
        &emsp;
            
      </div>


        </form>
        
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



