<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <meta charset="UTF-8">
  <title>PHP Search</title>
</head>
<body>
<div class="container">
   <div class="row">
   <div class="col-md-8 col-md-offset-2" style="margin-top: 5%;">
   <div class="row">
     
   <?php 

     $conn = new mysqli('sql5.webzdarma.cz', 'poteskvalitn9249', '7@Mb5k*Qs7)F&dxQP4_2', 'poteskvalitn9249');      
     if(isset($_GET['search'])){
        $searchKey = $_GET['search'];
        $sql = "SELECT * FROM technici WHERE jmenoTechnik LIKE '$searchKey%'";
     }else
     $sql = "SELECT * FROM technici";
     $result = $conn->query($sql);
   ?>

   <form action="" method="GET"> 
     <div class="col-md-6">
        <input type="text" name="search" class='form-control' placeholder="Search By Name" value=<?php echo @$_GET['search']; ?> > 
     </div>
     <div class="col-md-6 text-left">
      <button class="btn">Search</button>
     </div>
   </form>

   <br> 
   <br>
</div>

<table class="table table-bordered">
  <tr>
     <th>Name</th>
     <th>Amount</th>
     <th>City</th>
  </tr>
  <?php while( $row = $result->fetch_object() ): ?>
  
  <tr>
     <td><?php echo $row->jmenoTechnik ?></td>
     <td><?php echo $row->telefonTechnik ?></td>
     <td><?php echo $row->emailTechnik ?></td>
  </tr>
  <?php endwhile; ?>
</table>
</div>
</div>
</div>
</body>
</html>