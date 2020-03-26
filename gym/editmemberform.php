<!DOCTYPE html>
<html>
<?php
include("header.php");
include ("connection.php");
$a=array(
  'AL' => 'Alabama',
  'AK' => 'Alaska',
  'AZ' => 'Arizona',
  'AR' => 'Arkansas',
  'CA' => 'California',
  'CO' => 'Colorado',
  'CT' => 'Connecticut',
  'DE' => 'Delaware',
  'DC' => 'District Of Columbia',
  'FL' => 'Florida',
  'GA' => 'Georgia',
  'HI' => 'Hawaii',
  'ID' => 'Idaho',
  'IL' => 'Illinois',
  'IN' => 'Indiana',
  'IA' => 'Iowa',
  'KS' => 'Kansas',
  'KY' => 'Kentucky',
  'LA' => 'Louisiana',
  'ME' => 'Maine',
  'MD' => 'Maryland',
  'MA' => 'Massachusetts',
  'MI' => 'Michigan',
  'MN' => 'Minnesota',
  'MS' => 'Mississippi',
  'MO' => 'Missouri',
  'MT' => 'Montana',
  'NE' => 'Nebraska',
  'NV' => 'Nevada',
  'NH' => 'New Hampshire',
  'NJ' => 'New Jersey',
  'NM' => 'New Mexico',
  'NY' => 'New York',
  'NC' => 'North Carolina',
  'ND' => 'North Dakota',
  'OH' => 'Ohio',
  'OK' => 'Oklahoma',
  'OR' => 'Oregon',
  'PA' => 'Pennsylvania',
  'RI' => 'Rhode Island',
  'SC' => 'South Carolina',
  'SD' => 'South Dakota',
  'TN' => 'Tennessee',
  'TX' => 'Texas',
  'UT' => 'Utah',
  'VT' => 'Vermont',
  'VA' => 'Virginia',
  'WA' => 'Washington',
  'WV' => 'West Virginia',
  'WI' => 'Wisconsin',
  'WY' => 'Wyoming',
);
?>
<script>

    function validateform(){
        var myform=document.forms.frmmember;
        var UPass = myform.elements.UPass;
        var CellPhone = myform.elements.CPhone;
        var AddressLine1 = myform.elements.AL1;
        var Email = myform.elements.Email;
        var Email1 = myform.elements.Email.value;
        var City = myform.elements.City;
        var State = myform.elements.State;
        var ZipCode = myform.elements.ZCode;

        if (UPass.value==""){
            alert("Please enter Password");
            UPass.focus();
            return false;
        }
        if (UPass.value.length<5){
            alert("Please enter Password of at least 5 characters");
            UPass.focus();
            return false;
        }
        if (CellPhone.value==""){
            alert("Please enter your Cell Phone");
            CellPhone.focus();
            return false;
        }
        if (CellPhone.value.length<14){
            alert("Please enter valid Cell Phone");
            CellPhone.focus();
            return false;
        }
        if (AddressLine1.value==""){
            alert("Please enter your Address");
            AddressLine1.focus();
            return false;
        }
        if (Email==""){
            alert("Please enter your Email");
            Email.focus();
            return false;
        }
        if (Email1.indexOf("@") < 0){
            alert("Please enter a valid Email");
            Email.focus();
            return false;
        }
        if (Email1.indexOf(".") < 0){
            alert("Please enter a valid Email");
            Email.focus();
            return false;
        }
        if (City.value==""){
            alert("Please enter your City");
            City.focus();
            return false;
        }
        if (State.value==""){
            alert("Please enter your State");
            City.focus();
            return false;
        }
        if (ZipCode.value==""){
            alert("Please enter your Zip Code");
            ZipCode.focus();
            return false;
        }
         if (ZipCode.value.length!=5){
            alert("Zip code must be 5 characters");
            ZipCode.focus();
            return false;
        }
                canconfirm=confirm("Do you want to save?");
        if (canconfirm==true){
            
        }else{
            return false;
        }
    return true;
    }
    function cancelconfirm(){
        var myform=document.forms.frmmember;
        canconfirm=confirm("Do you want to cancel membership?");
        if (canconfirm==true){
            var memberid=myform.elements.IDMember.value;
            location.href='cancelmembership.php?memberid='+memberid;
        }else{
            return false;
        }
    }

</script>
</head>
<body>
<?php
include ("menu.php");
include ("bodyheader.php");
$id=intval($_GET['id']);
$sqlquery="SELECT * FROM tblmember WHERE id ='".$id."'";
$result=mysqli_query($connection,$sqlquery);
$row=mysqli_fetch_array($result);
$FirstName = $row['FirstName'];
$LastName = $row['LastName'];
$CellPhone = $row['CellPhone'];
$AddressLine1 = $row['AddressLine1'];
$AddressLine2 = $row['AddressLine2'];
$Email = $row['Email'];
$City = $row['City'];
$State = $row['State'];
$ZipCode = $row['ZipCode'];
$User=$row['User'];
$Password=$row['Password'];
?>
<br/><br/>
<div class="container">
    <form action="processmemberupdate.php" method="post" name="frmmember" onsubmit="return validateform();">
        <div class="form-row mb-4">
            <div class="col-2"></div>
            <div class="col-8">
                <legend>Update Member Information Form</legend>
                <hr>
            </div>
        </div>
        <div class="form-row">
            <div class="col-2"></div>
            <div class="col-8"><h5>Log In Information</h5>
            <hr>
            </div>
        </div>
        <div class="form-row mb-4">
            <div class="col-2"></div>
            <div class="col-4">
                <label>User</label>
                <input type="text" placeholder="User Name" class="form-control" name="UName" value= "<?php echo $User;?>" readonly="readonly">
            </div>
            <div class="col-4">
                <label>Password</label>
                <input type="password" placeholder="Password" class="form-control" name="UPass" value= "<?php echo $Password;?>" required>
            </div>
        </div>
        <div class="form-row mb-4">
            <div class="col-2"></div>
            <div class="col-4">
                <select class="form-control" name="SelMembership">
                    <option value=''>Select Membership</option>
                        <?php
                        //Gets memberships names and prices
                        $sqlquery3="SELECT * FROM tblmembershipreg WHERE CustomerId=$id";
                        $result3=mysqli_query($connection,$sqlquery3);
                        $row3=mysqli_fetch_array($result3);
                        $sqlquery2="SELECT * FROM tblmemberships";
                        $resultmem=mysqli_query($connection,$sqlquery2); 
                        while ($row2=mysqli_fetch_array($resultmem)){
                            if ($row2['Id']==$row3['MembershipId']){
                                $selected="selected";
                            }else{
                                $selected="";
                            }
                            $idm=$row2['Id'];$namem=$row2['Name'];$pricem=$row2['Price'];
                         echo "<option value=$idm $selected>$namem, $$pricem  </option>";
                        }
                        ?>           
                </select>
            </div>
            <div>
                <button type="button" onclick="return cancelconfirm();" class="btn btn-danger">Cancel Membership</button>
            </div>

        </div>

        <div class="form-row">
            <div class="col-2"></div>
            <div class="col-8">
                <h5>Contact Information</h5>
                <hr>
            </div>
        </div>
        <div class="form-row mb-4">
            <div class="col-2"></div>
            <div class="col-2">
                <label>Id</label>
                <input type="text" class="form-control" placeholder="Id" name="IDMember" value= "<?php echo $id;?>" readonly="readonly">
            </div>
        </div>
            
        <div class="form-row mb-4">
            <div class="col-2"></div>
            <div class="col-4">
                <label>First Name</label>
                <input type="text" class="form-control text-capitalize" placeholder="First Name" name="FName" value= "<?php echo $FirstName;?>" readonly="readonly">
            </div>
            <div class="col-4">
                <label>Last Name</label>
                <input type="text" class="form-control text-capitalize" placeholder="Last Name" name="LName" value= "<?php echo $LastName;?>" readonly="readonly">
            </div>
        </div>
        <div class="form-row mb-4">
             <div class="col-2"></div>
            <div class="col-4">
                <label>Cell Phone</label>
                <input type="text" class="form-control" id='phone' placeholder="Cell Phone" name="CPhone" value= "<?php echo $CellPhone;?>" required>
            </div>
            <div class="col-4">
                <label>E-Mail</label>
                <input type="text" class="form-control" placeholder="Email" name="Email" value= "<?php echo $Email;?>" required>
            </div>
        </div>
        <div class="form-row mb-4">
            <div class="col-2"></div>
            <div class="col-8">
                <label>Address</label>
                <input type="text" class="form-control text-capitalize" placeholder="Address" name="AL1" value= "<?php echo $AddressLine1;?>" required>
            </div>

        </div>
        <div class="form-row mb-4">
            <div class="col-2"></div>
            <div class="col-3">
                <label>City</label>
                <input type="text" class="form-control text-capitalize" placeholder="City" name="City" value= "<?php echo $City;?>" required>
            </div>
            <div class="col-2">
                <label>State</label>
                <select class="form-control" placeholder="State" name="State" required>
                    <option value=''>Select State</option>
                    
                    <?php
                    foreach ($a as $k=>$v){
                        if ($k==$State){
                            $Sselected="selected";
                        }else{
                            $Sselected="";
                        }
                        echo "<option value=$k $Sselected>$a[$k]</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-3">
                <label>Zip Code</label>
                <input type="text" id='Zcode' class="form-control" placeholder="Zip Code" name="ZCode" value= "<?php echo $ZipCode;?>" required>
            </div>
        </div>
        <div class="form-row mb-4">
            <div class="col-2"></div>
            <div class="col-4">
                <button type="submit" class="btn btn-primary col mr-2" name="btnmembersubmit">Save</button>
            </div>
            <div class="col-4">
                <button type="reset" class="btn btn-primary col mr-2" name="btnmemberreset">Reset</button>
            </div>
        </div>        
    </form>
</div>
<script>
    document.getElementById('phone').addEventListener('input', function (e) {
  var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
  e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
});
    document.getElementById('Zcode').addEventListener('input', function (e) {
  var x = e.target.value.replace(/\D/g, '').match(/(\d{0,5})/);
  console.log(x[1]);
  e.target.value = x[1];
});

</script>
<?php
include ("footer.php");
?>