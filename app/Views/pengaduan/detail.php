<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>


<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-8">
            <div class="report-detail-card p-4 p-md-5">
                <div class="d-flex justify-content-between align-items-start">
                    <span class="status-banner">
                        <i class="bi bi-info-circle-fill me-1"></i> Detail Laporan
                    </span>
                    <a href="<?= base_url('pengaduan') ?>" class="btn btn-light btn-sm rounded-pill px-3">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>

                <h1 class="report-title"><?= $pengaduan['judul'] ?></h1>

                <div class="report-meta">
                    <span><i class="bi bi-person-circle me-1"></i> Pelapor: <b><?= $pengaduan['nama'] ?></b></span>
                    <span><i class="bi bi-geo-alt-fill me-1"></i> Lokasi: <b><?= $pengaduan['lokasi'] ?></b></span>
                    <span><i class="bi bi-calendar3 me-1"></i> Status: <b class="text-primary text-uppercase"><?= $pengaduan['status'] ?></b></span>
                </div>

                <div class="report-description">
    <?= nl2br($pengaduan['deskripsi']) ?>
</div>

<?php if(session('role') == 'admin' && $pengaduan['status'] == 'menunggu'): ?>
    <div class="mt-4 p-3 rounded-4 border-start border-4 border-warning shadow-sm" style="background: #fffdf5;">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div class="small">
                <b class="text-dark d-block">Laporan Menunggu Tindakan</b>
                <span class="text-muted">Segera tugaskan teknisi untuk memproses laporan ini.</span>
            </div>
            <a href="<?= base_url('penugasan/create/' . $pengaduan['id_pengaduan']) ?>" 
               class="btn btn-warning btn-sm fw-bold px-3 shadow-sm">
                <i class="bi bi-tools me-1"></i> Tugaskan Sekarang
            </a>
        </div>
    </div>
<?php endif; ?>

                <hr class="my-5 opacity-10">

                <div class="timeline-section">
                    <h5 class="timeline-title">
                        <i class="bi bi-chat-left-text-fill me-2 text-primary"></i> 
                        Tanggapan Petugas (<?= count($tanggapan) ?>)
                    </h5>

                    <?php if (!empty($tanggapan)): ?>
                        <?php foreach ($tanggapan as $t): ?>
                            <div class="card comment-card">
                                <div class="card-body p-3">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span class="comment-user"><?= $t['nama'] ?></span>
                                        <small class="text-muted" style="font-size: 0.7rem;">Petugas/Admin</small>
                                    </div>
                                    <p class="comment-text mb-0"><?= $t['isi_tanggapan'] ?></p>
                                </div>
                            </div>
                        <?php endforeach ?>
                    <?php else: ?>
                        <div class="text-center py-4 bg-light rounded-4">
                            <i class="bi bi-chat-dots display-6 text-muted mb-2 d-block"></i>
                            <p class="text-muted mb-0">Belum ada tanggapan untuk laporan ini.</p>
                        </div>
                    <?php endif; ?>

                    <div class="mt-4">
                       <?php if(session('role') == 'admin'): ?>
    <div class="mt-4">
        <a href="<?= base_url('tanggapan/create/' . $pengaduan['id_pengaduan']) ?>" class="btn btn-respond">
            <i class="bi bi-plus-lg me-1"></i> Berikan Tanggapan
        </a>
    </div>
<?php endif; ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
    <div class="card border-0 rounded-4 shadow-sm p-4" style="background: white;">
        <h5 class="fw-bold mb-3" style="color: #2b3674;">Moderasi Laporan</h5>
        
        <?php if ($pengaduan['status'] == 'menunggu'): ?>
            <div class="d-grid gap-2">
                <a href="<?= base_url('penugasan/create/' . $pengaduan['id_pengaduan']) ?>" class="btn btn-primary rounded-3 py-2 fw-bold shadow-sm">
                    <i class="bi bi-tools me-2"></i> Tugaskan Teknisi
                </a>

                <button type="button" class="btn btn-outline-danger rounded-3 py-2 fw-bold" data-bs-toggle="modal" data-bs-target="#modalTolak">
                    <i class="bi bi-x-circle me-2"></i> Tolak Laporan
                </button>
            </div>
        <?php else: ?>
            <div class="alert alert-light border-0 text-center">
                <small class="text-muted text-uppercase fw-bold" style="font-size: 0.7rem;">Status Saat Ini</small>
                <h6 class="fw-bold mt-1 text-primary"><?= strtoupper($pengaduan['status']) ?></h6>
            </div>
        <?php endif; ?>

        <hr class="my-4 opacity-5">
        
        <h6 class="fw-bold mb-2">Informasi Tambahan</h6>
        <p class="small text-muted mb-0">Pastikan penolakan laporan didasari alasan yang kuat dan objektif.</p>
    </div>
</div>

<div class="modal fade" id="modalTolak" ... > 
   </div>

    </div>
</div>

<?= $this->endSection() ?>