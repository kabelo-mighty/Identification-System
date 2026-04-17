<?php include 'inc/session.php'; ?>
<?php include 'inc/connect.php'; ?>
<?php
$flashMessage = app_get_flash_message();
$redirectPath = 'criminal.php';
$adminId = (int) $id;
$docketId = $_GET['value'] ?? '';

if (!ctype_digit((string) $docketId) || (int) $docketId <= 0) {
    app_redirect($redirectPath, 'Invalid docket selected.');
}

$docketId = (int) $docketId;

$docketStatement = mysqli_prepare(
    $conn,
    'SELECT d.docket_id, d.person_id, d.crime_type, d.year, p.firstname, p.lastname, p.id_number, p.country
     FROM docket d
     INNER JOIN person p ON p.person_id = d.person_id
     WHERE d.docket_id = ?
     LIMIT 1'
);
mysqli_stmt_bind_param($docketStatement, 'i', $docketId);
mysqli_stmt_execute($docketStatement);
$docketResult = mysqli_stmt_get_result($docketStatement);
$docket = mysqli_fetch_assoc($docketResult);
mysqli_stmt_close($docketStatement);

if (!$docket) {
    app_redirect($redirectPath, 'Docket not found.');
}

$adminName = 'Administrator';
$adminStatement = mysqli_prepare($conn, 'SELECT firstname, lastname FROM admin WHERE admin_id = ? LIMIT 1');
if ($adminStatement) {
    mysqli_stmt_bind_param($adminStatement, 'i', $adminId);
    mysqli_stmt_execute($adminStatement);
    $adminResult = mysqli_stmt_get_result($adminStatement);
    $adminRow = mysqli_fetch_assoc($adminResult);
    mysqli_stmt_close($adminStatement);

    if ($adminRow) {
        $adminName = trim($adminRow['firstname'] . ' ' . $adminRow['lastname']);
    }
}

$crimeTypeValue = trim((string) ($_POST['crimetype'] ?? $docket['crime_type']));
$yearValue = trim((string) ($_POST['year'] ?? $docket['year']));

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    app_require_csrf_token('editrec.php?value=' . $docketId);

    if ($crimeTypeValue === '' || $yearValue === '') {
        app_redirect('editrec.php?value=' . $docketId, 'Crime type and year are required.');
    }

    if (!preg_match('/^[A-Za-z][A-Za-z ]*[A-Za-z]$/', $crimeTypeValue)) {
        app_redirect('editrec.php?value=' . $docketId, 'Crime type must contain letters only.');
    }

    if (!preg_match('/^\d{4}$/', $yearValue)) {
        app_redirect('editrec.php?value=' . $docketId, 'Year must be a four-digit number.');
    }

    $updateStatement = mysqli_prepare($conn, 'UPDATE docket SET crime_type = ?, year = ? WHERE docket_id = ?');
    mysqli_stmt_bind_param($updateStatement, 'ssi', $crimeTypeValue, $yearValue, $docketId);
    $updated = mysqli_stmt_execute($updateStatement);
    mysqli_stmt_close($updateStatement);

    if (!$updated) {
        app_redirect('editrec.php?value=' . $docketId, 'Docket could not be updated.');
    }

    app_redirect($redirectPath, 'Information updated.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identification System | Edit Case</title>
    <link rel="icon" href="assets/img/logo.png">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Sora', 'ui-sans-serif', 'system-ui', 'sans-serif']
                    }
                }
            }
        };
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="../../assets/css/tailwind-ui.css">
</head>
<body class="app-shell hero-grid">
    <div class="mx-auto flex min-h-screen max-w-[1680px] flex-col gap-6 px-4 py-4 lg:flex-row lg:px-6">
        <aside class="glass-panel app-card w-full rounded-[2rem] p-5 lg:sticky lg:top-4 lg:h-[calc(100vh-2rem)] lg:w-80 lg:self-start">
            <div class="flex items-center gap-4 border-b border-white/10 pb-5">
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-amber-400/15 text-amber-300">
                    <i class="fa fa-folder-open text-xl"></i>
                </div>
                <div>
                    <div class="app-kicker">Admin console</div>
                    <h1 class="mt-1 text-xl font-bold text-white">Edit case</h1>
                </div>
            </div>

            <nav class="mt-6 space-y-2">
                <a class="app-sidebar-link" href="dashboard.php"><i class="fas fa-tachometer-alt w-5"></i><span>Dashboard</span></a>
                <a class="app-sidebar-link" href="face_backfill.php"><i class="fa fa-database w-5"></i><span>Face Cache Backfill</span></a>
                <a class="app-sidebar-link" href="people.php"><i class="fa fa-users w-5"></i><span>Citizens</span></a>
                <a class="app-sidebar-link" href="non_citi.php"><i class="fa fa-globe w-5"></i><span>Non Citizens</span></a>
                <a class="app-sidebar-link" href="police.php"><i class="fa fa-user-secret w-5"></i><span>Police</span></a>
                <a class="app-sidebar-link is-active" href="criminal.php"><i class="fa fa-folder-open w-5"></i><span>Cases</span></a>
                <a class="app-sidebar-link" href="report.php"><i class="fa fa-line-chart w-5"></i><span>Reports</span></a>
                <a class="app-sidebar-link" href="inc/logout.php"><i class="fa fa-power-off w-5"></i><span>Logout</span></a>
            </nav>

            <div class="mt-8 rounded-[1.5rem] border border-white/10 bg-slate-950/40 p-4">
                <div class="app-badge app-badge-info">Session</div>
                <p class="mt-3 text-lg font-semibold text-white"><?php echo htmlspecialchars($adminName, ENT_QUOTES, 'UTF-8'); ?></p>
                <p class="mt-1 text-sm text-slate-400"><?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
        </aside>

        <main class="flex-1 space-y-6">
            <section class="glass-panel-strong app-card rounded-[2rem] p-6 md:p-8">
                <div class="flex flex-col gap-5 xl:flex-row xl:items-end xl:justify-between">
                    <div>
                        <div class="app-kicker">Case maintenance</div>
                        <h2 class="mt-3 text-4xl font-extrabold text-white">Edit docket CSZAR<?php echo htmlspecialchars((string) $docket['docket_id'], ENT_QUOTES, 'UTF-8'); ?></h2>
                        <p class="mt-4 max-w-3xl text-base leading-7 text-slate-300">Update the case details for <?php echo htmlspecialchars(trim($docket['firstname'] . ' ' . $docket['lastname']), ENT_QUOTES, 'UTF-8'); ?> while keeping the record connected to the criminal registry.</p>
                    </div>
                    <div class="flex flex-col gap-3 sm:flex-row">
                        <a class="app-button app-button-secondary" href="criminal.php"><i class="fa fa-arrow-left"></i>Back to Cases</a>
                        <span class="app-badge app-badge-info self-start sm:self-center"><?php echo htmlspecialchars((string) $docket['id_number'], ENT_QUOTES, 'UTF-8'); ?></span>
                    </div>
                </div>
            </section>

            <?php if ($flashMessage !== null) { ?>
                <div><?php echo app_render_flash_banner($flashMessage); ?></div>
            <?php } ?>

            <section class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                <div class="app-stat">
                    <div class="app-stat-value">CSZAR<?php echo htmlspecialchars((string) $docket['docket_id'], ENT_QUOTES, 'UTF-8'); ?></div>
                    <div class="app-stat-label">Docket number</div>
                </div>
                <div class="app-stat">
                    <div class="app-stat-value"><?php echo htmlspecialchars((string) $docket['person_id'], ENT_QUOTES, 'UTF-8'); ?></div>
                    <div class="app-stat-label">Person ID</div>
                </div>
                <div class="app-stat">
                    <div class="app-stat-value"><?php echo htmlspecialchars((string) $docket['country'], ENT_QUOTES, 'UTF-8'); ?></div>
                    <div class="app-stat-label">Country</div>
                </div>
                <div class="app-stat">
                    <div class="app-stat-value"><?php echo htmlspecialchars((string) $docket['year'], ENT_QUOTES, 'UTF-8'); ?></div>
                    <div class="app-stat-label">Recorded year</div>
                </div>
            </section>

            <form method="post" action="" class="space-y-6">
                <?php echo app_csrf_input(); ?>
                <section class="glass-panel app-card rounded-[2rem] p-6">
                    <div class="app-kicker">Docket details</div>
                    <div class="mt-5 grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="app-label" for="crimetype">Crime type</label>
                            <input class="app-input" type="text" id="crimetype" name="crimetype" required value="<?php echo htmlspecialchars($crimeTypeValue, ENT_QUOTES, 'UTF-8'); ?>">
                        </div>
                        <div>
                            <label class="app-label" for="year">Year</label>
                            <input class="app-input" type="text" id="year" name="year" inputmode="numeric" maxlength="4" pattern="\d{4}" required value="<?php echo htmlspecialchars($yearValue, ENT_QUOTES, 'UTF-8'); ?>">
                        </div>
                    </div>
                </section>

                <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                    <a class="app-button app-button-secondary" href="criminal.php"><i class="fa fa-times"></i>Cancel</a>
                    <button class="app-button app-button-primary" type="submit"><i class="fa fa-save"></i>Save Changes</button>
                </div>
            </form>
        </main>
    </div>
</body>
</html>
