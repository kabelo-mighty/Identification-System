<?php

//session
include 'inc/session.php';
require_once '../../src/face_descriptor_cache.php';

if(isset($_POST['photoStore'])) {
    $encoded_data = $_POST['photoStore'];
    $binary_data = base64_decode($encoded_data);
    $descriptorPayload = json_decode((string) ($_POST['faceDescriptor'] ?? '[]'), true);

    $photoname = $idno.'.jpg';

    $result = file_put_contents('../../faceapi/person_face_id/'.$photoname, $binary_data);

    if($result) {
        $existingStatement = mysqli_prepare($conn, 'SELECT face_id FROM face_identification WHERE person_id = ? LIMIT 1');
        mysqli_stmt_bind_param($existingStatement, 'i', $id);
        mysqli_stmt_execute($existingStatement);
        $existingResult = mysqli_stmt_get_result($existingStatement);
        $existingFace = mysqli_fetch_assoc($existingResult);
        mysqli_stmt_close($existingStatement);

        if ($existingFace) {
            $updateStatement = mysqli_prepare($conn, 'UPDATE face_identification SET picture = ? WHERE person_id = ?');
            mysqli_stmt_bind_param($updateStatement, 'si', $idno, $id);
            $saved = mysqli_stmt_execute($updateStatement);
            mysqli_stmt_close($updateStatement);
        } else {
            $insertStatement = mysqli_prepare($conn, 'INSERT INTO face_identification(person_id, picture) VALUES (?, ?)');
            mysqli_stmt_bind_param($insertStatement, 'is', $id, $idno);
            $saved = mysqli_stmt_execute($insertStatement);
            mysqli_stmt_close($insertStatement);
        }

        if (!$saved) {
            die('<h3>unsuccessfully </h3>' . mysqli_error($conn));
        }

        if (is_array($descriptorPayload) && count($descriptorPayload) > 0) {
            app_upsert_face_descriptor_cache($conn, (int) $id, $descriptorPayload);
        }

        echo 'success';
    } else {
        echo die('Could not save image! check file permission.');
    }


}