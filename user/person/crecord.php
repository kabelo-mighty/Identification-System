<?php
include 'inc/session.php';

$flashMessage = app_get_flash_message();

$records = [];
$statement = mysqli_prepare($conn, 'SELECT docket_id, crime_type, year FROM docket WHERE person_id = ? ORDER BY year DESC, docket_id DESC');
mysqli_stmt_bind_param($statement, 'i', $id);
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);
while ($row = mysqli_fetch_assoc($result)) {
    $records[] = $row;
}
mysqli_stmt_close($statement);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identification System | Criminal Record</title>
    <link rel="icon" href="../../assets/img/logo.jpg">
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
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets/css/tailwind-ui.css">
</head>
<body class="app-shell hero-grid">
    <div class="mx-auto flex min-h-screen max-w-[1600px] flex-col gap-6 px-4 py-4 lg:flex-row lg:px-6">
        <aside class="glass-panel app-card w-full rounded-[2rem] p-5 lg:sticky lg:top-4 lg:h-[calc(100vh-2rem)] lg:w-80 lg:self-start">
            <div class="border-b border-white/10 pb-5">
                <div class="brand-badge">
                    <i class="fa fa-folder-open"></i>
                    Record center
                </div>
                <h1 class="mt-4 text-2xl font-bold text-white">Criminal Record</h1>
                <p class="mt-2 text-sm text-slate-400"><?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
            <nav class="mt-6 space-y-2">
                <a class="app-sidebar-link" href="view.php"><i class="fa fa-home w-5"></i><span>Dashboard</span></a>
                <a class="app-sidebar-link" href="profile.php"><i class="fa fa-user w-5"></i><span>Profile</span></a>
                <a class="app-sidebar-link is-active" href="crecord.php"><i class="fa fa-folder-open w-5"></i><span>Criminal Record</span></a>
                <a class="app-sidebar-link" href="faceai.php"><i class="fa fa-camera w-5"></i><span>Capture Photo</span></a>
                <a class="app-sidebar-link" href="face-open.php"><i class="fa fa-image w-5"></i><span>View Photo</span></a>
            </nav>
        </aside>

        <main class="flex-1 space-y-6">
            <section class="glass-panel-strong app-card rounded-[2rem] p-6 md:p-8">
                <div class="app-kicker">Linked case history</div>
                <h2 class="mt-3 text-4xl font-extrabold text-white">Criminal file</h2>
                <p class="mt-4 max-w-3xl text-base leading-7 text-slate-300">This section shows any docket information currently linked to your person record.</p>
            </section>

            <?php if ($flashMessage) { ?>
                <?php echo app_render_flash_banner($flashMessage); ?>
            <?php } ?>

            <section class="glass-panel app-card rounded-[2rem] p-6">
                <?php if ($records) { ?>
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left text-sm text-slate-300">
                            <thead>
                                <tr class="border-b border-white/10 text-xs uppercase tracking-[0.2em] text-slate-400">
                                    <th class="px-4 py-3">Docket</th>
                                    <th class="px-4 py-3">Criminal record type</th>
                                    <th class="px-4 py-3">Year</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($records as $record) { ?>
                                    <tr class="border-b border-white/5">
                                        <td class="px-4 py-4 font-semibold text-white">DOC100<?php echo htmlspecialchars((string) $record['docket_id'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="px-4 py-4"><?php echo htmlspecialchars($record['crime_type'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="px-4 py-4"><?php echo htmlspecialchars($record['year'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } else { ?>
                    <div class="rounded-[1.5rem] border border-white/10 bg-slate-950/40 px-6 py-10 text-center">
                        <div class="app-badge app-badge-success">Clear record</div>
                        <h3 class="mt-4 text-2xl font-bold text-white">No criminal record linked.</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-300">There are currently no case or docket entries associated with this account.</p>
                    </div>
                <?php } ?>
            </section>
        </main>
    </div>
</body>
</html>