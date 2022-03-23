<?php
  $title = "Vložit nového admina | Potes";
  include_once("header.php");
?>

 <link rel="stylesheet" href="stylesadmin.css">
  <div class="container">


    <div class="pagePadding">
          <h1>Vložení admina</h1>
      <div class="pageText">

          <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                  <form action="php/vloz_admin_skript.php" method="post">  
                    <fieldset>
                      <div class="col-md-12">
                         <label for="jmenoAdmin">Jméno admina:* </label><br>
                        <input type="text" class="form-control" name="jmenoAdmin" required /><br />
                        <label for="prijmeniAdmin">Příjmení admina:* </label><br>
                        <input type="text" class="form-control" name="prijmeniAdmin" required /><br />                                                                                        
                        </div>
                        </fieldset>
                        <fieldset>
                      <div class="col-md-5">
                        <label for="telefonAdmin">Telefon:* </label><br>
                        <input type="tel" class="form-control" name="telefonAdmin" required/><br />
                      </div>
                      <div class="col-md-7">
                        <label for="emailAdmin">E-mail:* </label><br>
                        <input type="email" class="form-control" name="emailAdmin" required /><br />
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
