<?php
require_once __DIR__ . '/admin_actions.php';

admin_require_post_action('../criminal.php');
$docketId = admin_require_numeric_post_param('docket_id', '../criminal.php');

if (!admin_delete_docket_record($docketId)) {
    app_redirect('../criminal.php', 'Record could not be deleted.');
}

app_redirect('../criminal.php', 'Record successfully deleted.');