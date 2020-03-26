<!DOCTYPE html>
<html>
<?php
include("header.php");
include("connection.php");
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
    
    function checkuser(str){
        if (str==""){
           document.getElementById("checkuser").innerHTML = "";
            return; 
        }else{
            if (window.XMLHttpRequest){
                //code for ie7, firefox,chrome,opera,safari
                xmlhttp= new XMLHttpRequest();
            }
            else{
                //code for ie6,ie5
                xmlhttp=new AciveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function(){
                if (this.readyState==4 && this.status==200){
                    document.getElementById("checkuser").innerHTML=this.responseText;
                }
            };
            
            xmlhttp.open("GET","checkmemberuser.php?request="+str,true);
            xmlhttp.send();
        }
        
    }
    function validateform(){
        var myform=document.forms.frmmember;
        var UName=myform.elements.UName;
        var UPass = myform.elements.UPass;
        var FirstName = myform.elements.FName;
        var LastName = myform.elements.LName;
        var CellPhone = myform.elements.CPhone;
        var AddressLine1 = myform.elements.AL1;
        var Email = myform.elements.Email;
        var Email1 = myform.elements.Email.value;
        var City = myform.elements.City;
        var State = myform.elements.State;
        var ZipCode = myform.elements.ZCode;
        var SelMembership=myform.elements.SelMembership;
        canconfirm=confirm("Do you want to save?");
        if (canconfirm==true){
        }else{
            return false;
        }
        
        if (UName.value == ""){
            alert("Please enter User");
            UName.focus();
            return false;
        }
        if (!document.getElementById('available')){
            alert("Enter a User Name that is available");
            UName.focus();
            return false;
        }
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
        
        if (SelMembership.value==""){
            alert("Please Select membership");
            SelMembership.focus();
            return false;    
        }
        if (FirstName.value==""){
            alert("Please enter your name");
            FirstName.focus();
            return false;
        }
        if (LastName.value==""){
            alert("Please enter your Last Name");
            LastName.focus();
            return false;
        }
        if (CellPhone.value==""){
            alert("Please enter your Cell Phone");
            CellPhone.focus();
            return false;
        }
        if (CellPhone.length<10){
            alert("Please enter a valid phone number");
            CellPhone.focus();
            return false;
        }
        if (AddressLine1.value==""){
            alert("Please enter your AddressLine1");
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
            State.focus();
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

    return true;
    }

</script>
</head>
<body>
<?php
include ("menu.php");
include ("bodyheader.php");
?>
<br/><br/>
<div class="container">
    <form action="processmember.php" method="post" name="frmmember" onsubmit="return validateform();">
        <div class="form-row mb-4">
            <div class="col-2"></div>
            <div class="col-8">
                <legend>Add Member Form</legend>
                <hr>
            </div>
        </div>
        <div class="form-row">
            <div class="col-2"></div>
            <div class="col-8"><h5>Log In Information</h5></div>
        </div>
        <div class="form-row">
            <div class="col-2"></div>
            <div class="col-4">
                <label>User</label>
                <input type="text" placeholder="User Name" class="form-control" name="UName" onkeyup="checkuser(this.value);" required>
            </div>
            <div class="col-4">
                <label>Password</label>
                <input type="text" placeholder="Password" class="form-control" name="UPass" required>
            </div>
        </div>
        <div class="form-row">
            <div class="col-2"></div>
            <div class="col-8"><h5>Membership</h5></div>
        </div>
        <div class="form-row">
            <div class="col-2"></div>
            <div class="col-4">
                <select class="form-control" name="SelMembership" required>
                    <option value='' >Select Membership</option>
                        <?php
                        //Gets memberships names and prices
                        $sqlquery2="SELECT * FROM tblmemberships";
                        $resultmem=mysqli_query($connection,$sqlquery2);
                        while ($row2=mysqli_fetch_array($resultmem)){
                            $idm=$row2['Id'];$namem=$row2['Name'];$pricem=$row2['Price'];
                         echo "<option class='text-capitalize' value=$idm>$namem, $$pricem  </option>";
                        }
                        ?>           
                </select>
            </div>

        </div>

        <div class="form-row">
            <div class="col-2"></div>
            <div class="col-6" id="checkuser">
                
            </div>
        </div>
        <div class="form-row mb-2">
            <div class="col-2"></div>
            <div class="col-8"><hr></div>
        </div>
        <div class="form-row">
            <div class="col-2"></div>
            <div class="col-8"><h5>Contact Information</h5></div>
        </div>
        <div class="form-row mb-4">
            <div class="col-2"></div>
            <div class="col-4">
                <input type="text" class="form-control text-capitalize" placeholder="First Name" name="FName" required>
            </div>
            <div class="col-4">
                <input type="text" class="form-control text-capitalize" placeholder="Last Name" name="LName" required>
            </div>
        </div>
        <div class="form-row mb-4">
             <div class="col-2"></div>
            <div class="col-4">
                <input type="text" id='phone' class="form-control" placeholder="Cell Phone" name="CPhone" required>
            </div>
            <div class="col-4">
                <input type="text" class="form-control" placeholder="Email" name="Email" required>
            </div>
        </div>
        <div class="form-row mb-4">
            <div class="col-2"></div>
            <div class="col-8">
                <textarea type="text" class="form-control text-capitalize" placeholder="Address" name="AL1" row="3" required></textarea>
            </div>
        </div>
        <div class="form-row mb-4">
            <div class="col-2"></div>
            <div class="col-3">
                <input type="text" class="form-control text-capitalize" placeholder="City" name="City" required>
            </div>
            <div class="col-2">
                <select class="form-control" placeholder="State" name="State" required>
                    <option value=''>Select State</option>
                    <?php
                    $require="";
                    foreach ($a as $k=>$v){
                        if ($k=="NY"){
                           $require="selected"; 
                        }
                        echo "<option $require value=$k>$a[$k]</option>";
                        $require="";
                    }
                    ?>
                </select>
            </div>
            <div class="col-3">
                <input type="text" class="form-control" id='Zcode' placeholder="Zip Code" name="ZCode" required>
            </div>
        </div>
        <div class="form-row mb-4">
            <div class="col-2"></div>
            <div class="col-4">
                <input type="submit" class="btn btn-primary col mr-2" name="btnmembersubmit"></input>
            </div>
            <div class="col-4">
                <input type="reset" class="btn btn-primary col mr-2" name="btnmembersreset"></input>
            </div>

        </div>
         
        

                
    </form>

  <br><br>  
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