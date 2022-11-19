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


  

  
$command="UPDATE  next_keen
 SET 
 firstname='$firstname', lastname='$lastname', phone='$phone', email='$email'
 WHERE person_id='$id'";



$edit=mysqli_query($conn,$command);
  

if($edit){
mysqli_close($conn);

     
echo '<script>alert("Next of keen information Updated.");window.location = "../people.php";</script>';

exit;

}
else
{
    echo mysqli_error();

}
}


?>