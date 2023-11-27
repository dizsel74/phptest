<?php
  include "connect.php";
  $id="";
  $item="";
  $item_type="";
  //if no id  go to items page
  if($_SERVER["REQUEST_METHOD"]=='GET'){
    if(!isset($_GET['id'])){
      header("location:phptest/items.php");
      exit;
    }
  
    $id = $_GET['id'];
    $sql = "SELECT * FROM items WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    //if no result found return to page
    while(!$row){
      header("location:/phptest/items.php");
      exit;
    }
    //fill date fronm table
    $id=$row["id"];
    $item=$row["item"];
    $item_type=$row["item_type"];
  }
 else{
    //update
    $id=$_POST["id"];
    $item=$_POST["item"];
    $item_type=$_POST["item_type"];

    $sql = "UPDATE items SET item='$item', item_type='$item_type' WHERE id='$id'";
    $result = $conn->query($sql);
    header("location:/phptest/items.php");
    exit;
  }
  $conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <title>Edit Items</title>
</head>
<body>


<nav class="navbar navbar-expand-lg bg-dark border-body border-bottom " data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">UI INVENTORY</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link "  href="index.php">Add Request</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="items.php">items</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="summary.php">Summary</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>


<div class="col-lg-6 m-auto">  
  <form method="post">
      <br><br>
      <div class="card">
        
        <div class="card-header bg-dark" >
          <h1 class="text-white text-center">Edit Item</h1>
        </div>
        
        <br>
        <div style="padding: 0 3rem 1rem;">
            
            <input type="hidden" name="id" class="form-control" 
            value="<?php echo $id; ?>"> 

            <label> Item: </label>
            <input type="text" name="item" class="form-control" 
            value="<?php echo $item; ?>"> <br>
            
            
            <label> Item type: </label>
            <select id="item_type" name="item_type" class="form-select" > 
              <option selected value="<?php echo $item_type; ?>"> 
              
              <?php 
                if($item_type =='1'){
                  echo"Office Supply";
                }
                else if($item_type =='2'){
                  echo"Equipment";
                }
                else{
                  echo"Furniture";
                }
                   ?>
              </option>
              <option value="1">Office Supply</option>
              <option value="2">Equipment</option>
              <option value="3">Furniture</option>    
            </select>
           
            <br> 

            <a class="btn btn-info" type="submit" name="cancel" href="items.php"> Cancel </a>
            <button class="btn btn-success" type="submit" name="submit"> Submit</button>
            <br>
      </div>
      </div>
    </form>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

