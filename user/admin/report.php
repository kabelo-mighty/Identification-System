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

$people = [];
$query = 'SELECT * FROM person ORDER BY person_id DESC';
$result = mysqli_query($conn, $query);

$citizenCount = 0;
$nonCitizenCount = 0;
$femaleCount = 0;

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $country = trim((string) $row['country']);
        $isCitizen = strcasecmp($country, 'South Africa') === 0;
        $isFemale = strcasecmp((string) $row['gender'], 'Female') === 0;

        if ($isCitizen) {
            $citizenCount += 1;
        } else {
            $nonCitizenCount += 1;
        }

        if ($isFemale) {
            $femaleCount += 1;
        }

        $people[] = [
            'full_name' => trim($row['firstname'] . ' ' . $row['lastname']),
            'id_number' => (string) $row['id_number'],
            'gender' => (string) $row['gender'],
            'date_of_birth' => (string) $row['dateOfbirth'],
            'phone' => (string) $row['phone'],
            'email' => (string) $row['email'],
            'next_of_kin' => trim($row['keen_firstname'] . ' ' . $row['keen_lastname']),
            'keen_phone' => (string) $row['keen_phone'],
            'keen_email' => (string) $row['keen_email'],
            'house_no' => (string) $row['house_no'],
            'street_name' => (string) $row['street_name'],
            'suburb' => (string) $row['suburb'],
            'city' => (string) $row['city'],
            'province' => (string) $row['province'],
            'zip_code' => (string) $row['zip_code'],
            'country' => $country,
        ];
    }
}

$peopleCount = count($people);
$maleCount = $peopleCount - $femaleCount;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identification System | Report</title>
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
    <div class="mx-auto flex min-h-screen max-w-[1720px] flex-col gap-6 px-4 py-4 lg:flex-row lg:px-6">
        <aside class="glass-panel app-card w-full rounded-[2rem] p-5 lg:sticky lg:top-4 lg:h-[calc(100vh-2rem)] lg:w-80 lg:self-start">
            <div class="flex items-center gap-4 border-b border-white/10 pb-5">
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-rose-400/15 text-rose-300">
                    <i class="fa fa-line-chart text-xl"></i>
                </div>
                <div>
                    <div class="app-kicker">Admin console</div>
                    <h1 class="mt-1 text-xl font-bold text-white">Reports</h1>
                </div>
            </div>

            <nav class="mt-6 space-y-2">
                <a class="app-sidebar-link" href="dashboard.php"><i class="fas fa-tachometer-alt w-5"></i><span>Dashboard</span></a>
                <a class="app-sidebar-link" href="face_backfill.php"><i class="fa fa-database w-5"></i><span>Face Cache Backfill</span></a>
                <a class="app-sidebar-link" href="people.php"><i class="fa fa-users w-5"></i><span>Citizens</span></a>
                <a class="app-sidebar-link" href="non_citi.php"><i class="fa fa-globe w-5"></i><span>Non Citizens</span></a>
                <a class="app-sidebar-link" href="police.php"><i class="fa fa-user-secret w-5"></i><span>Police</span></a>
                <a class="app-sidebar-link" href="criminal.php"><i class="fa fa-folder-open w-5"></i><span>Cases</span></a>
                <a class="app-sidebar-link is-active" href="report.php"><i class="fa fa-line-chart w-5"></i><span>Reports</span></a>
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
                        <div class="app-kicker">Reporting workspace</div>
                        <h2 class="mt-3 text-4xl font-extrabold text-white">People information report</h2>
                        <p class="mt-4 max-w-3xl text-base leading-7 text-slate-300">Search across the registry, inspect the full reporting dataset, and export the current table to Word, Excel, CSV, or print.</p>
                    </div>
                    <div class="rounded-[1.5rem] border border-white/10 bg-slate-950/40 px-5 py-4 text-sm text-slate-300">
                        <div class="font-semibold text-white">Export note</div>
                        <p class="mt-2 max-w-sm leading-6">The export buttons still use the existing client-side table tools, now presented inside the updated admin shell.</p>
                    </div>
                </div>
            </section>

            <section class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                <div class="app-stat">
                    <div class="app-stat-value"><?php echo htmlspecialchars((string) $peopleCount, ENT_QUOTES, 'UTF-8'); ?></div>
                    <div class="app-stat-label">People in report</div>
                </div>
                <div class="app-stat">
                    <div class="app-stat-value"><?php echo htmlspecialchars((string) $citizenCount, ENT_QUOTES, 'UTF-8'); ?></div>
                    <div class="app-stat-label">South Africans</div>
                </div>
                <div class="app-stat">
                    <div class="app-stat-value"><?php echo htmlspecialchars((string) $nonCitizenCount, ENT_QUOTES, 'UTF-8'); ?></div>
                    <div class="app-stat-label">Non South Africans</div>
                </div>
                <div class="app-stat">
                    <div class="app-stat-value"><?php echo htmlspecialchars((string) $maleCount . ' / ' . (string) $femaleCount, ENT_QUOTES, 'UTF-8'); ?></div>
                    <div class="app-stat-label">Male / Female</div>
                </div>
            </section>

            <section class="glass-panel app-card rounded-[2rem] p-6">
                <div class="flex flex-col gap-4 border-b border-white/10 pb-5 xl:flex-row xl:items-end xl:justify-between">
                    <div>
                        <div class="app-kicker">Search</div>
                        <h3 class="mt-2 text-2xl font-bold text-white">Find a person quickly</h3>
                    </div>
                    <form action="search.php" method="post" class="w-full max-w-xl">
                        <div class="flex flex-col gap-3 sm:flex-row">
                            <input class="app-input" type="text" name="search" required placeholder="Search by name, ID, phone, or address">
                            <button class="app-button app-button-primary shrink-0" type="submit"><i class="fa fa-search"></i>Search</button>
                        </div>
                    </form>
                </div>

                <div class="mt-6 flex flex-wrap gap-3">
                    <button class="app-button app-button-secondary" type="button" onclick="jQuery('#tab').wordExport({font:20});"><i class="fa fa-file-word-o"></i>Word</button>
                    <button class="app-button app-button-secondary" type="button" onclick="jQuery('#tab').tblToExcel();"><i class="fa fa-file-excel-o"></i>Excel</button>
                    <button class="app-button app-button-secondary" type="button" onclick="jQuery('#tab').table2csv();"><i class="fa fa-file-text"></i>CSV</button>
                    <button class="app-button app-button-primary" type="button" onclick="myApp.printTable()"><i class="fa fa-print"></i>Print</button>
                </div>

                <?php if ($peopleCount === 0) { ?>
                    <div class="mt-6 rounded-[1.5rem] border border-white/10 bg-slate-950/40 px-5 py-8 text-center text-slate-300">No records are available to report yet.</div>
                <?php } else { ?>
                    <div class="mt-6 overflow-x-auto">
                        <table class="min-w-full divide-y divide-white/10 text-left text-sm text-slate-300" id="tab">
                            <thead>
                                <tr class="text-xs uppercase tracking-[0.18em] text-slate-400">
                                    <th class="px-4 py-3 font-semibold">No.</th>
                                    <th class="px-4 py-3 font-semibold">Name</th>
                                    <th class="px-4 py-3 font-semibold">ID Number</th>
                                    <th class="px-4 py-3 font-semibold">Gender</th>
                                    <th class="px-4 py-3 font-semibold">Date of Birth</th>
                                    <th class="px-4 py-3 font-semibold">Phone</th>
                                    <th class="px-4 py-3 font-semibold">Email</th>
                                    <th class="px-4 py-3 font-semibold">Next of Kin</th>
                                    <th class="px-4 py-3 font-semibold">Kin Phone</th>
                                    <th class="px-4 py-3 font-semibold">Kin Email</th>
                                    <th class="px-4 py-3 font-semibold">House No</th>
                                    <th class="px-4 py-3 font-semibold">Street</th>
                                    <th class="px-4 py-3 font-semibold">Suburb</th>
                                    <th class="px-4 py-3 font-semibold">City</th>
                                    <th class="px-4 py-3 font-semibold">Province</th>
                                    <th class="px-4 py-3 font-semibold">Zip Code</th>
                                    <th class="px-4 py-3 font-semibold">Country</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                <?php foreach ($people as $index => $person) { ?>
                                    <tr class="align-top transition hover:bg-white/5">
                                        <td class="px-4 py-4 text-slate-400"><?php echo htmlspecialchars((string) ($index + 1), ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="px-4 py-4 font-semibold text-white"><?php echo htmlspecialchars($person['full_name'] !== '' ? $person['full_name'] : 'Unknown person', ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="px-4 py-4 font-medium text-slate-200"><?php echo htmlspecialchars($person['id_number'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="px-4 py-4"><?php echo htmlspecialchars($person['gender'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="px-4 py-4"><?php echo htmlspecialchars($person['date_of_birth'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="px-4 py-4"><?php echo htmlspecialchars($person['phone'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="px-4 py-4"><?php echo htmlspecialchars($person['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="px-4 py-4"><?php echo htmlspecialchars($person['next_of_kin'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="px-4 py-4"><?php echo htmlspecialchars($person['keen_phone'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="px-4 py-4"><?php echo htmlspecialchars($person['keen_email'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="px-4 py-4"><?php echo htmlspecialchars($person['house_no'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="px-4 py-4"><?php echo htmlspecialchars($person['street_name'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="px-4 py-4"><?php echo htmlspecialchars($person['suburb'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="px-4 py-4"><?php echo htmlspecialchars($person['city'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="px-4 py-4"><?php echo htmlspecialchars($person['province'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="px-4 py-4"><?php echo htmlspecialchars($person['zip_code'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="px-4 py-4"><?php echo htmlspecialchars($person['country'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } ?>
            </section>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="table2csv.js"></script>
    <script src="jspdf.js"></script>
    <script src="jspdf/libs/base64.js"></script>
    <script src="jspdf/libs/sprintf.js"></script>
    <script src="jquery.base64.js"></script>
    <script src="tableExport.js"></script>
    <script src="jquery.tableToExcel.js"></script>
    <script src="FileSaver.js"></script>
    <script src="jquery.wordexport.js"></script>
    <script>
        var myApp = new function () {
            this.printTable = function () {
                var tab = document.getElementById('tab');
                var win = window.open('', '', 'height=700,width=1200');
                win.document.write('<html><head><title>Report</title></head><body>' + tab.outerHTML + '</body></html>');
                win.document.close();
                win.print();
            };
        };
    </script>
</body>
</html>