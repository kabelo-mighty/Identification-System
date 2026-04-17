<?php

include 'inc/session.php';
require_once '../../src/face_descriptor_cache.php';

header('Content-Type: application/json; charset=UTF-8');

function app_face_upload_response($success, $message, $extra = [])
{
    echo json_encode(array_merge([
        'success' => (bool) $success,
        'message' => (string) $message,
    ], $extra));
    exit;
}

if (!isset($_POST['photoStore'])) {
    app_face_upload_response(false, 'No captured image was received.');
}

$encoded_data = trim((string) $_POST['photoStore']);
if ($encoded_data === '') {
    app_face_upload_response(false, 'Captured image data is empty.');
}

$binary_data = base64_decode($encoded_data, true);
if ($binary_data === false) {
    app_face_upload_response(false, 'Captured image data is invalid.');
}

$descriptorPayload = json_decode((string) ($_POST['faceDescriptor'] ?? '[]'), true);
$photoName = $idno . '.jpg';
$photoPath = '../../faceapi/person_face_id/' . $photoName;

$result = @file_put_contents($photoPath, $binary_data);
if ($result === false) {
    app_face_upload_response(false, 'Could not save image. Check folder write permission for faceapi/person_face_id.');
}

$existingStatement = mysqli_prepare($conn, 'SELECT face_id FROM face_identification WHERE person_id = ? LIMIT 1');
if (!$existingStatement) {
    app_face_upload_response(false, 'Could not prepare the face record lookup.');
}

mysqli_stmt_bind_param($existingStatement, 'i', $id);
mysqli_stmt_execute($existingStatement);
$existingResult = mysqli_stmt_get_result($existingStatement);
$existingFace = mysqli_fetch_assoc($existingResult);
mysqli_stmt_close($existingStatement);

if ($existingFace) {
    $updateStatement = mysqli_prepare($conn, 'UPDATE face_identification SET picture = ? WHERE person_id = ?');
    if (!$updateStatement) {
        app_face_upload_response(false, 'Could not prepare the face record update.');
    }

    mysqli_stmt_bind_param($updateStatement, 'si', $idno, $id);
    $saved = mysqli_stmt_execute($updateStatement);
    mysqli_stmt_close($updateStatement);
} else {
    $insertStatement = mysqli_prepare($conn, 'INSERT INTO face_identification(person_id, picture) VALUES (?, ?)');
    if (!$insertStatement) {
        app_face_upload_response(false, 'Could not prepare the face record insert.');
    }

    mysqli_stmt_bind_param($insertStatement, 'is', $id, $idno);
    $saved = mysqli_stmt_execute($insertStatement);
    mysqli_stmt_close($insertStatement);
}

if (!$saved) {
    app_face_upload_response(false, 'The face record could not be saved to the database.');
}

if (is_array($descriptorPayload) && count($descriptorPayload) > 0) {
    app_upsert_face_descriptor_cache($conn, (int) $id, $descriptorPayload);
}

app_face_upload_response(true, 'Photo uploaded successfully.');