<?php 
include('connection.php');
$sql="SELECT * FROM img_carrousel";
if (!$resultcarrousel=mysqli_query($connection,$sql)){
    echo "Se ha producido un error al cargar las imagenes";
    die();
}
mysqli_close($connection);
?>