<?php

include 'inc/connect.php';
$cu=$_GET['url'];

$qry=mysqli_query($conn,"select * from person WHERE person_id='$cu'");

$data=mysqli_fetch_array($qry);



$command="UPDATE  person
 SET 
 confirmed_acc='1'
 WHERE person_id='$cu'";


$edit=mysqli_query($conn,$command);
  

if($edit){
mysqli_close($conn);

echo '<script>alert("Account confirmed");window.location = "people.php";</script>';

exit;

}
else
{
    echo mysqli_error();

}



?>
