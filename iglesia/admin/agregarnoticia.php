<?php
include('connection.php');
$titulo="Titulo Nuevo";
$descripcion="Descripcion Nueva";
$imagen="nuevo.png";
$sql="INSERT INTO noticias (titulo,descripcion,imagen) VALUES ('$titulo','$descripcion','$imagen')";
if (!$result=mysqli_query($connection,$sql)){
    echo "Se ha producido un error.".mysqli_error($connection);
    die();
}else{
    echo "true";
}
mysqli_close($connection);
?>