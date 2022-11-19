<!DOCTYPE html>
<html lang="en">

<?php

//connection
include '../src/connect.php';

if(isset($_POST['email']) && isset($_POST['cellno']) &&isset($_POST['password'])){
 //Assign

 $cellno=$_POST['cellno'];
$email=$_POST['email'];
$password=md5($_POST['password']);
//check record
//connect

//person
$cquery="select * from person where email='$email'and phone='$cellno'";
$cresult=mysqli_query($conn,$cquery) or die(mysqli_error($conn));
$crow=mysqli_fetch_array($cresult);


if($crow !==NULL && strtolower($crow['email'])==strtolower($email) && $crow['phone']==$cellno)
{
         
    
        $command="UPDATE  person SET password='$password'
        WHERE person.email='$email'";
        
        
        $edit=mysqli_query($conn,$command);    
        
        if($edit){
        mysqli_close($conn);
        
        echo'<script>alert("New Password successfully created.");window.location = "login.php";</script>';
       
         exit;
        
        }
        else
        {
            echo mysqli_error();
        
        }     
       
    

    
}else
{


    echo'<script>alert("Make sure that your phone number and email are correct.");window.location = "passwordrecover.php";</script>';
    exit;


}



}

?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title> Identification System | Password Recovery</title><link rel="icon" href="../assets/img/logo.jpg">
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

  var cerror=document.getElementById("cerror");
  var error=document.getElementById("error");
  var errormessage=document.getElementById("errorpass");
 

  if(
     document.forms["form"]["cellno"].value==""&&
     document.forms["form"]["email"].value==""&&
     document.forms["form"]["pwd"].value==""&&
     document.forms["form"]["cpwd"].value=="")
  {

    
    cerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>"
    error.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>"
    errormessage.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>"
    cerrorpass.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>"

    return false;
    

  }else
  {
      //account type


//cellno
   var cellno=document.forms["form"]["cellno"].value;
 
  if(cellno=="")
   {

       cerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>";
      return false;
  
   }
   else if(cellno.substring(0,1)!="0")
    {
 

 cerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" Cell number must start with 0.*</span>";
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
else if(cellno.substring(0,3)!='071'&& cellno.substring(0,3)!='072'&&
       cellno.substring(0,3)!='073'&& cellno.substring(0,3)!='074'&&
       cellno.substring(0,3)!='076'&& cellno.substring(0,3)!='060'&&
       cellno.substring(0,3)!='061'&& cellno.substring(0,3)!='062'&&
       cellno.substring(0,3)!='063'&& cellno.substring(0,3)!='064'&&
       cellno.substring(0,3)!='065'&& cellno.substring(0,3)!='066'&&
       cellno.substring(0,3)!='067'&& cellno.substring(0,3)!='068'&&
       cellno.substring(0,3)!='081'&& cellno.substring(0,3)!='082'&&
       cellno.substring(0,3)!='083'&& cellno.substring(0,3)!='084')
       {

     cerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" Surfix of phone number invalid. *</span>"
        return false;
       
    }else
{
    cerror.innerHTML="";

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
   }
  else
   {
   error.innerHTML="";
   }

   //
    var passd=document.forms["form"]["pwd"].value;
    var cpassd=document.forms["form"]["cpwd"].value;
   
   
   var cerrormessage=document.getElementById("cerrorpass");
   var pass=document.getElementById("pwd").value;

   if(pass=="")
   {

       errorpass.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" field should not be empty *</span>";
      return false;
  
   }else
   {
    errorpass.innerHTML="";
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

cerrorpass.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" confirm Password.*</span>";
return false;   
}else
{

cerrorpass.innerHTML="";
}

   if(cpassd!=passd){

    errorpass.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" Password doesnt match.*</span>"
    cerrorpass.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" Password doesnt match.*</span>"
    return false;   
   }else
   {
    errormessage.innerHTML=""
    cerrormessage.innerHTML=""
   }
  }
   }
  </script>
<body  style="background: rgb(255,255,255);">
    <div style="height: 500px;background: url(&quot;assets/img/Facial-recognition-technology-explained-compressed.jpg&quot;) center / cover no-repeat;">
        <div class="d-flex justify-content-center align-items-center" style="height: inherit;min-height: initial;width: 100%;position: absolute;left: 0;background: rgba(30,41,99,0);">
            <div class="d-flex align-items-center order-5" style="height:200px;">
                <div class="container">
                    <h1 class="text-center" style="color: rgb(242,245,248);font-size: 30px;font-weight: bold;"><i class="fa fa-bullseye" style="color: rgb(255,255,255);"></i><strong>&nbsp;IDENTIFICATION SYSTEM</strong><br></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="shadow login-card"  style="border-radius: 13px;background: rgb(255,255,255);opacity: 0.91;">
    
        <h3 class="text-uppercase" data-bs-toggle="tooltip" data-bss-tooltip="" style="font-size: 19px;text-align: right;color: rgb(46,35,253);" title="close"><a href="../index.php"><i class="fa fa-window-close" style="font-size: 21px;"></i></a>&nbsp;</h3>    
    <p style="text-align: center;">
            <picture><img src="assets/img/logo.png" style="height: 120px;"></picture>
        </p>
        <h1 class="text-uppercase" style="font-size: 19px;text-align: left;color: rgb(46,35,253);"></h1>
        <h3 class="text-uppercase" style="font-size: 19px;text-align: center;color: rgb(46,35,253);"><strong> Password Recovery</strong>&nbsp;</h3>
    
        <form class="form-signin" name="form" onsubmit="return validateForm();"  method="post" action=""><span class="reauth-email"> </span>
        <input class="form-control" type="text" id="cellno"  name="cellno" placeholder="Phone Number" autofocus="" style="font-size: 14px;"><span id="cerror"></span>
        <input class="form-control" type="email" id="email" name="email" placeholder="Email Address" style="font-size: 14px;"><span id="error"></span>
        <input class="form-control" type="password" id="pwd"  name="password" placeholder="New Password" autofocus="" style="font-size: 14px;"><span id="errorpass"></span>
        <input class="form-control" type="password" id="cpwd" name="Cpassword" placeholder="Confirm new Password" style="font-size: 14px;"><span id="cerrorpass"></span>
        
            <div class="checkbox"></div><button class="btn btn-primary btn-lg d-block btn-signin w-100" type="submit" style="background: rgb(48,37,252);">Save Password</button>
        </form>
       
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