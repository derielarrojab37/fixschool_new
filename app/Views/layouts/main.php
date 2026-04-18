<!doctype html>
<html lang="en"> 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fix School | Admin One Dashboard</title>

    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --admin-one-primary: #2563eb;
            --admin-one-dark: #1f2937;
            --admin-one-bg: #f3f4f6;
            --sidebar-width: 260px;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background-color: var(--admin-one-bg);
            color: #374151;
            margin: 0;
            display: flex;
            min-height: 100vh;
        }

        /* --- SIDEBAR ADMIN ONE STYLE --- */
        .sidebar-wrapper {
            width: var(--sidebar-width);
            background-color: var(--admin-one-dark); /* Sidebar Gelap khas Admin One */
            color: #ffffff;
            flex-shrink: 0;
            z-index: 1000;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            transition: transform 0.3s ease;
        }

        .sidebar-brand {
            padding: 1.5rem;
            background-color: rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .brand-icon {
            background: var(--admin-one-primary);
            padding: 5px 10px;
            border-radius: 8px;
            font-weight: 800;
        }

        /* --- MAIN CONTENT --- */
        .main-content {
            flex-grow: 1;
            margin-left: var(--sidebar-width);
            min-width: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Navbar Atas Flat (Bukan Gradient) */
        .top-navbar {
            background-color: #ffffff;
            height: 64px;
            display: flex;
            align-items: center;
            padding: 0 2rem;
            border-bottom: 1px solid #e5e7eb;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .content-body {
            padding: 2rem;
            flex-grow: 1;
        }

        /* --- CARD STYLE (Diterapkan di View Content) --- */
        .card {
            border: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            border-radius: 0.5rem;
        }

        /* --- FOOTER --- */
        footer {
            padding: 1.5rem 2rem;
            background: #ffffff;
            border-top: 1px solid #e5e7eb;
            color: #6b7280;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar-wrapper {
                transform: translateX(-100%);
            }
            .sidebar-wrapper.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
            .top-navbar {
                padding: 0 1rem;
            }
        }

        /* Animasi Transisi Halaman */
        .fade-in-up {
            animation: fadeInUp 0.4s ease-out;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body>

    <aside class="sidebar-wrapper">
        <div class="sidebar-brand">
            <span class="brand-icon">FS</span>
            <h5 class="mb-0 fw-bold text-white">FixSchool</h5>
        </div>
        
        <div class="sidebar-menu-container p-3">
            <?php include(APPPATH . 'Views/layouts/menu.php'); ?>
        </div>
    </aside>

    <div class="main-content">
        <header class="top-navbar d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <button class="btn btn-light d-lg-none me-3" id="sidebarToggle">
                    <i class="bi bi-list fs-4"></i>
                </button>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 small fw-semibold">
                        <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted">Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
            
            <div class="d-flex align-items-center gap-3">
                <div class="dropdown">
                    <button class="btn btn-light rounded-circle p-2" type="button">
                        <i class="bi bi-bell"></i>
                    </button>
                </div>
                <div class="fw-bold small d-none d-md-block">Admin User</div>
            </div>
        </header>

        <main class="content-body fade-in-up">
            <?= $this->renderSection('content') ?>
        </main>
        
        <footer class="mt-auto">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
                <div class="small">
                    &copy; 2026 <span class="fw-bold">Fix School</span>. Built for efficiency.
                </div>
                <div class="small d-flex gap-3">
                    <span class="badge bg-light text-dark border">v2.1.0</span>
                </div>
            </div>
        </footer>
    </div>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script>
        // Toggle Sidebar Mobile
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.querySelector('.sidebar-wrapper');
        
        sidebarToggle?.addEventListener('click', function(e) {
            e.stopPropagation();
            sidebar.classList.toggle('show');
        });

        // Klik di luar sidebar untuk menutup pada mobile
        document.addEventListener('click', function(e) {
            if (window.innerWidth <= 992) {
                if (!sidebar.contains(e.target) && sidebar.classList.contains('show')) {
                    sidebar.classList.remove('show');
                }
            }
        });
    </script>
</body>
</html>