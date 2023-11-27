<?php
  include "connect.php";
    //  Inicialize variables for edit
    $id = "";
    $item = "";
    $item_type = "";

    // DELETE
    if (isset($_GET['delete_id'])) {
          $id = $_GET['delete_id'];
          $sql = "DELETE FROM `items` WHERE id=$id";
          $conn->query($sql);
          if ($conn->affected_rows > 0) {
              header('location:/phptest/items.php');
              exit;
          } else {
              echo "Error deleting item: " . $conn->error;
          }
      }
      $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <title>View Items</title>
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
          <a class="nav-link" aria-current="page" href="index.php">Add Request</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">items</a>
        </li>
        <li class="nav-item">
          <!-- <a class="nav-link" href="summary.php">Summary</a> -->
          <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#summaryPopup">Summary</a>
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
        <tr>
          <th>Item</th>
          <th>Type</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-group-divider">
        <?php
        include "connect.php";
        $sql_query = "SELECT * FROM `items` ";
        $result = $conn->query($sql_query);
        if(!$result){
          die('Error in Query');
        }
        while($row=$result->fetch_assoc()){
          echo "
          <tr>
            <td>$row[item]</td>
            <td>$row[item_type]</td>
            <td>
            <a class='btn btn-success' href='#' onclick='showForm($row[id], \"$row[item]\", $row[item_type])'>Edit</a>
            <a class='btn btn-danger' href='?delete_id=$row[id]'>Delete</a>
            </td>
          </tr>
          ";
        }
        $conn->close();?>
    </tbody>
   </table>
  </div>
</div>

<!-- EDIT Popup -->
<div id="editPopup" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h5 class="modal-title text-white">Edit Item</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="">
          <input type="hidden" name="id" class="form-control"
            value="<?php echo $id; ?>">

            <label> Item: </label>
            <input type="text" name="item" class="form-control"
            value="<?php echo $item;?>"><br>
          <label> Item type:</label>
          <select id="item_type" name="item_type" class="form-select" >
              <option selected value="<?php echo $item_type;?>">
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

          <a class="btn btn-info" type="button" name="cancel" data-bs-dismiss="modal"> Cancel </a>
          <button class="btn btn-success" type="submit" name="submit"> Submit</button>
          <br>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Summary Popup -->
<div id="summaryPopup" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white">Today's Summary</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>Id request</th>
                            <th>Requested by</th>
                            <th>Ordered On</th>
                            <th>Items requested</th>
                        </tr>
                    </thead>
                    <tbody>
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

                        if (!$result) {
                            die('Error in Query');
                        }
                        while ($row = $result->fetch_assoc()) {
                            echo "
                            <tr>
                                <td>$row[req_id]</td>
                                <td>$row[requested_by]</td>
                                <td>$row[ordered_on]</td>
                                <td>$row[items]</td>
                            </tr>
                            ";
                        }
                      ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>
  function showForm(id, item, item_type) {
    document.querySelector('#editPopup input[name="id"]').value = id;
    document.querySelector('#editPopup input[name="item"]').value = item;
    document.querySelector('#editPopup select[name="item_type"]').value = item_type;

    var myModal = new bootstrap.Modal(document.getElementById('editPopup'));
    myModal.show();
  }
</script>
</body>
</html>
<?php
  include "connect.php";

  if($_SERVER["REQUEST_METHOD"]=='GET'){
    if(!isset($_GET['id'])){
      exit;
    }

    $id = $_GET['id'];
    $sql = "SELECT 'id','item','item_type' FROM items WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    //fillup the table
    $id=$row["id"];
    $item=$row["item"];
    $item_type=$row["item_type"];

  }
 else{
    //UPDATE
    $id=$_POST["id"];
    $item=$_POST["item"];
    $item_type=$_POST["item_type"];

    $sql = "UPDATE items SET item='$item', item_type='$item_type' WHERE id='$id'";
    $result = $conn->query($sql);
     //If Update refresh page
    if ($sql) {
      echo "<script>alert('All right request submitted!');
      window.location.href = '/phptest/items.php';</script>";
      exit;
    }

  }
  $conn->close();
  ?>