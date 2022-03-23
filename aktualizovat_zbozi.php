<?php
  $title = "Zboží | Potes";
  include_once("header.php");

  if(!isset($_GET["id"])){
    header("location: index.php");
    die();
  }

  $id_zbozi = (int)$_GET["id"];

  $id_zbozi = (int)$_GET["id"];
  $sql = "SELECT * FROM zbozi WHERE id_zbozi = $id_zbozi";

  if($query = mysqli_query($conn, $sql)){
    while($row = mysqli_fetch_array($query)){
      $ico = $row["ico"];
      $nazevZbozi = $row["nazevZbozi"];
      $id_kategorie = $row["id_kategorie"];
      $popis = $row["popis"];
      $cena = $row["cena"];  
    }
  } else {
    echo mysqli_error($conn);
    die();
  }
?>
 <link rel="stylesheet" href="stylesadmin.css">

 <div class="container">


   <div class="pagePadding">
         <h1>Aktualizace zboží</h1>
     <div class="pageText">
       <div class="row">

         <div class="col-lg-8 col-lg-offset-2">
           <form enctype="multipart/form-data" action="php/aktualizace_zbozi.php" method="post">
             <input type="hidden" name="id" value="<?php echo $id_zbozi; ?>">
             <fieldset>
               <div class="col-md-12">
                 <label for="nazevZbozi">Název techniky:* </label><br>
                 <input type="text" class="form-control" name="nazevZbozi" id="nazevZbozi" value="<?php echo $nazevZbozi; ?>" required /><br />
                 <br />
                 <label for="nazevKategorie">Kategorie:* </label><br>

                 <select class="form-control" name="nazevKategorie" id="nazevKategorie" placeholder="Vybrat kategorii" required>
                   <?php
                     $sql = "SELECT id_kategorie, nazevKategorie FROM kategorie";

                     if($query = mysqli_query($conn, $sql)){
                       while($row = mysqli_fetch_array($query)){
                         if($row["id_kategorie"] == $id_kategorie){
                           echo "<option value=".$row["id_kategorie"]." selected>".$row["nazevKategorie"]."</option>\n";
                         } else {
                           echo "<option value=".$row["id_kategorie"].">".$row["nazevKategorie"]."</option>\n";
                         }

                       }
                     } else {
                       echo "ERROR: ".mysqli_error($conn);
                     }

                   ?>
                 </select>
                 <br />
               </div>
              
              
               <div class="col-md-12">
               <div class="form-group">
                 <label  for="ZboziText">Popis techniky:* </label><br>
                 <textarea class="form-control" name="ZboziText" id="ZboziText"><?php echo $popis; ?></textarea><br />

                 <label for="SemPhoto">Ilustrační foto (nahráním nahradíte stávající foto): </label><br>
                 <input id="SemPhoto" type="file" name="SemPhoto" accept="image/*" class="form-control"><br />
               </div>
               </div>
               <div class="col-md-4">
                 <label for="ZboziCena">Cena:* </label><br>
                 <input type="number" class="form-control" name="ZboziCena" id="ZboziCena" min=1 max=1000000 value="<?php echo $cena; ?>" required /><br />
                 <input class="btn btn-primary" type="submit" value="Aktualizovat" /><br /><br />
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
