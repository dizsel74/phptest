<?php
  include "connect.php";

  if(isset($_POST['submit'])){
    $requested_by = $_POST['requested_by'];
    $items = $_POST['items'];
    
    $q = " INSERT INTO `requests`(`requested_by`, `items` ) VALUES ( '$requested_by', '$items' )";

    $query = mysqli_query($conn,$q);

    if ($query) {
      echo "<script>alert('All right request submitted!'); window.location.href = '/phptest/items.php';</script>";
    } else {
      echo "<script>alert('UPS error submitting request:" . mysqli_error($conn) . "');</script>";
    }
}
?>

