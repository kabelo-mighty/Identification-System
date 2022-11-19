<?php

//session
include 'inc/session.php';

if(isset($_POST['photoStore'])) {
    $encoded_data = $_POST['photoStore'];
    $binary_data = base64_decode($encoded_data);

    $photoname = $idno.'.jpg';

    $result = file_put_contents('../../faceapi/person_face_id/'.$photoname, $binary_data);

    $query="select * from face_identification where person_id='$id'";
    $results=mysqli_query($conn,$query) or die(mysqli_error($conn));
    $row=mysqli_fetch_array($results);


    //check if the face id exist
    $qry=mysqli_query($conn,"select * from face_identification WHERE person_id='$id'");
    $data=mysqli_fetch_array($qry);

    if($result) {

        if($data['picture']==$idno)
        {

            $command="UPDATE  face_identification
            SET 
            picture='$idno'
            WHERE person_id='$id'";
            $edit=mysqli_query($conn,$command);

            echo 'success'; 

        }else{

        $sql="INSERT INTO face_identification(person_id, picture) 
        VALUES ('$id','$idno')";

        if(mysqli_query($conn,$sql))
        {
          
            echo 'success';  
              }
      else{
        
       die("<h3>unsuccessfully </h3>".mysqli_error($conn));
     
     }

        }

        

       
    } else {
        echo die('Could not save image! check file permission.');
    }


}