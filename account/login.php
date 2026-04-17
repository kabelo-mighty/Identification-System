<?php
include '../src/connect.php';
require_once '../src/auth.php';

$flashMessage = app_get_flash_message();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = app_normalize_email($_POST['email'] ?? '');
    $password = (string) ($_POST['password'] ?? '');

    if ($email === '' || $password === '') {
        app_redirect('login.php', 'Email and password are required.');
    }

    $statement = mysqli_prepare($conn, 'SELECT person_id, email, password, id_number, confirmed_acc FROM person WHERE email = ? LIMIT 1');
    mysqli_stmt_bind_param($statement, 's', $email);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($statement);

    if (!$row) {
        app_redirect('login.php', 'Wrong email or password.');
    }

    if ($row['confirmed_acc'] !== '1') {
        app_redirect('login.php', 'Account not confirmed.');
    }

    if (!app_verify_password($password, $row['password'])) {
        app_redirect('login.php', 'Wrong email or password.');
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
    $_SESSION['id_number'] = $row['id_number'];

    app_redirect('../user/person/view.php', 'Login was successful.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identification System | Login</title>
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
    <main class="mx-auto grid min-h-screen max-w-7xl gap-10 px-6 py-8 lg:grid-cols-[1.05fr_0.95fr] lg:items-center lg:px-8">
        <section class="py-8">
            <a class="brand-badge" href="../index.php">
                <i class="fa fa-chevron-left"></i>
                Back to home
            </a>
            <div class="mt-8 max-w-2xl">
                <div class="app-kicker mb-4">Citizen access</div>
                <h1 class="text-5xl font-extrabold leading-tight text-white md:text-6xl">A cleaner front door for verified identity access.</h1>
                <p class="mt-6 text-lg leading-8 text-slate-300">Sign in to manage your profile, maintain your facial identity record, and access your linked information from a more modern workspace.</p>
            </div>

            <div class="mt-10 grid gap-4 sm:grid-cols-2">
                <div class="app-stat">
                    <div class="app-badge app-badge-success">Secure</div>
                    <div class="mt-4 text-lg font-semibold text-white">Verified account login</div>
                    <p class="mt-2 text-sm leading-6 text-slate-300">Confirmed accounts can access their profile and identity workflows.</p>
                </div>
                <div class="app-stat">
                    <div class="app-badge app-badge-info">Connected</div>
                    <div class="mt-4 text-lg font-semibold text-white">Profile and face services</div>
                    <p class="mt-2 text-sm leading-6 text-slate-300">Update information, store a face image, and work from a unified account area.</p>
                </div>
            </div>
        </section>

        <section class="glass-panel-strong app-card rounded-[2rem] p-7 md:p-10">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <div class="app-kicker">Welcome back</div>
                    <h2 class="mt-3 text-3xl font-bold text-white">User Login</h2>
                    <p class="mt-3 text-sm leading-6 text-slate-300">Use the email and password you registered with. Account approval is still required before access is granted.</p>
                </div>
                <img src="assets/img/logo.png" alt="Logo" class="h-14 w-14 rounded-2xl border border-white/10 bg-white/5 p-2">
            </div>

            <div class="mt-6">
                <?php echo app_render_flash_banner($flashMessage); ?>
            </div>

            <form class="mt-6 space-y-5" method="post" action="">
                <div>
                    <label class="app-label" for="email">Email address</label>
                    <input class="app-input" type="email" id="email" name="email" placeholder="you@example.com" required>
                </div>
                <div>
                    <div class="mb-2 flex items-center justify-between gap-3">
                        <label class="app-label mb-0" for="password">Password</label>
                        <a class="text-sm font-medium text-sky-300 hover:text-sky-200" href="passwordrecover.php">Forgot password?</a>
                    </div>
                    <input class="app-input" type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button class="app-button app-button-primary w-full" type="submit">
                    <i class="fa fa-sign-in"></i>
                    Login
                </button>
            </form>

            <div class="app-divider my-6"></div>

            <div class="flex flex-col gap-3 text-sm text-slate-300 sm:flex-row sm:items-center sm:justify-between">
                <span>Need a new account?</span>
                <a class="app-button app-button-secondary" href="register.php">Create account</a>
            </div>
        </section>
    </main>
</body>
</html>