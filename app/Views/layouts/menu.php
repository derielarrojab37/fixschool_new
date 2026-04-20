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
    /* Container Panel */
.sidebar-user-panel {
    margin-top: auto;
    padding: 0.85rem;
    background-color: rgba(255, 255, 255, 0.05); /* Sedikit lebih terang agar elegan */
    border-radius: 0.75rem;
    display: flex;
    align-items: center;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

/* 🎯 SOLUSI UTAMA: Mengunci ukuran foto agar tidak gepeng */
.sidebar-profile-img {
    width: 45px !important;      /* Paksa ukuran tetap */
    height: 45px !important;     /* Paksa ukuran tetap */
    min-width: 45px;             /* Mencegah penciutan */
    min-height: 45px;
    object-fit: contain;         /* 'contain' jika logo, 'cover' jika foto orang */
    background: white;           /* Latar belakang putih jika gambar transparan */
    border-radius: 50%;          /* Membuat bulat sempurna */
    padding: 4px;                /* Memberi ruang nafas untuk logo */
    border: 2px solid #374151;
}

/* Status Dot */
.status-indicator {
    width: 12px;
    height: 12px;
    background-color: #10b981;
    border: 2px solid #1f2937; /* Sesuaikan dengan warna bg sidebar */
    border-radius: 50%;
    position: absolute;
    bottom: 0px;
    right: 0px;
    z-index: 2;
}

/* Mencegah teks meluber */
.user-info-text {
    margin-left: 12px;
    overflow: hidden;
    white-space: nowrap;
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

    <div class="sidebar-user-panel mt-auto">
    <div class="position-relative">
        <img src="<?= session()->get('foto') ? base_url('uploads/users/' . session()->get('foto')) : base_url('assets/img/default-user.png') ?>" 
             class="sidebar-profile-img" 
             alt="Logo">
        <span class="status-indicator"></span>
    </div>
    
    <div class="user-info-text">
        <h6 class="mb-0 text-white small fw-bold text-truncate" style="max-width: 130px;">
            <?= session('nama'); ?>
        </h6>
        <p class="text-muted mb-0 fw-bold" style="font-size: 0.65rem; letter-spacing: 0.05em;">
            <?= strtoupper(session('role')); ?>
        </p>
    </div>
</div>