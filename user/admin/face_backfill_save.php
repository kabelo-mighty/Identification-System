<?php
include 'inc/session.php';
require_once '../../src/face_descriptor_cache.php';

header('Content-Type: application/json; charset=utf-8');

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    http_response_code(405);
    echo json_encode(['saved' => false, 'message' => 'Method not allowed.']);
    exit;
}

if (!app_verify_csrf_token($_POST['_csrf_token'] ?? '')) {
    http_response_code(403);
    echo json_encode(['saved' => false, 'message' => 'Invalid security token.']);
    exit;
}

$personId = (int) ($_POST['personId'] ?? 0);
$descriptor = json_decode((string) ($_POST['descriptor'] ?? '[]'), true);

if ($personId <= 0 || !is_array($descriptor) || count($descriptor) === 0) {
    http_response_code(422);
    echo json_encode(['saved' => false, 'message' => 'Invalid descriptor payload.']);
    exit;
}

$saved = app_upsert_face_descriptor_cache($conn, $personId, $descriptor);

if (!$saved) {
    http_response_code(500);
    echo json_encode(['saved' => false, 'message' => 'Descriptor cache could not be updated.']);
    exit;
}

echo json_encode(['saved' => true]);
?>