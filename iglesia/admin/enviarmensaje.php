<?php
include("connection.php");
if (isset($_POST['nombre']) && isset($_POST['mensaje']) && isset($_POST['email'])){
    $nombre=$_POST['nombre'];
    $mensaje=$_POST['mensaje'];
    $email=$_POST['email'];
}else{
    echo 'Los datos no se han mandado correctamente.';
}

    if (isset($nombre) && isset($mensaje) && isset($email) ){
        $sql="INSERT INTO mensajes (nombre,mensaje,email) VALUES ('$nombre','$mensaje','$email')";
        if ($result=mysqli_query($connection,$sql)){
            echo "true";
    }
    else
    {
        echo "Se ha producido un error al conectar a la base de datos".mysqli_error($connection);
    }}
    
    else{echo "Intente de nuevo.";}


mysqli_close($connection);
?>