<?php
require_once __DIR__ . '/inc/admin_actions.php';

admin_require_post_action('people.php');
$personId = admin_require_numeric_post_param('person_id', 'people.php');

if (!admin_person_exists($personId)) {
    app_redirect('people.php', 'Person not found.');
}

if (!admin_update_person_field($personId, 'employee_type', 'Police')) {
    app_redirect('people.php', 'Employment type could not be updated.');
}

app_redirect('people.php', 'Person is now allowed to use the AI function.');
