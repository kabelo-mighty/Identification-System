<?php

 //connection
 include 'connect.php';  

if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['phone']))
{
 $id=$_GET['value'];
    
//variables
    $name=$_POST['firstname'];
    $surname=$_POST['lastname'];
    $email=$_POST['email'];
    $cellno=$_POST['phone'];
   
    //hash up password

    $sql="INSERT INTO next_keen(person_id,firstname, lastname,phone,email) 
    VALUES ('$id','$name','$surname','$cellno','$email')";



            

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