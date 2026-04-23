<!DOCTYPE html>
<html lang="en">

<!-- ===================== HEAD ===================== -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium Sign In | Enterprise System</title>

    <!-- 🔹 CSS -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- ===================== STYLE ===================== -->
    <style>
        :root {
            --primary-dark: #0f172a;
            --accent-blue: #2563eb;
            --slate-500: #64748b;
            --slate-800: #1e293b;
        }

        /* ===================== BODY ===================== */
        body {
            background: linear-gradient(to bottom, 
                        rgba(248, 250, 252, 0) 10%, 
                        rgba(248, 250, 252, 0.4) 20%, 
                        rgba(248, 250, 252, 0.8) 30%, 
                        rgba(248, 250, 252, 1) 40%), 
                    url('<?= base_url("assets/img/sky.gif") ?>');

            background-size: cover; 
            background-position: top center;
            background-repeat: no-repeat;
            background-color: #f8fafc;
            background-attachment: fixed;

            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--slate-800);
            height: 100vh;
            margin: 0;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* ===================== AUTH CONTAINER ===================== */
        .auth-container {
            width: 100%;
            max-width: 440px;
            padding: 1rem;
        }

        .card {
            border: 1px solid rgba(255, 255, 255, 0.8);
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 1.5rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08) !important;
            padding: 1.5rem;
        }

        /* ===================== BRAND ===================== */
        .brand-section {
            text-align: center;
            margin-bottom: 2.5rem;
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

        .login-title {
            font-weight: 800;
            font-size: 1.75rem;
            letter-spacing: -0.03em;
            color: var(--primary-dark);
            margin-bottom: 0.25rem;
        }

        .login-subtitle {
            color: var(--slate-500);
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* ===================== FORM ===================== */
        .form-label {
            font-weight: 700;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--slate-500);
            margin-bottom: 0.5rem;
        }

        .input-group-text {
            background-color: #f1f5f9;
            border: 1.5px solid #e2e8f0;
            border-right: none;
            color: var(--slate-500);
            border-radius: 0.75rem 0 0 0.75rem;
        }

        .form-control {
            border: 1.5px solid #e2e8f0;
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.2s ease;
            background-color: #f8fafc;
        }

        .form-control:focus {
            background-color: #fff;
            border-color: var(--accent-blue);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.08);
            color: var(--primary-dark);
        }

        /* ===================== BUTTON ===================== */
        .btn-primary {
            background: var(--primary-dark);
            border: none;
            border-radius: 0.75rem;
            padding: 0.9rem;
            font-weight: 700;
            letter-spacing: 0.01em;
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
            border-radius: 0.75rem;
            font-weight: 500;
            font-size: 0.85rem;
        }

        /* ===================== LINKS ===================== */
        .auth-link {
            color: var(--accent-blue);
            text-decoration: none;
            font-weight: 700;
            transition: all 0.2s;
        }

        .auth-link:hover {
            text-decoration: underline;
            color: var(--primary-dark);
        }

        /* ===================== FOOTER ===================== */
        .footer-utils {
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px dashed #e2e8f0;
        }

        .btn-restore {
            border: 1.5px solid #fee2e2;
            color: #ef4444;
            font-weight: 600;
            border-radius: 0.5rem;
            transition: all 0.2s;
        }

        .btn-restore:hover {
            background-color: #ef4444;
            color: white;
        }

        /* ===================== ANIMATION ===================== */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade {
            animation: fadeIn 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }
    </style>
</head>

<!-- ===================== BODY ===================== -->
<body>

    <!-- 🔹 AUTH CONTAINER -->
    <div class="auth-container animate-fade">

        <!-- 🔹 BRAND -->
        <div class="brand-section">
            <div class="brand-logo">
                <i class="bi bi-layers-half"></i>
            </div>
            <h3 class="login-title">Welcome Back</h3>
            <p class="login-subtitle">Please enter your details to sign in</p>
        </div>

        <!-- 🔹 CARD -->
        <div class="card">
            <div class="card-body p-2">

                <!-- 🔹 ALERT -->
                <?php if (session()->getFlashdata('error') || session()->getFlashdata('salahpw')): ?>
                    <div class="alert alert-custom mb-4 d-flex align-items-center animate-fade" role="alert">
                        <i class="bi bi-x-circle-fill me-2"></i>
                        <div>
                            <?= session()->getFlashdata('error') ?: session()->getFlashdata('salahpw') ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- 🔹 FORM -->
                <form action="<?= base_url('/proses-login') ?>" method="post">

                    <!-- USERNAME -->
                    <div class="mb-4">
                        <label class="form-label">Identity</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-person"></i>
                            </span>
                            <input type="text" name="username" class="form-control" placeholder="Username" required>
                        </div>
                    </div>

                    <!-- PASSWORD -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label class="form-label mb-0">Security Key</label>
                            <a href="#" class="auth-link small" style="font-size: 0.75rem;">Recover?</a>
                        </div>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-key"></i>
                            </span>

                            <input type="password" name="password" id="passwordField" class="form-control" placeholder="Password" required>

                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="bi bi-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>

                    <!-- REMEMBER -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember">
                            <label class="form-check-label text-muted small fw-medium" for="remember">
                                Trust this device
                            </label>
                        </div>
                    </div>

                    <!-- SUBMIT -->
                    <button type="submit" class="btn btn-primary w-100 mb-3 shadow-sm">
                        Access Dashboard 
                        <i class="bi bi-arrow-right ms-2"></i>
                    </button>
                </form>

                <!-- REGISTER -->
                <div class="text-center mt-2">
                    <p class="text-muted small fw-medium">
                        New member? 
                        <a href="<?= base_url('users/create') ?>" class="auth-link">
                            Create Account
                        </a>
                    </p>
                </div>

                <!-- RESTORE -->
                <div class="footer-utils text-center">
                    <a href="<?= base_url('restore') ?>" class="btn btn-restore btn-sm px-3">
                        <i class="bi bi-database me-1"></i> System Restore
                    </a>
                </div>

            </div>
        </div>

        <!-- FOOTER -->
        <p class="text-center text-muted mt-4" style="font-size: 0.7rem; opacity: 0.6;">
            &copy; <?= date('Y') ?> Enterprise Internal System. All rights reserved.
        </p>
    </div>

    <!-- ================== SCRIPT SHOW / HIDE PASSWORD ================== -->
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const passwordField = document.querySelector('#passwordField');
        const toggleIcon = document.querySelector('#toggleIcon');

        togglePassword.addEventListener('click', function () {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            this.classList.toggle('active');
            toggleIcon.classList.toggle('bi-eye');
            toggleIcon.classList.toggle('bi-eye-slash');
        });
    </script>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>

</body>
</html>