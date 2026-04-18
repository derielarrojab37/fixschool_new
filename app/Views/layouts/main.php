<!doctype html>
<html lang="en"> 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fix School | Argon Dashboard</title>

    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <style>
        :root {
            --argon-primary: #5e72e4;
            --argon-bg: #f8f9fe;
            --sidebar-width: 250px;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            background-color: var(--argon-bg);
            color: #525f7f;
            margin: 0;
            display: flex;
            min-height: 100vh;
        }

        /* --- SIDEBAR WRAPPER --- */
        .sidebar-wrapper {
            width: var(--sidebar-width);
            background-color: #ffffff;
            flex-shrink: 0;
            z-index: 1000;
            box-shadow: 0 0 2rem 0 rgba(136, 152, 170, .15);
            position: fixed; /* Sidebar tetap di kiri */
            height: 100vh;
            overflow-y: auto;
        }

        /* --- MAIN CONTENT --- */
        .main-content {
            flex-grow: 1;
            margin-left: var(--sidebar-width); /* Memberi ruang karena sidebar fixed */
            min-width: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Top Header Gradient Area */
        .header-top {
            background: linear-gradient(87deg, #5e72e4 0, #825ee4 100%) !important;
            height: 300px; /* Area biru di belakang konten */
            width: 100%;
            position: absolute;
            top: 0;
            z-index: 1;
        }

        .content-body {
            position: relative;
            z-index: 2; /* Agar konten di atas gradient */
            padding: 2rem;
            flex-grow: 1;
            margin-top: 10px;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #cfd4da;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--argon-primary);
        }

        footer {
            padding: 2rem;
            background: transparent;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar-wrapper {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                position: fixed;
            }
            .sidebar-wrapper.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar-wrapper">
        <div class="p-4 text-center border-bottom mb-3">
            <h4 class="fw-bold text-primary mb-0" style="letter-spacing: -1px;">FIXSCHOOL</h4>
        </div>
        <?php include(APPPATH . 'Views/layouts/menu.php'); ?>
    </aside>

    <div class="main-content">
        <div class="header-top"></div>

        <div class="content-body">
            <div class="d-flex justify-content-between align-items-center mb-4 d-lg-none text-white">
                <h4 class="mb-0 fw-bold">FixSchool</h4>
                <button class="btn btn-link text-white p-0" id="sidebarToggle">
                    <i class="bi bi-list fs-2"></i>
                </button>
            </div>

            <?= $this->renderSection('content') ?>
            
            <footer class="mt-auto">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="text-muted small mb-0">&copy; 2026 <strong>Fix School</strong>. Managed by IT Team.</p>
                    <div class="small text-muted">Version 2.1.0</div>
                </div>
            </footer>
        </div>
    </div>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script>
        // Script sederhana untuk mobile toggle
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.querySelector('.sidebar-wrapper').classList.toggle('show');
        });
    </script>
</body>
</html>