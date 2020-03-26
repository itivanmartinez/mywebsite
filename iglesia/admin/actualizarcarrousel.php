<?php
include('connection.php');
if (isset($_POST['title']) && isset($_POST['descripcion']) && isset($_POST['id'])){
    $titulo=$_POST['title'];
    $descripcion=$_POST['descripcion'];
    $id=$_POST['id'];
}else {
    echo "false";
    die();
}
$sql="UPDATE img_carrousel SET titulo='$titulo', descripccion='$descripcion' WHERE id='$id'";
if ($result=mysqli_query($connection,$sql)){
 echo "true";
}else{
    echo "hay un errr al actualizar los datos. ".mysqli_error($connection);
}
mysqli_close($connection);
?>