<?php include 'inc/session.php';?>
<!DOCTYPE html>
<html lang="en">
<?php include'inc/connect.php'; ?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title> Identification System | Add</title><link rel="icon" href="../../assets/img/logo.jpg">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/material-icons.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="assets/css/Profile-Card.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/styles.css">
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
var crimeerror=document.getElementById("crimeerror");
var yerror=document.getElementById("yerror");


if(document.forms["form"]["crimetype"].value=="" && document.forms["form"]["year"].value=="")
{

    crimeerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+"field should not be empty *</span>"
    yerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+"field should not be empty *</span>"

return false;

}else{
//name 
var name=document.forms["form"]["crimetype"].value;


if(name=="")
{

    crimeerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should not be empty *</span>";
  return false;

}else if(!name.match(/[a-zA-Z][a-zA-Z ]+[a-zA-Z ]$/))
{
    crimeerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should contain alphabetical characters.*</span>";
return false;

}else
{

    crimeerror.innerHTML=""; 
}

var year=document.forms["form"]["year"].value;


if(year=="")
{

   yerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should not be empty *</span>";
  return false;

}else if(!year.match(/^[0-9]+$/))
{
    yerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should contain numbers only.*</span>";
return false;

}else
{

    yerror.innerHTML=""; 
}








}


}
</script>


<?php

$id=$_GET['value'];
  echo $id;

   if(isset($_POST['crimetype']) && isset($_POST['year']))
   {
   
    
           //variables
        
           $crimetype=$_POST['crimetype'];
           $year=$_POST['year'];
      
       
   
       $sql="INSERT INTO docket (person_id,crime_type, year)
       VALUES ('$id','$crimetype','$year')";
   
   
   
               
   
       if(mysqli_query($conn,$sql))
       {
          echo'<script>alert("Docket created successfully.");window.location = "criminal.php";</script>'; 
          
           exit;
    
                                                    
     }
     else{
       
      die("<h3>unsuccessfully not registered </h3>".mysqli_error($conn));
    
    }
   
   }

?>
<body style="background: #ffffff;">
    <section class="register-photo" style="background: rgb(255,255,255);">
        <div class="form-container">
            <form name="form" onsubmit="return validateForm();"  action=""  method="post" >
                <p class="d-lg-flex justify-content-lg-center" style="color: rgb(44,32,252);"><img class="d-lg-flex justify-content-lg-center" src="assets/img/logo.png" style="height: 150px;"></p>
                <h1 class="text-center" style="font-family: ABeeZee, sans-serif;font-size: 21px;">Add Criminal information<a class="float-end" href="criminal.php"><i class="fas fa-window-close" style="color: rgb(44,32,252);"></i></a></h1>
                <hr>
                <p style="color: rgb(44,32,252);">Criminal Record information</p>
                <div class="mb-3"><label class="form-label">Crime type</label><input class="form-control" type="text" name="crimetype"  placeholder="Crimetype"><span id="crimeerror"></span></div>
                <div class="mb-3"><label class="form-label">Year</label><input class="form-control" type="text" name="year"  placeholder="year"><span id="yerror"></span></div>
                <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit" style="background: rgb(44,32,252);color: rgb(255,255,255);">Save</button></div>
            </form>
        </div>
    </section>
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
</body>

</html>