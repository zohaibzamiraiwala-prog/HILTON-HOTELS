<?php
$servername = "localhost";
$username = "unkuodtm3putf";
$password = "htk2glkxl4n4";
$dbname = "dbmkn1c9ergset";
 
try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
} catch (Exception $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
