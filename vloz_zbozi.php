<?php
    $title = "Vložit nové zboží | Potes";
    include_once("header.php");
?>
       <link rel="stylesheet" href="stylesadmin.css">

        <div class="container">


          <div class="pagePadding">
                <h1>Vložení zboží</h1>
            <div class="pageText">
              <div class="row">

                <div class="col-lg-8 col-lg-offset-2">
                  <form enctype="multipart/form-data" action="php/vloz_zbozi_skript.php" method="post">
                    <fieldset>
                      <div class="col-md-12">                      
                        <label for="nazevZbozi">Název zboží:* </label><br>
                        <input type="text" class="form-control" name="nazevZbozi" id="nazevZbozi" required /><br />
                        <br />
                      </div>
                      <div class="col-md-12">
                      <label for="nazevKategorie">Kategorie:* </label><br>

                        <select class="form-control" name="nazevKategorie" id="nazevKategorie" placeholder="Vybrat kategorii" required>
                          <?php
                            $sql = "SELECT id_kategorie, nazevKategorie FROM kategorie";

                            if($query = mysqli_query($conn, $sql)){
                              while($row = mysqli_fetch_array($query)){
                                echo "<option value=".$row["id_kategorie"].">".$row["nazevKategorie"]."</option>\n";
                              }
                            } else {
                              echo "ERROR: ".mysqli_error($conn);
                            }

                          ?>
                        </select>
                        <br />
                      <div class="form-group">
                        <label  for="ZboziText">Popis zboží:* </label><br>
                        <textarea class="form-control" name="ZboziText" id="ZboziText"></textarea><br />
                        <label for="SemPhoto">Ilustrační foto (nepovinné): </label><br>
                        <input id="SemPhoto" type="file" name="SemPhoto" accept="image/*" class="form-control"><br />
                      </div>                     
                      </div>
                      <div class="col-md-4">                       
                        <label for="ZboziCena">Cena servisu:* </label><br>
                        <input type="number" class="form-control" name="ZboziCena" id="ZboziCena" min=1 max=100000 required /><br />
                        <input class="btn btn-primary" type="submit" value="Vložit" /><br /><br />
                      </div>
                    </fieldset>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>


       <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.2/tinymce.min.js" referrerpolicy="origin"></script>

              
                <script>
      tinymce.init({
  selector: 'textarea#ZboziText'
});
    </script>

<?php
    include_once("footer.php");
?>
