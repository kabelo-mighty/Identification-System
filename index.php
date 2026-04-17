<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identification System</title>
    <link rel="icon" href="assets/img/logo.jpg">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Sora', 'ui-sans-serif', 'system-ui', 'sans-serif']
                    },
                    boxShadow: {
                        ambient: '0 30px 80px rgba(2, 6, 23, 0.45)'
                    }
                }
            }
        };
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/tailwind-ui.css">
</head>
<body class="app-shell hero-grid overflow-x-hidden">
    <div class="relative isolate min-h-screen">
        <div class="absolute inset-x-0 top-0 -z-10 h-[36rem] bg-[radial-gradient(circle_at_top,rgba(34,197,94,0.18),transparent_34%),radial-gradient(circle_at_30%_20%,rgba(56,189,248,0.22),transparent_30%)]"></div>

        <header class="mx-auto max-w-7xl px-6 pt-6 lg:px-8">
            <div class="glass-panel app-card flex items-center justify-between rounded-full px-5 py-4">
                <div class="brand-badge">
                    <i class="fa fa-shield"></i>
                    Digital Identity Platform
                </div>
                <nav class="hidden items-center gap-3 md:flex">
                    <a class="app-button app-button-secondary text-sm" href="account/login.php">Citizen Login</a>
                    <a class="app-button app-button-secondary text-sm" href="user/admin/index.php">Admin</a>
                </nav>
            </div>
        </header>

        <main class="mx-auto grid max-w-7xl gap-12 px-6 pb-16 pt-10 lg:grid-cols-[1.1fr_0.9fr] lg:items-center lg:px-8 lg:pt-16">
            <section>
                <div class="brand-badge mb-6">
                    <i class="fa fa-circle text-[0.45rem]"></i>
                    AI-assisted identity verification
                </div>
                <h1 class="max-w-3xl text-5xl font-extrabold leading-tight text-white md:text-6xl">
                    Modern identity records, facial verification, and secure public-service workflows.
                </h1>
                <p class="mt-6 max-w-2xl text-lg leading-8 text-slate-300">
                    This platform brings registration, profile management, police verification, and facial identity checks into one streamlined system built for high-trust records.
                </p>

                <div class="mt-8 flex flex-col gap-4 sm:flex-row">
                    <a class="app-button app-button-primary" href="account/register.php">
                        <i class="fa fa-user-plus"></i>
                        Create Account
                    </a>
                    <a class="app-button app-button-secondary" href="faceapi/login.php">
                        <i class="fa fa-camera"></i>
                        Access Facial AI
                    </a>
                </div>

                <div class="mt-10 grid gap-4 sm:grid-cols-3">
                    <div class="app-stat">
                        <div class="app-stat-value">One</div>
                        <div class="app-stat-label">Platform for citizens, police, and administrators</div>
                    </div>
                    <div class="app-stat">
                        <div class="app-stat-value">AI</div>
                        <div class="app-stat-label">Face verification against stored identity photos</div>
                    </div>
                    <div class="app-stat">
                        <div class="app-stat-value">Live</div>
                        <div class="app-stat-label">Profiles, criminal records, and case management</div>
                    </div>
                </div>
            </section>

            <section class="glass-panel-strong app-card relative overflow-hidden rounded-[2rem] p-6 md:p-8">
                <div class="absolute -right-16 -top-16 h-48 w-48 rounded-full bg-emerald-400/15 blur-3xl"></div>
                <div class="absolute -bottom-20 left-0 h-52 w-52 rounded-full bg-sky-400/15 blur-3xl"></div>
                <div class="relative">
                    <div class="app-kicker mb-4">Platform overview</div>
                    <h2 class="text-3xl font-bold text-white">Designed for identity confidence and faster retrieval.</h2>
                    <div class="mt-8 space-y-4">
                        <div class="app-form-section">
                            <div class="flex items-start gap-4">
                                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-400/15 text-emerald-300">
                                    <i class="fa fa-id-card-o"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-white">Citizen onboarding</h3>
                                    <p class="mt-1 text-sm leading-6 text-slate-300">Register citizens, store contact and next-of-kin details, and manage profile data from a cleaner account workflow.</p>
                                </div>
                            </div>
                        </div>
                        <div class="app-form-section">
                            <div class="flex items-start gap-4">
                                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-sky-400/15 text-sky-300">
                                    <i class="fa fa-camera-retro"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-white">Facial verification</h3>
                                    <p class="mt-1 text-sm leading-6 text-slate-300">Capture a live webcam image and compare it against the stored face image for a claimed identity record.</p>
                                </div>
                            </div>
                        </div>
                        <div class="app-form-section">
                            <div class="flex items-start gap-4">
                                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-amber-400/15 text-amber-300">
                                    <i class="fa fa-folder-open-o"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-white">Operational control</h3>
                                    <p class="mt-1 text-sm leading-6 text-slate-300">Admins can confirm accounts, assign police roles, manage cases, and generate reports from the operations workspace.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <section class="mx-auto max-w-7xl px-6 pb-20 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-3">
                <a class="glass-panel app-card block rounded-[1.75rem] p-6 transition hover:-translate-y-1" href="account/login.php">
                    <div class="app-badge app-badge-info">Account access</div>
                    <h3 class="mt-5 text-2xl font-bold text-white">Citizen Portal</h3>
                    <p class="mt-3 text-sm leading-6 text-slate-300">Login, manage profile data, upload a facial image, and view linked records from a more polished account area.</p>
                </a>
                <a class="glass-panel app-card block rounded-[1.75rem] p-6 transition hover:-translate-y-1" href="faceapi/login.php">
                    <div class="app-badge app-badge-success">Verification</div>
                    <h3 class="mt-5 text-2xl font-bold text-white">Facial AI Access</h3>
                    <p class="mt-3 text-sm leading-6 text-slate-300">Use the face-verification workflow to retrieve a person record after a webcam comparison against the stored identity photo.</p>
                </a>
                <a class="glass-panel app-card block rounded-[1.75rem] p-6 transition hover:-translate-y-1" href="user/admin/index.php">
                    <div class="app-badge app-badge-warn">Operations</div>
                    <h3 class="mt-5 text-2xl font-bold text-white">Admin Console</h3>
                    <p class="mt-3 text-sm leading-6 text-slate-300">Access citizen management, police assignments, cases, and reporting with a cleaner control-room style dashboard.</p>
                </a>
            </div>
        </section>
    </div>
</body>
</html>