<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Baru | Admin One Style</title>

    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Nunito', sans-serif;
            color: #2d3748;
            min-height: 100vh;
        }

        /* Logo Brand Style */
        .brand-logo {
            width: 56px;
            height: 56px;
            background: #2563eb;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: white;
            font-size: 1.75rem;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        .title-text {
            color: #1a202c;
            font-weight: 800;
            letter-spacing: -0.025em;
        }

        .subtitle-text {
            color: #718096;
            margin-bottom: 2rem;
        }

        .card {
            border: none;
            background-color: #ffffff;
            border-radius: 1rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04) !important;
        }

        .form-label {
            color: #4a5568;
            font-size: 0.85rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .form-control, .form-select {
            border: 2px solid #e2e8f0;
            border-radius: 0.5rem;
            padding: 0.625rem 0.85rem;
            font-size: 0.95rem;
            background-color: #f8fafc;
            transition: all 0.2s ease-in-out;
        }

        .form-control:focus, .form-select:focus {
            background-color: #fff;
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
            outline: 0;
        }

        /* Button Modern */
        .btn-primary {
            background-color: #2563eb;
            border: none;
            border-radius: 0.5rem;
            padding: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.025em;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        /* Modern Alert */
        .alert-custom {
            background-color: #fff5f5;
            color: #c53030;
            border: 1px solid #feb2b2;
            border-radius: 0.6rem;
            font-weight: 600;
        }

        /* Custom file upload Admin One style */
        input[type="file"]::file-selector-button {
            background-color: #edf2f7;
            color: #4a5568;
            border: none;
            padding: 0.4rem 0.75rem;
            border-radius: 0.375rem;
            margin-right: 10px;
            font-weight: 700;
            font-size: 0.75rem;
            transition: background 0.2s;
        }

        input[type="file"]::file-selector-button:hover {
            background-color: #e2e8f0;
        }

        .auth-link {
            color: #2563eb;
            text-decoration: none;
            font-weight: 700;
        }

        .auth-link:hover {
            text-decoration: underline;
        }

        /* Entry Animation */
        @keyframes fadeInScale {
            from { opacity: 0; transform: scale(0.98) translateY(10px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }

        .animate-in {
            animation: fadeInScale 0.4s ease-out forwards;
        }
    </style>
</head>

<body>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-7 col-xl-6 animate-in">
                
                <div class="text-center">
                    <div class="brand-logo">
                        <i class="bi bi-person-plus-fill"></i>
                    </div>
                    <h2 class="title-text">Create Account</h2>
                    <p class="subtitle-text">Join us and manage your dashboard easily</p>
                </div>

                <div class="card">
                    <div class="card-body p-4 p-md-5">
                        
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-custom d-flex align-items-center mb-4">
                                <i class="bi bi-exclamation-circle-fill me-2"></i>
                                <div><?= session()->getFlashdata('error') ?></div>
                            </div>
                        <?php endif; ?>

                        <form action="<?= base_url('users/store') ?>" method="post" enctype="multipart/form-data">
                            
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label class="form-label">FULL NAME</label>
                                    <input type="text" name="nama" class="form-control" placeholder="John Doe" required>
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label">EMAIL ADDRESS</label>
                                    <input type="email" name="email" class="form-control" placeholder="john@example.com" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">USERNAME</label>
                                    <input type="text" name="username" class="form-control" placeholder="johndoe" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">PASSWORD</label>
                                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label">ACCOUNT ROLE</label>
                                    <select name="role" class="form-select" required>
                                        <option value="" selected disabled>Select role</option>
                                        <option value="admin">Admin</option>
                                        <option value="teknisi">Teknisi</option>
                                        <option value="pelapor">Pelapor</option>
                                    </select>
                                </div>

                                <div class="col-12 mb-4">
                                    <label class="form-label">PROFILE PICTURE</label>
                                    <input type="file" name="foto" class="form-control" accept="image/*">
                                    <div class="form-text small" style="color: #94a3b8;">Optional: JPG, PNG or GIF (Max. 2MB)</div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mb-4">
                                Register Account
                            </button>

                            <div class="text-center">
                                <p class="small text-muted mb-0">Already have an account? 
                                    <a href="<?= base_url('login') ?>" class="auth-link">Sign In</a>
                                </p>
                            </div>

                        </form>
                    </div>
                </div>

                <div class="text-center mt-5">
                    <p class="small text-muted">© 2026 Admin One Dashboard · All rights reserved.</p>
                </div>

            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>

</html>