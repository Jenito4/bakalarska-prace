<?php
  $title = "Kategorie | Potes";
  include_once("header.php");

  if(!isset($_GET["id"])){
    header("location: index.php");
    die();
  }

  $id_kategorie = (int)$_GET["id"];

  $id_kategorie = (int)$_GET["id"];
  $sql = "SELECT * FROM kategorie WHERE kategorie.id_kategorie = $id_kategorie";

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
       <form enctype="multipart/form-data" action="php/aktualizace_kategorie.php" method="post">
       <input type="hidden" name="id" value="<?php echo $id_kategorie; ?>">
      <div class="col-sm-5">
        <table class="table">
          <tr class="bolder">
            <td>Jméno:</td>
            <td><input name="nazevKategorie" class="form-control" type="text" id="nazevKategorie" value="<?php echo $nazevKategorie; ?>" size="15" required /></td>
          </tr>
        </table>

        <input class="btn btn-primary" type="submit" value="Aktualizovat" /><br /><br />
        &emsp;
        &emsp;

          <br />
         <br />
      </div>
      </form>
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
