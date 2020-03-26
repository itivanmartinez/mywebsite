<?php
include("bodyheader.php");
include("connection.php");
$UserName=$_POST['UName'];
$UserPass=$_POST['UPass'];
$UserClass=$_POST['UType'];
if ($UserClass=="1"){
    $UserType="Member";
}
if ($UserClass=="2"){
    $UserType="FrontDesk";
}
if ($UserClass=="3"){
    $UserType="Management";
}
$sql="INSERT INTO tblusers (User,PAssword,class) VALUES ('$UserName','$UserPass','$UserType')";
if (mysqli_query($connection,$sql)){
    echo "New User Added Succesfully";
}else{
    echo "Error: $sql <br>";
    echo mysqli_error($connection);
}

    mysqli_close($connection);
?>