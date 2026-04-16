<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Baru | Phoenix Style</title>

    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">

    <style>
        body {
            background-color: #0f111a;
            font-family: 'Segoe UI', Roboto, sans-serif;
            color: #eff2f6;
        }
        .card {
            border: 1px solid #31374a;
            background-color: #141824;
            border-radius: 0.75rem;
        }
        .form-label {
            color: #9ba1b7;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 0.4rem;
        }
        .form-control, .form-select {
            background-color: #0f111a;
            border: 1px solid #31374a;
            color: #eff2f6;
            padding: 0.6rem 0.75rem;
        }
        .form-control:focus, .form-select:focus {
            background-color: #0f111a;
            border-color: #3874ff;
            color: #fff;
            box-shadow: 0 0 0 0.25rem rgba(56, 116, 255, 0.1);
        }
        .btn-primary {
            background-color: #3874ff;
            border-color: #3874ff;
            font-weight: 600;
            padding: 0.7rem;
        }
        .title-text {
            font-weight: 700;
            letter-spacing: -0.02em;
        }
        /* Custom file upload styling */
        input[type="file"]::file-selector-button {
            background-color: #31374a;
            color: white;
            border: none;
            padding: 0.2rem 0.7rem;
            border-radius: 0.25rem;
            margin-right: 10px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                
                <div class="text-center mb-4">
                    <h2 class="title-text">Buat Akun</h2>
                    <p class="text-muted small">Daftarkan diri Anda untuk mengakses sistem</p>
                </div>

                <div class="card shadow-lg">
                    <div class="card-body p-4">
                        
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger small py-2">
                                <i class="bi bi-exclamation-circle me-2"></i><?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>

                        <form action="<?= base_url('users/store') ?>" method="post" enctype="multipart/form-data">
                            
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" name="nama" class="form-control" placeholder="John Doe" required>
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="nama@email.com" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Username</label>
                                    <input type="text" name="username" class="form-control" placeholder="username" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="******" required>
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label">Role</label>
                                    <select name="role" class="form-select" required>
                                        <option value="" selected disabled>-- Pilih Role --</option>
                                        <option value="admin">Admin</option>
                                        <option value="teknisi">Teknisi</option>
                                        <option value="pelapor">Pelapor</option>
                                    </select>
                                </div>

                                <div class="col-12 mb-4">
                                    <label class="form-label">Foto Profil</label>
                                    <input type="file" name="foto" class="form-control" accept="image/*">
                                    <div class="form-text small text-muted">Opsional, format JPG/PNG</div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mb-3">
                                <i class="bi bi-person-check me-2"></i>Daftar Sekarang
                            </button>

                            <div class="text-center mt-2">
                                <p class="small text-muted mb-0">Sudah punya akun? 
                                    <a href="<?= base_url('login') ?>" class="text-primary text-decoration-none fw-bold">Login di sini</a>
                                </p>
                            </div>

                        </form>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <p class="small text-muted">© 2026 Phoenix Dashboard System</p>
                </div>

            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>

</html>