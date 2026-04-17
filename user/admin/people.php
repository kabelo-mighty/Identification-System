<?php include 'inc/session.php'; ?>
<?php include 'inc/connect.php'; ?>
<?php
$flashMessage = app_get_flash_message();

$adminName = 'Administrator';
$adminStatement = mysqli_prepare($conn, 'SELECT firstname, lastname FROM admin WHERE admin_id = ? LIMIT 1');
if ($adminStatement) {
    mysqli_stmt_bind_param($adminStatement, 'i', $id);
    mysqli_stmt_execute($adminStatement);
    $adminResult = mysqli_stmt_get_result($adminStatement);
    $adminRow = mysqli_fetch_assoc($adminResult);
    mysqli_stmt_close($adminStatement);

    if ($adminRow) {
        $adminName = trim($adminRow['firstname'] . ' ' . $adminRow['lastname']);
    }
}

$people = [];
$query = "SELECT * FROM person WHERE country = 'South Africa' ORDER BY person_id DESC";
$result = mysqli_query($conn, $query);

$confirmedCount = 0;
$policeCount = 0;

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $isConfirmed = (string) $row['confirmed_acc'] === '1';
        $isPolice = strcasecmp((string) $row['employee_type'], 'Police') === 0;

        if ($isConfirmed) {
            $confirmedCount += 1;
        }

        if ($isPolice) {
            $policeCount += 1;
        }

        $people[] = [
            'person_id' => (int) $row['person_id'],
            'full_name' => trim($row['firstname'] . ' ' . $row['lastname']),
            'id_number' => (string) $row['id_number'],
            'gender' => (string) $row['gender'],
            'phone' => (string) $row['phone'],
            'email' => (string) $row['email'],
            'confirmed' => $isConfirmed,
            'is_police' => $isPolice,
            'employee_type' => (string) $row['employee_type'],
        ];
    }
}

$citizensCount = count($people);
$defaultCount = $citizensCount - $policeCount;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identification System | Citizens</title>
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
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-sky-400/15 text-sky-300">
                    <i class="fa fa-users text-xl"></i>
                </div>
                <div>
                    <div class="app-kicker">Admin console</div>
                    <h1 class="mt-1 text-xl font-bold text-white">Citizen records</h1>
                </div>
            </div>

            <nav class="mt-6 space-y-2">
                <a class="app-sidebar-link" href="dashboard.php"><i class="fas fa-tachometer-alt w-5"></i><span>Dashboard</span></a>
                <a class="app-sidebar-link" href="face_backfill.php"><i class="fa fa-database w-5"></i><span>Face Cache Backfill</span></a>
                <a class="app-sidebar-link is-active" href="people.php"><i class="fa fa-users w-5"></i><span>Citizens</span></a>
                <a class="app-sidebar-link" href="non_citi.php"><i class="fa fa-globe w-5"></i><span>Non Citizens</span></a>
                <a class="app-sidebar-link" href="police.php"><i class="fa fa-user-secret w-5"></i><span>Police</span></a>
                <a class="app-sidebar-link" href="criminal.php"><i class="fa fa-folder-open w-5"></i><span>Cases</span></a>
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
                        <div class="app-kicker">Registry overview</div>
                        <h2 class="mt-3 text-4xl font-extrabold text-white">South African citizens</h2>
                        <p class="mt-4 max-w-3xl text-base leading-7 text-slate-300">Review citizen accounts, confirm access, and manage police assignment from one consistent admin surface.</p>
                    </div>
                    <div class="rounded-[1.5rem] border border-white/10 bg-slate-950/40 px-5 py-4 text-sm text-slate-300">
                        <div class="font-semibold text-white">Operational note</div>
                        <p class="mt-2 max-w-sm leading-6">Account confirmation and role assignment actions remain protected with CSRF tokens and post-only forms.</p>
                    </div>
                </div>
            </section>

            <?php if ($flashMessage !== null) { ?>
                <div><?php echo app_render_flash_banner($flashMessage); ?></div>
            <?php } ?>

            <section class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                <div class="app-stat">
                    <div class="app-stat-value"><?php echo htmlspecialchars((string) $citizensCount, ENT_QUOTES, 'UTF-8'); ?></div>
                    <div class="app-stat-label">Citizen records</div>
                </div>
                <div class="app-stat">
                    <div class="app-stat-value"><?php echo htmlspecialchars((string) $confirmedCount, ENT_QUOTES, 'UTF-8'); ?></div>
                    <div class="app-stat-label">Confirmed accounts</div>
                </div>
                <div class="app-stat">
                    <div class="app-stat-value"><?php echo htmlspecialchars((string) $policeCount, ENT_QUOTES, 'UTF-8'); ?></div>
                    <div class="app-stat-label">Police assigned</div>
                </div>
                <div class="app-stat">
                    <div class="app-stat-value"><?php echo htmlspecialchars((string) $defaultCount, ENT_QUOTES, 'UTF-8'); ?></div>
                    <div class="app-stat-label">Default assignment</div>
                </div>
            </section>

            <section class="glass-panel app-card rounded-[2rem] p-6">
                <div class="flex flex-col gap-4 border-b border-white/10 pb-5 lg:flex-row lg:items-end lg:justify-between">
                    <div>
                        <div class="app-kicker">Citizen table</div>
                        <h3 class="mt-2 text-2xl font-bold text-white">Manage people records</h3>
                    </div>
                    <div class="text-sm text-slate-400">Showing <?php echo htmlspecialchars((string) $citizensCount, ENT_QUOTES, 'UTF-8'); ?> registered South African citizen records.</div>
                </div>

                <?php if ($citizensCount === 0) { ?>
                    <div class="mt-6 rounded-[1.5rem] border border-white/10 bg-slate-950/40 px-5 py-8 text-center text-slate-300">No citizen records are available yet.</div>
                <?php } else { ?>
                    <div class="mt-6 overflow-x-auto">
                        <table class="min-w-full divide-y divide-white/10 text-left text-sm text-slate-300">
                            <thead>
                                <tr class="text-xs uppercase tracking-[0.18em] text-slate-400">
                                    <th class="px-4 py-3 font-semibold">No.</th>
                                    <th class="px-4 py-3 font-semibold">Name</th>
                                    <th class="px-4 py-3 font-semibold">ID Number</th>
                                    <th class="px-4 py-3 font-semibold">Gender</th>
                                    <th class="px-4 py-3 font-semibold">Phone</th>
                                    <th class="px-4 py-3 font-semibold">Email</th>
                                    <th class="px-4 py-3 font-semibold">Account</th>
                                    <th class="px-4 py-3 font-semibold">Employment</th>
                                    <th class="px-4 py-3 font-semibold">Assignment</th>
                                    <th class="px-4 py-3 font-semibold">Confirmation</th>
                                    <th class="px-4 py-3 font-semibold">Record</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                <?php foreach ($people as $index => $person) { ?>
                                    <tr class="align-top transition hover:bg-white/5">
                                        <td class="px-4 py-4 text-slate-400"><?php echo htmlspecialchars((string) ($index + 1), ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="px-4 py-4">
                                            <div class="font-semibold text-white"><?php echo htmlspecialchars($person['full_name'] !== '' ? $person['full_name'] : 'Unknown person', ENT_QUOTES, 'UTF-8'); ?></div>
                                        </td>
                                        <td class="px-4 py-4 font-medium text-slate-200"><?php echo htmlspecialchars($person['id_number'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="px-4 py-4"><?php echo htmlspecialchars($person['gender'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="px-4 py-4"><?php echo htmlspecialchars($person['phone'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="px-4 py-4"><?php echo htmlspecialchars($person['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="px-4 py-4">
                                            <span class="app-badge <?php echo $person['confirmed'] ? 'app-badge-success' : 'app-badge-warn'; ?>"><?php echo $person['confirmed'] ? 'Confirmed' : 'Pending'; ?></span>
                                        </td>
                                        <td class="px-4 py-4">
                                            <span class="app-badge <?php echo $person['is_police'] ? 'app-badge-info' : 'app-badge-warn'; ?>"><?php echo htmlspecialchars($person['is_police'] ? 'Police' : 'Default', ENT_QUOTES, 'UTF-8'); ?></span>
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="flex flex-wrap gap-2">
                                                <form method="post" action="assign.php">
                                                    <?php echo app_csrf_input(); ?>
                                                    <input type="hidden" name="person_id" value="<?php echo htmlspecialchars((string) $person['person_id'], ENT_QUOTES, 'UTF-8'); ?>">
                                                    <button class="rounded-full border border-emerald-400/20 bg-emerald-400/10 px-3 py-2 text-xs font-semibold text-emerald-200 transition hover:bg-emerald-400/20" type="submit">Assign</button>
                                                </form>
                                                <form method="post" action="unassign.php">
                                                    <?php echo app_csrf_input(); ?>
                                                    <input type="hidden" name="person_id" value="<?php echo htmlspecialchars((string) $person['person_id'], ENT_QUOTES, 'UTF-8'); ?>">
                                                    <button class="rounded-full border border-white/10 bg-white/5 px-3 py-2 text-xs font-semibold text-slate-200 transition hover:bg-white/10" type="submit">Unassign</button>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="flex flex-wrap gap-2">
                                                <form method="post" action="confirm.php">
                                                    <?php echo app_csrf_input(); ?>
                                                    <input type="hidden" name="person_id" value="<?php echo htmlspecialchars((string) $person['person_id'], ENT_QUOTES, 'UTF-8'); ?>">
                                                    <button class="rounded-full border border-sky-400/20 bg-sky-400/10 px-3 py-2 text-xs font-semibold text-sky-100 transition hover:bg-sky-400/20" type="submit">Confirm</button>
                                                </form>
                                                <form method="post" action="notconfirm.php">
                                                    <?php echo app_csrf_input(); ?>
                                                    <input type="hidden" name="person_id" value="<?php echo htmlspecialchars((string) $person['person_id'], ENT_QUOTES, 'UTF-8'); ?>">
                                                    <button class="rounded-full border border-amber-400/20 bg-amber-400/10 px-3 py-2 text-xs font-semibold text-amber-100 transition hover:bg-amber-400/20" type="submit">Unconfirm</button>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="flex items-center gap-3">
                                                <a class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-sky-400/20 bg-sky-400/10 text-sky-200 transition hover:bg-sky-400/20" href="view.php?value=<?php echo htmlspecialchars((string) $person['person_id'], ENT_QUOTES, 'UTF-8'); ?>" title="View record">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <form method="post" action="inc/delete.php" onsubmit="return confirm('Do you really want to delete the record?');">
                                                    <?php echo app_csrf_input(); ?>
                                                    <input type="hidden" name="person_id" value="<?php echo htmlspecialchars((string) $person['person_id'], ENT_QUOTES, 'UTF-8'); ?>">
                                                    <button class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-rose-400/20 bg-rose-400/10 text-rose-200 transition hover:bg-rose-400/20" type="submit" title="Delete record">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } ?>
            </section>
        </main>
    </div>
</body>
</html>