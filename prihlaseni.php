<?php

include("login.php"); // Include loginserv for checking username and password

   $title = "Přihlášení | Potes";
   include_once("head.php");
?>
       <link rel="stylesheet" href="stylesadmin.css">
       <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
       
<div class="container">
  <div class="pagePadding">
                        
      <div class="pageText">
        <div class="row">
          <div class="col-lg-8 col-lg-offset-3">
            <div class="col-md-6">
               <div class="panel-body">              
                 <form action="" method="post">  
                    <label for="username">Příhlašovací jméno:</label>
                    <input type="text" class="form-control" id="username" name="username" required>   <br />             
                    <label for="password">Heslo:</label> 
                    <input type="password" class="form-control" id="password" name="password" required>  <br />               
             
                    <!-- Change this to a button or input when using this as a form -->   
                    <input class="btn btn-primary" type="submit" name="submit" value="Přihlásit" /><br /><br />
                </form>                 
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
    include_once("foot.php");
?>

