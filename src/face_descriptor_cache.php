<?php

function app_ensure_face_descriptor_cache_table($conn)
{
    static $isReady = false;

    if ($isReady) {
        return true;
    }

    $query = "CREATE TABLE IF NOT EXISTS face_descriptor_cache (
        person_id INT(11) NOT NULL,
        descriptor_json LONGTEXT NOT NULL,
        updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (person_id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

    $isReady = (bool) mysqli_query($conn, $query);

    return $isReady;
}

function app_upsert_face_descriptor_cache($conn, $personId, $descriptor)
{
    if (!app_ensure_face_descriptor_cache_table($conn)) {
        return false;
    }

    $normalized = [];
    foreach ((array) $descriptor as $value) {
        $normalized[] = (float) $value;
    }

    $descriptorJson = json_encode($normalized);
    if ($descriptorJson === false) {
        return false;
    }

    $statement = mysqli_prepare(
        $conn,
        'INSERT INTO face_descriptor_cache (person_id, descriptor_json) VALUES (?, ?)
         ON DUPLICATE KEY UPDATE descriptor_json = VALUES(descriptor_json), updated_at = CURRENT_TIMESTAMP'
    );

    if (!$statement) {
        return false;
    }

    mysqli_stmt_bind_param($statement, 'is', $personId, $descriptorJson);
    $saved = mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);

    return $saved;
}