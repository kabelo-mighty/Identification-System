<!DOCTYPE html>
<html lang="en">
<?php

 //connection
 include '../src/connect.php';  

if(isset($_POST['name']))
{
 
//variables
    $name=$_POST['name'];
    $surname=$_POST['surname']; 
    $gender=$_POST['gender'];
    $year=$_POST['dob'];
    $dob=$_POST['dob1'];
    $idno=$_POST['idno'];
   
  
    $cellno=$_POST['cellno'];
//nextkeen
    $keenfirstname=$_POST['keenfirstname'];
    $keenlastname=$_POST['keenlastname'];
    $kphone=$_POST['kphone'];
    $kemail=$_POST['kemail'];
   //address 
    $houseno=$_POST['houseno'];
    $streetname=$_POST['streetname'];
    $suburb=$_POST['suburb'];
    $city=$_POST['city'];
    $province=$_POST['province'];
    $zipcode=$_POST['zipcode'];

    $country=$_POST['country'];
      $checkcountry=$_POST['selector'];

    //account

      $email=$_POST['email'];
      $password=md5($_POST['password']);
    //hash up password
  
    
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
    
      
   if($checkcountry=='other')
   {

    $sql="INSERT INTO person(firstname, lastname, gender, dateOfbirth, id_number, phone, house_no, street_name, suburb, city, province, zip_code, country, keen_firstname, keen_lastname, keen_email, keen_phone, email, employee_type, password, confirmed_acc) 
    VALUES ('$name','$surname','$gender','$year','$fullid','$cellno','$houseno','$streetname','$suburb','$city','$province','$zipcode','$country','$keenfirstname','$keenlastname','$email','$kphone','$kemail','default','$password','0')";



            

    if(mysqli_query($conn,$sql))
    {
      
        echo'<script>alert("Account successfully created");window.location = "login.php";</script>';
        exit;
 
                                                 
  }
  else{
    
   die("<h3>unsuccessfully not registered </h3>".mysqli_error($conn));
 
 }



   }else{


    $sql="INSERT INTO person(firstname, lastname, gender, dateOfbirth, id_number, phone, house_no, street_name, suburb, city, province, zip_code, country, keen_firstname, keen_lastname, keen_email, keen_phone, email, employee_type, password, confirmed_acc) 
    VALUES ('$name','$surname','$gender','$year','$fullid','$cellno','$houseno','$streetname','$suburb','$city','$province','$zipcode','South Africa','$keenfirstname','$keenlastname','$email','$kphone','$kemail','default','$password','0')";



            

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



}

   
   
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title> Identification System | Register</title><link rel="icon" href="../assets/img/logo.jpg">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/alert.css">
    <link rel="stylesheet" href="assets/css/Bootstrap-4---Profile-Creation-Wizard.css">
    <link rel="stylesheet" href="assets/css/Contact-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Customizable-Background--Overlay.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="assets/css/FPE-Gentella-form-elements-1.css">
    <link rel="stylesheet" href="assets/css/FPE-Gentella-form-elements.css">
    <link rel="stylesheet" href="assets/css/Google-Style-Login.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/css/index-top-info-1.css">
    <link rel="stylesheet" href="assets/css/index-top-info.css">
    <link rel="stylesheet" href="assets/css/LinkedIn-like-Profile-Box.css">
    <link rel="stylesheet" href="assets/css/Multi-step-form.css">
    <link rel="stylesheet" href="assets/css/Navbar---Apple-1.css">
    <link rel="stylesheet" href="assets/css/Navbar---Apple.css">
    <link rel="stylesheet" href="assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/Profile-Card.css">
    <link rel="stylesheet" href="assets/css/Profile-with-data-and-skills.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/Video-Responsive.css">
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


<!-- new form -->
<section class="register-photo" style="background: rgb(255,255,255);">
        <div class="form-container">
<form action="" name="form" onsubmit="return validateForm();" method="post">
                <p class="d-lg-flex justify-content-lg-center" style="color: rgb(44,32,252);"><img class="d-lg-flex justify-content-lg-center" src="assets/img/logo.png" style="height: 150px;"></p>
                <h1 class="text-center" style="font-family: ABeeZee, sans-serif;font-size: 21px;">Register Account<a class="float-end" href="../index.php"><i class="fas fa-window-close" style="color: rgb(44,32,252);"></i></a></h1>
                <hr>
                <p style="color: rgb(44,32,252);">Personal information</p>
                <div class="mb-3"><label class="form-label">Firs tname</label><input class="form-control" type="text" id="name" name="name"><span id="nerror"></span></div>
                <div class="mb-3"><label class="form-label">Last name</label><input class="form-control" type="text"  name="surname" id="surname" ><span id="serror"></span></div>
                <label class="form-label" style="color: var(--color-text-grey);">Date Of Birth</label>
                <input class="form-control"type="date" name="dob"  id="dob" max="2005-12-31" min="1918-01-31"  placeholder="Id number"  style="font-size: 14px;"><span id="doberror"></span><br>
               <label class="form-label" style="color: var(--color-text-grey);">Id number</label>
               <div class="d-lg-flex justify-content-lg-start"></div>
               <div class="input-group"><input class="form-control" type="text" maxlength="6" name="dob1" id="dob1" style="width: 137px;font-size: 14px;" placeholder="D.O.B" readonly="">
               <input class="form-control" type="text" style="width: 130px;font-size: 14px;" id="idno" name="idno" maxlength="7" style="width: 130px;font-size: 14px;" placeholder="Complete Id"></div> <span id="iderror"></span><br>
               <label class="form-label" style="color: rgb(136,132,132);">Gender</label>
               <div class="form-check"><input class="form-check-input" type="radio" name="gender"   maxlength="13" id="gender" value="Male"><label class="form-check-label" for="formCheck-1" style="color: rgb(136,132,132);">Male</label></div>
               <div class="form-check"><input class="form-check-input" type="radio" name="gender"   maxlength="13" id="gender" value="Female"><label class="form-check-label" for="formCheck-2" style="color: rgb(136,132,132);">Female</label></div>  <span id="gerror"></span><br>
                <div class="mb-3"><label class="form-label">Phone number</label><input class="form-control" type="text" name="cellno" id="cellno"  ><span id="cerror"></span></div>

              
           
                <p style="color: rgb(44,32,252);">Address information</p>
                <hr>
                                                                                               
                <script>
                function countrycheck(that) 
                {
                if (that.value == "other") 
                {
                document.getElementById("divcountry").style.display = "block";
                document.getElementById("country").value="";
                }
                else
                {
                document.getElementById("divcountry").style.display = "none";
                document.getElementById("country").value="South africa";
              
                }
                }
                </script>
                <label style="color: var(--color-text-grey);" class="form-label">Country</label>
                 <select id="selector" name="selector" onchange="countrycheck(this);"  class="form-control">
                <option  value="">--Select Citizen--</option>
                <option  value="South Africa">South african</option>
                <option  value="other" id="chkcountry">Other</option>

                </select><span id="citerror"></span>
                <div class="mb-3"><label class="form-label">House No.</label><input class="form-control"   type="text" name="houseno" id="houseno" ><span id="keenhouse"></span></div>
                <div class="mb-3"><label class="form-label">Street name</label><input class="form-control"  type="text" name="streetname" id="streetname" ><span id="keenstreet"></span></div>
                <div class="mb-3"><label class="form-label">Suburb</label><input class="form-control"  type="text" name="suburb" id="suburb" ><span id="keensuburb"></span></div>
                <div class="mb-3"><label class="form-label">City</label><input class="form-control"  type="text" name="city" id="city" ><span id="keencity"></span></div>
                <div class="mb-3"><label class="form-label">Province</label><input class="form-control"  type="text" name="province" id="province" ><span id="keenprovince"></span></div>
                <div class="mb-3"><label class="form-label">Zip Code</label><input class="form-control"  type="text" name="zipcode" id="zipcode" ><span id="keenzipcode"></span></div>
               
               
               
                <div id="divcountry" style="display: none">
                <div class="mb-3"><label style="color: var(--color-text-grey);" class="form-label">Country</label><input class="form-control" type="text" name="country" id="country" ><span id="keencountry"></span></div>
                                                                                              
               </div> 
                <p style="color: rgb(44,32,252);">Next of keen information</p>
                <hr>
              
                <div class="mb-3"><label class="form-label">First name</label><input class="form-control" type="text" name="keenfirstname" id="keenfirstname" placeholder=""><span id="keenfname"></span></div>
                <div class="mb-3"><label class="form-label">Last name</label><input class="form-control"  type="text" name="keenlastname" id="keenlastname" placeholder=""><span id="keenlname"></span></div>
                <div class="mb-3"><label class="form-label">Phone number</label><input class="form-control"  type="text" name="kphone" id="kphone" placeholder=""><span id="keenphone"></span></div>
                <div class="mb-3"><label class="form-label">Email</label><input class="form-control"  type="text" name="kemail" id="kemail" placeholder=""><span id="keenemail"></span></div>
                <p style="color: rgb(44,32,252);">Account</p>
                <hr>
                <div class="mb-3"><label class="form-label">Email</label><input class="form-control" type="text" id="email"  name="email" ><span id="error"></span></div>
                <div class="mb-3"><label class="form-label">Password</label><input class="form-control" type="password" name="password" id="pwd" placeholder=""><span id="errorpass"></span></div>
                <div class="mb-3"><label class="form-label">Confirm Password</label><input class="form-control"  type="password" name="Cpassword" id="cpwd" placeholder=""><span id="cerrorpass"></span></div>
                
                <div class="mb-3"><input class="btn btn-primary d-block w-100" type="submit" value="Register" style="background: rgb(44,32,252);color: rgb(255,255,255);"></div>
            </form>
</div>
</section>


    <!-- old form -->

 <!-- <form  name="form" onsubmit="return validateForm();" method="post">



 <div class="container">
                                                                                        
 <div class="row">
                                                                                            <div class="col">
                                                                                                <div class="shadow-none login-card"   style="max-width: 100%;background-color:#fff;margin-bottom:-125px">
                                                                                                    <h5 style="font-weight: bold;color: rgb(48,37,252);"><i class="fa fa-user"></i>&nbsp;Personal information</h5>
                                                                                                    <hr>
                                                                                                    <div class="form-signin"><span class="reauth-email"> </span><label style="color: var(--color-text-grey);" class="form-label">First name</label>
                                                                                                    <input class="form-control" type="text" name="name" id="name"  style="font-size: 14px;"><span id="nerror"></span><br>
                                                                                                        <label style="color: var(--color-text-grey);" class="form-label">Last name</label>
                                                                                                        <input class="form-control" type="text" name="surname"  id="surname" style="font-size: 14px;"><span id="serror"><br>
                                                                                                        <label class="form-label" style="color: var(--color-text-grey);">Date Of Birth</label>
                                                                                                        <input class="form-control"type="date" name="dob"  id="dob" max="2005-12-31" min="1918-01-31"  placeholder="Id number"  style="font-size: 14px;"><span id="doberror"></span><br>
                                                                                                        <label class="form-label" style="color: var(--color-text-grey);">Id number</label>
                                                                                                        <div class="d-lg-flex justify-content-lg-start"></div>
                                                                                                        <div class="input-group"><input class="form-control" type="text" maxlength="6" name="dob1" id="dob1" style="width: 137px;font-size: 14px;" placeholder="D.O.B" readonly="">
                                                                                                        <input class="form-control" type="text" style="width: 130px;font-size: 14px;" id="idno" name="idno" maxlength="7" style="width: 130px;font-size: 14px;" placeholder="Complete Id"></div> <span id="iderror"></span><br>
                                                                                                        <label class="form-label" style="color: rgb(136,132,132);">Gender</label>
                                                                                                        <div class="form-check"><input class="form-check-input" type="radio" name="gender"   maxlength="13" id="gender" value="Male"><label class="form-check-label" for="formCheck-1" style="color: rgb(136,132,132);">Male</label></div>
                                                                                                        <div class="form-check"><input class="form-check-input" type="radio" name="gender"   maxlength="13" id="gender" value="Female"><label class="form-check-label" for="formCheck-2" style="color: rgb(136,132,132);">Female</label></div>  <span id="gerror"></span><br>
                                                                                                        <label style="color: var(--color-text-grey);" class="form-label">Phone number</label> <input class="form-control" type="text" name="cellno" id="cellno"  style="font-size: 14px;"><span id="cerror"></span><br>

                                                                                                        <hr>
                                                                                                
                                                                                                    </div>
                                                                                                </div>
                                                                                                
                                                                                                    <h5 style="font-weight: bold;color: rgb(48,37,252);"><i class="fa fa-users"></i>&nbsp;Next Of Keen Information</h5>
                                                                                                    <hr>
                                                                                                    <div class="form-signin"><span class="reauth-email"> </span>
                                                                                                    <div class="mb-3"><label style="color: var(--color-text-grey);" class="form-label">First name</label><input class="form-control"  type="text" name="keenfirstname" id="keenfirstname" placeholder=""><span id="keenfname"></span></div><br>
                                                                                                    <div class="mb-3"><label style="color: var(--color-text-grey);" class="form-label">Last name</label><input class="form-control"  type="text" name="keenlastname" id="keenlastname" placeholder=""><span id="keenlname"></span></div><br>
                                                                                                    <div class="mb-3"><label style="color: var(--color-text-grey);" class="form-label">Phone number</label><input class="form-control"  type="text" name="kphone" id="kphone" placeholder=""><span id="keenphone"></span></div><br>
                                                                                                    <div class="mb-3"><label style="color: var(--color-text-grey);" class="form-label">Email</label><input class="form-control"  type="text" name="kemail" id="kemail" placeholder=""><span id="keenemail"></span></div><br>
                                                                                                  </div>
                                                                                                </div>
                                                                                                
                                                                                            </div>                                                                                      
                                                                                
                                                                                         <script>
                                                                                            function countrycheck(that) 
                                                                                            {
                                                                                                if (that.value == "other") 
                                                                                                {
                                                                                                    document.getElementById("divcountry").style.display = "block";
                                                                                                }
                                                                                                else
                                                                                                {
                                                                                                    document.getElementById("divcountry").style.display = "none";
                                                                                                }
                                                                                            
                                                                                               
                                                                                                }


                                                                                         </script>
                                                                                            <div class="col">
                                                                                                <div class="shadow-none login-card"   style="max-width: 100%;background-color:#fff;margin-bottom:-125px">
                                                                                                    <h5 style="font-weight: bold;color: rgb(48,37,252);"><i class="fa fa-map-pin"></i>&nbsp;Address information</h5>
                                                                                                    <hr>
                                                                                                    <div class="form-signin"><span class="reauth-email"> </span>
                                                                                                    <label style="color: var(--color-text-grey);" class="form-label">Country</label>
                                                                                                 <select id="selector" onchange="countrycheck(this);"  class="form-control">
                                                                                                 <option  value="">--Select Citizen--</option>
                                                                                                   <option  value="South Africa">South african</option>
                                                                                                   <option  value="other"   id="chkcountry">Other</option>

                                                                                                   </select>
                                                                                                    <div class="mb-3"><label style="color: var(--color-text-grey);" class="form-label">House No.</label><input class="form-control"  type="text" name="houseno" id="houseno" ><span id="keenhouse"></span></div>
                                                                                                    <div class="mb-3"><label style="color: var(--color-text-grey);" class="form-label">Street name</label><input class="form-control"  type="text" name="streetname" id="streetname" ><span id="keenstreet"></span></div>
                                                                                                    <div class="mb-3"><label style="color: var(--color-text-grey);" class="form-label">Suburb</label><input class="form-control" type="text" name="suburb" id="suburb" ><span id="keensuburb"></span></div>
                                                                                                    <div class="mb-3"><label style="color: var(--color-text-grey);" class="form-label">City</label><input class="form-control"  type="text" name="city" id="city" ><span id="keencity"></span></div>
                                                                                                    <div class="mb-3"><label style="color: var(--color-text-grey);" class="form-label">Province</label><input class="form-control"  type="text" name="province" id="province" ><span id="keenprovince"></span></div>
                                                                                                    <div class="mb-3"><label style="color: var(--color-text-grey);" class="form-label">Zip Code</label><input class="form-control"  type="text" name="zipcode" id="zipcode" ><span id="keenzipcode"></span></div>
               
          
                                                                                                    <div id="divcountry" style="display: none">
                                                                                                     <div class="mb-3"><label style="color: var(--color-text-grey);" class="form-label">Country</label><input class="form-control" type="text" name="country" id="country" ><span id="keencountry"></span></div>
                                                                                              
                                                                                                </div>  </div>
                                                                                            
                                                                                                    <hr>
                                                                                                </div>
                                                                                                <div class="shadow-none login-card"   style="max-width: 100%;background-color:#fff">
                                                                                                    <h5 style="font-weight: bold;color: rgb(48,37,252);"><i class="fa fa-unlock-alt"></i>&nbsp;Account&nbsp;</h5>
                                                                                                    <hr>
                                                                                                    <div class="form-signin"><span class="reauth-email"> </span>
                                                                                                    <label style="color: var(--color-text-grey);" class="form-label">Email</label><input class="form-control" type="text"name="email" id="email" placeholder="Email address" autofocus="" style="font-size: 14px;"><span id="error"></span>

                                                                                                    <label style="color: var(--color-text-grey);" class="form-label">Password</label><input class="form-control" type="password" name="password" id="pwd"  placeholder="Password" style="font-size: 14px;"><span id="errorpass"></span>

                                                                                                    <label style="color: var(--color-text-grey);" class="form-label">Confirm Password</label><input class="form-control" type="password" name="Cpassword" id="cpwd" placeholder="Confirm Password" style="font-size: 14px;"><span id="cerrorpass"></span>

                                                                                                    
                                                                                                        <hr>
                                                                                                       <p  ><button class="btn text-center" type="submit" style="background: rgb(48,37,252);color: rgb(255,255,255);"><i class="fas fa-mouse-pointer"></i>&nbsp;Submit</a></p> 
                                                                                                       <p style="color: black;"><a  href="../index.php" role="button" style=";color: rgb(48,37,252);">&nbsp;Goto homepage</a> OR <br> <a  href="login.php" role="button" style=";color: rgb(48,37,252);">&nbsp;Have an account?</a></p>

                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                      



</div>
</form> -->
    
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="assets/js/Bootstrap-4---Profile-Creation-Wizard-1.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="assets/js/Bootstrap-4---Profile-Creation-Wizard.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
    <script src="assets/js/Bootstrap-4---Profile-Creation-Wizard-2.js"></script>
    <script src="assets/js/DataTable---Fully-BSS-Editable.js"></script>
    <script src="assets/js/Multi-step-form.js"></script>
    <script src="assets/js/Navbar---Apple.js"></script>
    <script src="assets/js/form-valid.js"></script>
</body>

</html>