<?php include 'inc/session.php'; ?>
<?php
$flashMessage = app_get_flash_message();
$redirectPath = 'non_citi.php';
$adminId = (int) $id;
$personId = $_GET['value'] ?? '';

if (!ctype_digit((string) $personId) || (int) $personId <= 0) {
  app_redirect($redirectPath, 'Invalid person selected.');
}

$personId = (int) $personId;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])) {
  app_require_csrf_token('viewnoncity.php?value=' . $personId);

  $name = trim((string) ($_POST['name'] ?? ''));
  $surname = trim((string) ($_POST['surname'] ?? ''));
  $gender = trim((string) ($_POST['gender'] ?? ''));
  $email = app_normalize_email($_POST['email'] ?? '');
  $cellno = trim((string) ($_POST['cellno'] ?? ''));
  $idno = trim((string) ($_POST['idno'] ?? ''));
  $houseno = trim((string) ($_POST['houseno'] ?? ''));
  $streetname = trim((string) ($_POST['streetname'] ?? ''));
  $city = trim((string) ($_POST['city'] ?? ''));
  $province = trim((string) ($_POST['province'] ?? ''));
  $country = trim((string) ($_POST['country'] ?? ''));
  $suburb = trim((string) ($_POST['suburb'] ?? ''));
  $zipcode = trim((string) ($_POST['zipcode'] ?? ''));
  $keenfirstname = trim((string) ($_POST['keenfirstname'] ?? ''));
  $keenlastname = trim((string) ($_POST['keenlastname'] ?? ''));
  $kphone = trim((string) ($_POST['kphone'] ?? ''));
  $kemail = app_normalize_email($_POST['kemail'] ?? '');

  $statement = mysqli_prepare($conn, 'UPDATE person SET firstname = ?, lastname = ?, gender = ?, id_number = ?, phone = ?, email = ?, house_no = ?, street_name = ?, suburb = ?, city = ?, province = ?, zip_code = ?, country = ?, keen_firstname = ?, keen_lastname = ?, keen_phone = ?, keen_email = ? WHERE person_id = ?');
  mysqli_stmt_bind_param($statement, 'sssssssssssssssssi', $name, $surname, $gender, $idno, $cellno, $email, $houseno, $streetname, $suburb, $city, $province, $zipcode, $country, $keenfirstname, $keenlastname, $kphone, $kemail, $personId);
  $updated = mysqli_stmt_execute($statement);
  mysqli_stmt_close($statement);

  if (!$updated) {
    app_redirect('viewnoncity.php?value=' . $personId, 'Information could not be updated.');
  }

  app_redirect($redirectPath, 'Information updated.');
}

$statement = mysqli_prepare($conn, 'SELECT * FROM person WHERE person_id = ? LIMIT 1');
mysqli_stmt_bind_param($statement, 'i', $personId);
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);
$data = mysqli_fetch_assoc($result);
mysqli_stmt_close($statement);

if (!$data) {
  app_redirect($redirectPath, 'Person not found.');
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identification System | Non-Citizen Profile</title>
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
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-cyan-400/15 text-cyan-300">
                    <i class="fa fa-globe text-xl"></i>
                </div>
                <div>
                    <div class="app-kicker">Admin console</div>
                    <h1 class="mt-1 text-xl font-bold text-white">Non-citizen profile</h1>
                </div>
            </div>

            <nav class="mt-6 space-y-2">
                <a class="app-sidebar-link" href="dashboard.php"><i class="fas fa-tachometer-alt w-5"></i><span>Dashboard</span></a>
                <a class="app-sidebar-link" href="face_backfill.php"><i class="fa fa-database w-5"></i><span>Face Cache Backfill</span></a>
                <a class="app-sidebar-link" href="people.php"><i class="fa fa-users w-5"></i><span>Citizens</span></a>
                <a class="app-sidebar-link is-active" href="non_citi.php"><i class="fa fa-globe w-5"></i><span>Non Citizens</span></a>
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
                        <div class="app-kicker">Profile editor</div>
                        <h2 class="mt-3 text-4xl font-extrabold text-white"><?php echo htmlspecialchars(trim($data['firstname'] . ' ' . $data['lastname']), ENT_QUOTES, 'UTF-8'); ?></h2>
                        <p class="mt-4 max-w-3xl text-base leading-7 text-slate-300">Update the non-citizen record, including contact details, address information, and next-of-kin data, from the same modern admin workspace.</p>
                    </div>
                    <div class="flex flex-col gap-3 sm:flex-row">
                        <a class="app-button app-button-secondary" href="non_citi.php"><i class="fa fa-arrow-left"></i>Back to Non Citizens</a>
                        <span class="app-badge app-badge-info self-start sm:self-center"><?php echo htmlspecialchars((string) $data['country'], ENT_QUOTES, 'UTF-8'); ?></span>
                    </div>
                </div>
            </section>

            <?php if ($flashMessage !== null) { ?>
                <div><?php echo app_render_flash_banner($flashMessage); ?></div>
            <?php } ?>

            <section class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                <div class="app-stat">
                    <div class="app-stat-value"><?php echo htmlspecialchars((string) $data['id_number'], ENT_QUOTES, 'UTF-8'); ?></div>
                    <div class="app-stat-label">ID Number</div>
                </div>
                <div class="app-stat">
                    <div class="app-stat-value"><?php echo htmlspecialchars((string) $data['gender'], ENT_QUOTES, 'UTF-8'); ?></div>
                    <div class="app-stat-label">Gender</div>
                </div>
                <div class="app-stat">
                    <div class="app-stat-value"><?php echo htmlspecialchars((string) $data['phone'], ENT_QUOTES, 'UTF-8'); ?></div>
                    <div class="app-stat-label">Phone</div>
                </div>
                <div class="app-stat">
                    <div class="app-stat-value"><?php echo htmlspecialchars((string) $data['city'], ENT_QUOTES, 'UTF-8'); ?></div>
                    <div class="app-stat-label">City</div>
                </div>
            </section>

            <form method="post" action="" class="space-y-6">
                <?php echo app_csrf_input(); ?>

                <section class="glass-panel app-card rounded-[2rem] p-6">
                    <div class="app-kicker">Personal information</div>
                    <div class="mt-5 grid gap-5 md:grid-cols-2 xl:grid-cols-3">
                        <div>
                            <label class="app-label" for="name">First name</label>
                            <input class="app-input" type="text" id="name" name="name" required value="<?php echo htmlspecialchars((string) $data['firstname'], ENT_QUOTES, 'UTF-8'); ?>">
                        </div>
                        <div>
                            <label class="app-label" for="surname">Last name</label>
                            <input class="app-input" type="text" id="surname" name="surname" required value="<?php echo htmlspecialchars((string) $data['lastname'], ENT_QUOTES, 'UTF-8'); ?>">
                        </div>
                        <div>
                            <label class="app-label" for="idno">ID number</label>
                            <input class="app-input opacity-80" type="text" id="idno" name="idno" readonly value="<?php echo htmlspecialchars((string) $data['id_number'], ENT_QUOTES, 'UTF-8'); ?>">
                        </div>
                        <div>
                            <label class="app-label" for="cellno">Phone number</label>
                            <input class="app-input" type="text" id="cellno" name="cellno" required value="<?php echo htmlspecialchars((string) $data['phone'], ENT_QUOTES, 'UTF-8'); ?>">
                        </div>
                        <div>
                            <label class="app-label" for="email">Email</label>
                            <input class="app-input opacity-80" type="email" id="email" name="email" readonly value="<?php echo htmlspecialchars((string) $data['email'], ENT_QUOTES, 'UTF-8'); ?>">
                        </div>
                        <div>
                            <label class="app-label" for="gender">Gender</label>
                            <input class="app-input opacity-80" type="text" id="gender" name="gender" readonly value="<?php echo htmlspecialchars((string) $data['gender'], ENT_QUOTES, 'UTF-8'); ?>">
                        </div>
                    </div>
                </section>

                <section class="glass-panel app-card rounded-[2rem] p-6">
                    <div class="app-kicker">Address information</div>
                    <div class="mt-5 grid gap-5 md:grid-cols-2 xl:grid-cols-3">
                        <div>
                            <label class="app-label" for="houseno">House No.</label>
                            <input class="app-input" type="text" id="houseno" name="houseno" required value="<?php echo htmlspecialchars((string) $data['house_no'], ENT_QUOTES, 'UTF-8'); ?>">
                        </div>
                        <div>
                            <label class="app-label" for="streetname">Street name</label>
                            <input class="app-input" type="text" id="streetname" name="streetname" required value="<?php echo htmlspecialchars((string) $data['street_name'], ENT_QUOTES, 'UTF-8'); ?>">
                        </div>
                        <div>
                            <label class="app-label" for="suburb">Suburb</label>
                            <input class="app-input" type="text" id="suburb" name="suburb" required value="<?php echo htmlspecialchars((string) $data['suburb'], ENT_QUOTES, 'UTF-8'); ?>">
                        </div>
                        <div>
                            <label class="app-label" for="city">City</label>
                            <input class="app-input" type="text" id="city" name="city" required value="<?php echo htmlspecialchars((string) $data['city'], ENT_QUOTES, 'UTF-8'); ?>">
                        </div>
                        <div>
                            <label class="app-label" for="province">Province</label>
                            <input class="app-input" type="text" id="province" name="province" required value="<?php echo htmlspecialchars((string) $data['province'], ENT_QUOTES, 'UTF-8'); ?>">
                        </div>
                        <div>
                            <label class="app-label" for="zipcode">Zip code</label>
                            <input class="app-input" type="text" id="zipcode" name="zipcode" required value="<?php echo htmlspecialchars((string) $data['zip_code'], ENT_QUOTES, 'UTF-8'); ?>">
                        </div>
                        <div class="md:col-span-2 xl:col-span-3">
                            <label class="app-label" for="country">Country</label>
                            <input class="app-input" type="text" id="country" name="country" required value="<?php echo htmlspecialchars((string) $data['country'], ENT_QUOTES, 'UTF-8'); ?>">
                        </div>
                    </div>
                </section>

                <section class="glass-panel app-card rounded-[2rem] p-6">
                    <div class="app-kicker">Next of kin</div>
                    <div class="mt-5 grid gap-5 md:grid-cols-2 xl:grid-cols-4">
                        <div>
                            <label class="app-label" for="keenfirstname">First name</label>
                            <input class="app-input" type="text" id="keenfirstname" name="keenfirstname" required value="<?php echo htmlspecialchars((string) $data['keen_firstname'], ENT_QUOTES, 'UTF-8'); ?>">
                        </div>
                        <div>
                            <label class="app-label" for="keenlastname">Last name</label>
                            <input class="app-input" type="text" id="keenlastname" name="keenlastname" required value="<?php echo htmlspecialchars((string) $data['keen_lastname'], ENT_QUOTES, 'UTF-8'); ?>">
                        </div>
                        <div>
                            <label class="app-label" for="kphone">Phone number</label>
                            <input class="app-input" type="text" id="kphone" name="kphone" required value="<?php echo htmlspecialchars((string) $data['keen_phone'], ENT_QUOTES, 'UTF-8'); ?>">
                        </div>
                        <div>
                            <label class="app-label" for="kemail">Email</label>
                            <input class="app-input" type="email" id="kemail" name="kemail" required value="<?php echo htmlspecialchars((string) $data['keen_email'], ENT_QUOTES, 'UTF-8'); ?>">
                        </div>
                    </div>
                </section>

                <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                    <a class="app-button app-button-secondary" href="non_citi.php"><i class="fa fa-times"></i>Cancel</a>
                    <button class="app-button app-button-primary" type="submit"><i class="fa fa-save"></i>Save Changes</button>
                </div>
            </form>
        </main>
    </div>
</body>
</html>