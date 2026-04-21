<style>
    /* Elite Sidebar Navigation */
    .sidebar-menu-wrapper {
        display: flex;
        flex-direction: column;
        height: calc(100vh - 120px);
    }

    .nav-label {
        font-size: 0.65rem;
        font-weight: 800;
        text-transform: uppercase;
        color: #64748b; /* Slate 500 */
        letter-spacing: 0.15em;
        margin: 1.5rem 0 0.5rem 0.75rem;
    }

    .nav-link-custom {
        display: flex;
        align-items: center;
        padding: 0.7rem 1rem;
        color: #94a3b8; /* Slate 400 */
        text-decoration: none;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 0.75rem;
        margin-bottom: 0.25rem;
        font-weight: 500;
        font-size: 0.875rem;
    }

    .nav-link-custom i {
        font-size: 1.2rem;
        margin-right: 0.85rem;
        line-height: 1;
    }

    .nav-link-custom:hover {
        color: #f8fafc;
        background-color: rgba(255, 255, 255, 0.05);
        transform: translateX(4px);
    }

    .nav-link-custom.active {
        color: #ffffff !important;
        background-color: #2563eb; /* Accent Blue */
        font-weight: 600;
        box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.25);
    }

    .nav-logout:hover {
        background-color: rgba(239, 68, 68, 0.1) !important;
        color: #f87171 !important;
    }

    /* User Panel Sleek Style */
    .sidebar-user-panel {
        margin-top: auto;
        padding: 1rem;
        background: rgba(15, 23, 42, 0.5); /* Slate 900 */
        border-radius: 1rem;
        display: flex;
        align-items: center;
        border: 1px solid rgba(255, 255, 255, 0.05);
        margin-bottom: 1rem;
    }

    .sidebar-profile-img {
        width: 40px !important;
        height: 40px !important;
        object-fit: cover;
        border-radius: 10px;
        border: 2px solid #334155;
    }

    .status-indicator {
        width: 10px;
        height: 10px;
        background-color: #10b981;
        border: 2px solid #0f172a;
        border-radius: 50%;
        position: absolute;
        bottom: -2px;
        right: -2px;
    }

    .user-info-text h6 {
        font-size: 0.85rem;
        letter-spacing: -0.01em;
    }
</style>

<div class="sidebar-menu-wrapper">
    <a href="<?= base_url('dashboard') ?>" class="nav-link-custom <?= url_is('dashboard*') ? 'active' : '' ?>">
        <i class="bi bi-grid-1x2-fill"></i> Dashboard
    </a>


    <?php if (in_array(session()->get('role'), ['admin', 'teknisi'])) : ?>
        <div class="nav-label">Management</div>
        <a href="<?= base_url('/users') ?>" class="nav-link-custom <?= (uri_string() == 'users') ? 'active' : '' ?>">
            <i class="bi bi-people-fill"></i> Profile List
        </a>
    <?php endif; ?>

    <div class="nav-label">Layanan</div>
    <a href="<?= base_url('/pengaduan') ?>" class="nav-link-custom <?= (uri_string() == 'pengaduan') ? 'active' : '' ?>">
        <i class="bi bi-inbox-fill"></i> Pengaduan
    </a>

    <?php if (session()->get('role') == 'admin') : ?>
        <a href="<?= base_url('/tanggapan') ?>" class="nav-link-custom <?= (uri_string() == 'tanggapan') ? 'active' : '' ?>">
            <i class="bi bi-chat-square-text-fill"></i> Tanggapan
        </a>
    <?php endif; ?>

    <?php if (in_array(session()->get('role'), ['admin', 'teknisi'])) : ?>
        <a href="<?= base_url('/penugasan') ?>" class="nav-link-custom <?= (uri_string() == 'penugasan') ? 'active' : '' ?>">
            <i class="bi bi-shield-check"></i> Penugasan
        </a>
    <?php endif; ?>

    <div class="nav-label">System</div>
    <a href="<?= base_url('users/edit/' . session('id_user')) ?>" class="nav-link-custom <?= (strpos(uri_string(), 'users/edit') !== false) ? 'active' : '' ?>">
        <i class="bi bi-gear-wide-connected"></i> Settings
    </a>

    <?php if (session()->get('role') == 'admin') : ?>
        <a href="<?= base_url('/backup') ?>" class="nav-link-custom">
            <i class="bi bi-database-fill-up text-success"></i> Backup DB
        </a>
    <?php endif; ?>

    <a href="<?= base_url('/logout') ?>" class="nav-link-custom nav-logout">
        <i class="bi bi-power"></i> Log Out
    </a>

    <div class="sidebar-user-panel">
        <div class="position-relative">
            <img src="<?= session()->get('foto') ? base_url('uploads/users/' . session()->get('foto')) : base_url('assets/img/default-user.png') ?>" 
                 class="sidebar-profile-img" alt="User">
            <span class="status-indicator"></span>
        </div>
        <div class="user-info-text ms-3">
            <h6 class="mb-0 text-white fw-bold text-truncate" style="max-width: 110px;"><?= session('nama'); ?></h6>
            <p class="text-muted mb-0 fw-bold" style="font-size: 0.6rem; letter-spacing: 0.05em;"><?= strtoupper(session('role')); ?></p>
        </div>
    </div>
</div>