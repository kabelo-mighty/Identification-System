<?php

include 'connect.php';

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  $id=$_GET['value'];

    $sql1=" DELETE From person WHERE person_id='$id'";
    $result1=mysqli_query($conn,$sql1);
  

    $sql3=" DELETE From face_identification WHERE person_id='$id'";
    $result3=mysqli_query($conn,$sql3);

    $sql4=" DELETE From docket WHERE person_id='$id'";
    $result4=mysqli_query($conn,$sql4);

    if (!$result1&&!$result3&&!$result4) {
    	echo "db access denied ".mysqli_error();
    }else{
      echo '<script>alert("record deleted.");window.location = "../people.php";</script>';
  }
  

?>


