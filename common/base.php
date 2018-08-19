<?php
    // Set the error reporting level
error_reporting(E_ALL);
ini_set("display_errors", 1);

    // Start a PHP session
session_start();

    // Include site constants
include_once "config.php";

    // Create a database object
try {
    $conn = new PDO("sqlsrv:server = tcp:timewise1.database.windows.net,1433; Database = Timewise1", "champwise", "Timewi$e");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}
?>
