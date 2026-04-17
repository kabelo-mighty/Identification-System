<?php include 'inc/session.php'; ?>
<?php $flashMessage = app_get_flash_message(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identification System | Facial Identity</title>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<body class="app-shell hero-grid">
    <div class="mx-auto flex min-h-screen max-w-[1600px] flex-col gap-6 px-4 py-4 lg:flex-row lg:px-6">
        <aside class="glass-panel app-card w-full rounded-[2rem] p-5 lg:sticky lg:top-4 lg:h-[calc(100vh-2rem)] lg:w-80 lg:self-start">
            <div class="border-b border-white/10 pb-5">
                <div class="brand-badge">
                    <i class="fa fa-camera"></i>
                    Facial service
                </div>
                <h1 class="mt-4 text-2xl font-bold text-white">Capture Photo</h1>
                <p class="mt-2 text-sm text-slate-400"><?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
            <nav class="mt-6 space-y-2">
                <a class="app-sidebar-link" href="view.php"><i class="fa fa-home w-5"></i><span>Dashboard</span></a>
                <a class="app-sidebar-link" href="profile.php"><i class="fa fa-user w-5"></i><span>Profile</span></a>
                <a class="app-sidebar-link" href="crecord.php"><i class="fa fa-folder-open w-5"></i><span>Criminal Record</span></a>
                <a class="app-sidebar-link is-active" href="faceai.php"><i class="fa fa-camera w-5"></i><span>Capture Photo</span></a>
                <a class="app-sidebar-link" href="face-open.php"><i class="fa fa-image w-5"></i><span>View Photo</span></a>
            </nav>
        </aside>

        <main class="flex-1 space-y-6">
            <section class="glass-panel-strong app-card rounded-[2rem] p-6 md:p-8">
                <div class="app-kicker">Facial identity</div>
                <h2 class="mt-3 text-4xl font-extrabold text-white">Capture facial identity</h2>
                <p class="mt-4 max-w-3xl text-base leading-7 text-slate-300">Take a clean photo to store the image used by the verification workflow. Good lighting and a centered face improve the match quality.</p>
            </section>

            <?php if ($flashMessage) { ?>
                <?php echo app_render_flash_banner($flashMessage); ?>
            <?php } ?>

            <section class="grid gap-6 xl:grid-cols-[0.85fr_1.15fr]">
                <div class="glass-panel app-card rounded-[2rem] p-6">
                    <div class="app-kicker">Instructions</div>
                    <ul class="mt-5 space-y-3 text-sm leading-6 text-slate-300">
                        <li>Ensure there is enough light in the room.</li>
                        <li>Face the camera directly before taking the snapshot.</li>
                        <li>Retake if the image is blurred or too dark.</li>
                        <li>Save only when the preview looks clear and centered.</li>
                    </ul>
                    <button class="app-button app-button-primary mt-8 w-full" id="accesscamera" data-toggle="modal" data-target="#photoModal" type="button">
                        <i class="fa fa-camera-retro"></i>
                        Open camera
                    </button>
                </div>

                <div class="glass-panel app-card rounded-[2rem] p-6">
                    <div class="rounded-[1.75rem] border border-dashed border-white/15 bg-slate-950/40 p-6 text-center">
                        <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-sky-400/12 text-sky-300">
                            <i class="fa fa-camera text-2xl"></i>
                        </div>
                        <h3 class="mt-5 text-2xl font-bold text-white">Ready to capture</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-300">Use the camera modal to preview, retake, and save a new facial image. The existing upload flow remains active behind the redesigned interface.</p>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <div class="modal fade" id="photoModal" tabindex="-1" aria-labelledby="photoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 bg-slate-950 text-white">
                <div class="modal-header border-slate-800">
                    <h5 class="modal-title" id="photoModalLabel">Capture Photo</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body space-y-4">
                    <div id="my_camera" class="mx-auto overflow-hidden rounded-2xl"></div>
                    <div id="results" class="d-none"></div>
                    <form method="post" id="photoForm">
                        <input type="hidden" id="photoStore" name="photoStore" value="">
                    </form>
                </div>
                <div class="modal-footer border-slate-800">
                    <button type="button" class="app-button app-button-secondary" id="retakephoto">Retake</button>
                    <button type="button" class="app-button app-button-secondary" id="takephoto">Capture Photo</button>
                    <button type="submit" class="app-button app-button-primary" id="uploadphoto" form="photoForm">Save</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <script src="./plugin/sweetalert/sweetalert.min.js"></script>
    <script src="./plugin/webcamjs/webcam.min.js"></script>
    <script src="main.js"></script>
    <script>
        document.getElementById('retakephoto').classList.add('d-none');
        document.getElementById('uploadphoto').classList.add('d-none');
    </script>
</body>
</html>