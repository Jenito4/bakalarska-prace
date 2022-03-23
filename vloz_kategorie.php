<?php
  $title = "Vložit novou kategorii | Potes";
  include_once("header.php");
?>

 <link rel="stylesheet" href="stylesadmin.css">
  <div class="container">


    <div class="pagePadding">
          <h1>Vložení kategorie</h1>
      <div class="pageText">

          <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                  <form action="php/vloz_kategorie_skript.php" method="post">  
                    <fieldset>
                      <div class="col-md-12">
                         <label for="nazevKategorie">Název kategorie:* </label><br>
                        <input type="text" class="form-control" name="nazevKategorie" required /><br />                                                             
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
