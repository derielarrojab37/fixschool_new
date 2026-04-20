<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* Admin One Detail Design */
    .detail-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        overflow: hidden;
    }

    .detail-header {
        background: #f9fafb;
        border-bottom: 1px solid #e5e7eb;
        padding: 1.5rem 2rem;
    }

    .info-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        font-weight: 700;
        color: #6b7280;
        letter-spacing: 0.05em;
        margin-bottom: 0.25rem;
    }

    .info-value {
        color: #111827;
        font-weight: 600;
        font-size: 1rem;
    }

    .status-pill {
        padding: 0.5rem 1rem;
        border-radius: 50rem;
        font-weight: 800;
        font-size: 0.75rem;
        text-transform: uppercase;
        display: inline-block;
    }

    /* Status Colors */
    .pill-ditugaskan { background: #e0e7ff; color: #4338ca; border: 1px solid #c7d2fe; }
    .pill-dikerjakan { background: #fef3c7; color: #92400e; border: 1px solid #fde68a; }
    .pill-selesai { background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }

    .evidence-img {
        border: 4px solid #f3f4f6;
        transition: transform 0.3s ease;
        cursor: zoom-in;
    }
    
    .evidence-img:hover {
        transform: scale(1.02);
    }
</style>

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="fw-800 text-dark mb-0">Detail Penugasan Kerja</h4>
                    <p class="text-muted small">Informasi lengkap mengenai delegasi dan hasil pengerjaan.</p>
                </div>
                <a href="<?= base_url('penugasan') ?>" class="btn btn-outline-secondary btn-sm fw-bold">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <div class="detail-card shadow-sm">
                <div class="detail-header">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <span class="info-label text-primary">Subjek Laporan</span>
                            <h3 class="fw-800 text-dark mb-0"><?= $penugasan['judul'] ?></h3>
                        </div>
                        <div class="col-md-4 text-md-end mt-3 mt-md-0">
                            <?php $statusClass = 'pill-' . strtolower($penugasan['status']); ?>
                            <div class="status-pill <?= $statusClass ?>">
                                <i class="bi bi-info-circle-fill me-1"></i> Status: <?= ucfirst($penugasan['status']) ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <div class="info-label"><i class="bi bi-person-badge me-1"></i> Teknisi Penanggung Jawab</div>
                                <div class="info-value d-flex align-items-center">
                                    <div class="bg-light rounded-circle p-2 me-2" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-person-fill text-secondary"></i>
                                    </div>
                                    <?= $penugasan['nama'] ?>
                                </div>
                            </div>
                            
                            <div>
                                <div class="info-label"><i class="bi bi-calendar-check me-1"></i> Tanggal Penugasan</div>
                                <div class="info-value"><?= date('d F Y', strtotime($penugasan['tanggal'])) ?></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-label"><i class="bi bi-image me-1"></i> Dokumentasi / Bukti Kerja</div>
                            
                            <?php if(!empty($penugasan['foto_bukti'])): ?>
                                <div class="mt-2">
                                    <a href="<?= base_url('uploads/bukti/' . $penugasan['foto_bukti']) ?>" target="_blank">
                                        <img src="<?= base_url('uploads/bukti/' . $penugasan['foto_bukti']) ?>" 
                                             class="img-fluid rounded-3 evidence-img" 
                                             alt="Bukti Kerja">
                                    </a>
                                    <p class="small text-muted mt-2 mb-0 italic">
                                        <i class="bi bi-zoom-in me-1"></i> Klik gambar untuk memperbesar
                                    </p>
                                </div>
                            <?php else: ?>
                                <div class="mt-2 p-4 bg-light rounded-3 text-center border border-dashed">
                                    <i class="bi bi-camera-video-off text-muted fs-2 d-block mb-2"></i>
                                    <span class="text-muted small fw-bold">Belum ada foto bukti yang diunggah</span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="mt-5 pt-4 border-top">
                        <div class="d-flex gap-2">
                            <a href="<?= base_url('penugasan/edit/' . $penugasan['id_penugasan']) ?>" class="btn btn-warning fw-bold px-4 text-white">
                                <i class="bi bi-pencil-square me-2"></i> Perbarui Status / Foto
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="alert bg-primary bg-opacity-10 border-0 mt-4">
                <div class="d-flex">
                    <i class="bi bi-shield-lock-fill text-primary me-3 fs-4"></i>
                    <p class="small text-dark mb-0">
                        Data ini bersifat rahasia dan hanya dapat diakses oleh Admin serta Teknisi yang bersangkutan. 
                        Segala perubahan status akan dicatat dalam log sistem.
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>