<?php
  //include "connect.php";

  $servername = "localhost"; // Server
  $username = "root"; //  MySQL username
  $password = ""; // MySQL pwd
  $database = "test-ricardo"; // tes-ricardo o test  DB name


  $conn = new mysqli($servername, $username, $password, $database);


  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  if(isset($_POST['submit'])){
    $requested_by = $_POST['requested_by'];
    $items = $_POST['items'];
    echo " $<script>alert('Please, confirm to proceed with the request.');</script>";
    $q = " INSERT INTO `requests`(`requested_by`, `items` ) VALUES ( '$requested_by', '$items' )";

    $query = mysqli_query($conn,$q);

    if ($query) {
      echo "<script>alert('All right request submitted!');</script>";
    } else {
      echo "<script>alert('UPS error submitting request:" . mysqli_error($conn) . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <title>Create Request</title>
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
          <a class="nav-link active" aria-current="page" href="#">Add Request</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="items.php">items</a>
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
          <h1 class="text-white text-center">Add Request</h1>
        </div>
        
        <br>
        <div style="padding: 0 3rem 1rem;">
            <label> User Name: </label>
            <input type="text" name="requested_by" class="form-control"> <br>
            
            
            <label> Request Items: </label>
            <select id="items" name="items" class="form-select"> 
              <option selected value="">Please select an Item</option>
              <?php
               //include "connect.php";
                $sql_query = "SELECT `id`,`item`, `item_type` FROM `items`";
                $result = $conn->query($sql_query);

                if(!$result){
                  die('Error in Query');
                }
                while($row=$result->fetch_assoc()){
            
                  // Metodo de Serialización para unir el id y el item_type
                  $serializedData = "{" . $row['id'] . "," . $row['item_type'] . "}";
                  echo "<option value='$serializedData'>$row[item]</option>";
                  
                }

            ?>
            </select>
            <p>
             <button class="btn" id="add-field" > add more items</button>
            </p>


            <a class="btn btn-info" type="submit" name="cancel" href="items.php"> Cancel </a>
            <button class="btn btn-success" type="submit" name="submit"> Submit </button><br>
      </div>
      </div>
    </form>
  </div>
  

  <script>
    //listener to the button
    const button = document.getElementById('add-field');
    button.addEventListener('click', function() {
      
      alert('Btn clic');
      // Create a new select 
    

        // Add an initial option to the new select element
       

        // Add the new select element after the existing one
     
    });
  </script>

  




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

