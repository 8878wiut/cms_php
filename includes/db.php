<?php 

$dbserver = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "cms";
$connection = mysqli_connect($dbserver, $dbuser, $dbpass, $dbname);

if (!$connection) {
    echo mysqli_error();
}

?>