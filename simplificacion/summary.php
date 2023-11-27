<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <title>Summary</title>
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
          <a class="nav-link"  href="index.php">Add Request</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="items.php">items</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page"href="summary.php">Summary</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<div class="container">

  <div class="col-sx-10 m-auto">
    <table class="table text-center">
      <thead>
        <tr><b>Today's Summary</b></tr>
        <tr>
          <th>Id requeste</th>
          <th>Requested by</th>
          <th>Orden On </th>
          <th>Items requested</th>
        </tr>
      </thead>
      <tbody class="table-group-divider">
        <?php
      include "connect.php";


      $q_drop_table = "DROP TABLE IF EXISTS summary";
      $result_drop_table = $conn->query($q_drop_table);
      
      // Consulta para crear la tabla summary y seleccionar datos de requests y pone la fecha actual de consulta
       $q_create_table = "
        CREATE TABLE summary AS
        SELECT req_id, requested_by, NOW() as ordered_on, items
        FROM requests";
        $result_create_table = $conn->query($q_create_table);

      $sql_query = "SELECT * FROM `summary` ";
      $result = $conn->query($sql_query);
      
      if(!$result){
        die('Error in Query');
      }
      while($row=$result->fetch_assoc()){
        echo "
        <tr>
        
          <td>$row[req_id]</td>
          <td>$row[requested_by]</td>
          <td>$row[ordered_on]</td>
          <td>$row[items]</td>
        <th>
        
        </th>
        </tr>
        ";
      }
      ?>
    </tbody>
   </table>
  </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

