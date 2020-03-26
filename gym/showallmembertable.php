<?php
include("connection.php");
if (isset($_GET['rquest'])){
 $request=$_GET['rquest'];   
}else {
    $request="";
}

if (!$request || ($request=="")){
$sql="SELECT * FROM tblmember";
}  
else{
    $sql="SELECT * FROM tblmember WHERE id ='$request'";
}
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
            <th>First Name</th>
            <th>Last Name</th>
            <th>Membership</th>
            <th></th>

        </tr>
    </thead>
    <tbody>
        <?php
        while($row=mysqli_fetch_array($result)){
            $id=$row['id'];
            $sqlquery="SELECT m.id,m.FirstName,m.LastName,
             mr.MembershipId, me.Name FROM tblmembershipreg mr LEFT JOIN tblmember m
            ON m.id=mr.CustomerId LEFT JOIN tblmemberships me ON me.ID=mr.MembershipId
            WHERE m.id=$id";
            $result2=mysqli_query($connection,$sqlquery);
            $row2=mysqli_fetch_array($result2);
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td class='text-capitalize'>".$row['FirstName']."</td>";
            echo "<td class='text-capitalize'>".$row['LastName']."</td>";
            echo "<td class='text-capitalize'>".$row2['Name']."</td>";
            echo "<td><a href=editmemberform.php?id=".$row['id']." class='btn btn-primary'>Edit Info</a> <a href=editcreditcardform.php?id=".$row['id']." class='btn btn-primary'>Credit Card</a></td>";
            //echo "<td></td>";
            //echo "<td></td>";
        }
        mysqli_close($connection);
        ?>
    </tbody>
</table>