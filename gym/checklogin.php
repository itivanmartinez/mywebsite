<?php
session_start(); 
if (isset($_SESSION['memberID'])){
}else{
    echo '<a href="index.php" class=\"display-4\">Log in to continue...</a>';
    exit();
}
?>

