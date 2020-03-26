<?php
include("connection.php");
if (!$_GET['rquest'] || $_GET['rquest']==""){
 $sql="SELECT * FROM tblclasses";
}else{
 $sql="SELECT * FROM tblclasses WHERE Location='".$_GET['rquest']."'";
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
            <th>Name</th>
            <th>Description</th>
            <th>Location</th>
            <th>Instructor</th>
            <th>Max</th>
            <th></th><th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        while($row=mysqli_fetch_array($result)){
            //$id=$row['id'];
            //$sqlquery="SELECT m.id,m.FirstName,m.LastName,
             //mr.MembershipId, me.Name FROM tblmembershipreg mr LEFT JOIN tblmember m
            //ON m.id=mr.CustomerId LEFT JOIN tblmemberships me ON me.ID=mr.MembershipId
            //WHERE m.id=$id";
            //$result2=mysqli_query($connection,$sqlquery);
            //$row2=mysqli_fetch_array($result2);
            if ($row['Location']==1){
             $loc='Yoga Room';
            }elseif ($row['Location']==2){
             $loc='Pool';
            }elseif ($row['Location']==3){
             $loc='Studio';
            }else {
             $loc='Not Assigned';
            }
            
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td class='text-capitalize'>".$row['Name']."</td>";
            echo "<td class='text-capitalize'>".$row['Description']."</td>";
            echo "<td class='text-capitalize'>".$loc."</td>";
            echo "<td class='text-capitalize'>".$row['Instructor']."</td>";
            echo "<td>".$row['MaxSignUps']."</td>";
            echo "<td><a class='btn btn-primary' href=editclasses.php?id=".$row['id'].">Edit Info</td>";
            echo "<td><a class='btn btn-primary' href=classregistrationroster.php?classid=".$row['id'].">See Roster</td>";
            //echo "<td><a href=editmemberform.php?id=".$row['id']." class='btn btn-primary'>Edit Info</a> <a href=editcreditcardform.php?id=".$row['id']." class='btn btn-primary'>Credit Card</a></td>";
            //echo "<td></td>";
            //echo "<td></td>";
        }
        mysqli_close($connection);
        ?>
    </tbody>
</table>

