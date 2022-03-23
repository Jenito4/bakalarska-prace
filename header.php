<?php
session_name("potes");
session_start();

if(!isset($_SESSION["potes"])){
  header("location: index.php");
  die("Přístup odepřen");
}

include_once("mysql_connect.php");
?>
<!DOCTYPE html>
<html lang="cz">
<head>
  <title><?php echo $title;?></title>
  <link href="/foto/favicon.ico" rel="shortcut icon" type="image/x-icon">
  <meta charset="utf-8">
  <meta name="robots" content="all">
  <meta name="description" content="Potes s.r.o. , montáž, servis hasicích přístrojů a kontroly požárních vodovodů">
  <meta name="keywords" content="potes s.r.o., potes, potes sobotín, hasící přístoje, hasící technika, požární technika">
  <meta name="author" content="Jan Mašlej">

  <meta property="og:title" content="Potes s.r.o. | Motnáž a servis hasících přístrojů" />
  <meta property="og:description" content="spoelčnost poskytující služby v oblasti hasící techniky" />
  <meta property="og:site_name" content="Potes s.r.o. | Motnáž a servis hasících přístrojů" />
  <meta property="og:image" content="http://potes.kvalitne.cz/foto/potes.JPG" />
  <meta property="og:type" content="website" />
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


</head>
<body>




<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
     <!-- <a class="navbar-brand" href="index.php">Agentura Legis</a>
      <a class="navbar-brand" href="index.php"><img src="/web/foto/legis.jpg" width="auto" height="50px"></a>     -->
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">   
      <?php
      switch($_SESSION["role"]) {
            case "technik":
      ?> 
        <li><a href="index.php">Nové objednávky</a></li>
        <li><a href="objednavky.php">Historie kontrol</a></li>
        
        <?php
        
      break;
            case "admin":
      ?> 
        <li><a href="index.php">Nové objednávky</a></li>
        <li><a href="objednavky.php">Historie kontrol</a></li>
        <li><a href="katalogZbozi.php">Katalog techniky</a></li>
        <li><a href="listKategorie.php">Kategorie</a></li>
        <li><a href="technici.php">Technici</a></li>
        <li><a href="zakaznici.php">Zákazníci</a></li> 
        <li><a href="admini.php">Admini</a></li>   
        <?php
      
      break;
            case "zakaznik":
      ?> 
        <li><a href="index.php">Objednávky</a></li>
        <li><a href="objednavky.php">Historie kontrol</a></li>
        <li><a href="zakoupeneZboziList.php">Zakoupené zboží</a></li> 
        <li><a href="kontakt.php">Kontakt</a></li> 
        <?php
         break;
      }
      ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
  <li><a href="logout.php"><?php echo $_SESSION["potes"]  ?> &emsp;<span class="glyphicon glyphicon-log-out"></span> Odhlásit se</a>

        </li>
      </ul>
    </div>
  </div>
</nav>
