<!DOCTYPE html>
    <html>
<?php
include ("header.php");

include("connection.php");

?>
</head>
<body>
    <?php
    include("menu.php");
    include("bodyheader.php");
    $ClassName=$_POST['ClassName'];
    $ClassDescription=$_POST['ClassDescription'];
    $ClassPrice=$_POST['ClassPrice'];
    $sql="INSERT INTO tblmemberships (Name,Price,Description) VALUES ('$ClassName','$ClassPrice','$ClassDescription')";
    if ($result=mysqli_query($connection,$sql)){
        echo "<div class='container'>";
        echo "<p class='display-4'>Membership added succesfully</p>";
        echo "<a class='btn btn-primary' href='showallmembershipsform.php'>Go Back</a>";
        echo "</div>";
    }else{
        echo "Error: $sql <br>";
        echo  mysqli_error($connection);
    }
    mysqli_close($connection);
    ?>
    
</body>