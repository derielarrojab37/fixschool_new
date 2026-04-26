<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Recovery | Secure Database Restore</title>

    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" href="<?= base_url('assets/img/FS_No_BG.png') ?>">

    <style>
        :root {
            --primary-dark: #0f172a;
            --danger-deep: #991b1b;
            --danger-soft: #fef2f2;
            --slate-500: #64748b;
            --slate-800: #1e293b;
        }

        body {
            background: radial-gradient(circle at top right, #f8fafc, #f1f5f9);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--slate-800);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .auth-container {
            width: 100%;
            max-width: 500px;
        }

        /* Brand Statement */
        .brand-section {
            text-align: center;
            margin-bottom: 2rem;
        }

        .brand-logo {
            width: 60px;
            height: 60px;
            background: var(--danger-deep);
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.75rem;
            margin-bottom: 1.25rem;
            box-shadow: 0 10px 15px -3px rgba(153, 27, 27, 0.3);
        }

        .title-text {
            font-weight: 800;
            font-size: 1.75rem;
            letter-spacing: -0.04em;
            color: var(--primary-dark);
        }

        /* Card Luxury Style */
        .card {
            border: 1px solid rgba(255, 255, 255, 0.8);
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 1.5rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1) !important;
            overflow: hidden;
        }

        .card-header-luxury {
            background: var(--danger-soft);
            padding: 1.5rem;
            border-bottom: 1px solid #fee2e2;
            text-align: center;
        }

        .alert-statement {
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--danger-deep);
            display: block;
            margin-bottom: 0.5rem;
        }

        .form-label {
            font-weight: 700;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--slate-500);
            margin-bottom: 0.6rem;
        }

        .form-control {
            border: 1.5px solid #e2e8f0;
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            background-color: #f8fafc;
        }

        /* Button Premium */
        .btn-danger-premium {
            background: var(--danger-deep);
            color: white;
            border: none;
            border-radius: 0.75rem;
            padding: 0.9rem;
            font-weight: 700;
            transition: all 0.3s;
            box-shadow: 0 4px 6px -1px rgba(153, 27, 27, 0.2);
        }

        .btn-danger-premium:hover {
            background: #7f1d1d;
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(153, 27, 27, 0.3);
            color: white;
        }

        .btn-outline-slate {
            border: 1.5px solid #e2e8f0;
            border-radius: 0.75rem;
            padding: 0.9rem;
            color: var(--slate-500);
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-outline-slate:hover {
            background: #f1f5f9;
            color: var(--primary-dark);
        }

        /* Warnings */
        .warning-box {
            background: #fffbeb;
            border: 1px solid #fde68a;
            border-radius: 1rem;
            padding: 1rem;
            margin-bottom: 2rem;
        }

        .warning-title {
            color: #92400e;
            font-weight: 800;
            font-size: 0.85rem;
            text-transform: uppercase;
            display: flex;
            align-items: center;
        }

        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.7; }
            100% { opacity: 1; }
        }

        .animate-pulse-subtle {
            animation: pulse 2s infinite;
        }
    </style>
</head>

<body>

    <div class="auth-container">
        <div class="brand-section">
            <div class="brand-logo">
                <i class="bi bi-arrow-counterclockwise"></i>
            </div>
            <h2 class="title-text">System Recovery</h2>
        </div>

        <div class="card">
            <div class="card-header-luxury">
                <span class="alert-statement animate-pulse-subtle">Critical Action Required</span>
                <p class="text-muted small mb-0">Revert your database to a previous state</p>
            </div>

            <div class="card-body p-4 p-md-5">
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger d-flex align-items-center rounded-4 mb-4" style="font-size: 0.85rem;">
                        <i class="bi bi-x-circle-fill me-2"></i>
                        <div><?= session()->getFlashdata('error') ?></div>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success d-flex align-items-center rounded-4 mb-4" style="font-size: 0.85rem;">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <div><?= session()->getFlashdata('success') ?></div>
                    </div>
                <?php endif; ?>

                <div class="warning-box">
                    <div class="warning-title mb-2">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i> Warning
                    </div>
                    <p class="mb-0 text-muted" style="font-size: 0.85rem; line-height: 1.6;">
                        Proses restore akan <b>menghapus dan menimpa</b> seluruh data saat ini secara permanen. Pastikan file SQL yang Anda unggah sudah benar.
                    </p>
                </div>

                <form action="<?= base_url('restore/process') ?>" method="post" enctype="multipart/form-data"
                    onsubmit="return confirm('KONFIRMASI SISTEM: Apakah Anda yakin ingin melakukan overwrite database? Tindakan ini tidak dapat dibatalkan.')">

                    <div class="mb-4">
                        <label class="form-label">Database Source File (.SQL)</label>
                        <input type="file" name="file_sql" class="form-control" accept=".sql" required>
                    </div>

                    <div class="d-grid gap-3 mt-5">
                        <button type="submit" class="btn btn-danger-premium">
                            <i class="bi bi-lightning-charge-fill me-2"></i> Execute Restore
                        </button>
                        <a href="<?= base_url('/') ?>" class="btn btn-outline-slate text-center text-decoration-none">
                            Discard & Return
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <p class="text-center text-muted mt-4" style="font-size: 0.7rem; opacity: 0.6; letter-spacing: 0.05em;">
            ENCRYPTED RECOVERY INTERFACE &bull; AUTHORIZED ACCESS ONLY
        </p>
    </div>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>

</html>