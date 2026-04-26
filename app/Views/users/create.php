<!DOCTYPE html>
<html lang="en">
<link rel="icon" href="<?= base_url('assets/img/FS_No_BG.png') ?>">

<!-- ===================== HEAD ===================== -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Enterprise | System Registration</title>

    <!-- 🔹 CSS -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- ===================== STYLE ===================== -->
    <style>
        :root {
            --primary-dark: #0f172a;
            --accent-blue: #2563eb;
            --slate-400: #94a3b8;
            --slate-500: #64748b;
            --slate-800: #1e293b;
        }

        /* ===================== BODY ===================== */
        body {
            background: radial-gradient(circle at top right, #f8fafc, #e2e8f0);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--slate-800);
            min-height: 100vh;
        }

        /* ===================== BRAND ===================== */
        .brand-section {
            text-align: center;
            margin-bottom: 2.5rem;
            padding-top: 3rem;
        }

        .brand-logo {
            width: 56px;
            height: 56px;
            background: var(--primary-dark);
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin-bottom: 1.25rem;
            transform: rotate(-5deg);
            box-shadow: 0 10px 15px -3px rgba(15, 23, 42, 0.3);
        }

        .title-text {
            font-weight: 800;
            font-size: 2rem;
            letter-spacing: -0.04em;
            color: var(--primary-dark);
            margin-bottom: 0.5rem;
        }

        .subtitle-text {
            color: var(--slate-500);
            font-size: 0.95rem;
            font-weight: 500;
        }

        /* ===================== CARD ===================== */
        .card {
            border: 1px solid rgba(255, 255, 255, 0.8);
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 1.5rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08) !important;
        }

        /* ===================== FORM ===================== */
        .form-label {
            font-weight: 700;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--slate-500);
            margin-bottom: 0.6rem;
        }

        .form-control,
        .form-select {
            border: 1.5px solid #e2e8f0;
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            font-weight: 500;
            background-color: #f8fafc;
            transition: all 0.2s ease;
        }

        .form-control:focus,
        .form-select:focus {
            background-color: #fff;
            border-color: var(--accent-blue);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.08);
            outline: 0;
            color: var(--primary-dark);
        }

        /* ===================== FILE INPUT ===================== */
        input[type="file"]::file-selector-button {
            background-color: var(--primary-dark);
            color: white;
            border: none;
            padding: 0.4rem 1rem;
            border-radius: 0.5rem;
            margin-right: 15px;
            font-weight: 600;
            font-size: 0.75rem;
            transition: all 0.2s;
        }

        input[type="file"]::file-selector-button:hover {
            background-color: #000;
            cursor: pointer;
        }

        /* ===================== BUTTON ===================== */
        .btn-primary {
            background: var(--primary-dark);
            border: none;
            border-radius: 0.75rem;
            padding: 0.9rem;
            font-weight: 700;
            letter-spacing: 0.02em;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-primary:hover {
            background: #000;
            transform: translateY(-2px);
            box-shadow: 0 12px 20px -5px rgba(15, 23, 42, 0.25);
        }

        /* ===================== ALERT ===================== */
        .alert-custom {
            background-color: #fef2f2;
            color: #991b1b;
            border: 1px solid #fee2e2;
            border-radius: 0.8rem;
            font-weight: 500;
            font-size: 0.85rem;
        }

        /* ===================== LINK ===================== */
        .auth-link {
            color: var(--accent-blue);
            text-decoration: none;
            font-weight: 700;
            transition: all 0.2s;
        }

        .auth-link:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        /* ===================== ANIMATION ===================== */
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-in {
            animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
    </style>
</head>

<!-- ===================== BODY ===================== -->
<body>

    <div class="container py-5">
        <div class="row justify-content-center">

            <!-- 🔹 MAIN COLUMN -->
            <div class="col-lg-8 col-xl-6 animate-in">

                <!-- 🔹 BRAND -->
                <div class="brand-section">
                    <div class="brand-logo">
                        <i class="bi bi-person-plus"></i>
                    </div>
                    <h2 class="title-text">Registration</h2>
                    <p class="subtitle-text">Create your administrative credentials</p>
                </div>

                <!-- 🔹 CARD -->
                <div class="card shadow-sm">
                    <div class="card-body p-4 p-md-5">

                        <!-- 🔹 ALERT -->
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-custom d-flex align-items-center mb-4">
                                <i class="bi bi-shield-exclamation me-2 fs-5"></i>
                                <div><?= session()->getFlashdata('error') ?></div>
                            </div>
                        <?php endif; ?>

                        <!-- 🔹 FORM -->
                        <form action="<?= base_url('users/store') ?>" method="post" enctype="multipart/form-data">

                            <div class="row g-4">

                                <!-- FULL NAME -->
                                <div class="col-12">
                                    <label class="form-label">Full Name</label>
                                    <div class="input-group">
                                        <input type="text" name="nama" class="form-control" placeholder="Enter your full name" required>
                                    </div>
                                </div>

                                <!-- EMAIL -->
                                <div class="col-12">
                                    <label class="form-label">Work Email Address</label>
                                    <input type="email" name="email" class="form-control" placeholder="name@enterprise.com" required>
                                </div>

                                <!-- USERNAME -->
                                <div class="col-md-6">
                                    <label class="form-label">Username</label>
                                    <input type="text" name="username" class="form-control" placeholder="id_account" required>
                                </div>

                                <!-- PASSWORD -->
                                <div class="col-md-6">
                                    <label class="form-label">Access Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password" id="accessPassword" class="form-control" placeholder="••••••••" required>
                                        <button class="btn btn-outline-secondary" type="button" id="btnToggleAccess">
                                            <i class="bi bi-eye" id="iconToggleAccess"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- ROLE -->
                                <?php if(session()->get('role') == 'admin'): ?>
                                <!-- ADMIN BOLEH PILIH ROLE -->
                                <div class="col-12">
                                    <label class="form-label">Administrative Role</label>
                                    <select name="role" class="form-select" required>
                                        <option value="" selected disabled>Select Access Level</option>
                                        <option value="admin">Administrator</option>
                                        <option value="teknisi">Field Technician</option>
                                        <option value="pelapor">General Reporter</option>
                                    </select>
                                </div>
                                <?php else: ?>
                                <!-- USER BIASA → AUTO PELAPOR -->
                                    <input type="hidden" name="role" value="pelapor">
                                <?php endif; ?>

                                <!-- FOTO -->
                                <div class="col-12">
                                    <label class="form-label">Profile Identification</label>
                                    <input type="file" name="foto" class="form-control" accept="image/*">
                                    <div class="form-text mt-2" style="font-size: 0.7rem; color: var(--slate-400);">
                                        <i class="bi bi-info-circle me-1"></i> Formats: JPEG, PNG. Max size 2MB.
                                    </div>
                                </div>

                            </div>

                            <!-- SUBMIT -->
                            <div class="mt-5">
                                <button type="submit" class="btn btn-primary w-100 shadow-sm">
                                    Finalize Registration 
                                    <i class="bi bi-arrow-right ms-2"></i>
                                </button>
                            </div>

                            <!-- LOGIN LINK -->
                            <?php if(!session()->get('id_user')): ?>
                                <div class="text-center mt-4 pt-2 border-top">
                                    <p class="small text-muted mb-0">
                                        Already a member? 
                                        <a href="<?= base_url('login') ?>" class="auth-link">
                                        Sign In to Dashboard
                                        </a>
                                    </p>
                                </div>
                            <?php endif; ?>

                            <?php if(session()->get('role') == 'admin'): ?>
                                <div class="mt-3 text-start">
                                    <a href="<?= base_url('users') ?>" class="btn btn-outline-secondary btn-sm">
                                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Data User
                                    </a>
                                </div>
                            <?php endif; ?>

                        </form>
                    </div>
                </div>

                <!-- FOOTER -->
                <div class="text-center mt-5">
                    <p style="font-size: 0.75rem; color: var(--slate-400); letter-spacing: 0.05em;">
                        SECURED ENTERPRISE SYSTEM &bull; &copy; 2026
                    </p>
                </div>

            </div>
        </div>
    </div>

    <!-- ===================== SCRIPT ===================== -->
    <script>
        const btnToggleAccess = document.querySelector('#btnToggleAccess');
        const accessField = document.querySelector('#accessPassword');
        const iconToggleAccess = document.querySelector('#iconToggleAccess');

        btnToggleAccess.addEventListener('click', function () {
            const isPassword = accessField.getAttribute('type') === 'password';
            accessField.setAttribute('type', isPassword ? 'text' : 'password');

            iconToggleAccess.classList.toggle('bi-eye');
            iconToggleAccess.classList.toggle('bi-eye-slash');
        });
    </script>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>

</body>
</html>