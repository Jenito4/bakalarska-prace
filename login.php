<?php
session_name("potes");
session_start();
include_once("mysql_connect.php");
$error=''; //Variable to Store error message;
if(isset($_POST['submit'])){
if(empty($_POST['username']) || empty($_POST['password'])){
$error = "Chybné uživatelské jméno nebo heslo";
}
else
{
//Define $user and $pass
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$password = hash("sha256", $password);
$query = mysqli_query($conn, "SELECT * FROM uzivatele WHERE password='$password' AND username='$username'");
$rowsCount = mysqli_num_rows($query);
if($rowsCount == 1){
    $idUzivatel = null;
    $role = null;
    
    while($row = mysqli_fetch_array($query)) {
        $idUzivatel = $row["id_uzivatel"];
        $role = $row["role"];
    }
            
    if($idUzivatel != null && $role != null) {   
        
        $idResult = null;
        if($role == "technik") {
         
          $queryTechnik = mysqli_query($conn, "SELECT * FROM technici WHERE id_uzivatel='$idUzivatel' LIMIT 1");
          while($rowTechnik = mysqli_fetch_array($queryTechnik)) {
            $idResult = $rowTechnik["id_technik"];
          } 
                  
        } 
        if($role == "zakaznik") {       
            $queryZakaznik = mysqli_query($conn, "SELECT * FROM zakaznici WHERE id_uzivatel='$idUzivatel' LIMIT 1");
            while($rowZakaznik = mysqli_fetch_array($queryZakaznik)) {
                $idResult = $rowZakaznik["id_zakaznik"];
            }            
        } 
        if($role == "admin") {
            $queryAdmin = mysqli_query($conn, "SELECT * FROM admini WHERE id_uzivatel='$idUzivatel' LIMIT 1");
            while($rowAdmin = mysqli_fetch_array($queryAdmin)) {
                $idResult = $rowAdmin["id_zakaznik"];        
             }
        }  
        
                       echo "HALO: ".$username." ".$idResult." ".$role;
            $_SESSION['potes'] = $username;
            $_SESSION['id'] = $idResult; // id zákazníka nebo technika
            $_SESSION['role'] = $role;
            $_SESSION['id_uzivatel'] = $idUzivatel;
            // teoreticky doplnit mysqli_close
             if($role == "zakaznik") {
            header("Location: zakoupeneZboziList.php"); // Redirecting to other page
            } else {
            header("Location: index.php");
            }
    }
      
    $error = "Chyba";
}
else
{
$error = "Chybné uživatelské jméno nebo heslo";
}
mysqli_close($conn); // Closing connection
}
}
?>
