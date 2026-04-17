<?php
include 'person_face_id/inc/session.php';

$idNumber = trim((string) ($_GET['edt'] ?? ''));

if ($idNumber === '' || !preg_match('/^\d{13}$/', $idNumber)) {
    app_redirect('face.php', 'Invalid person selected.');
}

$personStatement = mysqli_prepare(
    $conn,
    'SELECT p.person_id, p.firstname, p.lastname, p.dateOfbirth, p.gender, p.id_number, p.house_no, p.street_name, p.suburb, p.city, p.province, p.zip_code, p.country, p.email, p.phone, p.keen_firstname, p.keen_lastname, p.keen_email, p.keen_phone, f.picture
     FROM person p
     LEFT JOIN face_identification f ON f.person_id = p.person_id
     WHERE p.id_number = ?
     LIMIT 1'
);
mysqli_stmt_bind_param($personStatement, 's', $idNumber);
mysqli_stmt_execute($personStatement);
$personResult = mysqli_stmt_get_result($personStatement);
$person = mysqli_fetch_assoc($personResult);
mysqli_stmt_close($personStatement);

if (!$person) {
    app_redirect('face.php', 'No information found for that ID number.');
}

$dockets = [];
$docketStatement = mysqli_prepare(
    $conn,
    'SELECT docket_id, crime_type, year
     FROM docket
     WHERE person_id = ?
     ORDER BY year DESC, docket_id DESC'
);
mysqli_stmt_bind_param($docketStatement, 'i', $person['person_id']);
mysqli_stmt_execute($docketStatement);
$docketResult = mysqli_stmt_get_result($docketStatement);
while ($row = mysqli_fetch_assoc($docketResult)) {
    $dockets[] = $row;
}
mysqli_stmt_close($docketStatement);

$age = null;
if (!empty($person['dateOfbirth']) && $person['dateOfbirth'] !== '0000-00-00') {
    $dateOfBirth = DateTime::createFromFormat('Y-m-d', $person['dateOfbirth']);
    if ($dateOfBirth) {
        $age = $dateOfBirth->diff(new DateTime('today'))->y;
    }
}

$displayDateOfBirth = 'Not available';
if (!empty($person['dateOfbirth']) && $person['dateOfbirth'] !== '0000-00-00') {
    $dateOfBirth = DateTime::createFromFormat('Y-m-d', $person['dateOfbirth']);
    if ($dateOfBirth) {
        $displayDateOfBirth = $dateOfBirth->format('d M Y');
    }
}

$imagePath = 'person_face_id/error.png';
if (!empty($person['picture'])) {
    $imagePath = 'person_face_id/' . $person['picture'] . '.jpg';
}

function format_phone_display($phone)
{
    $digits = preg_replace('/\D+/', '', (string) $phone);

    if (strlen($digits) === 10) {
        return '(' . substr($digits, 0, 3) . ') ' . substr($digits, 3, 3) . ' ' . substr($digits, 6, 4);
    }

    return $phone === '' ? 'Not available' : $phone;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identification System | Found Information</title>
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
    <div class="mx-auto flex min-h-screen max-w-[1600px] flex-col gap-6 px-4 py-4 lg:flex-row lg:px-6">
        <aside class="glass-panel app-card w-full rounded-[2rem] p-5 lg:sticky lg:top-4 lg:h-[calc(100vh-2rem)] lg:w-80 lg:self-start">
            <div class="border-b border-white/10 pb-5">
                <div class="brand-badge">
                    <i class="fa fa-shield"></i>
                    Confidential record
                </div>
                <h1 class="mt-4 text-2xl font-bold text-white"><?php echo htmlspecialchars($person['firstname'] . ' ' . $person['lastname'], ENT_QUOTES, 'UTF-8'); ?></h1>
                <p class="mt-2 text-sm text-slate-400">ID <?php echo htmlspecialchars($person['id_number'], ENT_QUOTES, 'UTF-8'); ?></p>
            </div>

            <nav class="mt-6 space-y-2">
                <a class="app-sidebar-link" href="face.php"><i class="fa fa-camera w-5"></i><span>Verify face</span></a>
                <button class="app-sidebar-link w-full text-left" type="button" onclick="window.print();"><i class="fa fa-print w-5"></i><span>Print result</span></button>
                <a class="app-sidebar-link" href="person_face_id/inc/logout.php"><i class="fa fa-power-off w-5"></i><span>Logout</span></a>
            </nav>

            <div class="mt-8 rounded-[1.5rem] border border-white/10 bg-slate-950/40 p-4 text-sm leading-6 text-slate-300">
                This record is confidential and should only be used for authorized verification work.
            </div>
        </aside>

        <main class="flex-1 space-y-6">
            <section class="glass-panel-strong app-card rounded-[2rem] p-6 md:p-8">
                <div class="app-kicker">Match result</div>
                <h2 class="mt-3 text-4xl font-extrabold text-white">Retrieved information</h2>
                <p class="mt-4 max-w-3xl text-base leading-7 text-slate-300">The live face verification matched the stored reference image for this identity record.</p>
            </section>

            <section class="grid gap-6 xl:grid-cols-[0.8fr_1.2fr]">
                <div class="glass-panel app-card rounded-[2rem] p-6">
                    <div class="rounded-[1.75rem] border border-white/10 bg-slate-950/40 p-5 text-center">
                        <img src="<?php echo htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8'); ?>" alt="Stored face" class="mx-auto max-h-[24rem] rounded-[1.5rem] border border-white/10 object-contain">
                        <div class="mt-5 app-badge app-badge-success">Verified match</div>
                    </div>
                </div>

                <div class="space-y-6">
                    <section class="glass-panel app-card rounded-[2rem] p-6">
                        <div class="app-kicker">Personal details</div>
                        <div class="mt-5 grid gap-4 md:grid-cols-2">
                            <div class="app-form-section"><p class="text-xs uppercase tracking-[0.2em] text-slate-400">Firstname</p><p class="mt-2 text-lg font-semibold text-white"><?php echo htmlspecialchars($person['firstname'], ENT_QUOTES, 'UTF-8'); ?></p></div>
                            <div class="app-form-section"><p class="text-xs uppercase tracking-[0.2em] text-slate-400">Lastname</p><p class="mt-2 text-lg font-semibold text-white"><?php echo htmlspecialchars($person['lastname'], ENT_QUOTES, 'UTF-8'); ?></p></div>
                            <div class="app-form-section"><p class="text-xs uppercase tracking-[0.2em] text-slate-400">Date of birth</p><p class="mt-2 text-lg font-semibold text-white"><?php echo htmlspecialchars($displayDateOfBirth, ENT_QUOTES, 'UTF-8'); ?></p></div>
                            <div class="app-form-section"><p class="text-xs uppercase tracking-[0.2em] text-slate-400">Age</p><p class="mt-2 text-lg font-semibold text-white"><?php echo htmlspecialchars($age !== null ? (string) $age : 'Not available', ENT_QUOTES, 'UTF-8'); ?></p></div>
                            <div class="app-form-section"><p class="text-xs uppercase tracking-[0.2em] text-slate-400">Gender</p><p class="mt-2 text-lg font-semibold text-white"><?php echo htmlspecialchars($person['gender'], ENT_QUOTES, 'UTF-8'); ?></p></div>
                            <div class="app-form-section"><p class="text-xs uppercase tracking-[0.2em] text-slate-400">ID number</p><p class="mt-2 text-lg font-semibold text-white"><?php echo htmlspecialchars($person['id_number'], ENT_QUOTES, 'UTF-8'); ?></p></div>
                        </div>
                    </section>

                    <section class="glass-panel app-card rounded-[2rem] p-6">
                        <div class="app-kicker">Address and contact</div>
                        <div class="mt-5 grid gap-4 md:grid-cols-2">
                            <div class="app-form-section"><p class="text-xs uppercase tracking-[0.2em] text-slate-400">House no</p><p class="mt-2 text-lg font-semibold text-white"><?php echo htmlspecialchars($person['house_no'] ?: 'Not available', ENT_QUOTES, 'UTF-8'); ?></p></div>
                            <div class="app-form-section"><p class="text-xs uppercase tracking-[0.2em] text-slate-400">Street</p><p class="mt-2 text-lg font-semibold text-white"><?php echo htmlspecialchars($person['street_name'] ?: 'Not available', ENT_QUOTES, 'UTF-8'); ?></p></div>
                            <div class="app-form-section"><p class="text-xs uppercase tracking-[0.2em] text-slate-400">Suburb</p><p class="mt-2 text-lg font-semibold text-white"><?php echo htmlspecialchars($person['suburb'] ?: 'Not available', ENT_QUOTES, 'UTF-8'); ?></p></div>
                            <div class="app-form-section"><p class="text-xs uppercase tracking-[0.2em] text-slate-400">City</p><p class="mt-2 text-lg font-semibold text-white"><?php echo htmlspecialchars($person['city'] ?: 'Not available', ENT_QUOTES, 'UTF-8'); ?></p></div>
                            <div class="app-form-section"><p class="text-xs uppercase tracking-[0.2em] text-slate-400">Province</p><p class="mt-2 text-lg font-semibold text-white"><?php echo htmlspecialchars($person['province'] ?: 'Not available', ENT_QUOTES, 'UTF-8'); ?></p></div>
                            <div class="app-form-section"><p class="text-xs uppercase tracking-[0.2em] text-slate-400">Zip code</p><p class="mt-2 text-lg font-semibold text-white"><?php echo htmlspecialchars($person['zip_code'] ?: 'Not available', ENT_QUOTES, 'UTF-8'); ?></p></div>
                            <div class="app-form-section"><p class="text-xs uppercase tracking-[0.2em] text-slate-400">Country</p><p class="mt-2 text-lg font-semibold text-white"><?php echo htmlspecialchars($person['country'] ?: 'Not available', ENT_QUOTES, 'UTF-8'); ?></p></div>
                            <div class="app-form-section"><p class="text-xs uppercase tracking-[0.2em] text-slate-400">Email</p><p class="mt-2 text-lg font-semibold text-white"><?php echo htmlspecialchars($person['email'] ?: 'Not available', ENT_QUOTES, 'UTF-8'); ?></p></div>
                            <div class="app-form-section md:col-span-2"><p class="text-xs uppercase tracking-[0.2em] text-slate-400">Phone</p><p class="mt-2 text-lg font-semibold text-white"><?php echo htmlspecialchars(format_phone_display($person['phone'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></p></div>
                        </div>
                    </section>

                    <section class="glass-panel app-card rounded-[2rem] p-6">
                        <div class="app-kicker">Next of kin</div>
                        <div class="mt-5 grid gap-4 md:grid-cols-2">
                            <div class="app-form-section"><p class="text-xs uppercase tracking-[0.2em] text-slate-400">Firstname</p><p class="mt-2 text-lg font-semibold text-white"><?php echo htmlspecialchars($person['keen_firstname'] ?: 'Not available', ENT_QUOTES, 'UTF-8'); ?></p></div>
                            <div class="app-form-section"><p class="text-xs uppercase tracking-[0.2em] text-slate-400">Lastname</p><p class="mt-2 text-lg font-semibold text-white"><?php echo htmlspecialchars($person['keen_lastname'] ?: 'Not available', ENT_QUOTES, 'UTF-8'); ?></p></div>
                            <div class="app-form-section"><p class="text-xs uppercase tracking-[0.2em] text-slate-400">Email</p><p class="mt-2 text-lg font-semibold text-white"><?php echo htmlspecialchars($person['keen_email'] ?: 'Not available', ENT_QUOTES, 'UTF-8'); ?></p></div>
                            <div class="app-form-section"><p class="text-xs uppercase tracking-[0.2em] text-slate-400">Phone</p><p class="mt-2 text-lg font-semibold text-white"><?php echo htmlspecialchars(format_phone_display($person['keen_phone'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></p></div>
                        </div>
                    </section>

                    <section class="glass-panel app-card rounded-[2rem] p-6">
                        <div class="app-kicker">Criminal record</div>
                        <?php if ($dockets) { ?>
                            <div class="mt-5 overflow-x-auto">
                                <table class="min-w-full text-left text-sm text-slate-300">
                                    <thead>
                                        <tr class="border-b border-white/10 text-xs uppercase tracking-[0.2em] text-slate-400">
                                            <th class="px-4 py-3">Docket</th>
                                            <th class="px-4 py-3">Record type</th>
                                            <th class="px-4 py-3">Year</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($dockets as $docket) { ?>
                                            <tr class="border-b border-white/5">
                                                <td class="px-4 py-4 font-semibold text-white">Docket #<?php echo htmlspecialchars((string) $docket['docket_id'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td class="px-4 py-4"><?php echo htmlspecialchars($docket['crime_type'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td class="px-4 py-4"><?php echo htmlspecialchars($docket['year'], ENT_QUOTES, 'UTF-8'); ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } else { ?>
                            <div class="mt-5 rounded-[1.5rem] border border-white/10 bg-slate-950/40 px-6 py-8 text-center">
                                <div class="app-badge app-badge-success">No criminal record</div>
                                <p class="mt-4 text-sm leading-6 text-slate-300">No crime information is linked to this identity record.</p>
                            </div>
                        <?php } ?>
                    </section>
                </div>
            </section>
        </main>
    </div>
</body>
</html>