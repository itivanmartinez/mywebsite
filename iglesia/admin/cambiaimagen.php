<?php 
include('connection.php');
if (isset($_POST['id']) && isset($_POST['image']) ){
    $id=$_POST['id'];
    $image=$_POST['image'];
}else{
    echo 'false1';}
if (isset($id) && isset($image)){
    $sql="UPDATE img_carrousel SET imagen='$image' WHERE id = $id";
    if (mysqli_query($connection,$sql)){
        echo 'true';
    }else{
        echo 'false2';
    }
}else {
    {echo 'false3';}
}


mysqli_close($connection);
?>