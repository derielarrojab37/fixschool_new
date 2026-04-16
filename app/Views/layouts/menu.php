<style>
    .navbar-vertical {
        width: 250px;
        height: 100vh;
        background-color: #141824; /* Phoenix Dark Card Color */
        border-right: 1px solid #31374a;
        position: fixed;
        padding: 1.5rem 1rem;
        display: flex;
        flex-direction: column;
    }

    .nav-link-custom {
        display: flex;
        align-items: center;
        padding: 0.6rem 1rem;
        color: #9ba1b7;
        text-decoration: none;
        border-radius: 0.5rem;
        transition: all 0.2s ease;
        font-weight: 500;
        margin-bottom: 0.25rem;
    }

    .nav-link-custom:hover {
        background-color: rgba(56, 116, 255, 0.1);
        color: #3874ff;
    }

    .nav-link-custom.active {
        background-color: #3874ff;
        color: #fff !important;
    }

    .nav-link-custom i {
        font-size: 1.2rem;
        margin-right: 12px;
    }

    .nav-label {
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #525b75;
        letter-spacing: .05em;
        margin-top: 1.5rem;
        margin-bottom: 0.5rem;
        padding-left: 1rem;
    }

    .user-profile-box {
        margin-top: auto;
        padding-top: 1.5rem;
        border-top: 1px solid #31374a;
    }

    .brand-logo {
        font-size: 1.5rem;
        font-weight: 800;
        color: #fff;
        text-decoration: none;
        padding-left: 1rem;
        margin-bottom: 2rem;
        display: block;
    }
    
    .brand-logo span {
        color: #3874ff;
    }
</style>

<nav class="navbar-vertical">
    <a href="<?= base_url('/') ?>" class="brand-logo">
        Fix<span>School</span>
    </a>

    <a href="<?= base_url('/') ?>" class="nav-link-custom <?= (uri_string() == '') ? 'active' : '' ?>">
        <i class="bi bi-grid-fill"></i> Dashboard
    </a>

    <?php if (session()->get('role') == 'admin' || session()->get('role') == 'teknisi') : ?>
        <div class="nav-label">Management</div>
        
        <a href="<?= base_url('/users') ?>" class="nav-link-custom <?= (uri_string() == 'users') ? 'active' : '' ?>">
            <i class="bi bi-people"></i> Users
        </a>
    <?php endif; ?>

    <div class="nav-label">Layanan</div>
    
    <a href="<?= base_url('/pengaduan') ?>" class="nav-link-custom <?= (uri_string() == 'pengaduan') ? 'active' : '' ?>">
        <i class="bi bi-chat-square-dots"></i> Pengaduan
    </a>

    <?php if (session()->get('role') == 'admin') : ?>
        <a href="<?= base_url('/tanggapan') ?>" class="nav-link-custom <?= (uri_string() == 'tanggapan') ? 'active' : '' ?>">
            <i class="bi bi-reply-all"></i> Tanggapan
        </a>
    <?php endif; ?>

    <?php if (session()->get('role') == 'admin' || session()->get('role') == 'teknisi') : ?>
        <a href="<?= base_url('/penugasan') ?>" class="nav-link-custom <?= (uri_string() == 'penugasan') ? 'active' : '' ?>">
            <i class="bi bi-clipboard-check"></i> Penugasan
        </a>
    <?php endif; ?>

    <div class="nav-label">System</div>
    
    <?php $idu = session('id_user'); ?>
    <a href="<?= base_url('users/edit/' . $idu) ?>" class="nav-link-custom <?= (strpos(uri_string(), 'users/edit') !== false) ? 'active' : '' ?>">
        <i class="bi bi-gear"></i> Settings
    </a>

    <a href="<?= base_url('/logout') ?>" class="nav-link-custom text-danger">
        <i class="bi bi-box-arrow-left"></i> Log Out
    </a>

    <div class="user-profile-box mt-auto d-flex align-items-center">
        <div class="position-relative">
            <img src="<?= base_url('uploads/users/' . session()->get('foto')) ?>" 
                 class="rounded-circle border border-2 border-primary" 
                 width="45" height="45" style="object-fit: cover;">
            <span class="position-absolute bottom-0 end-0 p-1 bg-success border border-light rounded-circle"></span>
        </div>
        <div class="ms-3 overflow-hidden">
            <p class="mb-0 text-white fw-bold small text-truncate"><?= session('nama'); ?></p>
            <p class="mb-0 text-muted extra-small" style="font-size: 0.7rem;"><?= strtoupper(session('role')); ?></p>
        </div>
    </div>
</nav>