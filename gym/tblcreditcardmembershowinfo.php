<?php
$strRequest=($_GET['rquest']);
echo $strRequest;
include("connection.php");
$sqlquery="SELECT m.id,m.FirstName,m.LastName,
             c.CCNumber FROM tblcredcardinfo c LEFT JOIN tblmember m
            ON m.id=c.customerId
            WHERE m.id=$strRequest";
$result=mysqli_query($connection,$sqlquery);
?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>FIRST NAME</th>
            <th>LAST NAME</th>
            <th>Credit Card Number</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while($row=mysqli_fetch_array($result)){
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['FirstName']."</td>";
            echo "<td>".$row['LastName']."</td>";
            echo "<td>".$row['CCNumber']."</td>";
            echo "<td><a href=editcreditcardform.php?id=".$row['id'].">Edit</a></td>";
            echo "</tr>";
        }
        mysqli_close($connection);
        ?>
    </tbody>
</table>