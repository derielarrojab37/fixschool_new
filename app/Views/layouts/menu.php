<style>
    /* Admin One Sidebar Navigation */
    .sidebar-menu-wrapper {
        display: flex;
        flex-direction: column;
        height: calc(100vh - 100px); /* Menyesuaikan dengan tinggi brand logo */
    }

    /* Label Group (Management, Layanan, dll) */
    .nav-label {
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        color: #6b7280; /* Abu-abu muted khas Tailwind */
        letter-spacing: 0.1em;
        margin-top: 1.5rem;
        margin-bottom: 0.5rem;
        padding-left: 1rem;
    }

    /* Link Navigasi */
    .nav-link-custom {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        color: #9ca3af; /* Warna teks tidak aktif */
        text-decoration: none;
        transition: all 0.2s ease;
        border-radius: 0.5rem;
        margin-bottom: 0.2rem;
        font-weight: 500;
        font-size: 0.9rem;
    }

    .nav-link-custom i {
        font-size: 1.25rem;
        margin-right: 0.75rem;
        transition: color 0.2s;
    }

    /* Hover State */
    .nav-link-custom:hover {
        color: #ffffff;
        background-color: rgba(255, 255, 255, 0.1);
    }

    /* Active State (Admin One Style) */
    .nav-link-custom.active {
        color: #ffffff !important;
        background-color: var(--admin-one-primary); /* Biru yang didefinisikan di layout */
        font-weight: 700;
    }

    .nav-link-custom.active i {
        color: #ffffff !important;
    }

    /* Khusus Logout */
    .nav-logout:hover {
        background-color: rgba(239, 68, 68, 0.2);
        color: #f87171 !important;
    }

    /* Profile Box di bagian bawah Sidebar */
    .sidebar-user-panel {
        margin-top: auto;
        padding: 1rem;
        background-color: rgba(0, 0, 0, 0.2);
        border-radius: 0.75rem;
        margin-top: 2rem;
    }

    .user-avatar {
        border: 2px solid #374151;
        padding: 2px;
    }

    .status-indicator {
        width: 10px;
        height: 10px;
        background-color: #10b981; /* Green success */
        border: 2px solid var(--admin-one-dark);
        border-radius: 50%;
        position: absolute;
        bottom: 2px;
        right: 2px;
    }
</style>

<div class="sidebar-menu-wrapper">
    <a href="<?= base_url('/') ?>" class="nav-link-custom <?= (uri_string() == '') ? 'active' : '' ?>">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>

    <?php if (session()->get('role') == 'admin' || session()->get('role') == 'teknisi') : ?>
        <div class="nav-label">Management</div>
        
        <a href="<?= base_url('/users') ?>" class="nav-link-custom <?= (uri_string() == 'users') ? 'active' : '' ?>">
            <i class="bi bi-person-circle"></i> Profile List
        </a>
    <?php endif; ?>

    <div class="nav-label">Layanan</div>
    
    <a href="<?= base_url('/pengaduan') ?>" class="nav-link-custom <?= (uri_string() == 'pengaduan') ? 'active' : '' ?>">
        <i class="bi bi-clipboard-data"></i> Pengaduan
    </a>

    <?php if (session()->get('role') == 'admin') : ?>
        <a href="<?= base_url('/tanggapan') ?>" class="nav-link-custom <?= (uri_string() == 'tanggapan') ? 'active' : '' ?>">
            <i class="bi bi-chat-dots"></i> Tanggapan
        </a>
    <?php endif; ?>

    <?php if (session()->get('role') == 'admin' || session()->get('role') == 'teknisi') : ?>
        <a href="<?= base_url('/penugasan') ?>" class="nav-link-custom <?= (uri_string() == 'penugasan') ? 'active' : '' ?>">
            <i class="bi bi-briefcase"></i> Penugasan
        </a>
    <?php endif; ?>

    <div class="nav-label">System</div>
    
    <?php $idu = session('id_user'); ?>
    <a href="<?= base_url('users/edit/' . $idu) ?>" class="nav-link-custom <?= (strpos(uri_string(), 'users/edit') !== false) ? 'active' : '' ?>">
        <i class="bi bi-sliders"></i> Settings
    </a>

    <a href="<?= base_url('/logout') ?>" class="nav-link-custom nav-logout text-danger-emphasis">
        <i class="bi bi-box-arrow-right"></i> Log Out
    </a>

    <div class="sidebar-user-panel d-flex align-items-center mt-auto">
        <div class="position-relative">
            <img src="<?= session()->get('foto') ? base_url('uploads/users/' . session()->get('foto')) : base_url('assets/img/default-user.png') ?>" 
                 class="rounded-circle user-avatar" 
                 width="42" height="42" style="object-fit: cover;">
            <span class="status-indicator"></span>
        </div>
        <div class="ms-3 overflow-hidden">
            <h6 class="mb-0 text-white small fw-bold text-truncate"><?= session('nama'); ?></h6>
            <span class="text-muted extra-small fw-bold" style="font-size: 0.65rem;"><?= strtoupper(session('role')); ?></span>
        </div>
    </div>
</div>