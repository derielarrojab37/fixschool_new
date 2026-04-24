<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- ===================== STYLE ===================== -->
<style>
:root {
    --primary: #2563eb;
}

body {
    background-color: #f8fafc;
}

/* 🔹 TITLE SECTION */
.dashboard-title {
    font-weight: 800;
    font-size: 2.2rem;
    letter-spacing: -0.02em;
    background: linear-gradient(90deg, #0f172a, #334155);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* 🔹 CARD */
.card-clean {
    border: none;
    border-radius: 1.5rem;
    background: #fff;
    box-shadow: 0 10px 25px rgba(0,0,0,0.02);
}

/* 🔹 STAT CARD */
.stat-card {
    border: none;
    border-radius: 1.25rem;
    padding: 1.5rem;
    background: #fff;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0,0,0,0.03);
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 20px rgba(0,0,0,0.06);
}

.stat-icon-wrapper {
    width: 54px;
    height: 54px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

/* 🔹 LOG ICON */
.log-header-icon {
    width: 42px;
    height: 42px;
    background: #eef2ff;
    color: var(--primary);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

/* 🔹 NOTIFICATION */
.notif-item {
    border-bottom: 1px solid #f1f5f9;
    padding: 1.25rem 1.5rem;
    transition: 0.2s;
}

.notif-unread {
    border-left: 4px solid var(--primary);
    background: linear-gradient(90deg, #f8fbff, #ffffff);
}

.notif-bullet {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* 🔹 SIDEBAR */
.card-dark {
    background: linear-gradient(135deg, #1e293b, #0f172a);
    color: #fff;
    border-radius: 1.5rem;
    border: none;
}

.btn-soft {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(5px);
    border: 1px solid rgba(255,255,255,0.2);
    color: white;
    font-weight: 600;
}

.btn-soft:hover {
    background: white;
    color: #1e293b;
}
</style>

<!-- ===================== MAIN CONTAINER ===================== -->
<div class="container-fluid px-lg-5 py-4">

    <!-- ===================== HEADER ===================== -->
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1">
                <i class="bi bi-grid-1x2-fill text-primary"></i>
                <span class="text-uppercase fw-bold text-muted small" style="letter-spacing: 2px;">
                    Overview
                </span>
            </div>

            <h1 class="dashboard-title mb-0">Dashboard</h1>

            <p class="text-muted mb-0">
                Selamat datang kembali, <b><?= session()->get('nama') ?></b>
            </p>
        </div>

        <div class="text-end">
            <span class="badge bg-white text-dark border px-3 py-2 rounded-pill shadow-sm">
                <i class="bi bi-shield-lock me-1 text-primary"></i>
                <?= strtoupper(session()->get('role')) ?>
            </span>
        </div>
    </div>

    <!-- ===================== ADMIN STATS ===================== -->
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
                                <h6 class="text-muted small mb-2 fw-bolder text-uppercase" style="letter-spacing: 1px;">
                                    <?= $s['title'] ?>
                                </h6>
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

    <!-- ===================== CONTENT ===================== -->
    <div class="row g-4">

        <!-- 🔹 LEFT (LOG AKTIVITAS) -->
        <div class="col-lg-8">
            <div class="card card-clean overflow-hidden">

                <!-- HEADER -->
                <div class="card-header bg-white py-4 px-4 d-flex justify-content-between align-items-center border-0">
                    <div class="d-flex align-items-center gap-3">
                        <div class="log-header-icon shadow-sm">
                            <i class="bi bi-activity"></i>
                        </div>
                        <h5 class="mb-0 fw-bold text-dark">Log Aktivitas Eksklusif</h5>
                    </div>

                    <a href="<?= base_url('notifikasi/clear') ?>" 
                       onclick="return confirm('Hapus semua notifikasi?')" 
                       class="btn btn-sm btn-light text-danger fw-bold rounded-pill px-3">
                        Bersihkan
                    </a>
                </div>

                <!-- BODY -->
                <div class="card-body p-0">
                    <?php if(!empty($notif)): ?>

                        <?php foreach($notif as $n): ?>
                            <div class="notif-item d-flex align-items-start <?= $n['status'] == 'belum' ? 'notif-unread' : '' ?>">

                                <div class="notif-bullet <?= $n['status'] == 'belum' ? 'bg-primary text-white' : 'bg-light text-muted' ?> me-3 shadow-sm">
                                    <i class="bi <?= $n['status'] == 'belum' ? 'bi-lightning-charge-fill' : 'bi-app-indicator' ?>"></i>
                                </div>

                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="mb-1 fw-bold <?= $n['status'] == 'belum' ? 'text-dark' : 'text-muted' ?>">
                                            <?= $n['status'] == 'belum' ? 'Update Prioritas' : 'Notifikasi' ?>
                                        </h6>

                                        <small class="text-muted" style="font-size: 0.7rem;">
                                            <i class="bi bi-clock me-1"></i> 
                                            <?= date('H:i', strtotime($n['tanggal'])) ?> WIB
                                        </small>
                                    </div>

                                    <p class="text-muted small mb-0"><?= $n['pesan'] ?></p>

                                    <small class="text-primary fw-bold" style="font-size: 0.65rem;">
                                        <?= date('D, d M Y', strtotime($n['tanggal'])) ?>
                                    </small>
                                </div>

                            </div>
                        <?php endforeach; ?>

                    <?php else: ?>

                        <div class="text-center py-5">
                            <img src="https://illustrations.popsy.co/gray/empty-folder.svg" 
                                 style="width: 140px;" 
                                 class="mb-3 opacity-50">
                            <p class="text-muted fw-medium">Belum ada aktivitas baru.</p>
                        </div>

                    <?php endif; ?>
                </div>

            </div>
        </div>

        <!-- 🔹 RIGHT (SUPPORT) -->
        <div class="col-lg-4">

            <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 1.5rem;">

                <div class="d-flex align-items-center mb-4">
                    <div class="bg-primary-subtle p-3 rounded-4 me-3 text-primary">
                        <i class="bi bi-headset fs-4"></i>
                    </div>
                    <h6 class="fw-bold mb-0">Concierge IT</h6>
                </div>

                <p class="text-muted small mb-4">
                    <?= session()->get('role') == 'admin' 
                        ? 'Monitoring tiket bantuan yang masuk dari pengguna secara real-time.' 
                        : 'Butuh bantuan? Tim IT siap melayani kendala teknis Anda.' ?>
                </p>

                <div class="d-grid gap-2">

                    <a href="<?= base_url('support') ?>" class="btn btn-primary fw-bold py-2 shadow-sm">
                        <i class="bi bi-ticket-perforated me-2"></i> 
                        Lihat Semua Tiket
                    </a>

                    

                </div>

            </div>

        </div>

    </div>
</div>

<?= $this->endSection() ?>