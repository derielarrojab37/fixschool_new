<!doctype html>
<html lang="en"> 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Enterprise Dashboard | Fix School</title>

    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" href="<?= base_url('assets/img/emote.png') ?>">

    <style>
        :root {
            --primary-dark: #0f172a; /* Slate 900 */
            --primary-blue: #2563eb;
            --bg-body: #f8fafc;
            --sidebar-width: 280px;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-body);
            color: #1e293b;
            margin: 0;
            display: flex;
            min-height: 100vh;
        }

        /* --- SIDEBAR ELITE --- */
        .sidebar-wrapper {
            width: var(--sidebar-width);
            background-color: var(--primary-dark);
            color: #ffffff;
            flex-shrink: 0;
            z-index: 1050;
            position: fixed;
            height: 100vh;
            border-right: 1px solid rgba(255, 255, 255, 0.05);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar-brand {
            padding: 2rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-icon {
            width: 35px;
            height: 35px;
            background: var(--primary-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            font-weight: 800;
            font-size: 1rem;
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.3);
        }

        /* --- MAIN CONTENT --- */
        .main-content {
            flex-grow: 1;
            margin-left: var(--sidebar-width);
            min-width: 0;
            display: flex;
            flex-direction: column;
        }

        .top-navbar {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            height: 70px;
            display: flex;
            align-items: center;
            padding: 0 2rem;
            border-bottom: 1px solid #e2e8f0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .content-body {
            padding: 2rem;
            flex-grow: 1;
        }

        /* --- MODERN BREADCRUMB --- */
        .breadcrumb-item a {
            color: #64748b;
            font-size: 0.8rem;
            text-decoration: none;
            font-weight: 600;
        }
        
        .breadcrumb-item.active {
            color: var(--primary-dark);
            font-size: 0.8rem;
            font-weight: 700;
        }

        /* --- FOOTER --- */
        footer {
            padding: 1.5rem 2rem;
            background: #ffffff;
            border-top: 1px solid #e2e8f0;
            font-size: 0.8rem;
            color: #64748b;
        }

        @media (max-width: 992px) {
            .sidebar-wrapper { transform: translateX(-100%); }
            .sidebar-wrapper.show { transform: translateX(0); }
            .main-content { margin-left: 0; }
        }

        .fade-in-up {
            animation: fadeInUp 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body>
    <aside class="sidebar-wrapper" id="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon">FS</div>
            <h5 class="mb-0 fw-800 text-white" style="letter-spacing: -0.02em;">FixSchool</h5>
        </div>
        
        <div class="sidebar-menu-container px-3">
            <?php include(APPPATH . 'Views/layouts/menu.php'); ?>
        </div>
    </aside>

    <div class="main-content">
        <header class="top-navbar d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <button class="btn btn-white border-0 d-lg-none me-3 shadow-sm" id="sidebarToggle">
                    <i class="bi bi-text-left fs-3"></i>
                </button>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">SYSTEM</a></li>
                        <li class="breadcrumb-item active" aria-current="page">OVERVIEW</li>
                    </ol>
                </nav>
            </div>
            
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-light rounded-pill px-3 py-1 small fw-bold" style="font-size: 0.75rem;">
                    <i class="bi bi-clock-history me-1"></i> 2026 Season
                </button>
                <div class="vr mx-2 text-muted" style="height: 20px;"></div>
                <div class="d-flex align-items-center gap-2">
                    <div class="text-end d-none d-md-block">
                        <div class="fw-bold" style="font-size: 0.85rem; line-height: 1;"><?= session('nama') ?></div>
                        <small class="text-muted" style="font-size: 0.7rem;">Auth Verified</small>
                    </div>
                    <i class="bi bi-person-badge-fill fs-4 text-primary"></i>
                </div>
            </div>
        </header>

        <main class="content-body fade-in-up">
            <?= $this->renderSection('content') ?>
        </main>
        
        <footer class="mt-auto">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                <div>&copy; 2026 <span class="fw-bold text-dark">Fix School</span> &bull; Terminal System</div>
                <div class="d-flex gap-3 align-items-center">
                    <span class="badge bg-soft-primary text-primary px-3 py-2" style="background: #e0e7ff;">Stable Build v2.1.0</span>
                </div>
            </div>
        </footer>
    </div>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        
        sidebarToggle?.addEventListener('click', (e) => {
            e.stopPropagation();
            sidebar.classList.toggle('show');
        });

        document.addEventListener('click', (e) => {
            if (window.innerWidth <= 992 && !sidebar.contains(e.target) && sidebar.classList.contains('show')) {
                sidebar.classList.remove('show');
            }
        });
    </script>
</body>
</html>