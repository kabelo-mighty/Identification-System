<?php
include 'person_face_id/inc/session.php';
require_once '../src/face_descriptor_cache.php';

header('Content-Type: application/json; charset=utf-8');

$references = [];

app_ensure_face_descriptor_cache_table($conn);

$statement = mysqli_prepare(
    $conn,
        'SELECT p.person_id, p.id_number, p.firstname, p.lastname, f.picture, c.descriptor_json
     FROM face_identification f
     INNER JOIN person p ON p.person_id = f.person_id
         LEFT JOIN face_descriptor_cache c ON c.person_id = p.person_id
     WHERE f.picture <> ?
       AND p.id_number <> ?
       AND CHAR_LENGTH(p.id_number) = 13'
);

$empty = '';
mysqli_stmt_bind_param($statement, 'ss', $empty, $empty);
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);

while ($row = mysqli_fetch_assoc($result)) {
    $references[] = [
        'personId' => (int) $row['person_id'],
        'idNumber' => (string) $row['id_number'],
        'fullName' => trim($row['firstname'] . ' ' . $row['lastname']),
        'imagePath' => 'person_face_id/' . $row['picture'] . '.jpg',
        'descriptor' => $row['descriptor_json'] ? json_decode($row['descriptor_json'], true) : null,
    ];
}

mysqli_stmt_close($statement);

echo json_encode([
    'count' => count($references),
    'references' => $references,
]);
?>