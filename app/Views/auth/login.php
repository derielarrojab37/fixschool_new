<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | Admin One Style</title>

    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            /* Background abu-abu muda flat khas Admin One */
            background-color: #f0f2f5; 
            font-family: 'Nunito', sans-serif;
            color: #2d3748;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Logo Placeholder - Gaya Minimalis */
        .brand-logo {
            width: 64px;
            height: 64px;
            background: #2563eb;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: white;
            font-size: 2rem;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        .card {
            border: none;
            background-color: #ffffff;
            border-radius: 0.75rem;
            /* Shadow yang lebih dalam dan lembut */
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04) !important;
            transition: transform 0.3s ease;
        }

        .card-header {
            background-color: transparent;
            border: 0;
            padding: 1.5rem 1.5rem 0.5rem;
        }

        .login-title {
            color: #1a202c;
            font-weight: 800;
            letter-spacing: -0.025em;
        }

        /* Input Styles */
        .form-label {
            font-weight: 600;
            font-size: 0.875rem;
            color: #4a5568;
        }

        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: all 0.2s ease-in-out;
            background-color: #f8fafc;
        }

        .form-control:focus {
            outline: 0;
            background-color: #fff;
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        /* Button Styles dengan Animasi */
        .btn-primary {
            background-color: #2563eb;
            border: none;
            border-radius: 0.5rem;
            padding: 0.8rem;
            font-weight: 700;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        /* Alert Styling */
        .alert-custom {
            background-color: #fff5f5;
            color: #c53030;
            border: 1px solid #feb2b2;
            border-radius: 0.5rem;
            font-size: 0.875rem;
        }

        /* Link Styling */
        .auth-link {
            color: #4b5563;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.875rem;
            transition: color 0.2s;
        }

        .auth-link:hover {
            color: #2563eb;
        }

        /* Animasi Masuk */
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-in {
            animation: slideUp 0.5s ease-out forwards;
        }
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center">
        <div class="card p-3 animate-in" style="width: 100%; max-width: 420px;">
            
            <div class="card-header text-center">
                <div class="brand-logo">
                    <i class="bi bi-shield-lock-fill"></i>
                </div>
                <h3 class="login-title">Sign In</h3>
                <p class="text-muted small">Enter your credentials to access your account</p>
            </div>
            
            <div class="card-body">
                
                <?php if (session()->getFlashdata('error') || session()->getFlashdata('salahpw')): ?>
                    <div class="alert alert-custom mb-4 d-flex align-items-center" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <div>
                            <?= session()->getFlashdata('error') ?: session()->getFlashdata('salahpw') ?>
                        </div>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('/proses-login') ?>" method="post">

                    <div class="mb-4">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Masukan Usernamemu" required>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex justify-content-between">
                            <label class="form-label">Password</label>
                            <a href="#" class="auth-link small">Forgot?</a>
                        </div>
                        <input type="password" name="password" class="form-control" placeholder="Masukan Passwordmu" required>
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="remember">
                        <label class="form-check-label text-muted small" for="remember">
                            Stay logged in
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mb-3">
                        Login
                    </button>

                </form>

                <div class="text-center mt-3">
                    <p class="text-muted small">Don't have an account? 
                        <a href="<?= base_url('users/create') ?>" class="auth-link">Create Account</a>
                    </p>
                </div>

            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>