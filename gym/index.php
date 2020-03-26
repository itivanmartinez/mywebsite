<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['memberID'])){
echo "<!DOCTYPE html>";
echo "<html>";
include("header.php");
echo "<style>.card{
        background-color: transparent;
        color:white;
        border:0;
    }
    hr{
        border-top:2px solid rgba(0,49,82,0.8);
    }
    .bg-primary{
        background-color: rgba(100,175,250,.9)!important;
    }
        .gymbackground{
        background-image:url('pictures/gymbackground.jpg');
    }
    </style>";
echo "</head>";
echo "<body>";
echo "<div class='gymbackground'>";
include ("menu.php");

include ("bodyheader.php");

include ("dashboard.php");
include ("footer.php");
exit();   
}
?>

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
        alert  ("Please enter Password");
        upass.focus();
        return false;
       }
    }
    function credentials(){
        alert("To enter as admin use \n User: 'admin1' \n Password: '12345'")
    }
</script>
</head>
<body onload='credentials();'>
    <br>
<?php
include ("bodyheader.php");
?>
<div class="container ">
    <form action="processlogin.php" method="post" name="frmLogIn" onsubmit="return validateForm();">
        <div class="form-row">
            <div class="col-5"></div>
            <div class="col-4 bg-secondary">
                <legend class="text-white text-center h1">Sign In</legend>
            </div>
            
        </div>
        <br>
        <div class="form-row">
            <div class="col-5">
                <legend><a href="/gym/doc/documentation.docx">See documentation</a></legend>
            </div>
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
    
    <br>
        <div class="form-row">
            <div class="col-5"></div>
            <div class="col-4">
                <span class="h4">Not a Member?</span>
                <a type="button" href="addmembernew.php" class="btn btn-succesful col">Sign Up</a>
            </div>
        </div>

</div>
</div>
<?php
include ("footer.php");
?>