<?php
include("connection.php");
$sql="SELECT * FROM tblmemberships";
$result=mysqli_query($connection,$sql);
if (!$result){
    echo "There was an error";
    echo"Error: " .$sql."<br>".mysqli_error($connection);
    die();
}

?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        while($row=mysqli_fetch_array($result)){
            echo "<tr>";
            echo "<td class='text-capitalize'>".$row['Id']."</td>";
            echo "<td class='text-capitalize'>".$row['Name']."</td>";
            echo "<td >".$row['Price']."</td>";
            echo "<td class='text-capitalize'>".$row['Description']."</td>";
            echo "<td><a class='btn btn-primary' href=editmemberships.php?id=".$row['Id'].">Edit Info</td>";

        }
        mysqli_close($connection);
        ?>
    </tbody>
</table>

