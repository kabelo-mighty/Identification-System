<?php
require_once __DIR__ . '/admin_actions.php';

admin_require_post_action('../people.php');
$personId = admin_require_numeric_post_param('person_id', '../people.php');

if (!admin_delete_person_records($personId)) {
    app_redirect('../people.php', 'Record could not be deleted.');
}

app_redirect('../people.php', 'Record deleted.');


