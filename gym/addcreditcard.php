<!DOCTYPE html>
<html>
<?php
include("header.php");
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
        if (window.XMLHttpRequest){
        //code for ie7, firefox,chrome,opera,safari
        xmlhttp= new XMLHttpRequest();
        }
        else{
        //code for ie6,ie5
         xmlhttp=new AciveXObject("Microsoft.XMLHTTP");
        }
function validateform(){
        var myform=document.forms.frmCreditCard;
        var CCNumber = myform.elements.CCNumber;
        var CVV = myform.CVV;
        var EDate = myform.EDate;
        var NameCC= myform.NameCC;
        var BAddress = myform.BAddress;
        var State = myform.State;
        var City = myform.City;
        var ZCode = myform.ZCode;
        if (CCNumber.value==""){
            alert("Please enter Credit Card Number");
            CCNumber.focus();
            return false;
        }
        if (CCNumber.value.length<19){
        alert("Credit Card Number must be 16 numbers");
        CCNumber.focus();
            return false;
    }
            if (NameCC.value==""){
            alert("Please enter Name on Credit Card");
            NameCC.focus();
            return false;
        }
            if (EDate.value==""){
            alert("Please enter Expiration Date");
            EDate.focus();
            return false;
        }
        if (CVV.value==""){
            alert("Please enter CVV");
            CVV.focus();
            return false;
        }
                if (CVV.value.length>3 || CVV.value.length<3){
            alert("Please enter a valid CVV Number");
            CVV.focus();
            return false;
        }


        if (BAddress.value==""){
            alert("Please enter Billing Address");
            BAddress.focus();
            return false;
        }
        if (State.value==""){
            alert("Please enter State");
            State.focus();
            return false;
        }
        if (City.value==""){
            alert("Please enter City");
            City.focus();
            return false;
        }
        if (ZCode.value==""){
            alert("Please enter Zip Code");
            ZCode.focus();
            return false;
        }
    return true;
    }
    
    function showInfo(str){
        if (str==""){
            document.getElementById("fullName").innerHTML = "Enter Last Name";
            return;
        } else {

            xmlhttp.onreadystatechange = function(){
                if (this.readyState==4 && this.status==200){
                    document.getElementById("fullName").innerHTML=this.responseText;
                }
            };
            
            xmlhttp.open("GET","tblmembershowinfodropdown.php?rquest="+str,true);
            xmlhttp.send();
        }
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
    <form action="processcreditcard.php" method="post" name="frmCreditCard" onsubmit="return validateform();">
        <div class="form-row mb-4">
            <div class="col-2"></div>
            <div class="col-8">
                <legend>Add a Credit Card</legend>
                <hr/>
            </div>
        </div>
        <div class="form-row mb-4">
            <div class="col-2"></div>
            <div class="col-1">
                <input type="text" class="form-control" id="LastName"  value="<?php
                if (isset($_GET['id'])){echo $_GET['id'];}?>" oninput="return showInfo(this.value);" onfocus="return showInfo(this.value);" autofocus readonly >
            </div>
            <div class="col-5" id="fullName">

            </div>
        </div>
        <div class="form-row mb-4">
            <div class="col-2"></div>
            <div class="col-4">
                <label>Card Number</label>
                <input type="text" class="form-control" placeholder="Credit Card Number" id="cc" name="CCNumber" >
            </div>
            <div class="col-4">
                <label>Name on Credit Card</label>
                <input type="text" class="form-control text-capitalize" placeholder="Name on Credit Card" name="NameCC" >
            </div>

        </div>
                            <div class="form-row mb-4">
                        <div class="col-2"></div>
                        <div class="col-4">
                            <label>Expiration Date</label>
                            <input type="month" class="form-control" placeholder="Expiration Date" name="EDate">
                        </div>
                        <div class="col-2">
                            <label>CVV</label>
                            <input type="text" class="form-control" placeholder="CVV" id="cvv" name="CVV"  title="Must Enter 3 Numbers">
                        </div>
                    </div>
        <div class="form-row mb-4">
            <div class="col-2"></div>

            <div class="col-8">
                <label>Billing Address</label>
                <input type="text" rows="3" class="form-control text-capitalize" placeholder="Billing Address" name="BAddress" >
            </div>
        </div>
        <div class="form-row mb-4">
            <div class="col-2"></div>
            <div class="col-2">
                <label>State</label>
                                <select class="form-control" placeholder="State" name="State">
        <option value=''>Select State</option>
        <?php
        $require="";
        if ($BillingState==""){
            $BillingState="NY";
        }
        foreach ($a as $k=>$v){
            if ($k==$BillingState){
               $require="selected"; 
            }
            echo "<option $require value=$k>$a[$k]</option>";
            $require="";
        }
        ?>
    </select>
                
            </div>
            <div class="col-2">
                <label>City</label>
                <input type="text" class="form-control text-capitalize" placeholder= "City" name="City" >
            </div>
            <div class="col-2">
                <label>Zip Code</label>
                <input type="text" class="form-control" id="Zcode" maxlength=5 placeholder="Zip Code" name="ZCode" >
            </div>
        </div>
        <div class="form-row mb-4">
            <div class="col-3"></div>
            <div class="col-3">
                <button type="submit" class="btn btn-primary form-control" name="btnCCSubmit">Add</button>
            </div>
            <div class="col-3">
                <button type="reset" class="btn btn-primary form-control" name="btnCCReset">Reset</button>
            </div>

        </div>
    </form>
    <div class="">
        <a href=""
        
    </div>
            <script>        document.getElementById('Zcode').addEventListener('input', function (e) {
  var x = e.target.value.replace(/\D/g, '').match(/(\d{0,5})/);
  e.target.value = x[1];
});
        document.getElementById('cvv').addEventListener('input', function (e) {
  var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})/);
  e.target.value = x[1];
  });
                document.getElementById('cc').addEventListener('input', function (e) {
  var x = e.target.value.replace(/\D/g, '').match(/(\d{0,4})(\d{0,4})(\d{0,4})(\d{0,4})/);
  console.log(x);
  e.target.value = !x[2] ? x[1] : x[1] + '-' + x[2] + (x[3] ? '-' + x[3] : '')+(x[4] ? '-' + x[4] : '');
  });
</script>
</div>

<?php
include ("footer.php");
?>