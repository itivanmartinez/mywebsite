<?php
include("connection.php");
if (isset($_POST['cita']) && isset($_POST['capitulo'])){
    $cita=$_POST['cita'];
    $capitulo=$_POST['capitulo'];
}else{
    echo 'false';
}
if (isset($cita) && isset($capitulo) ){
    $sql="UPDATE citacion SET citacion='".$cita."',capitulo='".$capitulo."' WHERE id='1'";
    if ($result=mysqli_query($connection,$sql)){
        echo "true";
}
else
{
    echo "false";
}
}else{
    echo "false";
}


mysqli_close($connection);

?>