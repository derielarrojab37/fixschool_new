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

        <?php if(strtolower(session('role')) == 'admin'): ?>

<div class="col-lg-4">
    <div class="card border-0 rounded-4 shadow-sm p-4">
        <h5 class="fw-bold mb-3">Moderasi Laporan</h5>

        
        <?php 
$status = strtolower($pengaduan['status']);
if ($status == 'menunggu' || $status == 'diproses'): 
?>
    <div class="d-grid gap-2">

        <a href="<?= base_url('penugasan/create/' . $pengaduan['id_pengaduan']) ?>" 
           class="btn btn-primary">
           Tugaskan Teknisi
        </a>

        <a href="<?= base_url('pengaduan/tolak/' . $pengaduan['id_pengaduan']) ?>" 
           class="btn btn-danger">
           Tolak Laporan
        </a>

    </div>
<?php else: ?>
    <div class="alert alert-light text-center">
        <b>Status: <?= $pengaduan['status'] ?></b>
    </div>
<?php endif; ?>

    </div>
</div>

<?php endif; ?>

        <hr class="my-4 opacity-5">
        <?php if (strtolower($pengaduan['status']) == 'ditolak'): ?>
    <div class="alert alert-danger mt-3">
        <b>Laporan Ditolak</b><br>
        <?= $pengaduan['alasan_ditolak'] ?>
    </div>
<?php endif; ?>
<hr class="my-4 opacity-5">
        <hr class="my-4 opacity-5">
        <h6 class="fw-bold mb-2">Informasi Tambahan</h6>
        <p class="small text-muted mb-0">Pastikan penolakan laporan didasari alasan yang kuat dan objektif.</p>
    </div>
</div>

<div class="modal fade" id="modalTolak" ... > 
   </div>

    </div>
</div>

<?php 
    $bolehEdit = (
        session('role') == 'pelapor' &&
        $pengaduan['status'] == 'menunggu' &&
        empty($tanggapan)
    );
?>

<?php if($bolehEdit): ?>
    <div class="mt-3">
        <a href="<?= base_url('pengaduan/edit/' . $pengaduan['id_pengaduan']) ?>" 
           class="btn btn-warning">
            <i class="bi bi-pencil-square me-1"></i> Ubah Pengaduan
        </a>
    </div>
<?php endif; ?>


<?= $this->endSection() ?>