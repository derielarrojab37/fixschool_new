<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* 💎 Detail Case Styling */
    .detail-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 1.25rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    .status-banner {
        padding: 0.5rem 1rem;
        border-radius: 0.75rem;
        font-weight: 800;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    /* Status Variations */
    .sb-waiting { background: #fffbeb; color: #92400e; border: 1px solid #fde68a; }
    .sb-process { background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; }
    .sb-success { background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; }
    .sb-danger  { background: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; }

    /* ⏱️ Timeline Modern */
    .timeline-container {
        position: relative;
        padding-left: 2rem;
    }

    .timeline-container::before {
        content: '';
        position: absolute;
        left: 7px;
        top: 5px;
        bottom: 5px;
        width: 2px;
        background: #e2e8f0;
    }

    .timeline-item {
        position: relative;
        margin-bottom: 2rem;
    }

    .timeline-dot {
        position: absolute;
        left: -2rem;
        width: 16px;
        height: 16px;
        background: #fff;
        border: 3px solid #2563eb;
        border-radius: 50%;
        z-index: 2;
    }

    .comment-bubble {
        background: #f8fafc;
        border-radius: 1rem;
        padding: 1.25rem;
        border: 1px solid #f1f5f9;
    }

    /* 🖼️ Image Wrapper */
    .img-evidence {
        border-radius: 1rem;
        object-fit: cover;
        cursor: zoom-in;
        transition: transform 0.2s;
    }
    .img-evidence:hover { transform: scale(1.02); }

    .meta-label {
        font-size: 0.7rem;
        font-weight: 700;
        color: #94a3b8;
        text-transform: uppercase;
        margin-bottom: 0.25rem;
        display: block;
    }
</style>

<div class="container-fluid py-4">
    <div class="row g-4">
        
        <div class="col-lg-8">
            <div class="detail-card">
                <div class="card-body p-4 p-md-5">
                    
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <a href="<?= base_url('pengaduan') ?>" class="btn btn-light btn-sm rounded-pill px-3 fw-bold text-muted">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                        <div>
                            <?php 
                                $statusRaw = strtolower($pengaduan['status']);
                                $sbClass = 'sb-waiting'; $icon = 'bi-clock-history';
                                if (in_array($statusRaw, ['proses', 'diproses'])) { $sbClass = 'sb-process'; $icon = 'bi-gear-wide-connected'; }
                                elseif ($statusRaw == 'selesai') { $sbClass = 'sb-success'; $icon = 'bi-check-circle'; }
                                elseif ($statusRaw == 'ditolak') { $sbClass = 'sb-danger'; $icon = 'bi-x-octagon'; }
                            ?>
                            <div class="status-banner <?= $sbClass ?>">
                                <i class="bi <?= $icon ?>"></i> <?= $pengaduan['status'] ?>
                            </div>
                        </div>
                    </div>

                    <h1 class="fw-800 text-dark mb-4" style="letter-spacing: -0.03em; line-height: 1.2;"><?= $pengaduan['judul'] ?></h1>
                    
                    <div class="row g-4 mb-5">
                        <div class="col-6 col-md-4">
                            <span class="meta-label">ID Laporan</span>
                            <span class="fw-bold font-monospace text-primary">#PGN-<?= str_pad($pengaduan['id_pengaduan'], 4, '0', STR_PAD_LEFT) ?></span>
                        </div>
                        <div class="col-6 col-md-4">
                            <span class="meta-label">Pelapor Utama</span>
                            <div class="d-flex align-items-center gap-2">
                                <div class="bg-blue-soft rounded-circle px-2 small"><i class="bi bi-person-fill"></i></div>
                                <span class="fw-bold"><?= $pengaduan['nama'] ?></span>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <span class="meta-label">Lokasi Kerusakan</span>
                            <span class="fw-bold text-danger"><i class="bi bi-geo-alt-fill me-1"></i> <?= $pengaduan['lokasi'] ?></span>
                        </div>
                    </div>

                    <div class="content-body text-dark mb-5" style="font-size: 1.05rem; line-height: 1.8; color: #334155;">
                        <span class="meta-label mb-2">Deskripsi Laporan</span>
                        <div class="p-4 bg-light rounded-4 border-start border-primary border-4">
                            <?= nl2br($pengaduan['deskripsi']) ?>
                        </div>
                    </div>

                    <?php if ($statusRaw == 'ditolak'): ?>
                        <div class="alert sb-danger border-0 rounded-4 p-4 d-flex align-items-start gap-3 shadow-sm">
                            <i class="bi bi-exclamation-triangle-fill fs-3"></i>
                            <div>
                                <h6 class="fw-800 mb-1">Laporan Ditolak</h6>
                                <p class="mb-0 opacity-75 small"><?= $pengaduan['alasan_ditolak'] ?></p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <hr class="my-5 opacity-50">

                    <div class="tanggapan-section">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h4 class="fw-800 text-dark mb-0">Riwayat Perbaikan</h4>
                            <?php if(session('role') == 'admin'): ?>
                                <a href="<?= base_url('tanggapan/create/' . $pengaduan['id_pengaduan']) ?>" class="btn btn-primary btn-sm rounded-3 fw-bold px-3">
                                    <i class="bi bi-plus-circle me-2"></i> Tambah Update
                                </a>
                            <?php endif; ?>
                        </div>

                        <?php if (!empty($tanggapan)): ?>
                            <div class="timeline-container">
                                <?php foreach ($tanggapan as $t): ?>
                                    <div class="timeline-item">
                                        <div class="timeline-dot shadow-sm"></div>
                                        <div class="comment-bubble shadow-sm">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <div class="d-flex align-items-center gap-2">
                                                    <span class="fw-bold text-dark"><?= $t['nama'] ?></span>
                                                    <span class="badge bg-soft-primary text-primary px-2" style="font-size: 0.6rem;">OFFICIAL</span>
                                                </div>
                                                <small class="text-muted small">Update Terbaru</small>
                                            </div>
                                            <p class="mb-0 text-slate-600 small" style="line-height: 1.6;"><?= $t['isi_tanggapan'] ?></p>
                                            
                                            <?php if (!empty($t['foto'])): ?>
                                                <div class="mt-3">
                                                    <img src="<?= base_url('uploads/tanggapan/' . $t['foto']) ?>" class="img-evidence w-100 shadow-sm border" style="max-height: 350px;">
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-5 rounded-4 border border-dashed bg-light">
                                <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="50" class="opacity-25 mb-3">
                                <p class="text-muted small mb-0">Belum ada progres perbaikan atau tanggapan teknisi.</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if(session('role') == 'pelapor' && $statusRaw == 'menunggu' && empty($tanggapan)): ?>
                        <div class="mt-5 pt-4 border-top">
                            <a href="<?= base_url('pengaduan/edit/' . $pengaduan['id_pengaduan']) ?>" class="btn btn-warning btn-lg w-100 rounded-3 fw-800 shadow-sm text-dark">
                                <i class="bi bi-pencil-square me-2"></i> Edit Detail Laporan
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <?php if(session('role') == 'admin'): ?>
                <div class="detail-card mb-4 border-0 shadow-sm" style="background: #1e293b;">
                    <div class="card-body p-4">
                        <h5 class="text-white fw-800 mb-4"><i class="bi bi-shield-lock me-2 text-primary"></i>Moderasi</h5>
                        <?php if (in_array($statusRaw, ['menunggu', 'diproses'])): ?>
                            <div class="d-grid gap-3">
                                <a href="<?= base_url('penugasan/create/' . $pengaduan['id_pengaduan']) ?>" class="btn btn-primary fw-bold py-3 rounded-3">
                                    <i class="bi bi-person-plus-fill me-2"></i> Tugaskan Teknisi
                                </a>
                                <a href="<?= base_url('pengaduan/tolak/' . $pengaduan['id_pengaduan']) ?>" class="btn btn-outline-light border-secondary fw-bold py-3 rounded-3">
                                    <i class="bi bi-x-circle me-2"></i> Tolak Laporan
                                </a>
                            </div>
                        <?php else: ?>
                            <div class="p-3 bg-white bg-opacity-10 rounded-3 text-center">
                                <p class="small text-light opacity-50 mb-1">Status Laporan Dikunci:</p>
                                <span class="fw-bold text-white text-uppercase"><?= $pengaduan['status'] ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="detail-card p-4">
                <h6 class="fw-800 text-dark mb-4 pb-2 border-bottom">Informasi Metadata</h6>
                <div class="vstack gap-4">
                    <div>
                        <span class="meta-label">Tanggal Pengiriman</span>
                        <span class="fw-bold text-dark"><i class="bi bi-calendar3 me-2 text-muted"></i>12 April 2026</span>
                    </div>
                    <div>
                        <span class="meta-label">Waktu Presisi</span>
                        <span class="fw-bold text-dark"><i class="bi bi-clock me-2 text-muted"></i>08:30:45 WIB</span>
                    </div>
                    <div>
                        <span class="meta-label">Klasifikasi</span>
                        <span class="badge bg-soft-info text-info py-2 px-3 rounded-pill fw-bold">
                            <i class="bi bi-tags-fill me-1"></i> Sarana Prasarana
                        </span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 rounded-4 bg-blue-soft border border-blue-200">
                <div class="d-flex gap-3">
                    <i class="bi bi-info-circle-fill text-primary fs-4"></i>
                    <p class="small text-slate-600 mb-0">
                        Pastikan data laporan telah divalidasi sebelum dilakukan penugasan ke tim teknis di lapangan.
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>