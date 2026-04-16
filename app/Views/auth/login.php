<!DOCTYPE html>
<html lang="en" data-bs-theme="dark"> <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | Phoenix Style</title>

    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">

    <style>
        body {
            background-color: #0f111a; /* Warna background khas Phoenix Dark */
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }
        .card {
            border: 1px solid #31374a;
            background-color: #141824;
            border-radius: 0.75rem;
        }
        .form-control {
            background-color: #0f111a;
            border: 1px solid #31374a;
            color: #eff2f6;
            padding: 0.7rem 1rem;
        }
        .form-control:focus {
            background-color: #0f111a;
            border-color: #3874ff;
            color: #fff;
            box-shadow: 0 0 0 0.25rem rgba(56, 116, 255, 0.25);
        }
        .btn-primary {
            background-color: #3874ff;
            border-color: #3874ff;
            padding: 0.7rem;
            font-weight: 600;
        }
        .login-title {
            color: #eff2f6;
            font-weight: 700;
            letter-spacing: -0.02em;
        }
        .text-muted-custom {
            color: #9ba1b7;
        }
        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ba1b7;
        }
        .form-icon-container {
            position: relative;
        }
        .form-icon-container .form-control {
            padding-left: 45px;
        }
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg p-3" style="width: 100%; max-width: 420px;">
            <div class="card-body">
                <div class="text-center mb-4">
                    <h2 class="login-title">Sign In</h2>
                    <p class="text-muted-custom small">Masuk ke akun administrator Anda</p>
                </div>

                <?php if (session()->getFlashdata('error') || session()->getFlashdata('salahpw')): ?>
                    <div class="alert alert-outline-danger d-flex align-items-center small" role="alert" style="color: #ff6767; border: 1px solid #4b2525; background: #2a1a1a;">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <div><?= session()->getFlashdata('error') ?: session()->getFlashdata('salahpw') ?></div>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('/proses-login') ?>" method="post">

                    <div class="mb-3">
                        <label class="form-label text-muted-custom small fw-bold">Username</label>
                        <div class="form-icon-container">
                            <i class="bi bi-person input-icon"></i>
                            <input type="text" name="username" class="form-control" placeholder="user@example.com" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-muted-custom small fw-bold">Password</label>
                        <div class="form-icon-container">
                            <i class="bi bi-lock input-icon"></i>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember">
                            <label class="form-check-label text-muted-custom small" for="remember">Ingat saya</label>
                        </div>
                        <a href="#" class="text-primary text-decoration-none small">Lupa password?</a>
                    </div>

                    <button class="btn btn-primary w-100 mb-3">
                        Sign In <i class="bi bi-chevron-right ms-2 small"></i>
                    </button>

                </form>

                <div class="text-center pt-3 border-top" style="border-color: #31374a !important;">
                    <p class="text-muted-custom small mb-0">Belum punya akun? 
                        <a href="<?= base_url('users/create') ?>" class="text-primary text-decoration-none fw-bold">Buat Akun Baru</a>
                    </p>
                </div>

            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>

</html>