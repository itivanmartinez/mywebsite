<?php
$SERVERNAME="localhost";
$DATABASE="iglesia";
$USER="root";
$PASS="";
$connection=mysqli_connect($SERVERNAME,$USER,$PASS,$DATABASE);
//Checking connection
if (!$connection){
    die("Connection failed: ". mysqli_connect_error());
}

?>