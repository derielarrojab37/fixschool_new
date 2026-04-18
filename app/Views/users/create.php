<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Baru | Argon Style</title>

    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <style>
        body {
            background-color: #f8f9fe;
            font-family: 'Open Sans', sans-serif;
            color: #525f7f;
        }

        /* Background Gradient Header */
        .bg-gradient-primary {
            background: linear-gradient(87deg, #5e72e4 0, #825ee4 100%) !important;
            height: 400px;
            width: 100%;
            position: absolute;
            top: 0;
            z-index: -1;
        }

        .card {
            border: none;
            background-color: #ffffff;
            border-radius: 1rem;
            box-shadow: 0 15px 35px rgba(50, 50, 93, 0.1), 0 5px 15px rgba(0, 0, 0, 0.07) !important;
        }

        .title-text {
            color: #ffffff; /* Putih karena berada di atas gradient */
            font-weight: 700;
            margin-top: 60px;
        }

        .subtitle-text {
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 30px;
        }

        .form-label {
            color: #8898aa;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.025em;
        }

        .form-control, .form-select {
            border: 1px solid #cad1d7;
            border-radius: 0.5rem;
            color: #495057;
            padding: 0.625rem 0.75rem;
            box-shadow: 0 1px 3px rgba(50, 50, 93, 0.15), 0 1px 0 rgba(0, 0, 0, 0.02);
            transition: all 0.2s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: rgba(94, 114, 228, 0.5);
            box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);
            outline: 0;
        }

        .btn-primary {
            color: #fff;
            background-color: #5e72e4;
            border-color: #5e72e4;
            border-radius: 0.5rem;
            padding: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.025em;
            box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);
            transition: all 0.15s ease;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            background-color: #324cdd;
            box-shadow: 0 7px 14px rgba(50, 50, 93, 0.1), 0 3px 6px rgba(0, 0, 0, 0.08);
        }

        /* Custom file upload Argon style */
        input[type="file"]::file-selector-button {
            background-color: #e9ecef;
            color: #525f7f;
            border: none;
            padding: 0.4rem 0.75rem;
            border-radius: 0.375rem;
            margin-right: 10px;
            font-weight: 600;
            font-size: 0.75rem;
        }

        .input-group-text {
            background-color: #ffffff;
            border: 1px solid #cad1d7;
            color: #adb5bd;
        }

        .alert-argon {
            background-color: #f5365c;
            color: white;
            border: none;
            border-radius: 0.5rem;
        }
    </style>
</head>

<body>

    <div class="bg-gradient-primary"></div>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                
                <div class="text-center mb-4">
                    <h2 class="title-text">Buat Akun</h2>
                    <p class="subtitle-text small">Daftarkan diri Anda untuk mengakses sistem dashboard</p>
                </div>

                <div class="card shadow">
                    <div class="card-body p-4 p-md-5">
                        
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-argon small py-2 mb-4">
                                <i class="bi bi-exclamation-circle me-2"></i><?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>

                        <form action="<?= base_url('users/store') ?>" method="post" enctype="multipart/form-data">
                            
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label class="form-label">Nama Lengkap</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                                        <input type="text" name="nama" class="form-control" placeholder="John Doe" required>
                                    </div>
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                        <input type="email" name="email" class="form-control" placeholder="nama@email.com" required>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Username</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                                        <input type="text" name="username" class="form-control" placeholder="username" required>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-key"></i></span>
                                        <input type="password" name="password" class="form-control" placeholder="******" required>
                                    </div>
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

                            <button type="submit" class="btn btn-primary w-100 my-2">
                                Daftar Sekarang
                            </button>

                            <div class="text-center mt-4">
                                <p class="small text-muted mb-0">Sudah punya akun? 
                                    <a href="<?= base_url('login') ?>" class="text-primary text-decoration-none fw-bold">Login di sini</a>
                                </p>
                            </div>

                        </form>
                    </div>
                </div>

                <div class="text-center mt-5">
                    <p class="small text-white-50">© 2026 Argon Dashboard System</p>
                </div>

            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>

</html>