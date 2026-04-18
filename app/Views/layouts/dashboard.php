<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* Dashboard Admin One Style */
    .welcome-banner {
        margin-bottom: 2rem;
    }
    
    .dashboard-title {
        color: #1a202c;
        font-weight: 800;
        letter-spacing: -0.025em;
        font-size: 1.75rem;
    }

    .subtitle-welcome {
        color: #718096;
        font-size: 0.95rem;
    }

    /* Stats Card Modern */
    .stat-card {
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        transition: all 0.2s ease;
        background: #fff;
    }

    .stat-card:hover {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }

    /* Notification List Style */
    .notif-item {
        border-bottom: 1px solid #f3f4f6;
        padding: 1rem;
        transition: background 0.2s;
    }

    .notif-item:last-child {
        border-bottom: none;
    }

    .notif-item:hover {
        background-color: #f9fafb;
    }

    .notif-unread {
        border-left: 4px solid #3b82f6;
        background-color: #eff6ff;
    }

    .notif-icon-box {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    /* Action Card */
    .card-action-blue {
        background-color: #2563eb;
        color: #ffffff;
        border: none;
        border-radius: 0.75rem;
    }

    .btn-white-outline {
        border: 1px solid rgba(255,255,255,0.4);
        color: #fff;
        background: rgba(255,255,255,0.1);
    }

    .btn-white-outline:hover {
        background: #fff;
        color: #2563eb;
    }
</style>

<div class="container-fluid">
    <div class="welcome-banner">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="dashboard-title mb-1">Overview Dashboard</h1>
                <p class="subtitle-welcome mb-0">
                    Halo, <strong><?= session()->get('nama') ?></strong>. 
                    Kelola laporan sekolah dengan cepat dan efisien.
                </p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 rounded-pill">
                    <i class="bi bi-person-badge me-1"></i> Mode: <?= ucfirst(session()->get('role')) ?>
                </span>
            </div>
        </div>
    </div>

    <?php if(session()->get('role') == 'admin'): ?>
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card stat-card p-3">
                <div class="d-flex align-items-center">
                    <div class="stat-icon bg-secondary-subtle text-secondary me-3">
                        <i class="bi bi-people"></i>
                    </div>
                    <div>
                        <h6 class="text-muted small mb-1 fw-bold">PENGGUNA</h6>
                        <h3 class="fw-bold mb-0"><?= $total_user ?? 0 ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card p-3">
                <div class="d-flex align-items-center">
                    <div class="stat-icon bg-success-subtle text-success me-3">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <div>
                        <h6 class="text-muted small mb-1 fw-bold">SELESAI</h6>
                        <h3 class="fw-bold mb-0"><?= $selesai ?? 0 ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card p-3">
                <div class="d-flex align-items-center">
                    <div class="stat-icon bg-primary-subtle text-primary me-3">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                    <div>
                        <h6 class="text-muted small mb-1 fw-bold">DIPROSES</h6>
                        <h3 class="fw-bold mb-0"><?= $diproses ?? 0 ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card p-3">
                <div class="d-flex align-items-center">
                    <div class="stat-icon bg-danger-subtle text-danger me-3">
                        <i class="bi bi-x-circle"></i>
                    </div>
                    <div>
                        <h6 class="text-muted small mb-1 fw-bold">DITOLAK</h6>
                        <h3 class="fw-bold mb-0"><?= $ditolak ?? 0 ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php
        $notifModel = new \App\Models\NotifikasiModel();
        $notif = $notifModel
            ->where('id_user', session()->get('id_user'))
            ->orderBy('tanggal','DESC')
            ->findAll();
    ?>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm" style="border-radius: 1rem; overflow: hidden;">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                    <h5 class="mb-0 fw-bold text-dark">
                        <i class="bi bi-lightning-charge-fill text-warning me-2"></i>Aktifitas Terbaru
                    </h5>
                    <button class="btn btn-sm btn-light border fw-bold text-muted px-3">Mark all as read</button>
                </div>
                <div class="card-body p-0">
                    <?php if(!empty($notif)): ?>
                        <?php foreach($notif as $n): ?>
                            <div class="notif-item d-flex align-items-start <?= $n['status'] == 'belum' ? 'notif-unread' : '' ?>">
                                <div class="notif-icon-box <?= $n['status'] == 'belum' ? 'bg-primary text-white' : 'bg-light text-muted' ?> me-3">
                                    <i class="bi <?= $n['status'] == 'belum' ? 'bi-bell-fill' : 'bi-check-circle' ?>"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <h6 class="mb-0 fw-bold small"><?= $n['status'] == 'belum' ? 'Update Baru' : 'Laporan' ?></h6>
                                        <small class="text-muted" style="font-size: 0.75rem;">
                                            <i class="bi bi-clock me-1"></i><?= date('H:i', strtotime($n['tanggal'])) ?>
                                        </small>
                                    </div>
                                    <p class="mb-1 text-muted text-sm"><?= $n['pesan'] ?></p>
                                    <small class="fw-bold text-primary" style="font-size: 0.75rem;"><?= date('d M Y', strtotime($n['tanggal'])) ?></small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="bi bi-inbox fs-1 text-muted opacity-25"></i>
                            <p class="text-muted mt-3">Tidak ada aktifitas terbaru.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="card card-action-blue p-4 mb-4 shadow">
                <h6 class="text-uppercase small fw-bold opacity-75 mb-3">Sesi Sekarang</h6>
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-calendar-check fs-3 me-3"></i>
                    <h5 class="mb-0 fw-bold"><?= date('d F Y') ?></h5>
                </div>
                <p class="small opacity-75 mb-4">Pastikan Anda selalu logout setelah selesai menggunakan sistem untuk keamanan data.</p>
                <button class="btn btn-white-outline w-100 btn-sm fw-bold">
                    <i class="bi bi-shield-lock me-2"></i>Sistem Terenkripsi
                </button>
            </div>

            <div class="card border-0 shadow-sm p-4">
                <div class="text-center mb-3">
                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-question-circle text-primary fs-3"></i>
                    </div>
                    <h6 class="fw-bold mb-2">Bantuan IT</h6>
                    <p class="text-muted text-sm small px-3">Ada kendala teknis? Tim IT Administrator siap membantu Anda setiap hari kerja.</p>
                </div>
                <a href="mailto:it@school.id" class="btn btn-primary w-100 fw-bold py-2 shadow-sm">
                    Hubungi Support
                </a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>