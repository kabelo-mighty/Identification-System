<?php

include 'connect.php';

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  $id=$_GET['value'];

    $sql4=" DELETE From docket WHERE docket_id='$id'";
    $result4=mysqli_query($conn,$sql4);
    if (!$result4) {
    	echo "db access denied ".mysqli_error();
    }else{
      echo '<script>alert("Record succesfully deleted.");window.location = "../criminal.php";</script>';
  }
  

?>