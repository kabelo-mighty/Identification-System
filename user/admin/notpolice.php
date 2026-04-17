<?php
require_once __DIR__ . '/inc/admin_actions.php';

admin_require_post_action('police.php');
$personId = admin_require_numeric_post_param('person_id', 'police.php');

if (!admin_person_exists($personId)) {
    app_redirect('police.php', 'Person not found.');
}

if (!admin_update_person_field($personId, 'employee_type', 'Default')) {
    app_redirect('police.php', 'Employment type could not be updated.');
}

app_redirect('police.php', 'Person is unassigned from the AI function.');