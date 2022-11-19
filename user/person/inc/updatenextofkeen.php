<?php

//connect
include '../inc/connect.php';

$id=$_GET["value"];



if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['phone'])&& isset($_POST['email']))
{

    
    
$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$phone=$_POST['phone'];
$email=$_POST['email'];


  

  
$command="UPDATE  person
 SET 
 keen_firstname='$firstname', keen_lastname='$lastname', keen_phone='$phone', keen_email='$email'
 WHERE person_id='$id'";



$edit=mysqli_query($conn,$command);
  

if($edit){
mysqli_close($conn);

     
echo '<script>alert("Next of keen information Updated.");window.location = "../profile.php";</script>';

exit;

}
else
{
    echo mysqli_error();

}
}


?>