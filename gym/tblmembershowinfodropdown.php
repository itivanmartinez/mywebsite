<?php

$strRequest=($_GET['rquest']);
include("connection.php");
$sqlquery="SELECT * FROM tblmember WHERE id = '$strRequest'";
$result=mysqli_query($connection,$sqlquery);
?>

        <?php
        while($row=mysqli_fetch_array($result)){
            $id=$row['id'];
            $fname=$row['FirstName'];
            $lname=$row['LastName'];
            echo "<div class='form-group row'>";
            echo "<label for=\"staticEmail\" class=\"col-sm-2 col-form-label\">Member ID</label>";
            echo "<div class=\"col-sm-10\">";
            echo "<input type=\"text\" readonly class=\"form-control-plaintext\" name=\"memberId\" value=\"$id\">";
            echo "</div>";
            echo "</div>";
            echo "<div class='form-group row'>";
            echo "<label for=\"staticEmail\" class=\"col-sm-2 col-form-label\">First Name</label>";
            echo "<div class=\"col-sm-10\">";
            echo "<input type=\"text\" readonly class=\"form-control-plaintext text-capitalize\" name=\"MemberFName\" value=\"$fname\">";
            echo "</div>";
            echo "</div>";
            echo "<div class='form-group row'>";
            echo "<label for=\"staticEmail\" class=\"col-sm-2 col-form-label \">Last Name</label>";
            echo "<div class=\"col-sm-10\">";
            echo "<input type=\"text\" readonly class=\"form-control-plaintext text-capitalize\" name=\"MemberLName\" value=\"$lname\">";
            echo "</div>";
            echo "</div>";
            
        }
        mysqli_close($connection);
        ?>
