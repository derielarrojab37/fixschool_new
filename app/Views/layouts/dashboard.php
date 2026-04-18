<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* Argon Dashboard UI Style */
    .header-body {
        padding-bottom: 2rem;
    }
    
    .dashboard-title {
        color: #ffffff; /* Putih karena berada di atas gradient header */
        font-weight: 600;
        letter-spacing: .025em;
    }

    .subtitle-welcome {
        color: rgba(255, 255, 255, .8);
        font-size: 0.875rem;
    }

    /* Notification Card Style */
    .notif-card {
        border: none;
        border-radius: 0.5rem;
        background-color: #ffffff;
        box-shadow: 0 0 2rem 0 rgba(136, 152, 170, .15);
        transition: transform 0.15s ease;
        margin-bottom: 1rem;
    }

    .notif-card:hover {
        transform: translateY(-2px);
    }

    .notif-unread {
        border-left: 4px solid #fb6340 !important; /* Argon Orange */
    }

    .notif-read {
        background-color: #f6f9fc;
        opacity: 0.9;
    }

    .notif-icon-box {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .bg-icon-unread {
        background-color: rgba(251, 99, 64, 0.1);
        color: #fb6340;
    }

    .bg-icon-read {
        background-color: #e9ecef;
        color: #adb5bd;
    }

    /* Side Info Card */
    .card-info-argon {
        border: none;
        border-radius: 0.5rem;
        background: linear-gradient(87deg, #11cdef 0, #1171ef 100%) !important;
        color: #ffffff;
    }
</style>



<div class="container-fluid">
    <div class="header-body mb-4">
        <div class="row align-items-center py-4">
            <div class="col-lg-12">
                <h6 class="h2 dashboard-title d-inline-block mb-0">Dashboard</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ms-md-4">
                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark bg-transparent p-0 m-0">
                        <li class="breadcrumb-item"><a href="#"><i class="bi bi-house-door-fill text-white"></i></a></li>
                        <li class="breadcrumb-item active text-white opacity-8" aria-current="page">Default</li>
                    </ol>
                </nav>
                <p class="subtitle-welcome mt-2">
                    Selamat datang kembali, <span class="fw-bold text-white"><?= session()->get('nama') ?></span>. 
                    Anda masuk sebagai <span class="badge bg-secondary text-dark px-2"><?= ucfirst(session()->get('role')) ?></span>
                </p>
            </div>
        </div>
    </div>

    <?php
    $notifModel = new \App\Models\NotifikasiModel();
    $notif = $notifModel
        ->where('id_user', session()->get('id_user'))
        ->orderBy('tanggal','DESC')
        ->findAll();
    ?>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-4" style="border-radius: 1rem;">
                <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold" style="color: #32325d;"><i class="bi bi-bell-fill text-primary me-2"></i>Notifikasi Terbaru</h5>
                    <a href="#" class="btn btn-sm btn-outline-primary rounded-pill">Lihat Semua</a>
                </div>
                <div class="card-body px-3 pt-0">
                    <?php if(!empty($notif)): ?>
                        <?php foreach($notif as $n): ?>
                            <div class="card notif-card <?= $n['status'] == 'belum' ? 'notif-unread' : 'notif-read' ?>">
                                <div class="card-body p-3">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="notif-icon-box <?= $n['status'] == 'belum' ? 'bg-icon-unread' : 'bg-icon-read' ?>">
                                                <i class="bi <?= $n['status'] == 'belum' ? 'bi-megaphone-fill' : 'bi-check2-all' ?> fs-5"></i>
                                            </div>
                                        </div>
                                        <div class="col ms--2">
                                            <h4 class="mb-1 text-sm fw-bold" style="color: #32325d;"><?= $n['status'] == 'belum' ? 'Pemberitahuan Baru' : 'Sudah Dibaca' ?></h4>
                                            <p class="text-sm mb-0 text-muted"><?= $n['pesan'] ?></p>
                                            <small class="text-xs font-weight-bold text-primary mt-2 d-block">
                                                <i class="bi bi-clock me-1"></i><?= date('d M Y, H:i', strtotime($n['tanggal'])) ?>
                                            </small>
                                        </div>
                                        <?php if($n['status'] == 'belum'): ?>
                                        <div class="col-auto">
                                            <span class="badge badge-dot">
                                                <i class="bg-warning"></i>
                                            </span>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        
                    <?php else: ?>
                        <div class="text-center py-5">
                            <img src="https://cdn-icons-png.flaticon.com/512/3241/3241430.png" width="80" class="opacity-3 mb-3" alt="Empty">
                            <p class="text-muted small">Kotak masuk Anda kosong hari ini.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card card-info-argon shadow border-0 p-4 mb-4">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="text-uppercase text-white opacity-8 ls-1 mb-1">Status Sesi</h6>
                        <span class="h5 fw-bold mb-0 text-white">Akun Aktif</span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-white text-info rounded-circle shadow p-2">
                            <i class="bi bi-shield-check fs-4"></i>
                        </div>
                    </div>
                </div>
                <p class="mt-3 mb-0 text-sm">
                    <span class="text-white opacity-8 mr-2"><i class="bi bi-calendar3 me-1"></i> <?= date('l, d F Y') ?></span>
                </p>
            </div>

            <div class="card shadow border-0">
                <div class="card-body">
                    <h6 class="info-label text-muted fw-bold small text-uppercase mb-3">Butuh Bantuan?</h6>
                    <p class="text-sm text-muted">Jika Anda mengalami kendala pada sistem <strong>Fix School</strong>, silakan hubungi tim IT Administrator.</p>
                    <button class="btn btn-sm btn-primary w-100 shadow-none">Pusat Bantuan</button>
                </div>
            </div>
        </div>
    </div>
</div>



<?= $this->endSection() ?>