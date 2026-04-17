<?php
require_once __DIR__ . '/admin_actions.php';

admin_require_post_action('../non_citi.php');
$personId = admin_require_numeric_post_param('person_id', '../non_citi.php');

if (!admin_delete_person_records($personId)) {
    app_redirect('../non_citi.php', 'Record could not be deleted.');
}

app_redirect('../non_citi.php', 'Record deleted.');
