<?php
include '../../src/connect.php';
require_once '../../src/auth.php';

$flashMessage = app_get_flash_message();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = app_normalize_email($_POST['email'] ?? '');
    $password = (string) ($_POST['password'] ?? '');

    if ($email === '' || $password === '') {
        app_redirect('index.php', 'Email and password are required.');
    }

    $statement = mysqli_prepare($conn, 'SELECT admin_id, email, password FROM admin WHERE email = ? LIMIT 1');
    mysqli_stmt_bind_param($statement, 's', $email);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($statement);

    if (!$row || !app_verify_password($password, $row['password'])) {
        app_redirect('index.php', 'Wrong email or password.');
    }

    if (app_password_needs_upgrade($row['password'])) {
        $newHash = app_hash_password($password);
        $updateStatement = mysqli_prepare($conn, 'UPDATE admin SET password = ? WHERE admin_id = ?');
        mysqli_stmt_bind_param($updateStatement, 'si', $newHash, $row['admin_id']);
        mysqli_stmt_execute($updateStatement);
        mysqli_stmt_close($updateStatement);
    }

    app_start_session();
    session_regenerate_id(true);
    $_SESSION['email'] = $row['email'];
    $_SESSION['admin_id'] = $row['admin_id'];

    app_redirect('dashboard.php', 'Login was successful.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identification System | Admin Login</title>
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
    <main class="mx-auto grid min-h-screen max-w-7xl gap-10 px-6 py-8 lg:grid-cols-[1fr_1fr] lg:items-center lg:px-8">
        <section class="glass-panel app-card rounded-[2rem] p-7 md:p-10">
            <div class="app-badge app-badge-warn">Operations workspace</div>
            <h1 class="mt-5 text-4xl font-extrabold text-white md:text-5xl">A control room for identity operations.</h1>
            <p class="mt-5 text-base leading-7 text-slate-300">Admin access controls people records, case handling, police assignments, report generation, and account approval from one dashboard.</p>

            <div class="mt-8 grid gap-4">
                <div class="app-form-section">
                    <h2 class="text-lg font-semibold text-white">What you can manage</h2>
                    <ul class="mt-3 space-y-2 text-sm leading-6 text-slate-300">
                        <li>Citizen and non-citizen records</li>
                        <li>Police assignments and account confirmations</li>
                        <li>Cases, reporting, and facial record coverage</li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="glass-panel-strong app-card rounded-[2rem] p-7 md:p-10">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <div class="app-kicker">Restricted access</div>
                    <h2 class="mt-3 text-3xl font-bold text-white">Admin Login</h2>
                </div>
                <a class="brand-badge" href="../../index.php">
                    <i class="fa fa-home"></i>
                    Home
                </a>
            </div>

            <div class="mt-6">
                <?php echo app_render_flash_banner($flashMessage); ?>
            </div>

            <form class="mt-6 space-y-5" method="post" action="">
                <div>
                    <label class="app-label" for="email">Admin email</label>
                    <input class="app-input" type="email" id="email" name="email" placeholder="admin@example.com" required>
                </div>
                <div>
                    <label class="app-label" for="password">Password</label>
                    <input class="app-input" type="password" id="password" name="password" placeholder="Enter your admin password" required>
                </div>
                <button class="app-button app-button-primary w-full" type="submit">
                    <i class="fa fa-unlock-alt"></i>
                    Enter Dashboard
                </button>
            </form>
        </section>
    </main>
</body>
</html>