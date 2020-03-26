<?php 
include('connection.php');
if (isset($_POST['id']) && isset($_POST['image']) ){
    $id=$_POST['id'];
    $image=$_POST['image'];
}else{
    echo 'false1';}
if (isset($id) && isset($image)){
    $sql="UPDATE noticias SET imagen='$image' WHERE id = $id";
    if (mysqli_query($connection,$sql)){
        echo 'true';
    }else{
        echo 'Se ha producido un error al conectar base de datos'.mysqli_error($connection);
    }
}else {
    {echo 'Los datos no se han mandado correctamente al servidor';}
}


mysqli_close($connection);
?>