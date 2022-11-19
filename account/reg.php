<!DOCTYPE html>
<html lang="en">
<?php

 //connection
 include '../src/connect.php';  

if(isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['dob']) && isset($_POST['dob1']) && isset($_POST['idno'])
&& isset($_POST['gender']) && isset($_POST['email']) && isset($_POST['cellno']) && isset($_POST['password']))
{
    //start session
    session_start();
//variables
    $name=$_POST['name'];
    $surname=$_POST['surname'];
    $year=$_POST['dob'];
    $dob=$_POST['dob1'];
    $idno=$_POST['idno'];
    $gender=$_POST['gender'];
    $email=$_POST['email'];
    $cellno=$_POST['cellno'];
   
    //hash up password
    $password=md5($_POST['password']);
    
    //concat idnumber
    $fullid=$dob.''.$idno;
    
    $query="select * from person where email='$email' and id_number='$fullid'";
    
    $result=mysqli_query($conn,$query) or die(mysqli_error($conn));
    
    $row=mysqli_fetch_array($result);
    
    if($row !== NULL && $row['email']==$email && $row['id_number']==$fullid)
    {
    
        echo'<script>alert("Email and the Id Number exist within the system,Please login.");window.location = "register.php";</script>';
   
     exit;
    
    }                         
    else{
    
    $sql="INSERT INTO person(firstname, lastname,gender,dateOfbirth,id_number,phone,email,password) 
                VALUES ('$name','$surname','$gender','$year','$fullid','$cellno','$email','$password')";
    
    
    
                        
    
                if(mysqli_query($conn,$sql))
                {
                  
                    echo'<script>alert("Account successfully created");window.location = "login.php";</script>';
                    exit;
             
                                                             
              }
              else{
                
               die("<h3>unsuccessfully not registered </h3>".mysqli_error($conn));
             
             }
           }



}

   
   
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title> Identification System | Register</title><link rel="icon" href="../assets/img/logo.jpg">
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
<script>

    
function validateForm() 
{
var nerror=document.getElementById("nerror");
var serror=document.getElementById("serror");
var gerror=document.getElementById("gerror");
var cerror=document.getElementById("cerror");
var error=document.getElementById("error");
var iderror=document.getElementById("iderror");
var standerror=document.getElementById("standerror");
var streeterror=document.getElementById("streeterror");
var suberror=document.getElementById("suberror");
var cityerror=document.getElementById("cityerror");
var proverror=document.getElementById("proverror");

var accounttypeerror=document.getElementById("accounttypeerror");


var errormessage=document.getElementById("errorpass");
var ierror=document.getElementById("ierror");

if(document.forms["form"]["name"].value==""&&
 document.forms["form"]["surname"].value==""&&
 document.forms["form"]["gender"].value==""&&
 document.forms["form"]["idno"].value==""&&
 document.forms["form"]["cellno"].value==""&&
 document.forms["form"]["email"].value==""&&
 document.forms["form"]["pwd"].value=="" &&
 document.forms["form"]["cpwd"].value==""
 )
{

nerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>"
serror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>"
doberror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" select Date of birth. *</span>"
gerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" select gender please!*</span>"
cerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty*</span>"
error.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>"
iderror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>"
errormessage.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>"
cerrorpass.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>"

return false;


}else
{
//name 
var name=document.forms["form"]["name"].value;


if(name=="")
{

   nerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>";
  return false;

}else if(!name.match(/[a-zA-Z][a-zA-Z ]+[a-zA-Z ]$/))
{
nerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should contain alphabetical characters.*</span>";
return false;

}else
{

nerror.innerHTML=""; 
}
//surname

var surname=document.forms["form"]["surname"].value;


if(surname=="")
{

   serror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>";
  return false;

}
else if(!surname.match(/[a-zA-Z][a-zA-Z ]+[a-zA-Z]$/))
{
serror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should contain alphabetical characters.*</span>";
return false;

}else
{

serror.innerHTML="";  
}
//id


var Idno=document.forms["form"]["idno"].value;


var dob=document.forms["form"]["dob"].value;

if(dob=="")
{
   doberror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+"select Date of birth.*</span>";
   return false;
}else
{

    doberror.innerHTML="";
}

var year=document.getElementById('dob').value;
        var month=document.getElementById('dob').value;
        var day=document.getElementById('dob').value;
        //day.substring(7,5)
         var id=year.substring(2,4)+ month.substring(7,5)+day.substring(10,8);

        document.getElementById('dob1').value = id;
if(Idno=="")
{

  iderror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty. *</span>"
return false;

}else
if(Idno.toString().length!=7)
{

iderror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" Please check the field length,it should be 7. *</span>"
return false;

}
else 
if(!Idno.match(/^[0-9]+$/))
{

iderror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+"field should be filled with number only. *</span>"
return false;  
}else
{
    iderror.innerHTML=""; 
}
//addtional

      
        //add2

        var cit=Idno.substring(5,4);
   if(cit!="0")
   {
 
   iderror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" Invalid Id Number,Youre not a RSA citizen. *</span>"
return false;    
   }

var cite=Idno.substring(6,5);
   if(cite!="8")
   {
    iderror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" Invalid Rsa Id Number. *</span>"
return false;    
   }   
  else
{
  iderror.innerHTML="";

}

//addtional

//check year


var gender=Idno.substring(0,1);


if(gender <= "4")
{
  
  document.forms["form"]["gender"].value="Female";


}else
{

  document.forms["form"]["gender"].value="Male";
 
}

//gender
var gender=document.forms["form"]["gender"].value;


if(gender=="")
{

   gerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" Gender missing *</span>";
  return false;


}else
{

gerror.innerHTML="";  
}

//email


var email=document.forms["form"]["email"].value;

if(email=="")
{

   error.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>";
  return false;

}
else
if(!((email.indexOf(".") > 0) && (email.indexOf("@") > 0)) ||/[^a-zA-Z0-9.@_-]/.test(email))
{
error.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" Invalid email.*</span>";

return false;
}else if(email.slice(-3)!="com" && email.slice(-5)!="ac.za" && email.slice(-6)!="gov.za" && email.slice(-3)!="org" && email.slice(-5)!="co.za")
{
  error.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" Invalid email.*</span>";

return false;
}
else
{
error.innerHTML="";
}

//cellno
var cellno=document.forms["form"]["cellno"].value;

if(cellno=="")
{

   cerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>";
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

 cerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" Surfix of phone number invalid. *</span>"
    return false;
   
}
else if(cellno.substring(0,1)!="0")
{


cerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" cellno number must start with 0.*</span>";
return false;
}
else
if(!cellno.match(/^[0-9]+$/))
{

cerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+"field should be filled with number only.*</span>";
return false;   
}
else
if(cellno.toString().length!=10)
{
cerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+"field should be 10 characters.*</span>";    

return false;   
}
else
{
cerror.innerHTML="";

}

//
var passd=document.forms["form"]["pwd"].value;
var cpassd=document.forms["form"]["cpwd"].value;




var cerrormessage=document.getElementById("cerrorpass");
var pass=document.getElementById("pwd").value;

if(pass=="")
{

   errormessage.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>";
  return false;

}else
{
errormessage.innerHTML="";
}
//contain atleast 1 lowercase

if(!pass.match(/^(?=.*[a-z])/))
{
  errormessage.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" Password should contain atleast 1 lowercase alphabetical character.*</span>";
return false;
}
else
{
errormessage.innerHTML="";
}
//contain atleast 1 uppercase
if(!pass.match(/^(?=.*[A-Z])/))
{
  errormessage.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" Password should contain atleast 1 uppercase alphabetical character.*</span>";
return false;
}
else
{
errormessage.innerHTML="";
}
//contain atleast 1 numeric
if(!pass.match(/^(?=.*[0-9])/))
{
  errormessage.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" Password should contain atleast 1 numeric character.*</span>"
return false;
}
else
{
errormessage.innerHTML="";
}
//contain special character
if(!pass.match(/^(?=.*[!@#\$%\^&\*])/))
{
  errormessage.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" Password should contain special character.*</span>";
return false;
}
else
{
errormessage.innerHTML="";
}
//contain 8 or more characters
if(!pass.match(/^(?=.{8,})/))
{
  errormessage.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" Password shouldcontain 8 or more characters.*</span>";
return false;
}
else
{
errormessage.innerHTML="";
}
//confirm password
//step 1
if(cpassd==""){

cerrormessage.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" confirm Password.*</span>";
return false;   
}else
{

cerrormessage.innerHTML="";
}




if(cpassd!=passd){

errormessage.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" Password doesnt match.*</span>"
cerrormessage.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" Password doesnt match.*</span>"
return false;   
}else
{
errormessage.innerHTML=""
cerrormessage.innerHTML=""
}
}
}
</script>

<body style="background: rgb(255,255,255);">
    <div style="height: 500px;background: url(&quot;assets/img/Facial-recognition-technology-explained-compressed.jpg&quot;) center / cover no-repeat;">
        <div class="d-flex justify-content-center align-items-center" style="height: inherit;min-height: initial;width: 100%;position: absolute;left: 0;background: rgba(30,41,99,0);">
            <div class="d-flex align-items-center order-5" style="height:200px;">
                <div class="container">
                    <h1 class="text-center" style="color: rgb(242,245,248);font-size: 30px;font-weight: bold;"><i class="fa fa-bullseye" style="color: rgb(255,255,255);"></i><strong>&nbsp;IDENTIFICATION SYSTEM</strong><br></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="shadow login-card" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="500" style="margin-top: -154px;border-radius: 13px;">
        <h1 class="text-uppercase" style="font-size: 19px;text-align: center;color: rgb(46,35,253);">register account</h1>
        <hr>
        <form class="form-signin" action=""  name="form" onsubmit="return validateForm();" method="post">
            <span class="reauth-email"></span>
            <input class="form-control" type="text"  placeholder="Firstname" name="name" id="name" autofocus="" style="font-size: 14px;"><span id="nerror"></span>
            <input class="form-control" type="text"  placeholder="Lastname" name="surname"  id="surname" autofocus="" style="font-size: 14px;"><span id="serror"></span>
            <label class="form-label" style="color: rgb(136,132,132);">Date Of Birth</label>
            <input class="form-control" type="date" name="dob"  id="dob" max="2005-12-31" min="1918-01-31"  placeholder="Id number" autofocus="" style="font-size: 14px;"><span id="doberror"></span><br>
            <label class="form-label" style="color: rgb(136,132,132);">Id number</label>
            <div class="d-lg-flex justify-content-lg-start">
            <input class="form-control" type="text" maxlength="6" name="dob1" id="dob1" style="width: 137px;font-size: 14px;" placeholder="D.O.B" readonly="">
            <input class="form-control" type="text" id="idno" name="idno" maxlength="7" style="width: 130px;font-size: 14px;" placeholder="Complete Id"></div>
            <span id="iderror"></span><br>
            <label class="form-label" style="color: rgb(136,132,132);">Gender</label>
            <div class="form-check"><input class="form-check-input" type="radio" name="gender"   maxlength="13" id="gender" value="Male""><label class="form-check-label" for="gender" style="color: rgb(136,132,132);">Male</label></div>
            <div class="form-check"><input class="form-check-input" type="radio" name="gender"   maxlength="13" id="gender" value="Female""><label class="form-check-label" for="gender" style="color: rgb(136,132,132);">Female</label></div>
            <span id="gerror"></span>
            <input class="form-control" type="text"  name="cellno" id="cellno" placeholder="Phone Number" autofocus="" style="font-size: 14px;"><span id="cerror"></span>
            <input class="form-control" type="text" name="email" id="email" placeholder="Email address" autofocus="" style="font-size: 14px;"><span id="error"></span>
            <input class="form-control" type="password" name="password" id="pwd"  placeholder="Password" style="font-size: 14px;"><span id="errorpass"></span>
            <input class="form-control" type="password" name="Cpassword" id="cpwd" placeholder="Confirm Password" style="font-size: 14px;"><span id="cerrorpass"></span>
            <div class="checkbox"></div><button class="btn btn-primary btn-lg d-block btn-signin w-100" type="submit" style="background: rgb(48,37,252);">Register</button>
        </form>
        <p class="lead" style="font-size: 14px;">Have account?&nbsp;<a href="login.php" style="color: rgb(46,35,253);font-weight: bold;font-size: 14px;">Click here</a></p>
        <p class="lead" style="text-align: center;">&nbsp;<a href="../index.php" style="color: rgb(46,35,253);font-weight: bold;font-size: 14px;"><i class="fa fa-home"></i>Homepage</a></p>
    </div>
    <footer class="footer-basic">
        <p class="copyright" style="font-size: 14px;">Identificationsystem © 2022</p>
    </footer>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="assets/js/Multi-step-form.js"></script>
</body>

</html>