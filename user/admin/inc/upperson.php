<?php

//connect
include '../inc/connect.php';

$id=$_GET["value"];



$qry=mysqli_query($conn,"select * from person WHERE person_id='$id'");
$data=mysqli_fetch_array($qry);


if(isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['gender'])&& isset($_POST['email']) &&isset($_POST['cellno']) && isset($_POST['idno']))
{

    
    
$name=$_POST['name'];
$surname=$_POST['surname'];
$gender=$_POST['gender'];
$email=$_POST['email'];
$cellno=$_POST['cellno'];


$idno=$_POST['idno'];

  

  
$command="UPDATE  person
 SET 
 firstname='$name', lastname='$surname', gender='$gender',id_number='$idno',phone='$cellno',email='$email'
 WHERE person_id='$id'";



$edit=mysqli_query($conn,$command);
  

if($edit){
mysqli_close($conn);

     
echo '<script>alert("Personal information Updated.");window.location = "../people.php";</script>';

exit;

}
else
{
    echo mysqli_error();

}
}


?>