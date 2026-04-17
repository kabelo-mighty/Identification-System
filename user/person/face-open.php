<?php
include 'inc/session.php';

$flashMessage = app_get_flash_message();

$imagePath = '../../faceapi/person_face_id/error.png';
$hasImage = false;

$statement = mysqli_prepare($conn, 'SELECT picture FROM face_identification WHERE person_id = ? LIMIT 1');
mysqli_stmt_bind_param($statement, 'i', $id);
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);
$row = mysqli_fetch_assoc($result);
mysqli_stmt_close($statement);

if ($row && !empty($row['picture'])) {
    $imagePath = '../../faceapi/person_face_id/' . $row['picture'] . '.jpg';
    $hasImage = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identification System | Display Photo</title>
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
                    <i class="fa fa-image"></i>
                    Facial service
                </div>
                <h1 class="mt-4 text-2xl font-bold text-white">Saved Photo</h1>
                <p class="mt-2 text-sm text-slate-400"><?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
            <nav class="mt-6 space-y-2">
                <a class="app-sidebar-link" href="view.php"><i class="fa fa-home w-5"></i><span>Dashboard</span></a>
                <a class="app-sidebar-link" href="profile.php"><i class="fa fa-user w-5"></i><span>Profile</span></a>
                <a class="app-sidebar-link" href="crecord.php"><i class="fa fa-folder-open w-5"></i><span>Criminal Record</span></a>
                <a class="app-sidebar-link" href="faceai.php"><i class="fa fa-camera w-5"></i><span>Capture Photo</span></a>
                <a class="app-sidebar-link is-active" href="face-open.php"><i class="fa fa-image w-5"></i><span>View Photo</span></a>
            </nav>
        </aside>

        <main class="flex-1 space-y-6">
            <section class="glass-panel-strong app-card rounded-[2rem] p-6 md:p-8">
                <div class="app-kicker">Stored verification image</div>
                <h2 class="mt-3 text-4xl font-extrabold text-white">Saved picture</h2>
                <p class="mt-4 max-w-3xl text-base leading-7 text-slate-300">Preview the image currently on file for the facial verification workflow.</p>
            </section>

            <?php if ($flashMessage) { ?>
                <?php echo app_render_flash_banner($flashMessage); ?>
            <?php } ?>

            <section class="glass-panel app-card rounded-[2rem] p-6 text-center">
                <div class="mx-auto max-w-2xl rounded-[2rem] border border-white/10 bg-slate-950/40 p-6">
                    <img src="<?php echo htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8'); ?>" alt="Saved face" class="mx-auto max-h-[28rem] rounded-[1.5rem] border border-white/10 object-contain">
                    <div class="mt-6">
                        <div class="app-badge <?php echo $hasImage ? 'app-badge-success' : 'app-badge-warn'; ?>">
                            <?php echo $hasImage ? 'Face image available' : 'No image stored yet'; ?>
                        </div>
                    </div>
                    <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:justify-center">
                        <a class="app-button app-button-primary" href="faceai.php"><i class="fa fa-camera"></i><?php echo $hasImage ? 'Replace photo' : 'Capture photo'; ?></a>
                        <a class="app-button app-button-secondary" href="view.php"><i class="fa fa-home"></i>Back to dashboard</a>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>