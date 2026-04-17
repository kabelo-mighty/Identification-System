<?php include 'inc/session.php'; ?>
<?php include 'inc/connect.php'; ?>
<?php require_once '../../src/face_descriptor_cache.php'; ?>
<?php
app_ensure_face_descriptor_cache_table($conn);

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

$records = [];
$statement = mysqli_prepare(
    $conn,
    'SELECT p.person_id, p.id_number, p.firstname, p.lastname, f.picture, c.person_id AS cache_person_id
     FROM face_identification f
     INNER JOIN person p ON p.person_id = f.person_id
     LEFT JOIN face_descriptor_cache c ON c.person_id = p.person_id
     WHERE f.picture <> ?
       AND p.id_number <> ?
       AND CHAR_LENGTH(p.id_number) = 13
     ORDER BY p.person_id ASC'
);
$empty = '';
mysqli_stmt_bind_param($statement, 'ss', $empty, $empty);
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);

$cachedCount = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $isCached = !empty($row['cache_person_id']);
    if ($isCached) {
        $cachedCount += 1;
    }

    $records[] = [
        'personId' => (int) $row['person_id'],
        'fullName' => trim($row['firstname'] . ' ' . $row['lastname']),
        'idNumber' => (string) $row['id_number'],
        'imagePath' => '../../faceapi/person_face_id/' . $row['picture'] . '.jpg',
        'cached' => $isCached,
    ];
}
mysqli_stmt_close($statement);

$totalRecords = count($records);
$missingCount = $totalRecords - $cachedCount;
$csrfToken = app_get_csrf_token();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identification System | Face Cache Backfill</title>
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
    <div class="mx-auto flex min-h-screen max-w-[1600px] flex-col gap-6 px-4 py-4 lg:flex-row lg:px-6">
        <aside class="glass-panel app-card w-full rounded-[2rem] p-5 lg:sticky lg:top-4 lg:h-[calc(100vh-2rem)] lg:w-80 lg:self-start">
            <div class="flex items-center gap-4 border-b border-white/10 pb-5">
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-400/15 text-emerald-300">
                    <i class="fa fa-database text-xl"></i>
                </div>
                <div>
                    <div class="app-kicker">Admin console</div>
                    <h1 class="mt-1 text-xl font-bold text-white">Face cache tools</h1>
                </div>
            </div>

            <nav class="mt-6 space-y-2">
                <a class="app-sidebar-link" href="dashboard.php"><i class="fas fa-tachometer-alt w-5"></i><span>Dashboard</span></a>
                <a class="app-sidebar-link is-active" href="face_backfill.php"><i class="fa fa-database w-5"></i><span>Face Cache Backfill</span></a>
                <a class="app-sidebar-link" href="people.php"><i class="fa fa-users w-5"></i><span>Citizens</span></a>
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
                <div class="app-kicker">Descriptor maintenance</div>
                <h2 class="mt-3 text-4xl font-extrabold text-white">Face descriptor backfill</h2>
                <p class="mt-4 max-w-3xl text-base leading-7 text-slate-300">Generate cached face descriptors for existing enrolled face images so gallery searches stop recomputing references from raw image files on each lookup.</p>
            </section>

            <section class="grid gap-4 md:grid-cols-3">
                <div class="app-stat">
                    <div class="app-stat-value"><?php echo htmlspecialchars((string) $totalRecords, ENT_QUOTES, 'UTF-8'); ?></div>
                    <div class="app-stat-label">Enrolled face records</div>
                </div>
                <div class="app-stat">
                    <div class="app-stat-value"><?php echo htmlspecialchars((string) $cachedCount, ENT_QUOTES, 'UTF-8'); ?></div>
                    <div class="app-stat-label">Cached descriptors</div>
                </div>
                <div class="app-stat">
                    <div class="app-stat-value"><?php echo htmlspecialchars((string) $missingCount, ENT_QUOTES, 'UTF-8'); ?></div>
                    <div class="app-stat-label">Missing cache entries</div>
                </div>
            </section>

            <section class="grid gap-6 xl:grid-cols-[0.85fr_1.15fr]">
                <div class="glass-panel app-card rounded-[2rem] p-6">
                    <div class="app-kicker">Backfill run</div>
                    <p class="mt-4 text-sm leading-6 text-slate-300">Choose whether to fill only missing cache entries or rebuild descriptors for the entire enrolled set. Each image is loaded in the browser, converted into a face descriptor, and then stored through an admin-only endpoint.</p>
                    <div class="mt-6 grid gap-3 sm:grid-cols-2">
                        <button id="startBackfill" class="app-button app-button-primary w-full" type="button">
                            <i class="fa fa-play"></i>
                            Backfill Missing
                        </button>
                        <button id="rebuildAll" class="app-button app-button-secondary w-full" type="button">
                            <i class="fa fa-refresh"></i>
                            Rebuild All
                        </button>
                    </div>
                    <div class="mt-5 rounded-[1rem] border border-white/10 bg-slate-950/40 px-4 py-3 text-sm text-slate-300">
                        Progress: <span id="progressText" class="font-semibold text-white">Idle</span>
                    </div>
                    <div class="mt-3 rounded-[1rem] border border-white/10 bg-slate-950/40 px-4 py-3 text-sm text-slate-300">
                        Status: <span id="statusText" class="font-semibold text-white">Waiting to start</span>
                    </div>
                </div>

                <div class="glass-panel app-card rounded-[2rem] p-6">
                    <div class="app-kicker">Queue preview</div>
                    <div class="mt-5 max-h-[34rem] overflow-auto space-y-3" id="recordList">
                        <?php foreach ($records as $record) { ?>
                            <div class="rounded-[1.25rem] border border-white/10 bg-slate-950/40 px-4 py-4" data-person-id="<?php echo htmlspecialchars((string) $record['personId'], ENT_QUOTES, 'UTF-8'); ?>">
                                <div class="flex items-center justify-between gap-4">
                                    <div>
                                        <p class="text-base font-semibold text-white"><?php echo htmlspecialchars($record['fullName'] !== '' ? $record['fullName'] : 'Unknown person', ENT_QUOTES, 'UTF-8'); ?></p>
                                        <p class="mt-1 text-xs uppercase tracking-[0.18em] text-slate-400"><?php echo htmlspecialchars($record['idNumber'], ENT_QUOTES, 'UTF-8'); ?></p>
                                    </div>
                                    <span class="app-badge <?php echo $record['cached'] ? 'app-badge-success' : 'app-badge-warn'; ?>" data-status-badge>
                                        <?php echo $record['cached'] ? 'Cached' : 'Pending'; ?>
                                    </span>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>
    <script>
        const MODEL_PATH = '../../faceapi/assets/models';
        const SAVE_ENDPOINT = 'face_backfill_save.php';
        const CSRF_TOKEN = <?php echo json_encode($csrfToken); ?>;
        const allRecords = <?php echo json_encode($records, JSON_UNESCAPED_SLASHES); ?>;
        const startButton = document.getElementById('startBackfill');
        const rebuildButton = document.getElementById('rebuildAll');
        const progressText = document.getElementById('progressText');
        const statusText = document.getElementById('statusText');

        let modelsPromise = null;

        function ensureModelsLoaded() {
            if (!modelsPromise) {
                modelsPromise = Promise.all([
                    faceapi.nets.tinyFaceDetector.loadFromUri(MODEL_PATH),
                    faceapi.nets.faceLandmark68Net.loadFromUri(MODEL_PATH),
                    faceapi.nets.faceRecognitionNet.loadFromUri(MODEL_PATH),
                ]);
            }

            return modelsPromise;
        }

        function loadImage(src) {
            return new Promise(function(resolve, reject) {
                const img = new Image();
                img.onload = function() { resolve(img); };
                img.onerror = function() { reject(new Error('Image could not be loaded.')); };
                img.src = src;
            });
        }

        async function computeDescriptor(img) {
            const detection = await faceapi
                .detectSingleFace(img, new faceapi.TinyFaceDetectorOptions({ inputSize: 320, scoreThreshold: 0.5 }))
                .withFaceLandmarks()
                .withFaceDescriptor();

            if (!detection) {
                throw new Error('No face detected in reference image.');
            }

            return Array.from(detection.descriptor);
        }

        async function saveDescriptor(personId, descriptor) {
            const formData = new FormData();
            formData.append('personId', String(personId));
            formData.append('descriptor', JSON.stringify(descriptor));
            formData.append('_csrf_token', CSRF_TOKEN);

            const response = await fetch(SAVE_ENDPOINT, {
                method: 'POST',
                credentials: 'same-origin',
                body: formData,
            });

            if (!response.ok) {
                throw new Error('Descriptor save failed.');
            }

            const payload = await response.json();
            if (!payload.saved) {
                throw new Error(payload.message || 'Descriptor save failed.');
            }
        }

        function updateCard(personId, isSuccess, label) {
            const card = document.querySelector('[data-person-id="' + personId + '"]');
            if (!card) {
                return;
            }

            const badge = card.querySelector('[data-status-badge]');
            badge.className = 'app-badge ' + (isSuccess ? 'app-badge-success' : 'app-badge-warn');
            badge.textContent = label || (isSuccess ? 'Cached' : 'Failed');
        }

        function setButtonsDisabled(isDisabled) {
            startButton.disabled = isDisabled;
            rebuildButton.disabled = isDisabled;

            startButton.classList.toggle('opacity-60', isDisabled);
            rebuildButton.classList.toggle('opacity-60', isDisabled);
        }

        async function runBackfill(mode) {
            const targetRecords = mode === 'all'
                ? allRecords.slice()
                : allRecords.filter(function(record) { return !record.cached; });

            if (!targetRecords.length) {
                progressText.textContent = 'Nothing to do';
                statusText.textContent = 'All enrolled faces already have cached descriptors.';
                return;
            }

            setButtonsDisabled(true);

            try {
                progressText.textContent = 'Loading models';
                statusText.textContent = 'Preparing browser-side face recognition models.';
                await ensureModelsLoaded();

                for (let index = 0; index < targetRecords.length; index += 1) {
                    const record = targetRecords[index];
                    progressText.textContent = (index + 1) + ' / ' + targetRecords.length;
                    statusText.textContent = 'Processing ' + (record.fullName || record.idNumber) + '.';
                    updateCard(record.personId, true, mode === 'all' ? 'Refreshing' : 'Processing');

                    try {
                        const image = await loadImage(record.imagePath + '?ts=' + Date.now());
                        const descriptor = await computeDescriptor(image);
                        await saveDescriptor(record.personId, descriptor);
                        updateCard(record.personId, true, mode === 'all' ? 'Rebuilt' : 'Cached');
                    } catch (error) {
                        updateCard(record.personId, false, 'Failed');
                    }
                }

                statusText.textContent = mode === 'all'
                    ? 'Descriptor rebuild completed.'
                    : 'Backfill run completed.';
            } catch (error) {
                statusText.textContent = error.message || 'Backfill setup failed.';
            } finally {
                setButtonsDisabled(false);
            }
        }

        startButton.addEventListener('click', function() {
            runBackfill('missing');
        });

        rebuildButton.addEventListener('click', function() {
            runBackfill('all');
        });
    </script>
</body>
</html>