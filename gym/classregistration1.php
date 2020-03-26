<?php
include("header.php");
include("connection.php")
?>
</header>
<body>
<?php
include("menu.php");
include("bodyheader.php");
$sql="SELECT * FROM tblclasses";
if ($result=mysqli_query($connection,$sql)){
    
}else{
    echo "there was an error <br>".mysqli_error($connection,$sql);
}

?>
<div class="container">
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Location</th>
            <th>Instructor</th>
            <th>Seats Available</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row=mysqli_fetch_array($result)){
            $id=$row['id'];
            $name=$row['Name'];
            $description=$row['Description'];
            $location=$row['Location'];
            $instructor=$row['Instructor'];
            $maxsignups=$row['MaxSignUps'];
            echo "<tr>";
            echo "<td>$id</td>";
            echo "<td>$name</td>";
            echo "<td>$description</td>";
            echo "<td>$location</td>";
            echo "<td>$instructor</td>";
            echo "<td>$maxsignups</td>";
            echo "<td><a href='addregistration.php?request=$id' class='btn btn-primary' data-toggle='modal' data-target='#editform' data-whatever='$id'>Register</a></td>";
        }
        ?>
    </tbody>
    
</table>
</div>





<?php
mysqli_close($connection);
?>