<?php
//connect
include '../inc/connect.php';

$id=$_GET["value"];

if(isset($_POST['houseno']) && isset($_POST['streetname']) && isset($_POST['suburb'])&& isset($_POST['city']) &&isset($_POST['province']) && isset($_POST['zipcode']))
{

    
    
$houseno=$_POST['houseno'];
$streetname=$_POST['streetname'];
$suburb=$_POST['suburb'];
$city=$_POST['city'];
$province=$_POST['province'];
$zipcode=$_POST['zipcode'];

  

  
$command="UPDATE  address
 SET 
 house_no='$houseno', street_name='$streetname', suburb='$suburb', city='$city',province='$province',zip_code='$zipcode'
 WHERE person_id='$id'";



$edit=mysqli_query($conn,$command);
  

if($edit){
mysqli_close($conn);

     
echo '<script>alert("Address information Updated.");window.location = "../people.php";</script>';

exit;

}
else
{
    echo mysqli_error();

}
}


?>