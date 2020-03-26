<?php
session_start();
include 'connection.php';
//checking if post is not empty
$user="";
$password="";
if (!empty($_POST)){
    if (isset($_POST['usuario']) && (!$_POST['usuario']=="" )){
        $user=$_POST['usuario'];
    }else{
        die("You have to enter a user");
    }
    if (isset($_POST['contrasena']) && (!$_POST['contrasena']=="")){
        $password=$_POST['contrasena'] ;
    }else{
        die("You have to enter a password");
    }
}else{
    die("Usuario y password no deben estar vacios");
}
//checking user and password
$sql="SELECT * FROM user WHERE usuario='$user'";
$query=mysqli_query($connection,$sql);

if (!$query){
    die("El usuario o contraseña son incorrectos. Trata de Nuevo".mysqli_connect_error());
}
$num_rows=mysqli_num_rows($query);
if ($num_rows==0){
    die("El usuario o contraseña son incorrectos. Trata de Nuevo.");
}
//fecthing all results
while ($rows=mysqli_fetch_array($query)){
    if($rows['usuario']==$user && $rows['contrasena']==$password){
        $_SESSION['id'] =$rows['id'];
        header('Location: index.php');
    }
    else{
        echo("Usuario y Contraseña no son validos. Intenta de Nuevo");
    }
}

mysqli_close($connection);
?>