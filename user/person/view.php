<?php
include 'inc/session.php';

$flashMessage = app_get_flash_message();

$person = null;
$personStatement = mysqli_prepare($conn, 'SELECT firstname, lastname, email, id_number, confirmed_acc, employee_type, city, province FROM person WHERE person_id = ? LIMIT 1');
mysqli_stmt_bind_param($personStatement, 'i', $id);
mysqli_stmt_execute($personStatement);
$personResult = mysqli_stmt_get_result($personStatement);
$person = mysqli_fetch_assoc($personResult);
mysqli_stmt_close($personStatement);

$faceCount = 0;
$faceStatement = mysqli_prepare($conn, 'SELECT COUNT(*) AS count FROM face_identification WHERE person_id = ?');
mysqli_stmt_bind_param($faceStatement, 'i', $id);
mysqli_stmt_execute($faceStatement);
$faceResult = mysqli_stmt_get_result($faceStatement);
$faceRow = mysqli_fetch_assoc($faceResult);
$faceCount = (int) ($faceRow['count'] ?? 0);
mysqli_stmt_close($faceStatement);

$crimeCount = 0;
$crimeStatement = mysqli_prepare($conn, 'SELECT COUNT(*) AS count FROM docket WHERE person_id = ?');
mysqli_stmt_bind_param($crimeStatement, 'i', $id);
mysqli_stmt_execute($crimeStatement);
$crimeResult = mysqli_stmt_get_result($crimeStatement);
$crimeRow = mysqli_fetch_assoc($crimeResult);
$crimeCount = (int) ($crimeRow['count'] ?? 0);
mysqli_stmt_close($crimeStatement);

$isConfirmed = isset($person['confirmed_acc']) && $person['confirmed_acc'] === '1';
$hasFace = $faceCount > 0;
$displayName = trim(($person['firstname'] ?? '') . ' ' . ($person['lastname'] ?? ''));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identification System | Dashboard</title>
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
                    <i class="fa fa-id-card-o"></i>
                    Citizen workspace
                </div>
                <h1 class="mt-4 text-2xl font-bold text-white"><?php echo htmlspecialchars($displayName !== '' ? $displayName : 'User', ENT_QUOTES, 'UTF-8'); ?></h1>
                <p class="mt-2 text-sm text-slate-400"><?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?></p>
            </div>

            <nav class="mt-6 space-y-2">
                <a class="app-sidebar-link is-active" href="view.php"><i class="fa fa-home w-5"></i><span>Dashboard</span></a>
                <a class="app-sidebar-link" href="profile.php"><i class="fa fa-user w-5"></i><span>Profile</span></a>
                <a class="app-sidebar-link" href="crecord.php"><i class="fa fa-folder-open w-5"></i><span>Criminal Record</span></a>
                <a class="app-sidebar-link" href="faceai.php"><i class="fa fa-camera w-5"></i><span>Capture Photo</span></a>
                <a class="app-sidebar-link" href="face-open.php"><i class="fa fa-image w-5"></i><span>View Photo</span></a>
                <a class="app-sidebar-link" href="../../account/logout.php"><i class="fa fa-power-off w-5"></i><span>Logout</span></a>
            </nav>

            <div class="mt-8 rounded-[1.5rem] border border-white/10 bg-slate-950/40 p-4">
                <div class="app-badge <?php echo $isConfirmed ? 'app-badge-success' : 'app-badge-warn'; ?>">
                    <?php echo $isConfirmed ? 'Confirmed account' : 'Awaiting approval'; ?>
                </div>
                <p class="mt-3 text-sm leading-6 text-slate-300">Role: <?php echo htmlspecialchars($person['employee_type'] ?? 'default', ENT_QUOTES, 'UTF-8'); ?></p>
                <p class="mt-1 text-sm leading-6 text-slate-300">ID number: <?php echo htmlspecialchars($person['id_number'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
        </aside>

        <main class="flex-1 space-y-6">
            <section class="glass-panel-strong app-card rounded-[2rem] p-6 md:p-8">
                <div class="flex flex-col gap-6 xl:flex-row xl:items-end xl:justify-between">
                    <div>
                        <div class="app-kicker">Personal overview</div>
                        <h2 class="mt-3 text-4xl font-extrabold text-white">Your identity dashboard</h2>
                        <p class="mt-4 max-w-3xl text-base leading-7 text-slate-300">Track your account readiness, keep your profile current, and manage the face record used by the verification workflow.</p>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <a class="app-button app-button-primary" href="profile.php"><i class="fa fa-pencil"></i>Edit profile</a>
                        <a class="app-button app-button-secondary" href="faceai.php"><i class="fa fa-camera"></i>Capture face</a>
                    </div>
                </div>
            </section>

            <?php if ($flashMessage) { ?>
                <?php echo app_render_flash_banner($flashMessage); ?>
            <?php } ?>

            <?php if (!$hasFace || !$isConfirmed) { ?>
                <section class="glass-panel app-card rounded-[1.75rem] p-5">
                    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                        <div>
                            <div class="app-badge app-badge-warn">Action needed</div>
                            <p class="mt-3 text-sm leading-6 text-slate-300">
                                <?php if (!$hasFace && !$isConfirmed) { ?>
                                    Add your facial identity record and wait for the authorities to confirm your account.
                                <?php } elseif (!$hasFace) { ?>
                                    Add your facial identity record to complete the verification workflow.
                                <?php } else { ?>
                                    Your account information still needs to be verified by the authorities.
                                <?php } ?>
                            </p>
                        </div>
                        <div class="flex gap-3">
                            <?php if (!$hasFace) { ?><a class="app-button app-button-primary" href="faceai.php">Add facial identity</a><?php } ?>
                            <?php if (!$isConfirmed) { ?><a class="app-button app-button-secondary" href="profile.php">Review profile</a><?php } ?>
                        </div>
                    </div>
                </section>
            <?php } ?>

            <section class="grid gap-4 md:grid-cols-3">
                <div class="app-stat">
                    <div class="app-stat-value"><?php echo $isConfirmed ? 'Ready' : 'Pending'; ?></div>
                    <div class="app-stat-label">Account status</div>
                </div>
                <div class="app-stat">
                    <div class="app-stat-value"><?php echo $hasFace ? '1' : '0'; ?></div>
                    <div class="app-stat-label">Facial record on file</div>
                </div>
                <div class="app-stat">
                    <div class="app-stat-value"><?php echo htmlspecialchars((string) $crimeCount, ENT_QUOTES, 'UTF-8'); ?></div>
                    <div class="app-stat-label">Criminal records linked</div>
                </div>
            </section>

            <section class="grid gap-6 xl:grid-cols-[1.15fr_0.85fr]">
                <div class="glass-panel app-card rounded-[2rem] p-6">
                    <div class="app-kicker">Quick actions</div>
                    <div class="mt-6 grid gap-4 md:grid-cols-2">
                        <a class="app-form-section block transition hover:-translate-y-1" href="profile.php">
                            <div class="flex items-center justify-between gap-4">
                                <span class="text-lg font-semibold text-white">Profile details</span>
                                <i class="fa fa-user text-sky-300"></i>
                            </div>
                            <p class="mt-2 text-sm leading-6 text-slate-300">Update personal, address, next-of-kin, and password details.</p>
                        </a>
                        <a class="app-form-section block transition hover:-translate-y-1" href="crecord.php">
                            <div class="flex items-center justify-between gap-4">
                                <span class="text-lg font-semibold text-white">Criminal file</span>
                                <i class="fa fa-folder-open text-amber-300"></i>
                            </div>
                            <p class="mt-2 text-sm leading-6 text-slate-300">View any case or docket information currently linked to your record.</p>
                        </a>
                        <a class="app-form-section block transition hover:-translate-y-1" href="faceai.php">
                            <div class="flex items-center justify-between gap-4">
                                <span class="text-lg font-semibold text-white">Capture photo</span>
                                <i class="fa fa-camera text-emerald-300"></i>
                            </div>
                            <p class="mt-2 text-sm leading-6 text-slate-300">Open the webcam flow to create or replace your saved face image.</p>
                        </a>
                        <a class="app-form-section block transition hover:-translate-y-1" href="face-open.php">
                            <div class="flex items-center justify-between gap-4">
                                <span class="text-lg font-semibold text-white">View saved face</span>
                                <i class="fa fa-image text-rose-300"></i>
                            </div>
                            <p class="mt-2 text-sm leading-6 text-slate-300">Preview the image currently stored for facial verification.</p>
                        </a>
                    </div>
                </div>

                <div class="glass-panel app-card rounded-[2rem] p-6">
                    <div class="app-kicker">Profile snapshot</div>
                    <h3 class="mt-3 text-2xl font-bold text-white">Current record summary</h3>
                    <dl class="mt-6 space-y-4 text-sm text-slate-300">
                        <div class="flex items-center justify-between gap-4 rounded-2xl border border-white/10 bg-slate-950/40 px-4 py-3">
                            <dt>Location</dt>
                            <dd><?php echo htmlspecialchars(trim(($person['city'] ?? '') . ' ' . ($person['province'] ?? '')), ENT_QUOTES, 'UTF-8'); ?></dd>
                        </div>
                        <div class="flex items-center justify-between gap-4 rounded-2xl border border-white/10 bg-slate-950/40 px-4 py-3">
                            <dt>Email</dt>
                            <dd><?php echo htmlspecialchars($person['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?></dd>
                        </div>
                        <div class="flex items-center justify-between gap-4 rounded-2xl border border-white/10 bg-slate-950/40 px-4 py-3">
                            <dt>Verification</dt>
                            <dd><?php echo $hasFace ? 'Face image available' : 'No face image yet'; ?></dd>
                        </div>
                    </dl>

                    <div class="app-divider my-6"></div>
                    <a class="app-button app-button-secondary w-full" href="inc/delete.php?value=<?php echo urlencode((string) $id); ?>" onclick="return confirm('Do you really want to delete your account?');">
                        <i class="fa fa-trash"></i>
                        Delete account
                    </a>
                </div>
            </section>
        </main>
    </div>
</body>
</html>