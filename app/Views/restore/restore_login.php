<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security Verification | Restricted Access</title>

    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" href="<?= base_url('assets/img/FS_No_BG.png') ?>">

    <style>
        :root {
            --primary-dark: #0f172a;
            --slate-500: #64748b;
            --slate-800: #1e293b;
            --accent-blue: #3b82f6;
        }

        body {
            background: radial-gradient(circle at top right, #f8fafc, #e2e8f0);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--slate-800);
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-container {
            width: 100%;
            max-width: 400px;
            padding: 1.5rem;
        }

        /* Brand Statement */
        .brand-section {
            text-align: center;
            margin-bottom: 2rem;
        }

        .brand-logo {
            width: 64px;
            height: 64px;
            background: var(--primary-dark);
            border-radius: 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.75rem;
            margin-bottom: 1rem;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.2);
        }

        /* Card Style */
        .card {
            border: 1px solid rgba(255, 255, 255, 0.8);
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 1.5rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08) !important;
            padding: 1rem;
        }

        .title {
            font-weight: 800;
            font-size: 1.5rem;
            letter-spacing: -0.04em;
            color: var(--primary-dark);
        }

        .form-label {
            font-weight: 700;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--slate-500);
            margin-bottom: 0.5rem;
        }

        .form-control {
            border: 1.5px solid #e2e8f0;
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.2s ease;
            background-color: #f8fafc;
            letter-spacing: 0.1em;
        }

        .form-control:focus {
            background-color: #fff;
            border-color: var(--primary-dark);
            box-shadow: 0 0 0 4px rgba(15, 23, 42, 0.05);
            outline: 0;
        }

        /* Checkbox Style */
        .form-check-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--slate-500);
            cursor: pointer;
        }

        .form-check-input:checked {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        /* Button Style */
        .btn-auth {
            background: var(--primary-dark);
            color: white;
            border: none;
            border-radius: 0.75rem;
            padding: 0.9rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-transform: uppercase;
            font-size: 0.85rem;
        }

        .btn-auth:hover {
            background: #000;
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(15, 23, 42, 0.2);
            color: white;
        }

        /* Alert Style */
        .alert-custom {
            background-color: #fef2f2;
            color: #991b1b;
            border: 1px solid #fee2e2;
            border-radius: 0.75rem;
            font-weight: 600;
            font-size: 0.85rem;
            text-align: center;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-in {
            animation: fadeIn 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
    </style>
</head>

<body>

    <div class="auth-container animate-in">
        <div class="brand-section">
            <div class="brand-logo">
                <i class="bi bi-shield-lock"></i>
            </div>
            <h4 class="title">System Access</h4>
            <p class="text-muted small">Verification required to proceed</p>
        </div>

        <div class="card">
            <div class="card-body">

                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-custom mb-4">
                        <i class="bi bi-exclamation-octagon-fill me-2"></i>
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('restore/auth') ?>" method="post">

                    <div class="mb-3">
                        <label class="form-label">Admin Master Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Masukan password" required autofocus>
                    </div>

                    <div class="form-check mb-4">
                        <input type="checkbox" class="form-check-input" id="show-pass" onclick="togglePassword()">
                        <label class="form-check-label" for="show-pass">Show Character</label>
                    </div>

                    <button type="submit" class="btn btn-auth w-100 shadow-sm">
                        Verify Identity <i class="bi bi-key-fill ms-2"></i>
                    </button>

                </form>

            </div>
        </div>

        <div class="text-center mt-5">
            <a href="<?= base_url('/') ?>" class="text-decoration-none text-muted small fw-bold" style="opacity: 0.7;">
                <i class="bi bi-arrow-left me-1"></i> Cancel & Exit
            </a>
        </div>
    </div>

    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>

    <script>
        function togglePassword() {
            var x = document.getElementById("password");
            x.type = x.type === "password" ? "text" : "password";
        }
    </script>

</body>
</html>