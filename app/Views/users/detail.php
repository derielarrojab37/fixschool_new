<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* 💎 Elite Profile Styling */
    .profile-card {
        border: none;
        border-radius: 1.25rem;
        background-color: #ffffff;
        overflow: hidden;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
    }

    .profile-cover {
        height: 120px;
        background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
        position: relative;
    }

    /* Pattern overlay untuk cover agar tidak polos */
    .profile-cover::after {
        content: "";
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        opacity: 0.1;
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.4'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    .profile-avatar-wrapper {
        margin-top: -60px;
        position: relative;
        z-index: 2;
        display: flex;
        justify-content: center;
    }

    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 1.5rem; /* Modern Squircle */
        border: 5px solid #fff;
        object-fit: cover;
        background-color: #f1f5f9;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .info-label {
        color: #64748b;
        font-size: .65rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .1em;
    }

    .info-value {
        font-size: .9rem;
        color: #1e293b;
        font-weight: 600;
    }

    .detail-section {
        border-bottom: 1px solid #f1f5f9;
        padding: 1.25rem 0;
        transition: background 0.2s;
    }
    
    .detail-section:hover {
        background-color: #f8fafc;
    }

    .detail-section:last-child {
        border-bottom: none;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        background-color: #f0fdf4;
        color: #16a34a;
        padding: 0.35rem 0.85rem;
        border-radius: 8px;
        font-size: 0.7rem;
        font-weight: 800;
        border: 1px solid #dcfce7;
    }

    .role-pill {
        font-size: 0.7rem;
        font-weight: 800;
        padding: 0.4rem 1rem;
        border-radius: 8px;
        letter-spacing: 0.05em;
    }
</style>

<div class="container-fluid py-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="<?= base_url('users') ?>" class="text-primary fw-bold text-decoration-none small">DATABASE PENGGUNA</a></li>
                    <li class="breadcrumb-item active small text-uppercase fw-semibold" aria-current="page">Profil Detail</li>
                </ol>
            </nav>
            <h3 class="fw-800 text-dark mb-0" style="letter-spacing: -0.02em;">Informasi Personil</h3>
        </div>
        <a href="<?= base_url('users') ?>" class="btn btn-white border shadow-sm px-3 fw-bold">
            <i class="bi bi-arrow-left me-2"></i> Kembali
        </a>
    </div>

    <div class="row g-4">
        <div class="col-xl-4 col-lg-5">
            <div class="profile-card shadow-sm mb-4">
                <div class="profile-cover"></div>
                <div class="profile-avatar-wrapper">
                    <img src="<?= $user['foto'] ? base_url('uploads/users/' . $user['foto']) : base_url('assets/img/default-user.png') ?>" 
                         class="profile-avatar">
                </div>
                
                <div class="card-body text-center pt-3 px-4">
                    <h4 class="fw-800 text-dark mb-1"><?= $user['nama'] ?></h4>
                    <p class="text-muted small mb-3 font-monospace"><?= $user['email'] ?></p>
                    
                    <div class="d-flex justify-content-center gap-2 mb-4">
                        <span class="role-pill bg-primary text-white shadow-sm">
                            <i class="bi bi-shield-shaded me-1"></i> <?= strtoupper($user['role']) ?>
                        </span>
                        <div class="status-badge">
                            <span class="d-inline-block bg-success rounded-circle me-2" style="width: 6px; height: 6px;"></span>
                            TERVERIFIKASI
                        </div>
                    </div>

                    <div class="row border rounded-3 py-3 mb-4 bg-light mx-0 shadow-inner">
                        <div class="col-6 border-end">
                            <span class="d-block info-label mb-1">ID Personil</span>
                            <span class="fw-800 text-dark font-monospace">#<?= str_pad($user['id_user'], 4, '0', STR_PAD_LEFT) ?></span>
                        </div>
                        <div class="col-6">
                            <span class="d-block info-label mb-1">Tahun Aktif</span>
                            <span class="fw-800 text-dark">2026</span>
                        </div>
                    </div>

                    <?php if (session()->get('role') == 'admin') : ?>
                        <div class="pb-2">
                            <a href="<?= base_url('users/edit/' . $user['id_user']) ?>" class="btn btn-primary w-100 py-2 fw-bold shadow-sm" style="border-radius: 10px;">
                                <i class="bi bi-pencil-square me-2"></i> Konfigurasi Akun
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-lg-7">
            <div class="card border-0 shadow-sm" style="border-radius: 1.25rem;">
                <div class="card-header bg-white border-bottom py-4 px-4">
                    <div class="d-flex align-items-center">
                        <div class="p-2 bg-blue-soft rounded-3 me-3">
                            <i class="bi bi-person-badge-fill text-primary fs-4"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-800 text-dark">Data Autentikasi</h5>
                            <p class="text-muted small mb-0">Rincian kredensial dan hak akses keamanan pengguna.</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="detail-section">
                        <div class="row align-items-center">
                            <div class="col-sm-4 info-label">Nama Lengkap</div>
                            <div class="col-sm-8 info-value"><?= $user['nama'] ?></div>
                        </div>
                    </div>
                    
                    <div class="detail-section">
                        <div class="row align-items-center">
                            <div class="col-sm-4 info-label">Kontak Elektronik</div>
                            <div class="col-sm-8">
                                <span class="info-value text-primary border-bottom border-primary border-opacity-25"><?= $user['email'] ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="detail-section">
                        <div class="row align-items-center">
                            <div class="col-sm-4 info-label">Username Sistem</div>
                            <div class="col-sm-8 info-value font-monospace bg-light d-inline-block px-2 py-1 rounded"><?= $user['username'] ?></div>
                        </div>
                    </div>

                    <div class="detail-section">
                        <div class="row align-items-center">
                            <div class="col-sm-4 info-label">Protokol Keamanan</div>
                            <div class="col-sm-8">
                                <div class="d-flex align-items-center text-success fw-bold small">
                                    <i class="bi bi-shield-fill-check fs-5 me-2"></i>
                                    DATABASE ENCRYPTED & HASHED (SHA-256)
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="detail-section">
                        <div class="row align-items-center">
                            <div class="col-sm-4 info-label">Otoritas Akses</div>
                            <div class="col-sm-8 info-value">
                                <div class="d-flex align-items-center">
                                    <div class="bg-blue-soft p-2 rounded-3 me-3 text-primary">
                                        <i class="bi bi-key-fill"></i>
                                    </div>
                                    <span>Tingkat Otoritas: <strong class="text-dark text-uppercase"><?= $user['role'] ?></strong></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer bg-light border-0 py-4 px-4 text-center">
                    <p class="text-muted small mb-0">
                        <i class="bi bi-info-circle-fill me-1 text-primary"></i>
                        Data ini bersifat rahasia dan hanya dapat dimodifikasi oleh manajemen TI yang berwenang.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>