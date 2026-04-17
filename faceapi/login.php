<?php
include '../src/connect.php';
require_once '../src/auth.php';

$flashMessage = app_get_flash_message();

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    app_require_csrf_token('login.php');

    $email = app_normalize_email($_POST['email'] ?? '');
    $password = (string) ($_POST['password'] ?? '');

    if ($email === '' || $password === '') {
        app_redirect('login.php', 'Email and password are required.');
    }

    $statement = mysqli_prepare($conn, 'SELECT person_id, email, password, employee_type FROM person WHERE email = ? LIMIT 1');
    mysqli_stmt_bind_param($statement, 's', $email);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($statement);

    if (!$row || !app_verify_password($password, $row['password'])) {
        app_redirect('login.php', 'Wrong email or password.');
    }

    if (strcasecmp((string) $row['employee_type'], 'Police') !== 0) {
        app_redirect('login.php', 'Only authorized police users can use this service.');
    }

    if (app_password_needs_upgrade($row['password'])) {
        $newHash = app_hash_password($password);
        $updateStatement = mysqli_prepare($conn, 'UPDATE person SET password = ? WHERE person_id = ?');
        mysqli_stmt_bind_param($updateStatement, 'si', $newHash, $row['person_id']);
        mysqli_stmt_execute($updateStatement);
        mysqli_stmt_close($updateStatement);
    }

    app_start_session();
    session_regenerate_id(true);
    $_SESSION['email'] = $row['email'];
    $_SESSION['person_id'] = $row['person_id'];

    app_redirect('face.php', 'Login successful.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identification System | Police Login</title>
    <link rel="icon" href="../assets/img/logo.jpg">
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
    <link rel="stylesheet" href="../assets/css/tailwind-ui.css">
</head>
<body class="app-shell hero-grid">
    <div class="mx-auto flex min-h-screen max-w-[1480px] flex-col justify-center gap-6 px-4 py-6 lg:px-6">
        <section class="grid gap-6 lg:grid-cols-[1.08fr_0.92fr] lg:items-stretch">
            <div class="glass-panel-strong app-card overflow-hidden rounded-[2.25rem] p-6 md:p-8 lg:p-10">
                <div class="brand-badge">
                    <i class="fa fa-shield"></i>
                    Police-only access
                </div>
                <h1 class="mt-6 max-w-2xl text-4xl font-extrabold leading-tight text-white md:text-5xl">Secure face retrieval login for field operations.</h1>
                <p class="mt-5 max-w-2xl text-base leading-7 text-slate-300">Sign in with an authorized police account to open the browser-based face verification workspace. The retrieval service matches a live capture against enrolled references without requiring a claimed ID number first.</p>

                <div class="mt-8 grid gap-4 md:grid-cols-3">
                    <div class="app-stat">
                        <div class="app-stat-value">Face-only</div>
                        <div class="app-stat-label">Identity retrieval flow</div>
                    </div>
                    <div class="app-stat">
                        <div class="app-stat-value">Local models</div>
                        <div class="app-stat-label">Browser recognition stack</div>
                    </div>
                    <div class="app-stat">
                        <div class="app-stat-value">Restricted</div>
                        <div class="app-stat-label">Police accounts only</div>
                    </div>
                </div>

                <div class="mt-8 grid gap-4 md:grid-cols-2">
                    <div class="rounded-[1.5rem] border border-white/10 bg-slate-950/40 p-5">
                        <div class="app-kicker">What you can do</div>
                        <ul class="mt-4 space-y-2 text-sm leading-6 text-slate-300">
                            <li>Run camera-based face verification.</li>
                            <li>Retrieve person information from enrolled references.</li>
                            <li>Continue without the old Python search step.</li>
                        </ul>
                    </div>
                    <div class="rounded-[1.5rem] border border-white/10 bg-slate-950/40 p-5">
                        <div class="app-kicker">Security rules</div>
                        <ul class="mt-4 space-y-2 text-sm leading-6 text-slate-300">
                            <li>Only authorized police accounts are accepted.</li>
                            <li>Keep retrieved information confidential.</li>
                            <li>Use a stable network and a clear camera feed.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="glass-panel app-card rounded-[2.25rem] p-6 md:p-8 lg:p-10">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <div class="app-kicker">Access portal</div>
                        <h2 class="mt-3 text-3xl font-extrabold text-white">Police login</h2>
                    </div>
                    <a class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-white/10 bg-white/5 text-slate-200 transition hover:bg-white/10" href="../index.php" title="Back to home">
                        <i class="fa fa-times"></i>
                    </a>
                </div>

                <?php if ($flashMessage !== null) { ?>
                    <div class="mt-6"><?php echo app_render_flash_banner($flashMessage); ?></div>
                <?php } ?>

                <div class="mt-8 flex items-center gap-4 rounded-[1.5rem] border border-sky-400/20 bg-sky-400/10 px-5 py-4 text-sky-100">
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-sky-400/15 text-3xl">
                        <i class="fa fa-unlock-alt"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.18em] text-sky-200">Authorized access</p>
                        <p class="mt-1 text-sm text-sky-100/90">Enter your police account credentials to continue to live face retrieval.</p>
                    </div>
                </div>

                <form method="post" action="" class="mt-8 space-y-5">
                    <?php echo app_csrf_input(); ?>
                    <div>
                        <label class="app-label" for="email">Email address</label>
                        <input class="app-input" type="email" id="email" name="email" autocomplete="username" required placeholder="officer@service.gov.za">
                    </div>
                    <div>
                        <label class="app-label" for="password">Password</label>
                        <input class="app-input" type="password" id="password" name="password" autocomplete="current-password" required placeholder="Enter your password">
                    </div>
                    <button class="app-button app-button-primary h-[3.5rem] w-full justify-center" type="submit">
                        <i class="fa fa-sign-in"></i>
                        Login to Face Retrieval
                    </button>
                </form>

                <div class="mt-6 rounded-[1.5rem] border border-white/10 bg-slate-950/40 p-5 text-sm leading-6 text-slate-300">
                    This login is reserved for police operators. If your account is not assigned to police access, the face retrieval service will reject the session.
                </div>
            </div>
        </section>
    </div>
</body>
</html>
