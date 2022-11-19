<!--session-->
<?php include'connect.php';?>
<!DOCTYPE html>
<html lang="en">
    <?php
$id=$_GET['value'];
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title> Identification System | Edit Profile</title><link rel="icon" href="assets/img/logo.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/alert.css">
    <link rel="stylesheet" href="assets/css/Contact-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Customizable-Background--Overlay.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="assets/css/Google-Style-Login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="assets/css/Multi-step-form.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body class="font-monospace" style="background: #ffffff;">

 
    <div class="container" style="padding-top: 61px;padding-right: 40px;padding-left: 40px;"><div >
    <div class="card-header shadow-lg py-3" style="background: rgb(255,255,255);">
        <p class="text-primary m-0 fw-bold" style="text-align: right;"><a href="../people.php" style="color: rgb(107,140,235);"><i class="fa fa-window-close" style="font-size: 28px;"></i></a></p>
    </div>
</div>
<br><br>
    <script>

    
function validateForm() 
{
var nerror=document.getElementById("nerror");
var serror=document.getElementById("serror");
var gerror=document.getElementById("gerror");
var cerror=document.getElementById("cerror");
var error=document.getElementById("error");
var iderror=document.getElementById("iderror");
var ierror=document.getElementById("ierror");

if(document.forms["form"]["name"].value==""&&
 document.forms["form"]["surname"].value==""&&
 document.forms["form"]["gender"].value==""&&
 document.forms["form"]["idno"].value==""&&
 document.forms["form"]["cellno"].value==""

 )
{

nerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should not be empty *</span>"
serror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should not be empty *</span>"


return false;


}else
{
//name 
var name=document.forms["form"]["name"].value;


if(name=="")
{

   nerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should not be empty *</span>";
  return false;

}else if(!name.match(/[a-zA-Z][a-zA-Z ]+[a-zA-Z ]$/))
{
nerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should contain alphabetical characters.*</span>";
return false;

}else
{

nerror.innerHTML=""; 
}
//surname

var surname=document.forms["form"]["surname"].value;


if(surname=="")
{

   serror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should not be empty *</span>";
  return false;

}
else if(!surname.match(/[a-zA-Z][a-zA-Z ]+[a-zA-Z]$/))
{
serror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should contain alphabetical characters.*</span>";
return false;

}else
{

serror.innerHTML="";  
}
//

//
//cellno
var cellno=document.forms["form"]["cellno"].value;

if(cellno=="")
{

   cerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should not be empty *</span>";
  return false;

}
if(cellno.substring(0,3)!='071'&& cellno.substring(0,3)!='072'&&
   cellno.substring(0,3)!='073'&& cellno.substring(0,3)!='074'&&
   cellno.substring(0,3)!='076'&& cellno.substring(0,3)!='060'&&
   cellno.substring(0,3)!='078'&& cellno.substring(0,3)!='079'&&
   cellno.substring(0,3)!='061'&& cellno.substring(0,3)!='062'&&
   cellno.substring(0,3)!='063'&& cellno.substring(0,3)!='064'&&
   cellno.substring(0,3)!='065'&& cellno.substring(0,3)!='066'&&
   cellno.substring(0,3)!='067'&& cellno.substring(0,3)!='068'&&
   cellno.substring(0,3)!='010'&& cellno.substring(0,3)!='011'&&
   cellno.substring(0,3)!='012'&& cellno.substring(0,3)!='013'&&
   cellno.substring(0,3)!='014'&& cellno.substring(0,3)!='015'&&
   cellno.substring(0,3)!='016'&& cellno.substring(0,3)!='017'&&
   cellno.substring(0,3)!='018'&& cellno.substring(0,3)!='021'&&
   cellno.substring(0,3)!='022'&& cellno.substring(0,3)!='023'&&
   cellno.substring(0,3)!='027'&& cellno.substring(0,3)!='028'&&
   cellno.substring(0,3)!='031'&& cellno.substring(0,3)!='032'&&
   cellno.substring(0,3)!='033'&& cellno.substring(0,3)!='034'&&
   cellno.substring(0,3)!='035'&& cellno.substring(0,3)!='036'&&
   cellno.substring(0,3)!='039'&& cellno.substring(0,3)!='040'&&
   cellno.substring(0,3)!='041'&& cellno.substring(0,3)!='042'&&
   cellno.substring(0,3)!='043'&& cellno.substring(0,3)!='044'&&
   cellno.substring(0,3)!='045'&& cellno.substring(0,3)!='046'&&
   cellno.substring(0,3)!='047'&& cellno.substring(0,3)!='048'&&
   cellno.substring(0,3)!='049'&& cellno.substring(0,3)!='051'&&
   cellno.substring(0,3)!='053'&& cellno.substring(0,3)!='054'&&
   cellno.substring(0,3)!='056'&& cellno.substring(0,3)!='057'&&
   cellno.substring(0,3)!='058'&& 
   cellno.substring(0,3)!='083'&& cellno.substring(0,3)!='084')
   {

 cerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" Surfix of phone number invalid. *</span>"
    return false;
   
}
else if(cellno.substring(0,1)!="0")
{


cerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" cellno number must start with 0.*</span>";
return false;
}
else
if(!cellno.match(/^[0-9]+$/))
{

cerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+"field should be filled with number only.*</span>";
return false;   
}
else
if(cellno.toString().length!=10)
{
cerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+"field should be 10 characters.*</span>";    

return false;   
}
else
{
cerror.innerHTML="";

}



}
}
</script>
<?php


$qry=mysqli_query($conn,"select * from person WHERE person_id='$id'");
$data=mysqli_fetch_array($qry);

?>

        <form class="shadow" style="background: #ffffff;margin-top: 0px;border-radius: 10px;" action="upperson.php?value=<?php echo $id; ?>" name="form" onsubmit="return validateForm();" method="post">
            <h1 style="font-size: 20px;padding-top: 20px;color: rgb(44,32,252);">&nbsp; &nbsp;<i class="fa fa-user"></i>&nbsp; Personal information</h1>
            <div class="row">
                <div class="col-lg-4 offset-lg-2" style="font-weight: bold;"><label class="form-label" style="color: rgb(44,32,252);">Firstname</label>
                <input class="form-control" type="text" id="name" value="<?php echo $data['firstname']?>" name="name"><span id="nerror"></span></div>
                <div class="col-lg-4"><label class="form-label" style="font-weight: bold;color: rgb(44,32,252);">Lastname</label>
                <input class="form-control" type="text" value="<?php echo $data['lastname']?>" name="surname" id="surname"><span id="serror"></span></div>
            </div>
            <div class="row">
                <div class="col-lg-4 offset-lg-2" style="font-weight: bold;"><label class="form-label" style="color: rgb(44,32,252);">Id number</label>
                <input class="form-control" type="text" value="<?php echo $data['id_number']?>" readonly="" name="idno" id="idno"><span id="iderror"></span></div>
                <div class="col-lg-4"><label class="form-label" style="font-weight: bold;color: rgb(44,32,252);">Phone number</label>
                <input class="form-control"  type="text" name="cellno" id="cellno"  value="<?php echo $data['phone']?>"><span id="cerror"></span></div>
            </div>
            <div class="row">
                <div class="col-lg-4 offset-lg-2" style="font-weight: bold;"><label class="form-label" style="color: rgb(44,32,252);">Email Address</label>
                <input class="form-control" type="text" id="email"  value="<?php echo $data['email']?>" name="email" readonly=""><span id="error"></span></div>
                <div class="col-lg-4"><label class="form-label" style="font-weight: bold;color: rgb(44,32,252);">Gender</label>
                <input class="form-control" type="text" value="<?php echo $data['gender']?>" id="gender" name="gender" readonly=""><span id="gerror"></span></div>
            </div>
            <div class="row">
                <div class="col-lg-4 offset-lg-2" style="font-weight: bold;"><button class="btn" type="submit" style="margin-top: 15px;margin-bottom: 23px;color: rgb(255,255,255);background: rgb(44,32,252);">Save</button></div>
            </div>
        </form>

<!--address-->

<?php


$qry=mysqli_query($conn,"select * from address WHERE person_id='$id'");
$data=mysqli_fetch_array($qry);

?>
<!--validate-->

<script>

    
function validateaddressForm() 
{

var keenhouse=document.getElementById("keenhouse");
var keenstreet=document.getElementById("keenstreet");
var keensuburb=document.getElementById("keensuburb");
var keencity=document.getElementById("keencity");
var keenprovince=document.getElementById("keenprovince");
var keenzipcode=document.getElementById("keenzipcode");

if(document.forms["formaddress"]["houseno"].value==""&&
 document.forms["formaddress"]["streetname"].value==""&&
 document.forms["formaddress"]["suburb"].value==""&&
 document.forms["formaddress"]["city"].value==""&&
 document.forms["formaddress"]["province"].value==""&&
 document.forms["formaddress"]["zipcode"].value==""

 )
{

    keenhouse.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>"
    keenstreet.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>"
    keensuburb.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>"
    keencity.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty</span>"
    keenprovince.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>"
    keenzipcode.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty</span>"

return false;


}else
{
    //house no
var houseno=document.forms["formaddress"]["houseno"].value;
if(houseno=="")
{

   keenhouse.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should not be empty *</span>";
  return false;

}
else if(!houseno.match(/^[0-9]+$/))
{
    keenhouse.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should contain numeric characters only.*</span>";
return false;

}else
{

    keenhouse.innerHTML="";  
}
//streetname
var streetname=document.forms["formaddress"]["streetname"].value;
if(streetname=="")
{

    keenstreet.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should not be empty *</span>";
  return false;

}
else if(!streetname.match(/[a-zA-Z][a-zA-Z ]+[a-zA-Z ]$/))
{
    keenstreet.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should contain alphabetical characters only.*</span>";
return false;

}else
{

    keenstreet.innerHTML="";  
}
//suburb
var suburb=document.forms["formaddress"]["suburb"].value;
if(suburb=="")
{

    keensuburb.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should not be empty *</span>";
  return false;

}
else if(!suburb.match(/[a-zA-Z][a-zA-Z ]+[a-zA-Z ]$/))
{
    keensuburb.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should contain alphabetical characters only.*</span>";
return false;

}else
{

    keensuburb.innerHTML="";  
}
//city

var city=document.forms["formaddress"]["city"].value;
if(city=="")
{

    keencity.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should not be empty *</span>";
  return false;

}
else if(!city.match(/[a-zA-Z][a-zA-Z ]+[a-zA-Z ]$/))
{
    keencity.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should contain alphabetical characters only.*</span>";
return false;

}else
{

    keencity.innerHTML="";  
}
//province
var province=document.forms["formaddress"]["province"].value;
if(province=="")
{

    keenprovince.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should not be empty *</span>";
  return false;

}
else if(!province.match(/[a-zA-Z][a-zA-Z ]+[a-zA-Z ]$/))
{
    keenprovince.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should contain alphabetical characters only.*</span>";
return false;

}else
{

    keenprovince.innerHTML="";  
}

//zipcode

 var zipcode=document.forms["formaddress"]["zipcode"].value;
if(zipcode=="")
{

    keenzipcode.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should not be empty *</span>";
  return false;

}
else if(!zipcode.match(/^[0-9]+$/))
{
    keenzipcode.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should contain numeric characters only.*</span>";
return false;

}else
{

    keenzipcode.innerHTML="";  
}

}

}
</script>

        <form class="shadow-lg" style="background: #ffffff;margin-top: 49px;border-radius: 10px;" action="addu.php?value=<?php echo $id; ?>" name="formaddress" onsubmit="return validateaddressForm();" method="post">
            <h1 style="font-size: 20px;padding-top: 20px;color: rgb(44,32,252);">&nbsp; &nbsp;<i class="fa fa-address-book"></i>&nbsp; Address information</h1>
            <div class="row">
                <div class="col-lg-4 offset-lg-2" style="font-weight: bold;"><label class="form-label" style="color: rgb(44,32,252);">House no</label>
                <input class="form-control" value="<?php echo $data['house_no'] ?>" type="text" name="houseno" id="houseno"><span id="keenhouse"></span></div>
                <div class="col-lg-4"><label class="form-label" style="font-weight: bold;color: rgb(44,32,252);">Street name</label>
                <input class="form-control" value="<?php echo $data['street_name'] ?>" type="text" name="streetname" id="streetname"><span id="keenstreet"></span></div>
            </div>
            <div class="row">
                <div class="col-lg-4 offset-lg-2" style="font-weight: bold;"><label class="form-label" style="color: rgb(44,32,252);">Suburb</label>
                <input class="form-control" value="<?php echo $data['suburb'] ?>" type="text" name="suburb" id="suburb"><span id="keensuburb"></span></div>
                <div class="col-lg-4"><label class="form-label" style="font-weight: bold;color: rgb(44,32,252);">City</label>
                <input class="form-control" value="<?php echo $data['city'] ?>" type="text" name="city" id="city"><span id="keencity"></span></div>
            </div>
            <div class="row">
                <div class="col-lg-4 offset-lg-2" style="font-weight: bold;"><label class="form-label" style="color: rgb(44,32,252);">Province</label>
                <input class="form-control" value="<?php echo $data['province'] ?>" type="text" name="province" id="province"><span id="keenprovince"></span></div>
                <div class="col-lg-4"><label class="form-label" style="font-weight: bold;color: rgb(44,32,252);">Zip Code</label>
                <input class="form-control" value="<?php echo $data['zip_code'] ?>" type="text" name="zipcode" id="zipcode"><span id="keenzipcode"></span></div>
            </div>
            <div class="row">
                <div class="col-lg-4 offset-lg-2" style="font-weight: bold;"><button class="btn" type="submit" style="margin-top: 15px;margin-bottom: 23px;color: rgb(255,255,255);background: rgb(44,32,252);">Save</button></div>
            </div>
        </form>
        

<!--next of keen-->
<?php


$qry=mysqli_query($conn,"select * from next_keen WHERE person_id='$id'");
$data=mysqli_fetch_array($qry);

?>
<!--validation-->
<script>

    
function validatekeenForm() 
{

var keenfname=document.getElementById("keenfname");
var keenlname=document.getElementById("keenlname");
var keenphone=document.getElementById("keenphone");
var keenemail=document.getElementById("keenemail");


if(document.forms["formkeen"]["firstname"].value==""&&
 document.forms["formkeen"]["lastname"].value==""&&
 document.forms["formkeen"]["phone"].value==""&&
 document.forms["formkeen"]["email"].value==""

 )
{

    keenfname.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>"
    keenlname.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>"
    keenphone.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>"
    keenemail.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty</span>"


return false;


}else
{
//fname 
var name=document.forms["formkeen"]["firstname"].value;


if(name=="")
{

    keenfname.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>";
  return false;

}else if(!name.match(/[a-zA-Z][a-zA-Z ]+[a-zA-Z ]$/))
{
    keenfname.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should contain alphabetical characters.*</span>";
return false;

}else
{

    keenfname.innerHTML=""; 
}
//lname

var surname=document.forms["formkeen"]["lastname"].value;


if(surname=="")
{

    keenlname.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>";
  return false;

}
else if(!surname.match(/[a-zA-Z][a-zA-Z ]+[a-zA-Z]$/))
{
    keenlname.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should contain alphabetical characters.*</span>";
return false;

}else
{

    keenlname.innerHTML="";  
}
//phone
var cellno=document.forms["formkeen"]["phone"].value;

if(cellno=="")
{

    keenphone.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>";
  return false;

}
if(cellno.substring(0,3)!='071'&& cellno.substring(0,3)!='072'&&
   cellno.substring(0,3)!='073'&& cellno.substring(0,3)!='074'&&
   cellno.substring(0,3)!='076'&& cellno.substring(0,3)!='060'&&
   cellno.substring(0,3)!='078'&& cellno.substring(0,3)!='079'&&
   cellno.substring(0,3)!='061'&& cellno.substring(0,3)!='062'&&
   cellno.substring(0,3)!='063'&& cellno.substring(0,3)!='064'&&
   cellno.substring(0,3)!='065'&& cellno.substring(0,3)!='066'&&
   cellno.substring(0,3)!='067'&& cellno.substring(0,3)!='068'&& 
   cellno.substring(0,3)!='083'&& cellno.substring(0,3)!='084')
   {

    keenphone.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" Surfix of phone number invalid. *</span>"
    return false;
   
}
else if(cellno.substring(0,1)!="0")
{


    keenphone.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" cellno number must start with 0.*</span>";
return false;
}
else
if(!cellno.match(/^[0-9]+$/))
{

    keenphone.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+"field should be filled with number only.*</span>";
return false;   
}
else
if(cellno.toString().length!=10)
{
    keenphone.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+"field should be 10 characters.*</span>";    

return false;   
}
else
{
    keenphone.innerHTML="";

}



//email
var email=document.forms["formkeen"]["email"].value;

if(email=="")
{

    keenemail.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>";
  return false;

}
else
if(!((email.indexOf(".") > 0) && (email.indexOf("@") > 0)) ||/[^a-zA-Z0-9.@_-]/.test(email))
{
    keenemail.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" Invalid email.*</span>";

return false;
}else if(email.slice(-3)!="com" && email.slice(-5)!="ac.za" && email.slice(-6)!="gov.za" && email.slice(-3)!="org" && email.slice(-5)!="co.za")
{
    keenemail.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" Invalid email.*</span>";

return false;
}
else
{
    keenemail.innerHTML="";
}




}
}
</script>
<!--end-->


<form class="shadow-lg" style="background: #ffffff;margin-top: 49px;border-radius: 10px;" action="upkn.php?value=<?php echo $id; ?>" name="formkeen" onsubmit="return validatekeenForm();" method="post">
        <h1 style="font-size: 20px;padding-top: 20px;color: rgb(44,32,252);">&nbsp; &nbsp;<i class="fa fa-address-book"></i>&nbsp; Next of keen information</h1>
        <div class="row">
            <div class="col-lg-4 offset-lg-2" style="font-weight: bold;"><label class="form-label" style="color: rgb(44,32,252);">Firstname</label>
            <input class="form-control" value="<?php echo $data['firstname'] ?>" type="text" name="firstname" id="firstname"><span id="keenfname"></span></div>
            <div class="col-lg-4"><label class="form-label" style="font-weight: bold;color: rgb(44,32,252);">Lastname</label>
            <input class="form-control" value="<?php echo $data['lastname'] ?>" type="text" name="lastname" id="lastname"><span id="keenlname"></span></div>
        </div>
        <div class="row">
            <div class="col-lg-4 offset-lg-2" style="font-weight: bold;"><label class="form-label" style="color: rgb(44,32,252);">Phone number</label>
            <input class="form-control" value="<?php echo $data['phone'] ?>" type="text" name="phone" id="phone"><span id="keenphone"></span></div>
            <div class="col-lg-4"><label class="form-label" style="font-weight: bold;color: rgb(44,32,252);">Email</label>
            <input class="form-control" value="<?php echo $data['email'] ?>" type="text" name="email" id="email"><span id="keenemail"></span></div>
        </div>
       
        <div class="row">
            <div class="col-lg-4 offset-lg-2" style="font-weight: bold;"><button class="btn" type="submit" style="margin-top: 15px;margin-bottom: 23px;color: rgb(255,255,255);background: rgb(44,32,252);">Save</button></div>
        </div>
    </form>




        <script>

    
function validate() 
{





var errormessage=document.getElementById("errorpass");
var ierror=document.getElementById("ierror");

if(document.forms["form1"]["pwd"].value=="")
{

errormessage.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should not be empty *</span>"
cerrorpass.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should not be empty *</span>"

return false;


}else
{


//
var passd=document.forms["form1"]["pwd"].value;
var cpassd=document.forms["form1"]["cpwd"].value;




var cerrormessage=document.getElementById("cerrorpass");
var pass=document.getElementById("pwd").value;

if(pass=="")
{

   errormessage.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should not be empty *</span>";
  return false;

}else
{
errormessage.innerHTML="";
}
//contain atleast 1 lowercase

if(!pass.match(/^(?=.*[a-z])/))
{
  errormessage.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" Password should contain atleast 1 lowercase alphabetical character.*</span>";
return false;
}
else
{
errormessage.innerHTML="";
}
//contain atleast 1 uppercase
if(!pass.match(/^(?=.*[A-Z])/))
{
  errormessage.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" Password should contain atleast 1 uppercase alphabetical character.*</span>";
return false;
}
else
{
errormessage.innerHTML="";
}
//contain atleast 1 numeric
if(!pass.match(/^(?=.*[0-9])/))
{
  errormessage.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" Password should contain atleast 1 numeric character.*</span>"
return false;
}
else
{
errormessage.innerHTML="";
}
//contain special character
if(!pass.match(/^(?=.*[!@#\$%\^&\*])/))
{
  errormessage.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" Password should contain special character.*</span>";
return false;
}
else
{
errormessage.innerHTML="";
}
//contain 8 or more characters
if(!pass.match(/^(?=.{8,})/))
{
  errormessage.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" Password shouldcontain 8 or more characters.*</span>";
return false;
}
else
{
errormessage.innerHTML="";
}
//confirm password
//step 1
if(cpassd==""){

cerrormessage.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" confirm Password.*</span>";
return false;   
}else
{

cerrormessage.innerHTML="";
}




if(cpassd!=passd){

errormessage.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" Password doesnt match.*</span>"
cerrormessage.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" Password doesnt match.*</span>"
return false;   
}else
{
errormessage.innerHTML=""
cerrormessage.innerHTML=""
}
}
}
</script>




       
    </div>
    <footer class="footer-basic" style="margin-top: 30px;">
        <p class="copyright" style="font-size: 14px;">Identificationsystem © 2022</p>
    </footer>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="assets/js/Multi-step-form.js"></script>
</body>

</html>