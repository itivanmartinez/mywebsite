<?php

session_start();

include ("connection.php");
  if (!empty($_POST)){
    if (isset($_POST['userName']) && isset($_POST['userPassword'])) {
      $user=$_POST['userName'];
      $pass=$_POST['userPassword'];
    $sqlQuery="SELECT * FROM tblmember WHERE User='$user'";
    $result=mysqli_query($connection,$sqlQuery);
    if (!$result)
    {
      $error = 'Error retrieving data: ' . mysqli_error($dbconn);
      exit();
    }
    $numRows=mysqli_num_rows($result);
    if ($numRows==0){
      echo "Entered User or pasword is incorrect";
      exit();
      //output data for each row

        }
    else {
      $row=mysqli_fetch_array($result);
        if ($row['User']==$user and $row['Password']==$pass){
          $_SESSION['memberID'] =$row['id'];
          $_SESSION['PrivilegeID']=$row['privilegeID'];
          header('Location: index.php');
      }else{
        echo "Entered User or paswword is incorrect";
      }
    }
  }
 }
  $connection->close();
?>
