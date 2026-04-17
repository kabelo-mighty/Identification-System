<?php
include 'inc/session.php';
require_once '../../src/auth.php';

$flashMessage = app_get_flash_message();

$personStatement = mysqli_prepare($conn, 'SELECT firstname, lastname, gender, id_number, phone, email, employee_type, house_no, street_name, suburb, city, province, zip_code, keen_firstname, keen_lastname, keen_phone, keen_email FROM person WHERE person_id = ? LIMIT 1');
mysqli_stmt_bind_param($personStatement, 'i', $id);
mysqli_stmt_execute($personStatement);
$personResult = mysqli_stmt_get_result($personStatement);
$data = mysqli_fetch_assoc($personResult) ?: [];
mysqli_stmt_close($personStatement);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formType = (string) ($_POST['form_type'] ?? '');

    if ($formType === 'personal') {
        $firstname = trim((string) ($_POST['name'] ?? ''));
        $lastname = trim((string) ($_POST['surname'] ?? ''));
        $phone = trim((string) ($_POST['cellno'] ?? ''));

        if ($firstname === '' || $lastname === '' || $phone === '') {
            app_redirect('profile.php', 'Please complete the personal information fields.');
        }

        $statement = mysqli_prepare($conn, 'UPDATE person SET firstname = ?, lastname = ?, phone = ? WHERE person_id = ?');
        mysqli_stmt_bind_param($statement, 'sssi', $firstname, $lastname, $phone, $id);
        mysqli_stmt_execute($statement);
        mysqli_stmt_close($statement);

        app_redirect('profile.php', 'Personal information updated.');
    }

    if ($formType === 'address') {
        $houseno = trim((string) ($_POST['houseno'] ?? ''));
        $streetname = trim((string) ($_POST['streetname'] ?? ''));
        $suburb = trim((string) ($_POST['suburb'] ?? ''));
        $city = trim((string) ($_POST['city'] ?? ''));
        $province = trim((string) ($_POST['province'] ?? ''));
        $zipcode = trim((string) ($_POST['zipcode'] ?? ''));

        if ($houseno === '' || $streetname === '' || $suburb === '' || $city === '' || $province === '' || $zipcode === '') {
            app_redirect('profile.php', 'Please complete the address fields.');
        }

        $statement = mysqli_prepare($conn, 'UPDATE person SET house_no = ?, street_name = ?, suburb = ?, city = ?, province = ?, zip_code = ? WHERE person_id = ?');
        mysqli_stmt_bind_param($statement, 'ssssssi', $houseno, $streetname, $suburb, $city, $province, $zipcode, $id);
        mysqli_stmt_execute($statement);
        mysqli_stmt_close($statement);

        app_redirect('profile.php', 'Address information updated.');
    }

    if ($formType === 'next_of_kin') {
        $firstname = trim((string) ($_POST['firstname'] ?? ''));
        $lastname = trim((string) ($_POST['lastname'] ?? ''));
        $phone = trim((string) ($_POST['phone'] ?? ''));
        $emailAddress = app_normalize_email($_POST['email'] ?? '');

        if ($firstname === '' || $lastname === '' || $phone === '' || $emailAddress === '') {
            app_redirect('profile.php', 'Please complete the next of kin fields.');
        }

        $statement = mysqli_prepare($conn, 'UPDATE person SET keen_firstname = ?, keen_lastname = ?, keen_phone = ?, keen_email = ? WHERE person_id = ?');
        mysqli_stmt_bind_param($statement, 'ssssi', $firstname, $lastname, $phone, $emailAddress, $id);
        mysqli_stmt_execute($statement);
        mysqli_stmt_close($statement);

        app_redirect('profile.php', 'Next of kin information updated.');
    }

    if ($formType === 'password') {
        $password = (string) ($_POST['password'] ?? '');
        $confirmPassword = (string) ($_POST['Cpassword'] ?? '');

        if ($password === '' || $confirmPassword === '') {
            app_redirect('profile.php', 'Please provide the new password and confirmation.');
        }

        if (!hash_equals($password, $confirmPassword)) {
            app_redirect('profile.php', 'Password confirmation does not match.');
        }

        $hash = app_hash_password($password);
        $statement = mysqli_prepare($conn, 'UPDATE person SET password = ? WHERE person_id = ?');
        mysqli_stmt_bind_param($statement, 'si', $hash, $id);
        mysqli_stmt_execute($statement);
        mysqli_stmt_close($statement);

        app_redirect('profile.php', 'Password changed.');
    }
}

$displayName = trim(($data['firstname'] ?? '') . ' ' . ($data['lastname'] ?? ''));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identification System | Profile</title>
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
                    <i class="fa fa-user-circle-o"></i>
                    Profile workspace
                </div>
                <h1 class="mt-4 text-2xl font-bold text-white"><?php echo htmlspecialchars($displayName !== '' ? $displayName : 'User', ENT_QUOTES, 'UTF-8'); ?></h1>
                <p class="mt-2 text-sm text-slate-400"><?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?></p>
            </div>

            <nav class="mt-6 space-y-2">
                <a class="app-sidebar-link" href="view.php"><i class="fa fa-home w-5"></i><span>Dashboard</span></a>
                <a class="app-sidebar-link is-active" href="profile.php"><i class="fa fa-user w-5"></i><span>Profile</span></a>
                <a class="app-sidebar-link" href="crecord.php"><i class="fa fa-folder-open w-5"></i><span>Criminal Record</span></a>
                <a class="app-sidebar-link" href="faceai.php"><i class="fa fa-camera w-5"></i><span>Capture Photo</span></a>
                <a class="app-sidebar-link" href="face-open.php"><i class="fa fa-image w-5"></i><span>View Photo</span></a>
                <a class="app-sidebar-link" href="../../account/logout.php"><i class="fa fa-power-off w-5"></i><span>Logout</span></a>
            </nav>
        </aside>

        <main class="flex-1 space-y-6">
            <section class="glass-panel-strong app-card rounded-[2rem] p-6 md:p-8">
                <div class="app-kicker">Account management</div>
                <h2 class="mt-3 text-4xl font-extrabold text-white">Profile</h2>
                <p class="mt-4 max-w-3xl text-base leading-7 text-slate-300">Update your personal record, address, next-of-kin details, and password from one place.</p>
            </section>

            <?php if ($flashMessage) { ?>
                <?php echo app_render_flash_banner($flashMessage); ?>
            <?php } ?>

            <section class="grid gap-6 xl:grid-cols-2">
                <form class="glass-panel app-card rounded-[2rem] p-6 space-y-5" method="post" action="">
                    <input type="hidden" name="form_type" value="personal">
                    <div>
                        <div class="app-kicker">Section 1</div>
                        <h3 class="mt-2 text-2xl font-bold text-white">Personal information</h3>
                    </div>
                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="app-label" for="name">First name</label>
                            <input class="app-input" type="text" id="name" name="name" value="<?php echo htmlspecialchars($data['firstname'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                        </div>
                        <div>
                            <label class="app-label" for="surname">Last name</label>
                            <input class="app-input" type="text" id="surname" name="surname" value="<?php echo htmlspecialchars($data['lastname'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                        </div>
                    </div>
                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="app-label" for="idno">ID number</label>
                            <input class="app-input" type="text" id="idno" value="<?php echo htmlspecialchars($data['id_number'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" readonly>
                        </div>
                        <div>
                            <label class="app-label" for="cellno">Phone number</label>
                            <input class="app-input" type="text" id="cellno" name="cellno" value="<?php echo htmlspecialchars($data['phone'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                        </div>
                    </div>
                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="app-label" for="email_display">Email address</label>
                            <input class="app-input" type="text" id="email_display" value="<?php echo htmlspecialchars($data['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" readonly>
                        </div>
                        <div>
                            <label class="app-label" for="gender_display">Gender</label>
                            <input class="app-input" type="text" id="gender_display" value="<?php echo htmlspecialchars($data['gender'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" readonly>
                        </div>
                    </div>
                    <button class="app-button app-button-primary" type="submit"><i class="fa fa-save"></i>Save personal details</button>
                </form>

                <form class="glass-panel app-card rounded-[2rem] p-6 space-y-5" method="post" action="">
                    <input type="hidden" name="form_type" value="address">
                    <div>
                        <div class="app-kicker">Section 2</div>
                        <h3 class="mt-2 text-2xl font-bold text-white">Address information</h3>
                    </div>
                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="app-label" for="houseno">House number</label>
                            <input class="app-input" type="text" id="houseno" name="houseno" value="<?php echo htmlspecialchars($data['house_no'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                        </div>
                        <div>
                            <label class="app-label" for="streetname">Street name</label>
                            <input class="app-input" type="text" id="streetname" name="streetname" value="<?php echo htmlspecialchars($data['street_name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                        </div>
                    </div>
                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="app-label" for="suburb">Suburb</label>
                            <input class="app-input" type="text" id="suburb" name="suburb" value="<?php echo htmlspecialchars($data['suburb'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                        </div>
                        <div>
                            <label class="app-label" for="city">City</label>
                            <input class="app-input" type="text" id="city" name="city" value="<?php echo htmlspecialchars($data['city'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                        </div>
                    </div>
                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="app-label" for="province">Province</label>
                            <input class="app-input" type="text" id="province" name="province" value="<?php echo htmlspecialchars($data['province'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                        </div>
                        <div>
                            <label class="app-label" for="zipcode">Zip code</label>
                            <input class="app-input" type="text" id="zipcode" name="zipcode" value="<?php echo htmlspecialchars($data['zip_code'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                        </div>
                    </div>
                    <button class="app-button app-button-primary" type="submit"><i class="fa fa-map-marker"></i>Save address</button>
                </form>

                <form class="glass-panel app-card rounded-[2rem] p-6 space-y-5" method="post" action="">
                    <input type="hidden" name="form_type" value="next_of_kin">
                    <div>
                        <div class="app-kicker">Section 3</div>
                        <h3 class="mt-2 text-2xl font-bold text-white">Next of kin</h3>
                    </div>
                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="app-label" for="firstname">First name</label>
                            <input class="app-input" type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($data['keen_firstname'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                        </div>
                        <div>
                            <label class="app-label" for="lastname">Last name</label>
                            <input class="app-input" type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($data['keen_lastname'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                        </div>
                    </div>
                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="app-label" for="phone">Phone number</label>
                            <input class="app-input" type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($data['keen_phone'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                        </div>
                        <div>
                            <label class="app-label" for="kin_email">Email address</label>
                            <input class="app-input" type="email" id="kin_email" name="email" value="<?php echo htmlspecialchars($data['keen_email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                        </div>
                    </div>
                    <button class="app-button app-button-primary" type="submit"><i class="fa fa-users"></i>Save next of kin</button>
                </form>

                <form class="glass-panel app-card rounded-[2rem] p-6 space-y-5" method="post" action="">
                    <input type="hidden" name="form_type" value="password">
                    <div>
                        <div class="app-kicker">Section 4</div>
                        <h3 class="mt-2 text-2xl font-bold text-white">Change password</h3>
                    </div>
                    <div>
                        <label class="app-label" for="password">New password</label>
                        <input class="app-input" type="password" id="password" name="password" required>
                    </div>
                    <div>
                        <label class="app-label" for="Cpassword">Confirm password</label>
                        <input class="app-input" type="password" id="Cpassword" name="Cpassword" required>
                    </div>
                    <div class="rounded-2xl border border-emerald-400/15 bg-emerald-400/8 p-4 text-sm leading-6 text-emerald-100">
                        New passwords are now saved using the modern password hashing flow from the shared auth helpers.
                    </div>
                    <button class="app-button app-button-primary" type="submit"><i class="fa fa-lock"></i>Save password</button>
                </form>
            </section>
        </main>
    </div>
</body>
</html>