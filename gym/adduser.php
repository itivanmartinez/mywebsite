<!DOCTYPE html>
<html>
<?php
include("header.php");
include("connection.php")
?>
</head>
<body>
<?php
include ("menu.php");
include ("bodyheader.php");
?>
<br/><br/>
<div class="container">
    <form action="processuser.php" method="post" name="frmuser">
        <div class="forms-row mb-4">
            <div class="col-2"></div>
            <div class="col-8">
                <legend>Add User Form</legend>
                <hr/>
            </div>
        </div>
        <div class="form-row">
            <div class="col-2"></div>
            <div class="col-4">
                <legend>User Name</legend>
                <input type="text" class="form-control" placeholder="User Name" name="UName">
            </div>
        </div>
        <div class="form-row">
            <div class="col-2"></div>
            <div class="col-4">
                <legend>Password</legend>
                <input type="text" class="form-control" placeholder="Password" name="UPass">
            </div>
        </div>
        <div class="form-row">
            <div class="col-2"></div>
            <div class="col-4">
                <legend>Select User Type</legend>
                <select class="custom-select mr-sm-4" name="UType">
                    <option selected>Choose User Type</option>
                    <option value="1">Member</option>
                    <option value="2">Front Desk</option>
                    <option value="3">Management</option>
                </select>
            </div>
        </div>
        <br>
        <div class="form-row">
            <div class="col-2"></div>
            <div class="col-2">
                <button class="col btn btn-primary" type="submit">Add User</button>
            </div>
            <div class="col-2">
                <button class="col btn btn-primary" type="reset">Reset</button>
            </div>
            
        </div>
    </form>
    
</div>
<?php
include ("footer.php");
?>