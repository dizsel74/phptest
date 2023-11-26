<?php
//Fore best practices this part soud be in a separated file credentials.php
//anbd be included like so include 'credentials.php';

    $servername = "localhost"; // Server
    $username = "root"; //  MySQL username
    $password = ""; // MySQL pwd
    $database = "test-ricardo"; // tes-ricardo o test  DB name


    $conn = new mysqli($servername, $username, $password, $database);


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

?>
