<!DOCTYPE html>
    <html>
    
<?php
include("header.php");
?>
</head>
<body>
    
<?php
include ("menu.php");
include("bodyheader.php");
include("connection.php");
echo "<div class=\"container\"><div class=\"row\"><div class=\"col display-4 \">";
$ClassName=$_POST['ClName'];
$ClassDescription=$_POST['ClassDescription'];
$ClassLocation=$_POST['ClassLocation'];
$ClassDay=$_POST['ClassDay'];
$ClassTime=$_POST['ClassTime'];
$Classinstructor=$_POST['Classinstructor'];
$ClassMaxSignUps=0;
if ($ClassLocation==1){
    $ClassMaxSignUps=15;
}
if ($ClassLocation==2){
    $ClassMaxSignUps=20;
}
if ($ClassLocation==3){
    $ClassMaxSignUps=15;
}
$sqlLookClass="SELECT c.location, c.id ,cd.id,cd.days,cd.time FROM tblclassesdays  cd LEFT JOIN tblclasses c  on c.id=cd.id
                WHERE c.location='$ClassLocation' AND cd.days='$ClassDay' AND cd.time='$ClassTime'";
$resultLook=mysqli_query($connection,$sqlLookClass);
if (!$resultLook){
    echo "error $sql <br> ".mysqli_error($connection);
}
if (mysqli_num_rows($resultLook)>0){
    echo "There is a classes on that location and time";
    echo "<p>Please try another time</p>";
    mysqli_close($connection);
    exit();
    
}
$sql= "INSERT INTO tblclasses (Name,Description, Location, Instructor, MaxSignUps)
        VALUES ('$ClassName','$ClassDescription','$ClassLocation','$Classinstructor','$ClassMaxSignUps')";
if (mysqli_query($connection,$sql)){
    $lastid = mysqli_insert_id($connection);
    $sql2="INSERT INTO tblclassesdays (id,days,time) VALUES('$lastid','$ClassDay','$ClassTime')";
    if (mysqli_query($connection,$sql2)){
        echo "<div class='container'>";
        echo "New class created successfully<br>";
        echo "<a class='btn btn-primary' href='showallclassesform.php'>Go Back</a>";
        echo "</div>";
        
    }else{
        echo "There was an error inserting time to classes";
    }
    
}else{
    echo "error $sql <br> ".mysqli_error($connection);
}
mysqli_close($connection);
?>
</div></div></div>