<?php
  $title = "Kontakt | Potes";
  include_once("header.php");
?>
<link rel="stylesheet" href="stylesadmin.css">
  <div class="container">


    <div class="pagePadding">
          <h1>Kontakt</h1>

          <?php
          if(isset($_GET["ok"])){
          ?>
          <div class="alert alert-success" role="alert">
            Děkujeme za dotaz! Budeme se Vám snažit co nejdříve odpovědět.
          </div>
          <?php
          }
        ?>
        
         <?php
        $sql="";
        switch($_SESSION["role"]) {
            case "zakaznik":
                $id_zakaznik = $_SESSION['id'];
         $sql = "SELECT jmenoZakaznik, prijmeniZakaznik, emailZakaznik, telefonZakaznik FROM zakoupene_zbozi, zakaznici
          WHERE zakaznici.id_zakaznik = zakoupene_zbozi.id_zakaznik AND zakoupene_zbozi.id_zakaznik = $id_zakaznik
          ORDER BY datum_platnosti ASC";
                break;
        }
        if($query = mysqli_query($conn, $sql)){
    while($row = mysqli_fetch_array($query)){    
      $jmenoZakaznik = $row["jmenoZakaznik"]; 
      $prijmeniZakaznik = $row["prijmeniZakaznik"]; 
      $telefonZakaznik = $row["telefonZakaznik"]; 
      $emailZakaznik = $row["emailZakaznik"];  
    }
  } else {
    echo mysqli_error($conn);
    die();
  }
        ?>
        
      <div class="pageText">
        <div class="row">

            <div class="col-md-5">
              <b>POTES s.r.o.</b> <br />
              Telefon: +420 538 273 162<br />
              E-mail: potes@pottes.cz<br />
              IČO: 26849011 <br />
              DIČ: CZ26849011<br />
              <br /><br />
              <b>Adresa:</b> <br />
              Sobotín 239, 78816 Sobotín<br />
              <br /><br />

            </div>
            <div class="col-md-7">
                <form action="/php/mail.php" method="post">
                  <b>Napište nám!</b> <br />
                  <input type="text" class="form-control" name="jmeno" value="<?php echo $jmenoZakaznik." ".$prijmeniZakaznik; ?>" required /><br />
                  <input type="tel" class="form-control" name="telefon" value="<?php echo $telefonZakaznik; ?>" required /><br />
                  <input type="email" class="form-control" name="email" value="<?php echo $emailZakaznik; ?>" required /><br />
                  <textarea name="zprava" class="form-control" name="zprava" placeholder="Jaký je váš dotaz?" maxlength="200" style="height:150px;"></textarea><br />
                  <input class="btn btn-primary" type="submit" value="Odeslat" /><br /><br />
                </form>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>


<?php
  include_once("footer.php");
?>
