<?php

require_once __DIR__ . '/../../../src/auth.php';
include __DIR__ . '/session.php';

function admin_require_post_action($redirectPath)
{
    app_require_post_request($redirectPath);
    app_require_csrf_token($redirectPath);
}

function admin_require_numeric_post_param($key, $redirectPath)
{
    $value = $_POST[$key] ?? '';

    if (!ctype_digit((string) $value) || (int) $value <= 0) {
        app_redirect($redirectPath, 'Invalid request.');
    }

    return (int) $value;
}

function admin_person_exists($personId)
{
    global $conn;

    $statement = mysqli_prepare($conn, 'SELECT person_id FROM person WHERE person_id = ? LIMIT 1');
    mysqli_stmt_bind_param($statement, 'i', $personId);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($statement);

    return $row !== null;
}

function admin_update_person_field($personId, $field, $value)
{
    global $conn;

    $allowedFields = ['employee_type', 'confirmed_acc'];
    if (!in_array($field, $allowedFields, true)) {
        return false;
    }

    $sql = sprintf('UPDATE person SET %s = ? WHERE person_id = ?', $field);
    $statement = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($statement, 'si', $value, $personId);
    $ok = mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);

    return $ok;
}

function admin_delete_person_records($personId)
{
    global $conn;

    mysqli_begin_transaction($conn);

    try {
        $deleteFace = mysqli_prepare($conn, 'DELETE FROM face_identification WHERE person_id = ?');
        mysqli_stmt_bind_param($deleteFace, 'i', $personId);
        mysqli_stmt_execute($deleteFace);
        mysqli_stmt_close($deleteFace);

        $deleteDocket = mysqli_prepare($conn, 'DELETE FROM docket WHERE person_id = ?');
        mysqli_stmt_bind_param($deleteDocket, 'i', $personId);
        mysqli_stmt_execute($deleteDocket);
        mysqli_stmt_close($deleteDocket);

        $deletePerson = mysqli_prepare($conn, 'DELETE FROM person WHERE person_id = ?');
        mysqli_stmt_bind_param($deletePerson, 'i', $personId);
        mysqli_stmt_execute($deletePerson);
        $affectedRows = mysqli_stmt_affected_rows($deletePerson);
        mysqli_stmt_close($deletePerson);

        mysqli_commit($conn);

        return $affectedRows > 0;
    } catch (Throwable $exception) {
        mysqli_rollback($conn);
        return false;
    }
}

function admin_delete_docket_record($docketId)
{
    global $conn;

    $statement = mysqli_prepare($conn, 'DELETE FROM docket WHERE docket_id = ?');
    mysqli_stmt_bind_param($statement, 'i', $docketId);
    mysqli_stmt_execute($statement);
    $affectedRows = mysqli_stmt_affected_rows($statement);
    mysqli_stmt_close($statement);

    return $affectedRows > 0;
}