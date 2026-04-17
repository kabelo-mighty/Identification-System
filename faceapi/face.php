<?php include '../faceapi/person_face_id/inc/session.php'; ?>
<?php
$referenceCount = 0;
$countStatement = mysqli_prepare(
        $conn,
        'SELECT COUNT(*) AS count
         FROM face_identification f
         INNER JOIN person p ON p.person_id = f.person_id
         WHERE f.picture <> ?
             AND p.id_number <> ?
             AND CHAR_LENGTH(p.id_number) = 13'
);
$empty = '';
mysqli_stmt_bind_param($countStatement, 'ss', $empty, $empty);
mysqli_stmt_execute($countStatement);
$countResult = mysqli_stmt_get_result($countStatement);
$countRow = mysqli_fetch_assoc($countResult);
$referenceCount = (int) ($countRow['count'] ?? 0);
mysqli_stmt_close($countStatement);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identification System | Facial Recognition</title>
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
                    <i class="fa fa-camera"></i>
                    Facial verification
                </div>
                <h1 class="mt-4 text-2xl font-bold text-white">Police retrieval</h1>
                <p class="mt-2 text-sm text-slate-400"><?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?></p>
            </div>

            <nav class="mt-6 space-y-2">
                <a class="app-sidebar-link is-active" href="face.php"><i class="fa fa-camera w-5"></i><span>Verify face</span></a>
                <a class="app-sidebar-link" href="person_face_id/inc/logout.php"><i class="fa fa-power-off w-5"></i><span>Logout</span></a>
            </nav>

            <div class="mt-8 rounded-[1.5rem] border border-white/10 bg-slate-950/40 p-4 text-sm leading-6 text-slate-300">
                The live camera frame is matched against all enrolled face records. No claimed ID number is required before retrieval.
            </div>
        </aside>

        <main class="flex-1 space-y-6">
            <section class="glass-panel-strong app-card rounded-[2rem] p-6 md:p-8">
                <div class="app-kicker">No Python flow</div>
                <h2 class="mt-3 text-4xl font-extrabold text-white">Face-only retrieval</h2>
                <p class="mt-4 max-w-3xl text-base leading-7 text-slate-300">This page now searches across the enrolled face gallery in the browser using local face-recognition models. The operator no longer has to type an ID number before retrieval.</p>
            </section>

            <section class="grid gap-6 xl:grid-cols-[1.1fr_0.9fr]">
                <div class="glass-panel app-card rounded-[2rem] p-6">
                    <div class="rounded-[1.75rem] border border-white/10 bg-slate-950/40 p-4">
                        <video id="video" autoplay playsinline muted class="aspect-video w-full rounded-[1.25rem] border border-white/10 bg-slate-900 object-cover"></video>
                    </div>
                    <canvas id="captureCanvas" class="hidden"></canvas>

                    <div class="mt-6 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                        <div class="rounded-[1rem] border border-white/10 bg-slate-950/40 px-4 py-3 text-sm text-slate-300">
                            Enrolled references available: <span id="indexedCount" class="font-semibold text-white"><?php echo htmlspecialchars((string) $referenceCount, ENT_QUOTES, 'UTF-8'); ?></span>
                        </div>
                        <button class="app-button app-button-primary h-[3.5rem]" id="verifyButton" type="button">
                            <i class="fa fa-search"></i>
                            Search by Face
                        </button>
                    </div>
                </div>

                <div class="space-y-6">
                    <section id="statusPanel" class="glass-panel app-card rounded-[2rem] p-6">
                        <div id="statusBadge" class="app-badge app-badge-info">Ready</div>
                        <h3 id="statusTitle" class="mt-4 text-2xl font-bold text-white">Initializing</h3>
                        <p id="statusText" class="mt-3 text-sm leading-6 text-slate-300">Camera access, local recognition models, and the stored face gallery are loading.</p>
                        <div class="mt-5 rounded-[1rem] border border-white/10 bg-slate-950/40 px-4 py-3 text-sm text-slate-300">
                            Match distance: <span id="distanceValue" class="font-semibold text-white">-</span>
                        </div>
                    </section>

                    <section class="glass-panel app-card rounded-[2rem] p-6">
                        <div class="app-kicker">Comparison previews</div>
                        <div class="mt-5 grid gap-4 md:grid-cols-2">
                            <div>
                                <p class="mb-2 text-sm font-semibold text-slate-200">Live capture</p>
                                <img id="livePreview" alt="Live capture preview" class="aspect-[4/3] w-full rounded-[1.25rem] border border-white/10 bg-slate-950/40 object-cover">
                            </div>
                            <div>
                                <p class="mb-2 text-sm font-semibold text-slate-200">Stored reference</p>
                                <img id="referencePreview" alt="Stored face preview" class="aspect-[4/3] w-full rounded-[1.25rem] border border-white/10 bg-slate-950/40 object-cover">
                            </div>
                        </div>
                    </section>

                    <section class="glass-panel app-card rounded-[2rem] p-6">
                        <div class="app-kicker">Rules</div>
                        <ul class="mt-4 space-y-2 text-sm leading-6 text-slate-300">
                            <li>The information is confidential.</li>
                            <li>The information should not be distributed or shared.</li>
                            <li>Ensure the face is clearly visible and centered before running the gallery search.</li>
                        </ul>
                    </section>
                </div>
            </section>
        </main>
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>
    <script defer src="assets/js/browser-face-verify.js"></script>
</body>
</html>