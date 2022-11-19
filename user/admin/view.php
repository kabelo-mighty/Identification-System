<!--session-->
<?php include'inc/connect.php';?>
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/material-icons.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
   
</head>

<style>

.register-photo {
  background: #f1f7fc;
  padding: 80px 0;
}

.register-photo .image-holder {
  display: table-cell;
  width: auto;
  background: url(../../assets/img/meeting.jpg);
  background-size: cover;
}

.register-photo .form-container {
  display: table;
  max-width: 900px;
  width: 90%;
  margin: 0 auto;
  box-shadow: 1px 1px 5px rgba(0,0,0,0.1);
}

.register-photo form {
  display: table-cell;
  width: 400px;
  background-color: #ffffff;
  padding: 40px 60px;
  color: #505e6c;
}

@media (max-width:991px) {
  .register-photo form {
    padding: 40px;
  }
}

.register-photo form h2 {
  font-size: 24px;
  line-height: 1.5;
  margin-bottom: 30px;
}

.register-photo form .form-control {
  background: #f7f9fc;
  border: none;
  border-bottom: 1px solid #dfe7f1;
  border-radius: 0;
  box-shadow: none;
  outline: none;
  color: inherit;
  text-indent: 6px;
  height: 40px;
}

.register-photo form .form-check {
  font-size: 13px;
  line-height: 20px;
}

.register-photo form .btn-primary {
  background: #f4476b;
  border: none;
  border-radius: 4px;
  padding: 11px;
  box-shadow: none;
  margin-top: 35px;
  text-shadow: none;
  outline: none !important;
}

.register-photo form .btn-primary:hover, .register-photo form .btn-primary:active {
  background: #eb3b60;
}

.register-photo form .btn-primary:active {
  transform: translateY(1px);
}

.register-photo form .already {
  display: block;
  text-align: center;
  font-size: 12px;
  color: #6f7a85;
  opacity: 0.9;
  text-decoration: none;
}.register-photo {
  background: #f1f7fc;
  padding: 80px 0;
}

.register-photo .image-holder {
  display: table-cell;
  width: auto;
  background: url(../../assets/img/meeting.jpg);
  background-size: cover;
}

.register-photo .form-container {
  display: table;
  max-width: 900px;
  width: 90%;
  margin: 0 auto;
  box-shadow: 1px 1px 5px rgba(0,0,0,0.1);
}

.register-photo form {
  display: table-cell;
  width: 400px;
  background-color: #ffffff;
  padding: 40px 60px;
  color: #505e6c;
}

@media (max-width:991px) {
  .register-photo form {
    padding: 40px;
  }
}

.register-photo form h2 {
  font-size: 24px;
  line-height: 1.5;
  margin-bottom: 30px;
}

.register-photo form .form-control {
  background: #f7f9fc;
  border: none;
  border-bottom: 1px solid #dfe7f1;
  border-radius: 0;
  box-shadow: none;
  outline: none;
  color: inherit;
  text-indent: 6px;
  height: 40px;
}

.register-photo form .form-check {
  font-size: 13px;
  line-height: 20px;
}

.register-photo form .btn-primary {
  background: #f4476b;
  border: none;
  border-radius: 4px;
  padding: 11px;
  box-shadow: none;
  margin-top: 35px;
  text-shadow: none;
  outline: none !important;
}

.register-photo form .btn-primary:hover, .register-photo form .btn-primary:active {
  background: #eb3b60;
}

.register-photo form .btn-primary:active {
  transform: translateY(1px);
}

.register-photo form .already {
  display: block;
  text-align: center;
  font-size: 12px;
  color: #6f7a85;
  opacity: 0.9;
  text-decoration: none;
}
</style>
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
var keenfname=document.getElementById("keenfname");
    var keenlname=document.getElementById("keenlname");
    var keenphone=document.getElementById("keenphone");
    var keenemail=document.getElementById("keenemail");
    var keenhouse=document.getElementById("keenhouse");
        var keenstreet=document.getElementById("keenstreet");
        var keensuburb=document.getElementById("keensuburb");
        var keencity=document.getElementById("keencity");
        var keenprovince=document.getElementById("keenprovince");
        var keenzipcode=document.getElementById("keenzipcode");
        var keencountry=document.getElementById("keencountry");
if(document.forms["form"]["name"].value==""&&
 document.forms["form"]["surname"].value==""&&
 document.forms["form"]["gender"].value==""&&
 document.forms["form"]["idno"].value==""&&
 document.forms["form"]["cellno"].value==""&&
 document.forms["form"]["keenfirstname"].value==""&&
     document.forms["form"]["keenlastname"].value==""&&
     document.forms["form"]["keenphone"].value==""&&
     document.forms["form"]["keenemail"].value==""&&
     document.forms["form"]["houseno"].value==""&&
         document.forms["form"]["streetname"].value==""&&
         document.forms["form"]["suburb"].value==""&&
         document.forms["form"]["city"].value==""&&
         document.forms["form"]["province"].value==""&&
         document.forms["form"]["zipcode"].value==""&& document.forms["form"]["country"].value==""

 )
{

nerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should not be empty *</span>"
serror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should not be empty *</span>"
keenhouse.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>"
keenstreet.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>"
keensuburb.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>"
keencity.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty</span>"
keenprovince.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>"
keenzipcode.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty</span>"
keencountry.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty</span>"
keenfname.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>"
keenlname.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>"
keenphone.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>"
keenemail.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty</span>"
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

 //house no
        var houseno=document.forms["form"]["houseno"].value;
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
        var streetname=document.forms["form"]["streetname"].value;
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
        var suburb=document.forms["form"]["suburb"].value;
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
        
        var city=document.forms["form"]["city"].value;
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
        var province=document.forms["form"]["province"].value;
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
        
         var zipcode=document.forms["form"]["zipcode"].value;
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

        var country=document.forms["form"]["country"].value;
        if(country=="")
        {
        
            keencountry.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should not be empty *</span>";
          return false;
        
        }
        else if(!country.match(/[a-zA-Z][a-zA-Z ]+[a-zA-Z ]$/))
        {
          keencountry.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should contain alphabetical characters only.*</span>";
        return false;
        
        }else
        {
        
            keenzipcode.innerHTML="";  
        }
          //fname 
    var keenfirstname=document.forms["form"]["keenfirstname"].value;
    
    
    if(keenfirstname=="")
    {
    
        keenfname.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should not be empty *</span>";
      return false;
    
    }else if(!keenfirstname.match(/[a-zA-Z][a-zA-Z ]+[a-zA-Z ]$/))
    {
        keenfname.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should contain alphabetical characters.*</span>";
    return false;
    
    }else
    {
    
        keenfname.innerHTML=""; 
    }
    //lname
    
    var keenl=document.forms["form"]["keenlastname"].value;
    
    
    if(keenl=="")
    {
    
        keenlname.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should not be empty *</span>";
      return false;
    
    }
    else if(!keenl.match(/[a-zA-Z][a-zA-Z ]+[a-zA-Z]$/))
    {
        keenlname.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should contain alphabetical characters.*</span>";
    return false;
    
    }else
    {
    
        keenlname.innerHTML="";  
    }
    //phone
    var cell=document.forms["form"]["kphone"].value;
    
    if(cell=="")
    {
    
        keenphone.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should not be empty *</span>";
      return false;
    
    }
    if(cell.substring(0,3)!='071'&& cell.substring(0,3)!='072'&&
       cell.substring(0,3)!='073'&& cell.substring(0,3)!='074'&&
       cell.substring(0,3)!='076'&& cell.substring(0,3)!='060'&&
       cell.substring(0,3)!='078'&& cell.substring(0,3)!='079'&&
       cell.substring(0,3)!='061'&& cell.substring(0,3)!='062'&&
       cell.substring(0,3)!='063'&& cell.substring(0,3)!='064'&&
       cell.substring(0,3)!='065'&& cell.substring(0,3)!='066'&&
       cell.substring(0,3)!='067'&& cell.substring(0,3)!='068'&& 
       cell.substring(0,3)!='083'&& cell.substring(0,3)!='084')
       {
    
        keenphone.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" Surfix of phone number invalid. *</span>"
        return false;
       
    }
    else if(cell.substring(0,1)!="0")
    {
    
    
        keenphone.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" cellno number must start with 0.*</span>";
    return false;
    }
    else
    if(!cell.match(/^[0-9]+$/))
    {
    
        keenphone.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+"field should be filled with number only.*</span>";
    return false;   
    }
    else
    if(cell.toString().length!=10)
    {
        keenphone.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+"field should be 10 characters.*</span>";    
    
    return false;   
    }
    else
    {
        keenphone.innerHTML="";
    
    }
    
    
    
    //email
    var ke=document.forms["form"]["kemail"].value;
    
    if(ke=="")
    {
    
        keenemail.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should not be empty *</span>";
      return false;
    
    }
    else
    if(!((ke.indexOf(".") > 0) && (ke.indexOf("@") > 0)) ||/[^a-zA-Z0-9.@_-]/.test(ke))
    {
        ke.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" Invalid email.*</span>";
    
    return false;
    }else if(ke.slice(-3)!="com" && ke.slice(-5)!="ac.za" && ke.slice(-6)!="gov.za" && ke.slice(-3)!="org" && ke.slice(-5)!="co.za")
    {
        keenemail.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" Invalid email.*</span>";
    
    return false;
    }
    else
    {
        keenemail.innerHTML="";
    }
  
  }
}
</script>

   
    
<body style="background: #ffffff;">
    <section class="register-photo" style="background: rgb(255,255,255);">
        <div class="form-container">
        <?php


$qry=mysqli_query($conn,"select * from person WHERE person_id='$id'");
$data=mysqli_fetch_array($qry);



if(isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['gender'])&& isset($_POST['email']) &&isset($_POST['cellno']) && isset($_POST['idno']))
{

    
 //personal information   
$name=$_POST['name'];
$surname=$_POST['surname'];
$gender=$_POST['gender'];
$email=$_POST['email'];
$cellno=$_POST['cellno'];
$idno=$_POST['idno'];
//address information
$houseno=$_POST['houseno'];
$streetname=$_POST['streetname'];
$city=$_POST['city'];
$province=$_POST['province'];
$country=$_POST['country'];
$suburb=$_POST['suburb'];
$zipcode=$_POST['zipcode'];
//next keen
$keenfirstname=$_POST['keenfirstname'];
$keenlastname=$_POST['keenlastname'];
$kphone=$_POST['kphone'];
$kemail=$_POST['kemail'];

  

  
$command="UPDATE  person
 SET 
 firstname='$name', lastname='$surname', gender='$gender',id_number='$idno',phone='$cellno',email='$email',
 house_no='$houseno', street_name='$streetname', suburb='$suburb', city='$city',province='$province',zip_code='$zipcode',country='$country',
 keen_firstname='$keenfirstname', keen_lastname='$keenlastname', keen_phone='$kphone', keen_email='$kemail'
 WHERE person_id='$id'";



$edit=mysqli_query($conn,$command);
  

if($edit){
mysqli_close($conn);

     
echo '<script>alert(" Information Updated.");window.location = "people.php";</script>';

exit;

}
else
{
    echo mysqli_error();

}
}

?>
            <form action="" name="form" onsubmit="return validateForm();" method="post">
                <p class="d-lg-flex justify-content-lg-center" style="color: rgb(44,32,252);"><img class="d-lg-flex justify-content-lg-center" src="assets/img/logo.png" style="height: 150px;"></p>
                <h1 class="text-center" style="font-family: ABeeZee, sans-serif;font-size: 21px;">Update user information<a class="float-end" href="people.php"><i class="fas fa-window-close" style="color: rgb(44,32,252);"></i></a></h1>
                <hr>
                <p style="color: rgb(44,32,252);">Personal information</p>
                <div class="mb-3"><label class="form-label">Firs tname</label><input class="form-control" type="text" id="name" value="<?php echo $data['firstname']?>" name="name" placeholder="Firstname"><span id="nerror"></span></div>
                <div class="mb-3"><label class="form-label">Last name</label><input class="form-control" type="text" value="<?php echo $data['lastname']?>" name="surname" id="surname" placeholder="Lastname"><span id="serror"></span></div>
                <div class="mb-3"><label class="form-label">Id number</label><input class="form-control" type="text" value="<?php echo $data['id_number']?>" readonly="" name="idno" id="idno" placeholder="Id number"><span id="iderror"></span></div>
                <div class="mb-3"><label class="form-label">Phone number</label><input class="form-control" type="text" name="cellno" id="cellno"  value="<?php echo $data['phone']?>" placeholder="Phone"><span id="cerror"></span></div>
                <div class="mb-3"><label class="form-label">Email</label><input class="form-control" type="text" id="email"  value="<?php echo $data['email']?>" name="email" readonly="" placeholder="Email"><span id="error"></span></div>
                <div class="mb-3"><label class="form-label">Gender</label><input class="form-control" type="text" value="<?php echo $data['gender']?>" id="gender" name="gender" readonly="" placeholder="Gender"><span id="gerror"></span></div>
           
                <p style="color: rgb(44,32,252);">Address information</p>
                <hr>
               
                <div class="mb-3"><label class="form-label">House No.</label><input class="form-control"  value="<?php echo $data['house_no'] ?>" type="text" name="houseno" id="houseno" placeholder="House no"><span id="keenhouse"></span></div>
                <div class="mb-3"><label class="form-label">Street name</label><input class="form-control" value="<?php echo $data['street_name'] ?>" type="text" name="streetname" id="streetname" placeholder="Street name"><span id="keenstreet"></span></div>
                <div class="mb-3"><label class="form-label">Suburb</label><input class="form-control" value="<?php echo $data['suburb'] ?>" type="text" name="suburb" id="suburb" placeholder="Suburb"><span id="keensuburb"></span></div>
                <div class="mb-3"><label class="form-label">City</label><input class="form-control" value="<?php echo $data['city'] ?>" type="text" name="city" id="city" placeholder="City"><span id="keencity"></span></div>
                <div class="mb-3"><label class="form-label">Province</label><input class="form-control" value="<?php echo $data['province'] ?>" type="text" name="province" id="province" placeholder="Province"><span id="keenprovince"></span></div>
                <div class="mb-3"><label class="form-label">Zip Code</label><input class="form-control" value="<?php echo $data['zip_code'] ?>" type="text" name="zipcode" id="zipcode" placeholder="Zip code"><span id="keenzipcode"></span></div>
                <div class="mb-3"><label class="form-label">Country</label><input class="form-control" value="<?php echo $data['country'] ?>" type="text" name="country" id="country" placeholder="Country"><span id="keencountry"></span></div>
          
                <p style="color: rgb(44,32,252);">Next of keen information</p>
                <hr>
              
                <div class="mb-3"><label class="form-label">Firs tname</label><input class="form-control" value="<?php echo $data['keen_firstname'] ?>" type="text" name="keenfirstname" id="keenfirstname" placeholder=""><span id="keenfname"></span></div>
                <div class="mb-3"><label class="form-label">Last name</label><input class="form-control" value="<?php echo $data['keen_lastname'] ?>" type="text" name="keenlastname" id="keenlastname" placeholder=""><span id="keenlname"></span></div>
                <div class="mb-3"><label class="form-label">Phone number</label><input class="form-control"  value="<?php echo $data['keen_phone'] ?>" type="text" name="kphone" id="kphone" placeholder=""><span id="keenphone"></span></div>
                <div class="mb-3"><label class="form-label">Email</label><input class="form-control"  value="<?php echo $data['keen_email'] ?>" type="text" name="kemail" id="kemail" placeholder=""><span id="keenemail"></span></div>
                <div class="mb-3"><input class="btn btn-primary d-block w-100" type="submit" value="Save" style="background: rgb(44,32,252);color: rgb(255,255,255);"></div>
            </form>
        </div>
    </section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js"></script>

</body>

</html>