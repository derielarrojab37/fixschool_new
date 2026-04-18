<style>
    /* Argon Sidebar Customization */
    .navbar-vertical {
        width: 250px;
        height: 100vh;
        background-color: #ffffff; /* Argon White Sidebar */
        border-right: none;
        position: fixed;
        padding: 0;
        display: flex;
        flex-direction: column;
        box-shadow: 0 0 2rem 0 rgba(136, 152, 170, .15);
    }

    .brand-container {
        padding: 1.5rem;
        margin-bottom: 1rem;
        text-align: center;
    }

    .brand-logo {
        font-size: 1.25rem;
        font-weight: 700;
        color: #32325d;
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .brand-logo span {
        color: #5e72e4; /* Argon Primary */
    }

    .nav-link-custom {
        display: flex;
        align-items: center;
        padding: 0.65rem 1.5rem;
        color: rgba(0, 0, 0, .5);
        text-decoration: none;
        transition: all 0.15s ease;
        font-weight: 400;
        font-size: 0.9rem;
    }

    .nav-link-custom:hover {
        color: #5e72e4;
        background-color: #f6f9fc;
    }

    /* Argon Active Style */
    .nav-link-custom.active {
        color: #5e72e4 !important;
        font-weight: 600;
        background-color: #f6f9fc;
        border-left: 3px solid #5e72e4;
    }

    /* Icon Colors Argon Style */
    .nav-link-custom i {
        font-size: 1.1rem;
        margin-right: 1rem;
        line-height: 1;
        transition: transform 0.2s;
    }

    /* Assigning distinct colors to icons like Argon */
    .nav-dashboard i { color: #5e72e4; } /* Blue */
    .nav-users i { color: #f5365c; }     /* Red */
    .nav-pengaduan i { color: #fb6340; } /* Orange */
    .nav-tanggapan i { color: #2dce89; } /* Green */
    .nav-penugasan i { color: #11cdef; } /* Cyan */
    .nav-settings i { color: #8898aa; }  /* Gray */
    .nav-logout i { color: #f5365c; }    /* Red */

    .nav-link-custom:hover i {
        transform: scale(1.1);
    }

    .nav-label {
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #8898aa;
        letter-spacing: .05em;
        margin-top: 1.5rem;
        margin-bottom: 0.5rem;
        padding-left: 1.5rem;
    }

    /* Profile Box at Bottom */
    .user-profile-box {
        margin-top: auto;
        padding: 1.5rem;
        background-color: #f6f9fc;
        border-top: 1px solid #e9ecef;
    }

    .extra-small {
        font-size: 0.65rem;
        font-weight: 600;
        color: #8898aa;
    }
</style>

<nav class="navbar-vertical">
 

    <a href="<?= base_url('/') ?>" class="nav-link-custom nav-dashboard <?= (uri_string() == '') ? 'active' : '' ?>">
        <i class="bi bi-tv-fill"></i> Dashboard
    </a>

    <?php if (session()->get('role') == 'admin' || session()->get('role') == 'teknisi') : ?>
        <div class="nav-label">Management</div>
        
        <a href="<?= base_url('/users') ?>" class="nav-link-custom nav-users <?= (uri_string() == 'users') ? 'active' : '' ?>">
            <i class="bi bi-people-fill"></i> Profile
        </a>
    <?php endif; ?>

    <div class="nav-label">Layanan</div>
    
    <a href="<?= base_url('/pengaduan') ?>" class="nav-link-custom nav-pengaduan <?= (uri_string() == 'pengaduan') ? 'active' : '' ?>">
        <i class="bi bi-megaphone-fill"></i> Pengaduan
    </a>

    <?php if (session()->get('role') == 'admin') : ?>
        <a href="<?= base_url('/tanggapan') ?>" class="nav-link-custom nav-tanggapan <?= (uri_string() == 'tanggapan') ? 'active' : '' ?>">
            <i class="bi bi-chat-left-text-fill"></i> Tanggapan
        </a>
    <?php endif; ?>

    <?php if (session()->get('role') == 'admin' || session()->get('role') == 'teknisi') : ?>
        <a href="<?= base_url('/penugasan') ?>" class="nav-link-custom nav-penugasan <?= (uri_string() == 'penugasan') ? 'active' : '' ?>">
            <i class="bi bi-tools"></i> Penugasan
        </a>
    <?php endif; ?>

    <div class="nav-label">System</div>
    
    <?php $idu = session('id_user'); ?>
    <a href="<?= base_url('users/edit/' . $idu) ?>" class="nav-link-custom nav-settings <?= (strpos(uri_string(), 'users/edit') !== false) ? 'active' : '' ?>">
        <i class="bi bi-gear-fill"></i> Settings
    </a>

    <a href="<?= base_url('/logout') ?>" class="nav-link-custom nav-logout text-danger">
        <i class="bi bi-door-open-fill"></i> Log Out
    </a>

    <div class="user-profile-box d-flex align-items-center">
        <div class="position-relative">
            <img src="<?= session()->get('foto') ? base_url('uploads/users/' . session()->get('foto')) : base_url('assets/img/default-user.png') ?>" 
                 class="rounded-circle shadow-sm" 
                 width="40" height="40" style="object-fit: cover; border: 2px solid #fff;">
            <span class="position-absolute bottom-0 end-0 p-1 bg-success border border-white rounded-circle"></span>
        </div>
        <div class="ms-3 overflow-hidden">
            <p class="mb-0 text-dark fw-bold small text-truncate" style="font-size: 0.8rem;"><?= session('nama'); ?></p>
            <p class="mb-0 extra-small uppercase text-muted"><?= strtoupper(session('role')); ?></p>
        </div>
    </div>
</nav>