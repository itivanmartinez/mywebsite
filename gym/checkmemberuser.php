<?php
include("connection.php");
$request=$_GET['request'];
$sqlquery="SELECT * FROM tblmember WHERE User ='$request'";
$result=mysqli_query($connection,$sqlquery);
if(mysqli_num_rows($result) > 0) {
echo "User is not available";
}
else {
echo "<p id='available'>User is available</p>";
}

?>