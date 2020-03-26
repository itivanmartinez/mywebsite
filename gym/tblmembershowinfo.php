<?php
$strRequest=$_GET['rquest'];
include("connection.php");
$sqlquery="SELECT * FROM tblmember WHERE lastname LIKE '%".$strRequest."%'";
$result=mysqli_query($connection,$sqlquery);
?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>FIRST NAME</th>
            <th>LAST NAME</th>
            <th>PHONE</th>
            <th>ADDRESS</th>
            <th>EMAIL</th>
            <th>CITY</th>
            <th>STATE</th>
            <th>ZIP CODE</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        while($row=mysqli_fetch_array($result)){
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['FirstName']."</td>";
            echo "<td>".$row['LastName']."</td>";
            echo "<td>".$row['CellPhone']."</td>";
            echo "<td>".$row['AddressLine1']."</td>";
            echo "<td>".$row['Email']."</td>";
            echo "<td>".$row['City']."</td>";
            echo "<td>".$row['State']."</td>";
            echo "<td>".$row['ZipCode']."</td>";
            echo "<td><a href='editmemberform.php?id=".$row['id']."' class='btn btn-primary'>Edit</a></td>";
            echo "</tr>";
        }
        mysqli_close($connection);
        ?>
    </tbody>
</table>