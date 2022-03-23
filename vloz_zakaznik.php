<?php
  $title = "Vložit nového zákazníka | Potes";
  include_once("header.php");
?>

 <link rel="stylesheet" href="stylesadmin.css">
  <div class="container">


    <div class="pagePadding">
          <h1>Vložení zákazníka</h1>
      <div class="pageText">

          <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                  <form action="php/vloz_zakaznik_skript.php" method="post">  
                    <fieldset>
                      <div class="col-md-12">
                         <label for="jmenoZakaznik">Jméno zakazníka:* </label><br>
                        <input type="text" class="form-control" name="jmenoZakaznik" required /><br />  
                        <label for="prijmeniZakaznik">Příjmení zakazníka:* </label><br>
                        <input type="text" class="form-control" name="prijmeniZakaznik" required /><br />                                                                
                        </div>
                        </fieldset>
                        <fieldset>
                      <div class="col-md-5">
                        <label for="telefonZakaznik">Telefon:* </label><br>
                        <input type="tel" class="form-control" name="telefonZakaznik" required/><br />
                      </div>
                      <div class="col-md-7">
                        <label for="emailZakaznik">E-mail:* </label><br>
                        <input type="email" class="form-control" name="emailZakaznik" required /><br />
                      </div>
                    </fieldset>
                    <div class="col-md-12">
                    <input class="btn btn-primary" type="submit" value="Vložit" /><br /><br />
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
  </div>
  
<?php
    include_once("footer.php");
?>
