<!doctype html>
<html lang="en" data-bs-theme="dark"> <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fix School | Phoenix Dashboard</title>

    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">

    <style>
        :root {
            --phoenix-bg: #0f111a;
            --phoenix-card: #141824;
            --sidebar-width: 255px;
        }

        body {
            font-family: 'Segoe UI', Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: var(--phoenix-bg);
            color: #eff2f6;
            margin: 0;
            display: flex;
            min-height: 100vh;
        }

        /* Container Sidebar */
        .sidebar-wrapper {
            width: var(--sidebar-width);
            flex-shrink: 0;
            z-index: 1000;
        }

        /* Konten Utama */
        .main-content {
            flex-grow: 1;
            min-width: 0; /* Mencegah konten overflow */
            background-color: var(--phoenix-bg);
            padding: 2rem;
            height: 100vh;
            overflow-y: auto; /* Scroll hanya di bagian konten */
        }

        /* Scrollbar Styling (Agar serasi dengan Dark Mode) */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: var(--phoenix-bg);
        }
        ::-webkit-scrollbar-thumb {
            background: #31374a;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #3874ff;
        }

        /* Responsive: Jika layar kecil, sidebar bisa disembunyikan (opsional) */
        @media (max-width: 992px) {
            .sidebar-wrapper {
                display: none; /* Kamu bisa menambahkan toggle JS nantinya */
            }
            .main-content {
                padding: 1rem;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar-wrapper">
        <?php include(APPPATH . 'Views/layouts/menu.php'); ?>
    </aside>

    <main class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4 d-lg-none">
            <h4 class="mb-0 text-primary fw-bold">FixSchool</h4>
            <button class="btn btn-outline-light btn-sm"><i class="bi bi-list"></i></button>
        </div>

        <?= $this->renderSection('content') ?>
        
        <footer class="mt-5 pt-4 border-top border-secondary-subtle">
            <p class="text-muted small">&copy; 2026 <strong>Fix School</strong>. Managed by IT Team.</p>
        </footer>
    </main>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>

</html>