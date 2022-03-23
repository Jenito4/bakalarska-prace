<?php
  $title = "Vložit nového technika | Potes";
  include_once("header.php");
?>

 <link rel="stylesheet" href="stylesadmin.css">
  <div class="container">


    <div class="pagePadding">
          <h1>Vložení technika</h1>
      <div class="pageText">

          <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                  <form action="php/vloz_technik_skript.php" method="post">  
                    <fieldset>
                      <div class="col-md-12">
                         <label for="jmenoTechnik">Jméno technika:* </label><br>
                        <input type="text" class="form-control" name="jmenoTechnik" required /><br />
                        <label for="prijmeniTechnik">Příjmení technika:* </label><br>
                        <input type="text" class="form-control" name="prijmeniTechnik" required /><br />                                                                                        
                        </div>
                        </fieldset>
                        <fieldset>
                      <div class="col-md-5">
                        <label for="telefonTechnik">Telefon:* </label><br>
                        <input type="tel" class="form-control" name="telefonTechnik" required/><br />
                      </div>
                      <div class="col-md-7">
                        <label for="emailTechnik">E-mail:* </label><br>
                        <input type="email" class="form-control" name="emailTechnik" required /><br />
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
