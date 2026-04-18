<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | Argon Dashboard Style</title>

    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <style>
        body {
            background-color: #f8f9fe; /* Background light khas Argon */
            font-family: 'Open Sans', sans-serif;
            color: #525f7f;
        }
        
        /* Background decorative top (opsional, untuk efek lengkung Argon) */
        .bg-gradient-primary {
            background: linear-gradient(87deg, #5e72e4 0, #825ee4 100%) !important;
            height: 300px;
            width: 100%;
            position: absolute;
            top: 0;
            z-index: -1;
        }

        .card {
            border: none;
            background-color: #ffffff;
            border-radius: 1rem; /* Border radius lebih besar */
            box-shadow: 0 15px 35px rgba(50, 50, 93, 0.1), 0 5px 15px rgba(0, 0, 0, 0.07) !important;
        }

        .card-header {
            background-color: transparent;
            border: 0;
            padding-top: 2rem;
        }

        .form-control {
            border: 1px solid #cad1d7;
            border-radius: 0.5rem;
            color: #8898aa;
            padding: 0.625rem 0.75rem;
            transition: all 0.2s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .form-control:focus {
            outline: 0;
            box-shadow: 0 3px 9px rgba(50, 50, 93, 0.1), 0 1px 7px rgba(0, 0, 0, 0.08);
            border-color: rgba(94, 114, 228, 0.5);
        }

        /* Styling Button Argon */
        .btn-primary {
            color: #fff;
            background-color: #5e72e4;
            border-color: #5e72e4;
            border-radius: 0.5rem;
            padding: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.025em;
            transition: all 0.15s ease;
            box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);
        }

        .btn-primary:hover {
            background-color: #324cdd;
            transform: translateY(-1px);
            box-shadow: 0 7px 14px rgba(50, 50, 93, 0.1), 0 3px 6px rgba(0, 0, 0, 0.08);
        }

        .login-title {
            color: #32325d;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .text-muted-custom {
            color: #8898aa;
        }

        /* Switch style untuk Remember Me */
        .form-check-input:checked {
            background-color: #5e72e4;
            border-color: #5e72e4;
        }

        .input-group-text {
            background-color: #fff;
            border: 1px solid #cad1d7;
            color: #adb5bd;
        }
    </style>
</head>

<body>
    <div class="bg-gradient-primary"></div>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow p-2" style="width: 100%; max-width: 450px;">
            <div class="card-header text-center">
                <h3 class="login-title">Welcome back</h3>
                <p class="text-muted-custom small">Gunakan kredensial Anda untuk masuk</p>
            </div>
            
            <div class="card-body px-lg-5 py-lg-4">
                
                <?php if (session()->getFlashdata('error') || session()->getFlashdata('salahpw')): ?>
                    <div class="alert alert-danger border-0 small text-white" role="alert" style="background-color: #f5365c;">
                        <i class="bi bi-exclamation-circle-fill me-2"></i>
                        <?= session()->getFlashdata('error') ?: session()->getFlashdata('salahpw') ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('/proses-login') ?>" method="post">

                    <div class="mb-3">
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" name="username" class="form-control" placeholder="Username" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                    </div>

                    <div class="form-check form-switch my-3">
                        <input class="form-check-input" type="checkbox" id="remember">
                        <label class="form-check-label text-muted-custom small" for="remember">Ingat saya</label>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-primary w-100 my-3">Sign In</button>
                    </div>

                </form>

                <div class="row mt-3">
                    <div class="col-6">
                        <a href="#" class="text-light small"><small class="text-primary fw-bold">Lupa password?</small></a>
                    </div>
                    <div class="col-6 text-end">
                        <a href="<?= base_url('users/create') ?>" class="text-light small"><small class="text-primary fw-bold">Buat Akun</small></a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>