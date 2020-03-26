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
    if ($result->num_rows>0){
      //output data for each row
      while ($row=$result->fetch_assoc()){
        if ($row['User']==$user and $row['Password']==$pass){
          $_SESSION['userid'] =$row['id'];
          $_SESSION['PrivilegeID']=$row['privilegeID'];
        }
    else {
      if ($result->num_rows==0){
        echo "Entered User is incorrect";
        exit();
      }
      
      echo "Entered password is incorrect";
    }


    }
    }
  }
}
  $connection->close();
?>
