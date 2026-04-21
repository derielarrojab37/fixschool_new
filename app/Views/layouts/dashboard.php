<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* Global refinement */
    :root {
        --glass-bg: rgba(255, 255, 255, 0.7);
        --accent-color: #2563eb;
    }

    body { background-color: #f8fafc; }

    /* Welcome Banner - More Cinematic */
    .welcome-banner {
        margin-bottom: 2.5rem;
        padding: 1.5rem 0;
    }
    
    .dashboard-title {
        color: #0f172a;
        font-weight: 800;
        letter-spacing: -0.04em;
        font-size: 2.2rem;
        background: linear-gradient(90deg, #0f172a, #334155);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Eksklusif Badge */
    .role-badge {
        background: #ffffff;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        border: 1px solid #e2e8f0 !important;
        color: #475569 !important;
        font-weight: 600;
        letter-spacing: 0.05em;
    }

    /* Stat Card - Premium Look */
    .stat-card {
        border: none !important;
        border-radius: 1.25rem;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        background: #ffffff;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02), 0 10px 20px rgba(0,0,0,0.03);
    }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
    }

    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 16px;
        font-size: 1.5rem;
    }

    /* Notification - Sleek List */
    .card-luxury {
        border: none;
        border-radius: 1.5rem;
        background: #ffffff;
        box-shadow: 0 10px 30px rgba(0,0,0,0.04);
    }

    .notif-item {
        border-bottom: 1px solid #f1f5f9;
        padding: 1.25rem;
    }

    .notif-unread {
        border-left: 5px solid var(--accent-color);
        background: linear-gradient(to right, #f0f7ff, #ffffff);
    }

    /* Action Card - Deep Gradient */
    .card-action-blue {
        background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
        color: #ffffff;
        border: none;
        border-radius: 1.5rem;
        position: relative;
        overflow: hidden;
    }

    /* Decorative Circle */
    .card-action-blue::after {
        content: "";
        position: absolute;
        width: 150px;
        height: 150px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
        top: -50px;
        right: -50px;
    }

    .btn-premium {
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.2);
        color: white;
        border-radius: 0.75rem;
        transition: all 0.3s;
    }

    .btn-premium:hover {
        background: white;
        color: #1e293b;
    }
</style>

<div class="container-fluid px-lg-5 py-4">
    <div class="welcome-banner">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="dashboard-title mb-2">Internal Overview</h1>
                <p class="subtitle-welcome mb-0 fw-medium">
                    Selamat datang kembali, <span class="text-primary fw-bold"><?= session()->get('nama') ?></span>. 
                    Sistem siap untuk memproses laporan Anda.
                </p>
            </div>
            <div class="col-md-4 text-md-end">
                <span class="badge role-badge px-4 py-2 rounded-pill">
                    <i class="bi bi-shield-check me-2 text-primary"></i> <?= strtoupper(session()->get('role')) ?> PRIVILEGE
                </span>
            </div>
        </div>
    </div>

    <?php if(session()->get('role') == 'admin'): ?>
    <div class="row g-4 mb-5">
        <?php 
        $stats = [
            ['title' => 'TOTAL PENGGUNA', 'val' => $total_user ?? 0, 'icon' => 'bi-people', 'color' => 'secondary'],
            ['title' => 'LAPORAN SELESAI', 'val' => $selesai ?? 0, 'icon' => 'bi-check-all', 'color' => 'success'],
            ['title' => 'DALAM PROSES', 'val' => $diproses ?? 0, 'icon' => 'bi-arrow-repeat', 'color' => 'primary'],
            ['title' => 'LAPORAN DITOLAK', 'val' => $ditolak ?? 0, 'icon' => 'bi-exclamation-triangle', 'color' => 'danger'],
        ];
        foreach($stats as $s): ?>
        <div class="col-md-3">
            <div class="card stat-card p-4">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="text-muted small mb-2 fw-bolder text-uppercase" style="letter-spacing: 1px;"><?= $s['title'] ?></h6>
                        <h2 class="fw-bold mb-0 text-dark"><?= $s['val'] ?></h2>
                    </div>
                    <div class="stat-icon bg-<?= $s['color'] ?>-subtle text-<?= $s['color'] ?> d-flex align-items-center justify-content-center">
                        <i class="bi <?= $s['icon'] ?>"></i>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-lg-8">
            <div class="card card-luxury">
                <div class="card-header bg-transparent py-4 px-4 d-flex justify-content-between align-items-center border-0">
                    <h5 class="mb-0 fw-bold text-dark">
                        <span class="p-2 bg-light rounded-3 me-2"><i class="bi bi-stack text-primary"></i></span>
                        Log Aktivitas Eksklusif
                    </h5>
                    <a href="#" class="text-decoration-none small fw-bold text-primary">Bersihkan Semua</a>
                </div>
                <div class="card-body p-0">
                    <?php if(!empty($notif)): ?>
                        <?php foreach($notif as $n): ?>
                            <div class="notif-item d-flex align-items-start <?= $n['status'] == 'belum' ? 'notif-unread' : '' ?>">
                                <div class="notif-icon-box <?= $n['status'] == 'belum' ? 'bg-primary text-white shadow-sm' : 'bg-light text-muted' ?> me-4">
                                    <i class="bi <?= $n['status'] == 'belum' ? 'bi-lightning-fill' : 'bi-check2-circle' ?>"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <h6 class="mb-0 fw-bold"><?= $n['status'] == 'belum' ? 'Prioritas Baru' : 'Sistem Notifikasi' ?></h6>
                                        <span class="badge bg-light text-muted rounded-pill fw-normal" style="font-size: 0.7rem;">
                                            <?= date('H:i', strtotime($n['tanggal'])) ?>
                                        </span>
                                    </div>
                                    <p class="text-muted small mb-1"><?= $n['pesan'] ?></p>
                                    <div class="text-primary fw-bold" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                        <?= date('D, d M Y', strtotime($n['tanggal'])) ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <img src="https://illustrations.popsy.co/gray/empty-folder.svg" style="width: 120px;" class="mb-3 opacity-50">
                            <p class="text-muted fw-medium">Belum ada catatan aktivitas masuk.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card card-action-blue p-4 mb-4 shadow-lg border-0">
                <div class="position-relative z-1">
                    <h6 class="text-uppercase small fw-bolder opacity-50 mb-4" style="letter-spacing: 2px;">Identity Security</h6>
                    <div class="d-flex align-items-center mb-4">
                        <div class="p-3 bg-white bg-opacity-10 rounded-4 me-3">
                            <i class="bi bi-clock-history fs-3"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold"><?= date('l') ?></h5>
                            <small class="opacity-75"><?= date('d F Y') ?></small>
                        </div>
                    </div>
                    <p class="small opacity-75 mb-4">Enkripsi AES-256 aktif. Sesi Anda terlindungi secara menyeluruh oleh protokol keamanan sekolah.</p>
                    <button class="btn btn-premium w-100 py-2 fw-bold">
                        <i class="bi bi-fingerprint me-2"></i>Verifikasi Keamanan
                    </button>
                </div>
            </div>

            <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 1.5rem;">
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-primary-subtle p-3 rounded-4 me-3 text-primary">
                        <i class="bi bi-headset fs-4"></i>
                    </div>
                    <h6 class="fw-bold mb-0">Concierge IT</h6>
                </div>
                <p class="text-muted small mb-4">Butuh bantuan eksklusif mengenai fungsionalitas sistem atau kendala teknis?</p>
                <a href="mailto:it@school.id" class="btn btn-dark w-100 fw-bold py-2 shadow-sm rounded-3">
                    Buka Tiket Support
                </a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>