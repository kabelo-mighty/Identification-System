<?php include 'inc/session.php'; ?>
<?php
$docketId = $_GET['value'] ?? '';

if (!ctype_digit((string) $docketId) || (int) $docketId <= 0) {
    app_redirect('criminal.php', 'Invalid docket selected.');
}

app_redirect('editrec.php?value=' . rawurlencode((string) $docketId));
