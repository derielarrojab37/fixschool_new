<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* Argon Profile Styling */
    .card-profile {
        border: none;
        border-radius: 1rem;
        background-color: #ffffff;
        box-shadow: 0 0 2rem 0 rgba(136, 152, 170, .15) !important;
        margin-top: 50px; /* Memberi ruang untuk avatar yang menonjol */
    }

    .profile-image-container {
        position: relative;
    }

    .profile-image {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        border: 4px solid #fff;
        box-shadow: 0 5px 15px rgba(0,0,0,.1);
        object-fit: cover;
        margin-top: -70px; /* Efek floating avatar khas Argon */
        background-color: white;
    }

    .info-label {
        color: #8898aa;
        font-size: .75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .025em;
    }

    .info-value {
        font-size: .875rem;
        color: #32325d;
        font-weight: 400;
    }

    .section-title {
        color: #32325d;
        font-weight: 600;
        letter-spacing: .025em;
        position: relative;
        padding-bottom: 10px;
    }

    .btn-argon-edit {
        background-color: #5e72e4;
        color: #fff;
        border-radius: 0.375rem;
        font-weight: 600;
        transition: all 0.15s ease;
    }

    .btn-argon-edit:hover {
        background-color: #324cdd;
        color: #fff;
        transform: translateY(-1px);
    }

    .status-active {
        color: #2dce89;
        font-weight: 600;
        font-size: 0.85rem;
    }
</style>

<div class="container-fluid py-5">
    <div class="mb-5">
        <a href="<?= base_url('users') ?>" class="btn btn-sm btn-link text-primary fw-bold p-0 mb-2">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke daftar
        </a>
        <h3 class="fw-bold" style="color: #32325d;">Informasi Profil</h3>
    </div>

    <div class="row">
        <div class="col-xl-4 col-md-5">
            <div class="card card-profile text-center pb-4">
                <div class="profile-image-container">
                    <img src="<?= $user['foto'] ? base_url('uploads/users/' . $user['foto']) : base_url('assets/img/default-user.png') ?>" 
                         class="profile-image shadow">
                </div>
                
                <div class="card-body pt-3">
                    <h4 class="fw-bold mb-1" style="color: #32325d;"><?= $user['nama'] ?></h4>
                    <div class="mb-4">
                        <span class="badge bg-gradient-primary rounded-pill px-3" style="background: linear-gradient(87deg, #5e72e4 0, #825ee4 100%);">
                            <?= ucfirst($user['role']) ?>
                        </span>
                    </div>

                    <div class="d-flex justify-content-around border-top border-bottom py-3 mb-4">
                        <div>
                            <span class="d-block info-label">Status</span>
                            <span class="status-active"><i class="bi bi-circle-fill me-1 small"></i> Aktif</span>
                        </div>
                        <div>
                            <span class="d-block info-label">ID</span>
                            <span class="info-value">#<?= $user['id_user'] ?></span>
                        </div>
                    </div>

                    <?php if (session()->get('role') == 'admin') : ?>
                        <div class="px-3">
                            <a href="<?= base_url('users/edit/' . $user['id_user']) ?>" class="btn btn-argon-edit w-100 shadow-sm">
                                <i class="bi bi-pencil-square me-2"></i> Edit Profile
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-md-7 mt-4 mt-md-0">
            <div class="card shadow border-0" style="border-radius: 1rem;">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h5 class="section-title mb-0">Detail Akun Pengguna</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row mb-4 align-items-center">
                        <div class="col-sm-4 info-label">Nama Lengkap</div>
                        <div class="col-sm-8 info-value fw-bold"><?= $user['nama'] ?></div>
                    </div>
                    <hr class="my-3 opacity-5">
                    
                    <div class="row mb-4 align-items-center">
                        <div class="col-sm-4 info-label">Alamat Email</div>
                        <div class="col-sm-8 info-value text-primary fw-600"><?= $user['email'] ?></div>
                    </div>
                    <hr class="my-3 opacity-5">

                    <div class="row mb-4 align-items-center">
                        <div class="col-sm-4 info-label">Username</div>
                        <div class="col-sm-8 info-value"><?= $user['username'] ?></div>
                    </div>
                    <hr class="my-3 opacity-5">

                    <div class="row mb-4 align-items-center">
                        <div class="col-sm-4 info-label">Kata Sandi</div>
                        <div class="col-sm-8 info-value text-muted">
                            <span class="badge bg-light text-muted border px-2 py-1">
                                <i class="bi bi-shield-lock me-1"></i> Terenkripsi
                            </span>
                        </div>
                    </div>
                    <hr class="my-3 opacity-5">

                    <div class="row mb-2 align-items-center">
                        <div class="col-sm-4 info-label">Hak Akses Sistem</div>
                        <div class="col-sm-8 info-value">
                            <i class="bi bi-person-check-fill text-info me-2"></i> User ini memiliki akses sebagai <strong><?= ucfirst($user['role']) ?></strong>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light border-0 py-3 text-center" style="border-radius: 0 0 1rem 1rem;">
                    <p class="mb-0 text-muted small italic">Informasi ini rahasia dan hanya untuk keperluan internal sistem.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>