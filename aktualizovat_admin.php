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
       <form enctype="multipart/form-data" action="php/aktualizace_admin.php" method="post">
       <input type="hidden" name="id" value="<?php echo $id_admin; ?>">
      <div class="col-sm-5">
        <table class="table">
          <tr class="bolder">
            <td>Jméno:</td>
            <td><input name="jmenoAdmin" class="form-control" type="text" id="jmenoAdmin" value="<?php echo $jmenoAdmin; ?>" size="15" required /></td>
          </tr>
          <tr class="bolder">
            <td>Příjmení:</td>
            <td><input name="prijmeniAdmin" class="form-control" type="text" id="prijmeniAdmin" value="<?php echo $prijmeniAdmin; ?>" size="15" required /></td>
          </tr>
          <tr class="bolder">
            <td>Telefon:</td>
            <td><input name="telefonAdmin" class="form-control" type="text" id="telefonAdmin" value="<?php echo $telefonAdmin; ?>" size="15" required /></td>
          </tr>
          <tr class="bolder">
            <td>E-mail</td>
            <td><input name="emailAdmin" class="form-control" type="email" id="emailAdmin" value="<?php echo $emailAdmin; ?>" size="15" required /></td>
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
