<?php
$directory="../img/";
include('connection.php');
$sql="SELECT * FROM noticias";
if (!$resultnoticias=mysqli_query($connection,$sql)){
    echo "Se ha producido un error.".mysqli_error($connection);
    die();
}
mysqli_close($connection);
?>


