<?php

 //connection
 include 'connect.php';  

if(isset($_POST['houseno']) && isset($_POST['streetname']) && isset($_POST['suburb'])&& isset($_POST['city']) &&isset($_POST['province']) && isset($_POST['zipcode']))
{
 $id=$_GET['value'];
    
        //variables
        $houseno=$_POST['houseno'];
        $streetname=$_POST['streetname'];
        $suburb=$_POST['suburb'];
        $city=$_POST['city'];
        $province=$_POST['province'];
        $zipcode=$_POST['zipcode'];
   
    

    $sql="INSERT INTO address(person_id,house_no, street_name,suburb,city,province,zip_code)
    VALUES ('$id','$houseno','$streetname','$suburb','$city','$province','$zipcode')";



            

    if(mysqli_query($conn,$sql))
    {
      
        echo'<script>alert("Information captured.");window.location = "../profile.php";</script>';
        exit;
 
                                                 
  }
  else{
    
   die("<h3>unsuccessfully not registered </h3>".mysqli_error($conn));
 
 }

}

   
   
?>