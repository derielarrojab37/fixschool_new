<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* Styling khusus dashboard agar senada dengan Phoenix */
    .dashboard-header {
        margin-bottom: 2rem;
    }
    .text-phoenix-title {
        color: #eff2f6;
        font-weight: 700;
        letter-spacing: -0.02em;
    }
    .notif-card {
        background-color: #141824;
        border: 1px solid #31374a;
        border-radius: 0.5rem;
        transition: all 0.2s ease;
        margin-bottom: 12px;
    }
    .notif-card:hover {
        border-color: #3874ff;
        background-color: #1c2233;
    }
    .notif-unread {
        border-left: 4px solid #f2ac57; /* Aksen warna warning untuk yang belum dibaca */
    }
    .notif-read {
        opacity: 0.8;
    }
    .notif-icon {
        width: 40px;
        height: 40px;
        background-color: #0f111a;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
    }
</style>

<div class="container-fluid pt-4">

    <div class="dashboard-header">
        <h2 class="text-phoenix-title">Dashboard</h2>
        <p class="text-muted">Selamat datang kembali, <span class="text-primary fw-bold"><?= session()->get('nama') ?></span> di <b>Fix School</b></p>
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
            <div class="d-flex align-items-center mb-3">
                <h5 class="text-phoenix-title mb-0 me-2">🔔 Notifikasi</h5>
                <span class="badge rounded-pill bg-primary-subtle text-primary">Terbaru</span>
            </div>

            <?php if(!empty($notif)): ?>
                <?php foreach($notif as $n): ?>
                    <div class="card notif-card <?= $n['status'] == 'belum' ? 'notif-unread' : 'notif-read' ?>">
                        <div class="card-body d-flex align-items-start p-3">
                            <div class="notif-icon">
                                <i class="bi <?= $n['status'] == 'belum' ? 'bi-bell-fill text-warning' : 'bi-bell text-muted' ?> fs-5"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between">
                                    <p class="mb-1 fw-semibold <?= $n['status'] == 'belum' ? 'text-white' : 'text-muted' ?>">
                                        <?= $n['pesan'] ?>
                                    </p>
                                    <small class="text-muted" style="font-size: 0.75rem;">
                                        <i class="bi bi-clock me-1"></i><?= date('d M, H:i', strtotime($n['tanggal'])) ?>
                                    </small>
                                </div>
                                <?php if($n['status'] == 'belum'): ?>
                                    <span class="badge bg-warning-subtle text-warning p-1 px-2" style="font-size: 0.65rem;">Baru</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="card notif-card border-dashed">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-inbox text-muted fs-1"></i>
                        <p class="text-muted mt-2">Tidak ada notifikasi saat ini.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="col-lg-4">
            <div class="card notif-card p-3">
                <h6 class="text-phoenix-title mb-3">Info Akun</h6>
                <div class="d-flex align-items-center mb-2">
                    <i class="bi bi-person-badge me-2 text-primary"></i>
                    <span class="small text-muted">Role: <?= ucfirst(session()->get('role')) ?></span>
                </div>
                <div class="d-flex align-items-center">
                    <i class="bi bi-calendar-event me-2 text-primary"></i>
                    <span class="small text-muted">Login hari ini: <?= date('d F Y') ?></span>
                </div>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>