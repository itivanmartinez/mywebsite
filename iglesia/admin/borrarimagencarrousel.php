<?php 
include('connection.php');
if (isset($_POST['id'])){
    $id=$_POST['id'];
}else{
    echo "Se ha producido un error";
    die();
}
if (isset($id)){
    $sql="DELETE FROM img_carrousel WHERE id=$id";
    if ($result=mysqli_query($connection,$sql)){
        echo "true";
    }else {
        echo  "false".mysqli_error($connection);
    }

}else{
    echo "false";
}


?>