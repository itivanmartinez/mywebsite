<!DOCTYPE html>
<html>
<?php
include("header.php");
include("connection.php");
?>
</head>
<body>
<?php
include ("menu.php");
include ("bodyheader.php");
$id=$_POST['id'];
$Name=$_POST['name'];
$Price=$_POST['price'];
$Description=$_POST['description'];
$sql="UPDATE tblmemberships SET  Name='".$Name."',Price='".$Price."',Description='".$Description."' WHERE id='".$id."'";
if (mysqli_query($connection,$sql)){
        echo "<div class='container'>";
        echo "<p class='display-4'>Record edited succesfully</p>";
        echo "<a class='btn btn-primary' href='showallmembershipsform.php'>Go Back</a>";
        echo "</div>";
    
    }else{
        echo "<p class='display-4 text-danger'>There was an error updating membership</p>";
    }

mysqli_close($connection);
?></body>
</html>