<!DOCTYPE html>
<html>
<?php
include("header.php");

?>
</head>
<body>
<?php
include ("menu.php");
include ("bodyheader.php");
?>
<br><br>
<div class="container">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-10"><h4>Date: <span id="date" ><?php echo date("F j, Y");?></span></h4></div>
        <div class="col-2"></div>
        <div class="col">
            <h1>All Members Report</h1>
        </div>
        
        <div class="float-right col-2">
        <button type="button" class="btn btn-primary col d-print-none" onclick="window.print();">Print</button>
        <p></p><a type="button" class="btn btn-primary col d-print-none" href="reports.php">Go Back</a>
        </div>
    </div>

</div>
<br>
<div class="container">
    <?php
include("connection.php");
$sqlquery="SELECT * FROM tblmember ORDER BY id";

if ($result=mysqli_query($connection,$sqlquery)){
    
}else{
    echo mysqli_error($connection);
    die();
}
?>
<table class="table table-striped">
    <thead>
        <tr class="text-center">
            <th>id</th>
            <th>FIRST NAME</th>
            <th>LAST NAME</th>
            <th>PHONE</th>
            <th>ADDRESS LINE 1</th>
            <th>CITY</th>
            <th>STATE</th>
            <th>ZIP CODE</th>
            <th>DATE JOINED</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while($row=mysqli_fetch_array($result)){
            $date=date('M j Y', strtotime($row['DateJoined']));
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td class='text-capitalize'>".$row['FirstName']."</td>";
            echo "<td class='text-capitalize'>".$row['LastName']."</td>";
            echo "<td>".$row['CellPhone']."</td>";
            echo "<td class='text-capitalize'>".$row['AddressLine1']."</td>";
            echo "<td class='text-capitalize'>".$row['City']."</td>";
            echo "<td>".$row['State']."</td>";
            echo "<td>".$row['ZipCode']."</td>";
            echo "<td>$date</td>";
        }
        mysqli_close($connection);
        ?>
    </tbody>
</table>
</div>



<?php
include ("footer.php");
?>

