<?php include 'inc/session.php'; ?>
<?php include 'inc/connect.php'; ?>
<?php
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

function dashboard_count($conn, $query)
{
    $result = mysqli_query($conn, $query);
    if (!$result) {
        return '0';
    }

    $row = mysqli_fetch_assoc($result);
    return (string) ($row['count'] ?? '0');
}

$citizensCount = dashboard_count($conn, "SELECT COUNT(*) AS count FROM person WHERE country = 'South Africa'");
$nonCitizensCount = dashboard_count($conn, "SELECT COUNT(*) AS count FROM person WHERE country != 'South Africa'");
$facesCount = dashboard_count($conn, "SELECT COUNT(*) AS count FROM face_identification");
$policeCount = dashboard_count($conn, "SELECT COUNT(*) AS count FROM person WHERE employee_type = 'Police'");
$casesCount = dashboard_count($conn, "SELECT COUNT(*) AS count FROM docket");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identification System | Dashboard</title>
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
    <div class="mx-auto flex min-h-screen max-w-[1600px] flex-col gap-6 px-4 py-4 lg:flex-row lg:px-6">
        <aside class="glass-panel app-card w-full rounded-[2rem] p-5 lg:sticky lg:top-4 lg:h-[calc(100vh-2rem)] lg:w-80 lg:self-start">
            <div class="flex items-center gap-4 border-b border-white/10 pb-5">
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-400/15 text-emerald-300">
                    <i class="fa fa-shield text-xl"></i>
                </div>
                <div>
                    <div class="app-kicker">Admin console</div>
                    <h1 class="mt-1 text-xl font-bold text-white">Identification System</h1>
                </div>
            </div>

            <nav class="mt-6 space-y-2">
                <a class="app-sidebar-link is-active" href="dashboard.php"><i class="fas fa-tachometer-alt w-5"></i><span>Dashboard</span></a>
                <a class="app-sidebar-link" href="people.php"><i class="fa fa-users w-5"></i><span>Citizens</span></a>
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
                <div class="flex flex-col gap-6 xl:flex-row xl:items-end xl:justify-between">
                    <div>
                        <div class="app-kicker">Operations overview</div>
                        <h2 class="mt-3 text-4xl font-extrabold text-white">Dashboard</h2>
                        <p class="mt-4 max-w-3xl text-base leading-7 text-slate-300">Track record coverage, role assignments, and case activity from one modern operations surface.</p>
                    </div>
                    <div class="flex flex-col gap-3 sm:flex-row">
                        <a class="app-button app-button-primary" href="report.php"><i class="fa fa-download"></i>Generate Report</a>
                        <a class="app-button app-button-secondary" href="people.php"><i class="fa fa-arrow-right"></i>Manage Records</a>
                    </div>
                </div>
            </section>

            <section class="grid gap-4 md:grid-cols-2 xl:grid-cols-5">
                <div class="app-stat">
                    <div class="app-stat-value"><?php echo htmlspecialchars($citizensCount, ENT_QUOTES, 'UTF-8'); ?></div>
                    <div class="app-stat-label">South Africans</div>
                </div>
                <div class="app-stat">
                    <div class="app-stat-value"><?php echo htmlspecialchars($nonCitizensCount, ENT_QUOTES, 'UTF-8'); ?></div>
                    <div class="app-stat-label">Non South Africans</div>
                </div>
                <div class="app-stat">
                    <div class="app-stat-value"><?php echo htmlspecialchars($facesCount, ENT_QUOTES, 'UTF-8'); ?></div>
                    <div class="app-stat-label">Face records</div>
                </div>
                <div class="app-stat">
                    <div class="app-stat-value"><?php echo htmlspecialchars($policeCount, ENT_QUOTES, 'UTF-8'); ?></div>
                    <div class="app-stat-label">Police accounts</div>
                </div>
                <div class="app-stat">
                    <div class="app-stat-value"><?php echo htmlspecialchars($casesCount, ENT_QUOTES, 'UTF-8'); ?></div>
                    <div class="app-stat-label">Cases</div>
                </div>
            </section>

            <section class="grid gap-6 xl:grid-cols-[1.15fr_0.85fr]">
                <div class="glass-panel app-card rounded-[2rem] p-6">
                    <div class="app-kicker">Quick actions</div>
                    <h3 class="mt-3 text-2xl font-bold text-white">Move directly into operational tasks.</h3>
                    <div class="mt-6 grid gap-4 md:grid-cols-2">
                        <a class="app-form-section block transition hover:-translate-y-1" href="people.php">
                            <div class="flex items-center justify-between gap-4">
                                <span class="text-lg font-semibold text-white">Review citizen records</span>
                                <i class="fa fa-users text-sky-300"></i>
                            </div>
                            <p class="mt-2 text-sm leading-6 text-slate-300">Confirm accounts, update records, and manage citizen status.</p>
                        </a>
                        <a class="app-form-section block transition hover:-translate-y-1" href="police.php">
                            <div class="flex items-center justify-between gap-4">
                                <span class="text-lg font-semibold text-white">Manage police roles</span>
                                <i class="fa fa-user-secret text-emerald-300"></i>
                            </div>
                            <p class="mt-2 text-sm leading-6 text-slate-300">View assigned officers and maintain police-specific accounts.</p>
                        </a>
                        <a class="app-form-section block transition hover:-translate-y-1" href="criminal.php">
                            <div class="flex items-center justify-between gap-4">
                                <span class="text-lg font-semibold text-white">Open case records</span>
                                <i class="fa fa-folder-open text-amber-300"></i>
                            </div>
                            <p class="mt-2 text-sm leading-6 text-slate-300">Inspect and update docket entries linked to person records.</p>
                        </a>
                        <a class="app-form-section block transition hover:-translate-y-1" href="report.php">
                            <div class="flex items-center justify-between gap-4">
                                <span class="text-lg font-semibold text-white">Export reporting</span>
                                <i class="fa fa-line-chart text-rose-300"></i>
                            </div>
                            <p class="mt-2 text-sm leading-6 text-slate-300">Generate summaries and inspect the broader dataset.</p>
                        </a>
                    </div>
                </div>

                <div class="glass-panel app-card rounded-[2rem] p-6">
                    <div class="app-kicker">System focus</div>
                    <h3 class="mt-3 text-2xl font-bold text-white">Where this platform is strongest.</h3>
                    <div class="mt-6 space-y-4">
                        <div class="app-form-section">
                            <div class="app-badge app-badge-success">Identity</div>
                            <p class="mt-3 text-sm leading-6 text-slate-300">Centralized records connect personal details, contact data, next-of-kin, and operational role information.</p>
                        </div>
                        <div class="app-form-section">
                            <div class="app-badge app-badge-info">Verification</div>
                            <p class="mt-3 text-sm leading-6 text-slate-300">Face-record coverage can be tracked from the dashboard and linked to the facial verification workflow.</p>
                        </div>
                        <div class="app-form-section">
                            <div class="app-badge app-badge-warn">Operations</div>
                            <p class="mt-3 text-sm leading-6 text-slate-300">Account confirmation, police assignment, criminal cases, and reporting stay within one admin workflow.</p>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>