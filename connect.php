<?php

    include 'credentials.php';

    $conn = new mysqli($servername, $username, $password, $database);


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

   // echo "<div class='btn btn-success' href='#'>You are Connected</div>";

    // Perform your database operations here


    //$conn->close();

?>
