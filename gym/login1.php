<!DOCTYPE html>
<html>
<?php
include("header.php");
?>
<script>

    function validateForm(){
       var formlogin=document.forms.frmLogIn;
       var uname=formlogin.elements.userName;
       var upass=formlogin.elements.userPassword;
       if (uname.value==""){
        alert("Please enter User Name");
        uname.focus();
        return false;
       }
       if (upass.value==""){
        alert  ("Plaes enter Password");
        upass.focus();
        return false
       }
    }
</script>
</head>
<body>
    <br>
<?php
include ("bodyheader.php");
?>
<div class="container ">
    <form action="login.php" method="post" name="frmLogIn" onsubmit="return validateForm();">
        <div class="form-row">
            <div class="col-5"></div>
            <div class="col-4 bg-secondary">
                <legend class="text-white">Sign In</legend>
                <br>
            </div>
            
        </div>
        <br>
        <div class="form-row">
            <div class="col-5"></div>
            <div class="col-4">
                <legend>User Name</legend>
                <input type="text" name="userName" class="form-control" placeholder="Enter User Name" >
            </div>
        </div>
        <div class="form-row">
            <div class="col-5"></div>
            <div class="col-4">
                <legend>Password</legend>
                <input type="text" name="userPassword" class="form-control" placeholder="Enter Password" >
            </div>
        </div>
        <br>
        <div class="form-row">
            <div class="col-5"></div>
            <div class="col-4">
                <button type="submit" class="btn btn-primary col">Sign In</button>
            </div>
        </div>
    </form>
    
</div>
<?php
include ("footer.php");
?>