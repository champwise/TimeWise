<?php
    // Set the error reporting level
error_reporting(E_ALL);
ini_set("display_errors", 1);

    // Start a PHP session
session_start();

    // Include site constants
include_once "config.php";



<<<<<<< HEAD
    // Create a database object
try {
    $db = new PDO("sqlsrv:server = tcp:timewisesvr.database.windows.net,1433; Database = timewisedb", "champwise", 'jTel79rv');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}
=======
//     // Create a database object
// try {
//     $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
//     $db = new PDO($dsn, DB_USER, DB_PASS);
// } catch (PDOException $e) {
//     echo 'Connection failed: ' . $e->getMessage();
//     exit;
// }

$con=mysqli_init();
 mysqli_ssl_set($con, NULL, NULL, {ca-cert filename}, NULL, NULL);
 mysqli_real_connect($con, "timewise1-server.mysql.database.azure.com", "champwise@timewise1-server", {'jTel79rv'}, {"timewisedb"}, 3306);
>>>>>>> 807d07f... connection strin ghange
?>
