<!DOCTYPE html>
   <html>
<?php
include("header.php");
include("connection.php");
$classid=$_GET['classid'];
$sql="SELECT * FROM tblclasses cl inner JOIN tblclassesdays cd ON cd.id=cl.id WHERE cd.id='$classid'";
?>
<script>
    if (window.XMLHttpRequest){
       //code for ie7, firefox,chrome,opera,safari
       xmlhttp= new XMLHttpRequest();
   }
   else{
       //code for ie6,ie5
       xmlhttp=new AciveXObject("Microsoft.XMLHTTP");
   }
   function ShowMember(str){
        xmlhttp.onreadystatechange = function(){
            if (this.readyState==4 && this.status==200){
                document.getElementById("showmemberinfo").innerHTML=this.responseText;
            }else{
                document.getElementById("showmemberinfo").innerHTML=this.responseText;
            }
        };
        
        xmlhttp.open("GET","tblmembershowinfodropdown.php?rquest="+str,true);
        xmlhttp.send();
   }
   function confirmation(){
      var form = document.forms.frmClassRegistration;
      var memberId=form.elements.memberId;
      if (memberId=form.elements.memberId){
      }else{
            
         alert("You must enter a member Id")
         return false;
         }

      var con=confirm("Do you want to register member for this class?");
      if (con==true){
         
      }else{
         return false;
      }
   }
</script>
</head>
<body>
<?php
include("menu.php");
include("bodyheader.php");

?>
<div class="container">
         <div class="form-row">
         <div class="col">
            <h3>Class Registration Form</h3>
            <hr>
         </div>
      </div>
    <div class="row">
        <div class="col-4">
            <label>Enter Member Id to Register for class</label>
            <input type="text" class="form-control col-3" onkeyup="ShowMember(this.value);">
        </div>
    </div>
    <br>
<form action="processclassregistration.php?classid=<?php $classid; ?>" method="post" name="frmClassRegistration" onsubmit="return confirmation();">
    <div class="row">
        <div class="col" id="showmemberinfo">
            
        </div>
    </div>
    <div class="row">
      <div class="col-8">

            
         
         <?php
$DayArray=array("all"=>"Show All","mon"=>"Monday","tue"=>"Tuesday","wed"=>"Wednesday","thu"=>"Thursday","fri"=>"Friday","sat"=>"Saturday", "sun"=>"Sunday");
$result=mysqli_query($connection,$sql);
$row=mysqli_fetch_array($result);
    $id=$row['id'];
    $name=$row['Name'];
    $description=$row['Description'];
    $location=$row['Location'];
    $instructor=$row['Instructor'];
    $maxsignups=$row['MaxSignUps'];
    $classday=$DayArray[$row['days']];
   if ($location==1){
      $location1="Yoga Room";
   }
   if ($location==2){
      $location1='Pool';
   }
   if ($location==3){
      $location1="Studio";
   }
         ?>
<div class="form-row">
   <div class="col">
         <legend>Class Information</legend>
         <hr>
         </div>
</div>
      <div class="form-row">
         
         <div class="col-2">
            <label>Class ID</label>
            <input class="form-control" type="text" name="classid" value="<?php echo $id?>" readonly>
         </div>
         <div class="col-6">
            <label>Name</label>
            <input class="form-control text-capitalize" type="text" name="name" value="<?php echo $name?>" readonly>
         </div>
      </div>
      <div class="form-row">
         <div class="col-8">
            <label>Description</label>
            <textarea class="form-control text-capitalize" rows=3 readonly name="description"><?php echo $description?></textarea>
         </div>
      </div>
      <div class="form-row">
         <div class="col-8">
            <label>Location</label>
            <input class="form-control text-capitalize" type="text" name="location" value="<?php echo $location1?>" readonly>
         </div>
      </div>
      <div class="form-row">
         <div class="col-8">
            <label>Location</label>
            <input class="form-control" type="text" name="classday" value="<?php echo $classday?>" readonly>
         </div>
      </div>
               <br>
      <div class="form-row">

         <div class="col-8">
            <button type='submit' class='btn btn-primary form-control'>Register</button>
         </div>
         
      </div></div></div>
    </form>
    
</div>
<br><br><br>

<?php
include("footer.php");
mysqli_close($connection);
?>