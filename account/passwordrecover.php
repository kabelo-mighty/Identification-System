<?php
include '../src/connect.php';
require_once '../src/auth.php';

$flashMessage = app_get_flash_message();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cellno = trim((string) ($_POST['cellno'] ?? ''));
    $email = app_normalize_email($_POST['email'] ?? '');
    $password = (string) ($_POST['password'] ?? '');

    if ($cellno === '' || $email === '' || $password === '') {
        app_redirect('passwordrecover.php', 'Email, phone number, and password are required.');
    }

    $checkStatement = mysqli_prepare($conn, 'SELECT person_id FROM person WHERE email = ? AND phone = ? LIMIT 1');
    mysqli_stmt_bind_param($checkStatement, 'ss', $email, $cellno);
    mysqli_stmt_execute($checkStatement);
    $result = mysqli_stmt_get_result($checkStatement);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($checkStatement);

    if (!$row) {
        app_redirect('passwordrecover.php', 'Make sure that your phone number and email are correct.');
    }

    $passwordHash = app_hash_password($password);
    $updateStatement = mysqli_prepare($conn, 'UPDATE person SET password = ? WHERE person_id = ?');
    mysqli_stmt_bind_param($updateStatement, 'si', $passwordHash, $row['person_id']);
    $updated = mysqli_stmt_execute($updateStatement);
    mysqli_stmt_close($updateStatement);

    if (!$updated) {
        app_redirect('passwordrecover.php', 'New password could not be created. Please try again.');
    }

    app_redirect('login.php', 'New password successfully created.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identification System | Password Recovery</title>
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
    <main class="mx-auto grid min-h-screen max-w-7xl gap-10 px-6 py-8 lg:grid-cols-[0.95fr_1.05fr] lg:items-center lg:px-8">
        <section class="glass-panel app-card rounded-[2rem] p-7 md:p-10">
            <div class="app-kicker">Recovery flow</div>
            <h1 class="mt-3 text-4xl font-extrabold text-white md:text-5xl">Reset account access without leaving the system.</h1>
            <p class="mt-5 text-base leading-7 text-slate-300">Confirm the registered email and phone number, then assign a new password. The backend will update the account record directly once the identity check passes.</p>

            <div class="mt-8 space-y-4">
                <div class="app-form-section">
                    <div class="flex items-start gap-4">
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-sky-400/15 text-sky-300">
                            <i class="fa fa-envelope-o"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-white">Verify contact details</h2>
                            <p class="mt-1 text-sm leading-6 text-slate-300">Recovery still depends on matching the stored email and phone number in the person record.</p>
                        </div>
                    </div>
                </div>
                <div class="app-form-section">
                    <div class="flex items-start gap-4">
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-400/15 text-emerald-300">
                            <i class="fa fa-lock"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-white">Set a new password</h2>
                            <p class="mt-1 text-sm leading-6 text-slate-300">Use a strong replacement password and sign in again from the modern login screen.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="glass-panel-strong app-card rounded-[2rem] p-7 md:p-10">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <div class="app-kicker">Account support</div>
                    <h2 class="mt-3 text-3xl font-bold text-white">Password Recovery</h2>
                </div>
                <a class="brand-badge" href="login.php">
                    <i class="fa fa-chevron-left"></i>
                    Back to login
                </a>
            </div>

            <div class="mt-6">
                <?php echo app_render_flash_banner($flashMessage); ?>
            </div>

            <form class="mt-6 grid gap-5" method="post" action="">
                <div>
                    <label class="app-label" for="cellno">Phone number</label>
                    <input class="app-input" type="text" id="cellno" name="cellno" placeholder="0712345678" required>
                </div>
                <div>
                    <label class="app-label" for="email">Email address</label>
                    <input class="app-input" type="email" id="email" name="email" placeholder="you@example.com" required>
                </div>
                <div>
                    <label class="app-label" for="password">New password</label>
                    <input class="app-input" type="password" id="password" name="password" placeholder="Create a strong password" required>
                </div>
                <button class="app-button app-button-primary w-full" type="submit">
                    <i class="fa fa-refresh"></i>
                    Save Password
                </button>
            </form>
        </section>
    </main>
</body>
</html>