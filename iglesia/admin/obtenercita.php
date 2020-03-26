<?php
include('connection.php');
$cita="";
$capitulo="";
$sql = "SELECT * FROM citacion";
if ($result = mysqli_query($connection, $sql)) {
    while ($row = mysqli_fetch_array($result)) {
        $cita=$row['citacion'];
        $capitulo=$row['capitulo'];

    }
}
mysqli_close($connection);
?>
