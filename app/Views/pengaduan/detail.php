<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* Admin One Design System */
    .admin-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
    }

    .badge-soft {
        font-size: 0.75rem;
        font-weight: 700;
        padding: 0.4rem 0.8rem;
        border-radius: 0.375rem;
        text-transform: uppercase;
    }

    /* Status Colors */
    .bg-pending-soft { background-color: #fef3c7; color: #92400e; }
    .bg-proses-soft { background-color: #e0e7ff; color: #3730a3; }
    .bg-selesai-soft { background-color: #d1fae5; color: #065f46; }
    .bg-red-soft { background-color: #fee2e2; color: #dc2626; }

    /* Timeline/Tanggapan Style */
    .tanggapan-item {
        border-left: 3px solid #e5e7eb;
        padding-left: 1.5rem;
        position: relative;
    }
    .tanggapan-item::before {
        content: "";
        position: absolute;
        left: -9px;
        top: 0;
        width: 15px;
        height: 15px;
        border-radius: 50%;
        background: #fff;
        border: 3px solid #2563eb;
    }
</style>

<div class="container-fluid py-4">
    <div class="row g-4">
        
        <div class="col-lg-8">
            <div class="admin-card mb-4">
                <div class="card-body p-4 p-md-5">
                    
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <a href="<?= base_url('pengaduan') ?>" class="text-muted text-decoration-none small fw-bold">
                            <i class="bi bi-chevron-left"></i> Kembali ke Daftar
                        </a>
                        <div>
                            <?php 
                                $statusRaw = strtolower($pengaduan['status']);
                                $statusClass = 'bg-pending-soft';
                                if (in_array($statusRaw, ['proses', 'diproses'])) $statusClass = 'bg-proses-soft';
                                elseif ($statusRaw == 'selesai') $statusClass = 'bg-selesai-soft';
                                elseif ($statusRaw == 'ditolak') $statusClass = 'bg-red-soft';
                            ?>
                            <span class="badge-soft <?= $statusClass ?>">
                                <?= $pengaduan['status'] ?>
                            </span>
                        </div>
                    </div>

                    <h1 class="fw-800 text-dark mb-3"><?= $pengaduan['judul'] ?></h1>
                    
                    <div class="row g-3 mb-4 py-3 border-top border-bottom border-light">
                        <div class="col-6 col-md-4">
                            <label class="text-muted small d-block">Pelapor</label>
                            <span class="fw-bold"><i class="bi bi-person me-1"></i> <?= $pengaduan['nama'] ?></span>
                        </div>
                        <div class="col-6 col-md-4">
                            <label class="text-muted small d-block">Lokasi</label>
                            <span class="fw-bold"><i class="bi bi-geo-alt me-1"></i> <?= $pengaduan['lokasi'] ?></span>
                        </div>
                        <div class="col-6 col-md-4">
                            <label class="text-muted small d-block">ID Laporan</label>
                            <span class="font-monospace text-primary fw-bold">#PGN-<?= str_pad($pengaduan['id_pengaduan'], 4, '0', STR_PAD_LEFT) ?></span>
                        </div>
                    </div>

                    <div class="content-body text-dark mb-5" style="font-size: 1.1rem; line-height: 1.8;">
                        <?= nl2br($pengaduan['deskripsi']) ?>
                    </div>

                    <?php if ($statusRaw == 'ditolak'): ?>
                        <div class="alert bg-red-soft border-0 rounded-3 d-flex align-items-start gap-3">
                            <i class="bi bi-exclamation-octagon-fill fs-4"></i>
                            <div>
                                <b class="d-block">Alasan Penolakan:</b>
                                <?= $pengaduan['alasan_ditolak'] ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <hr class="my-5">

                    <div class="tanggapan-section">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="fw-bold text-dark mb-0">
                                Tanggapan <span class="badge bg-light text-dark ms-2"><?= count($tanggapan) ?></span>
                            </h4>
                            <?php if(session('role') == 'admin'): ?>
                                <a href="<?= base_url('tanggapan/create/' . $pengaduan['id_pengaduan']) ?>" class="btn btn-primary btn-sm fw-bold">
                                    <i class="bi bi-chat-left-dots me-1"></i> Beri Tanggapan
                                </a>
                            <?php endif; ?>
                        </div>

                        <?php if (!empty($tanggapan)): ?>
                            <div class="ms-2">
                                <?php foreach ($tanggapan as $t): ?>
                                    <div class="tanggapan-item mb-4">
                                        <div class="admin-card bg-light border-0 shadow-none">
                                            <div class="card-body p-3">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <span class="fw-bold text-primary small"><?= $t['nama'] ?> <span class="text-muted fw-normal ms-1">• Petugas</span></span>
                                                </div>
                                                <p class="mb-0 text-dark small"><?= $t['isi_tanggapan'] ?></p>
                                                
                                                <?php if (!empty($t['foto'])): ?>
                                                    <div class="mt-3">
                                                        <img src="<?= base_url('uploads/tanggapan/' . $t['foto']) ?>" class="img-fluid rounded border shadow-sm" style="max-height: 250px;">
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-5 border rounded-3 border-dashed">
                                <i class="bi bi-chat-square-dots text-muted display-6"></i>
                                <p class="text-muted mt-2">Belum ada tanggapan untuk laporan ini.</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if(session('role') == 'pelapor' && $statusRaw == 'menunggu' && empty($tanggapan)): ?>
                        <div class="mt-5 pt-4 border-top">
                            <a href="<?= base_url('pengaduan/edit/' . $pengaduan['id_pengaduan']) ?>" class="btn btn-warning fw-bold px-4">
                                <i class="bi bi-pencil-square me-2"></i> Edit Laporan Ini
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <?php if(session('role') == 'admin'): ?>
                <div class="admin-card mb-4">
                    <div class="card-header bg-white py-3 border-bottom-0">
                        <h5 class="fw-bold mb-0">Moderasi Petugas</h5>
                    </div>
                    <div class="card-body pt-0">
                        <?php if (in_array($statusRaw, ['menunggu', 'diproses'])): ?>
                            <div class="d-grid gap-2">
                                <a href="<?= base_url('penugasan/create/' . $pengaduan['id_pengaduan']) ?>" class="btn btn-primary fw-bold py-2">
                                    <i class="bi bi-person-plus me-2"></i> Tugaskan Teknisi
                                </a>
                                <a href="<?= base_url('pengaduan/tolak/' . $pengaduan['id_pengaduan']) ?>" class="btn btn-outline-danger fw-bold py-2">
                                    <i class="bi bi-x-circle me-2"></i> Tolak Laporan
                                </a>
                            </div>
                        <?php else: ?>
                            <div class="p-3 bg-light rounded text-center">
                                <p class="small text-muted mb-1">Status laporan saat ini:</p>
                                <span class="fw-bold text-uppercase"><?= $pengaduan['status'] ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="admin-card p-4">
                <h6 class="fw-bold mb-3">Informasi Tambahan</h6>
                <div class="d-flex flex-column gap-3">
                    <div class="small">
                        <span class="text-muted d-block">Dibuat pada:</span>
                        <span class="fw-semibold">12 April 2024, 08:30 WIB</span> </div>
                    <div class="small">
                        <span class="text-muted d-block">Kategori:</span>
                        <span class="badge bg-info text-dark">Sarana Prasarana</span> </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>