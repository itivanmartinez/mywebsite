<?php 
include('connection.php');
$title="Nuevo Titulo";
$descripcion="Nueva Descripcion";
$imagen="nuevo.png";
$sql="INSERT INTO img_carrousel (titulo,descripccion,imagen) VALUES ('$title','$descripcion','$imagen')";
if ($result=mysqli_query($connection,$sql)){
    echo "true";
}else{
    echo "Se ha producido un error al crear imagen".mysqli_error($connection);
}
mysqli_close($connection);
?>