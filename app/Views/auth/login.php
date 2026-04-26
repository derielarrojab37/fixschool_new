<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium Sign In | Enterprise System</title>

    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" href="<?= base_url('assets/img/FS_No_BG.png') ?>">

    <style>
        :root {
            /* Variabel warna global untuk konsistensi desain */
            --primary-dark: #0f172a;
            --accent-blue: #2563eb;
            --slate-500: #64748b;
            --slate-800: #1e293b;
        }

        body {
            /* Latar belakang menggunakan gradasi transparan di atas gambar GIF awan yang bergerak */
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

            /* Mengatur form login tepat di tengah layar secara vertikal dan horizontal */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-container {
            width: 100%;
            max-width: 440px;
            padding: 1rem;
        }

        /* Desain kartu login dengan efek kaca transparan (Glassmorphism) */
        .card {
            border: 1px solid rgba(255, 255, 255, 0.8);
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 1.5rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08) !important;
            padding: 1.5rem;
        }

        .brand-section {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .login-brand-img {
            width: 80px;
            height: auto;
            object-fit: contain;
            /* Memberikan efek bayangan pada logo agar terlihat menonjol */
            filter: drop-shadow(0 10px 15px rgba(15, 23, 42, 0.15));
            transition: transform 0.3s ease;
        }

        /* Efek interaktif saat mouse diarahkan ke logo */
        .login-brand-img:hover {
            transform: scale(1.05);
        }

        .login-title {
            font-weight: 800;
            font-size: 1.75rem;
            letter-spacing: -0.03em;
            color: var(--primary-dark);
            margin-top: 1rem;
        }

        /* Styling elemen input agar terlihat bersih dan modern */
        .form-control {
            border: 1.5px solid #e2e8f0;
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            background-color: #f8fafc;
            transition: all 0.2s ease;
        }

        /* Memberikan highlight biru saat input sedang aktif (fokus) */
        .form-control:focus {
            background-color: #fff;
            border-color: var(--accent-blue);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.08);
        }

        .btn-primary {
            background: var(--primary-dark);
            border: none;
            border-radius: 0.75rem;
            padding: 0.9rem;
            font-weight: 700;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Efek tombol sedikit terangkat saat di-hover */
        .btn-primary:hover {
            background: #000;
            transform: translateY(-2px);
            box-shadow: 0 12px 20px -5px rgba(15, 23, 42, 0.25);
        }

        /* Styling untuk pesan kesalahan (alert) */
        .alert-custom {
            background-color: #fef2f2;
            color: #991b1b;
            border: 1px solid #fee2e2;
            border-radius: 0.75rem;
            font-size: 0.85rem;
        }

        .footer-utils {
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px dashed #e2e8f0;
        }

        /* Animasi masuk dari bawah saat halaman pertama kali dimuat */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade {
            animation: fadeIn 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }
    </style>
</head>

<body>

    <div class="auth-container animate-fade">

        <div class="brand-section">
            <img src="<?= base_url('assets/img/FS_Icon.png') ?>" alt="FixSchool Logo" class="login-brand-img">
            <h3 class="login-title mt-3">Welcome Back</h3>
            <p class="login-subtitle text-muted">Please enter your details to sign in</p>
        </div>

        <div class="card">
            <div class="card-body p-2">

                <?php if (session()->getFlashdata('error') || session()->getFlashdata('salahpw')): ?>
                    <div class="alert alert-custom mb-4 d-flex align-items-center animate-fade" role="alert">
                        <i class="bi bi-x-circle-fill me-2"></i>
                        <div>
                            <?= session()->getFlashdata('error') ?: session()->getFlashdata('salahpw') ?>
                        </div>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('/proses-login') ?>" method="post">

                    <div class="mb-4">
                        <label class="form-label fw-bold small text-uppercase text-muted">Identity</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="bi bi-person"></i>
                            </span>
                            <input type="text" name="username" class="form-control" placeholder="Username" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label class="form-label fw-bold small text-uppercase text-muted mb-0">Security Key</label>
                            <a href="#" class="text-primary text-decoration-none small fw-bold" style="font-size: 0.75rem;">Recover?</a>
                        </div>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="bi bi-key"></i>
                            </span>
                            <input type="password" name="password" id="passwordField" class="form-control" placeholder="Password" required>
                            <button class="btn btn-outline-secondary border-start-0 bg-light" type="button" id="togglePassword">
                                <i class="bi bi-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember">
                            <label class="form-check-label text-muted small fw-medium" for="remember">
                                Trust this device
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mb-3 shadow-sm text-white">
                        Access Dashboard 
                        <i class="bi bi-arrow-right ms-2"></i>
                    </button>
                </form>

                <div class="text-center mt-2">
                    <p class="text-muted small fw-medium">
                        New member? 
                        <a href="<?= base_url('users/create') ?>" class="text-primary text-decoration-none fw-bold">
                            Create Account
                        </a>
                    </p>
                </div>

                <div class="footer-utils text-center">
                    <a href="<?= base_url('restore') ?>" class="btn btn-outline-danger btn-sm px-3 fw-bold" style="border-radius: 0.5rem;">
                        <i class="bi bi-database me-1"></i> System Restore
                    </a>
                </div>

            </div>
        </div>

        <p class="text-center text-muted mt-4" style="font-size: 0.7rem; opacity: 0.6;">
            &copy; <?= date('Y') ?> Enterprise Internal System. All rights reserved.
        </p>
    </div>

    <script>
        /* Mengambil elemen DOM yang diperlukan */
        const togglePassword = document.querySelector('#togglePassword');
        const passwordField = document.querySelector('#passwordField');
        const toggleIcon = document.querySelector('#toggleIcon');

        /* Event listener untuk mengubah tipe input dari 'password' ke 'text' dan sebaliknya */
        togglePassword.addEventListener('click', function () {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            /* Mengubah ikon mata saat diklik */
            this.classList.toggle('active');
            toggleIcon.classList.toggle('bi-eye');
            toggleIcon.classList.toggle('bi-eye-slash');
        });
    </script>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>

</body>
</html>