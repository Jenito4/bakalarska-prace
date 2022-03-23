<?php
  $title = "Technik | Potes";
  include_once("header.php");

  if(!isset($_GET["id"])){
    header("location: index.php");
    die();
  }

  $id_technik = (int)$_GET["id"];

  $id_technik = (int)$_GET["id"];
  $sql = "SELECT * FROM technici WHERE technici.id_technik = $id_technik";

  if($query = mysqli_query($conn, $sql)){
    while($row = mysqli_fetch_array($query)){
      $jmenoTechnik = $row["jmenoTechnik"];
      $prijmeniTechnik = $row["prijmeniTechnik"];
      $telefonTechnik = $row["telefonTechnik"];
      $emailTechnik = $row["emailTechnik"];

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
       <form enctype="multipart/form-data" action="php/aktualizace_technik.php" method="post">
       <input type="hidden" name="id" value="<?php echo $id_technik; ?>">
      <div class="col-sm-5">
        <table class="table">
          <tr class="bolder">
            <td>Jméno:</td>
            <td><input name="jmenoTechnik" class="form-control" type="text" id="jmenoTechnik" value="<?php echo $jmenoTechnik; ?>" size="15" required /></td>
          </tr>
          <tr class="bolder">
            <td>Příjmení:</td>
            <td><input name="prijmeniTechnik" class="form-control" type="text" id="prijmeniTechnik" value="<?php echo $prijmeniTechnik; ?>" size="15" required /></td>
          </tr>
          <tr class="bolder">
            <td>Telefon:</td>
            <td><input name="telefonTechnik" class="form-control" type="text" id="telefonTechnik" value="<?php echo $telefonTechnik; ?>" size="15" required /></td>
          </tr>
          <tr class="bolder">
            <td>E-mail</td>
            <td><input name="emailTechnik" class="form-control" type="email" id="emailTechnik" value="<?php echo $emailTechnik; ?>" size="15" required /></td>
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
