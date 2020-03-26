<?php 
include('connection.php');
if (isset($_POST['title']) && isset($_POST['descripcion']) && isset($_POST['id'])){
    $titulo=$_POST['title'];
    $descripcion=$_POST['descripcion'];
    $id=$_POST['id'];
}else{
    echo "Se ha producido un error al enviar datos";
    die();
}
if (isset($titulo) && isset($descripcion) && isset($id)){
    $sql="UPDATE noticias SET titulo='$titulo', descripcion='$descripcion' WHERE id='$id'";
}
if($result=mysqli_query($connection,$sql)){
    echo "true";
}else {
    echo "Se ha producido un error al actualizar datos en la base de datos".mysqli_error($connection);
}
mysqli_close($connection);
?>