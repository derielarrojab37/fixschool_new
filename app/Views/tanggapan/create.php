<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* Admin One Response Design */
    .admin-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        overflow: hidden;
    }

    .form-header-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        padding: 2rem;
        color: white;
    }

    .info-box-light {
        background-color: #f0fdf4;
        border: 1px solid #dcfce7;
        padding: 1.25rem;
        border-radius: 0.5rem;
    }

    .form-label {
        font-weight: 700;
        font-size: 0.85rem;
        color: #374151;
        text-transform: uppercase;
        letter-spacing: 0.025em;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
    }

    .form-control {
        border: 1px solid #e5e7eb;
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
    }

    .form-control:focus {
        border-color: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }

    .btn-send {
        background: #10b981;
        color: white;
        font-weight: 700;
        padding: 0.75rem 2.5rem;
        border: none;
        border-radius: 0.5rem;
        transition: all 0.2s;
    }

    .btn-send:hover {
        background: #059669;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.2);
    }
</style>

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb small fw-bold">
                    <li class="breadcrumb-item"><a href="<?= base_url('pengaduan') ?>" class="text-decoration-none text-muted">Pengaduan</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('pengaduan/show/'.$pengaduan['id_pengaduan']) ?>" class="text-decoration-none text-muted">Detail</a></li>
                    <li class="breadcrumb-item active text-success" aria-current="page">Beri Tanggapan</li>
                </ol>
            </nav>

            <div class="admin-card shadow-sm">
                <div class="form-header-success">
                    <div class="d-flex align-items-center">
                        <div class="bg-white bg-opacity-20 rounded-circle p-3 me-3">
                            <i class="bi bi-chat-left-check-fill fs-3"></i>
                        </div>
                        <div>
                            <h3 class="fw-800 mb-0">Tambah Tanggapan</h3>
                            <p class="mb-0 opacity-75 small">Berikan informasi update atau penyelesaian laporan</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form method="post" action="<?= base_url('tanggapan/store') ?>" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id_pengaduan" value="<?= $pengaduan['id_pengaduan'] ?>">

                        <div class="info-box-light mb-4">
                            <label class="form-label text-success"><i class="bi bi-info-circle me-2"></i> Merespons Laporan:</label>
                            <h5 class="fw-bold text-dark mb-0"><?= $pengaduan['judul'] ?></h5>
                            <p class="text-muted small mb-0 mt-1"><i class="bi bi-geo-alt"></i> <?= $pengaduan['lokasi'] ?></p>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <label class="form-label">
                                    <i class="bi bi-card-text me-2"></i> Isi Tanggapan / Progress
                                </label>
                                <textarea 
                                    name="isi_tanggapan" 
                                    class="form-control" 
                                    rows="6" 
                                    placeholder="Tuliskan tindakan yang telah dilakukan atau pesan untuk pelapor..." 
                                    required></textarea>
                            </div>

                            <div class="col-md-12 mb-5">
                                <label class="form-label">
                                    <i class="bi bi-camera me-2"></i> Foto Bukti Perbaikan <span class="text-muted ms-1 fw-normal">(Opsional)</span>
                                </label>
                                <input type="file" name="foto" class="form-control">
                                <div class="form-text small mt-2">Format: JPG, PNG, WEBP (Max. 2MB). Unggah foto hasil perbaikan jika ada.</div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center border-top pt-4">
                            <a href="<?= base_url('pengaduan/detail/'.$pengaduan['id_pengaduan']) ?>" class="btn btn-link text-muted fw-bold text-decoration-none">
                                <i class="bi bi-arrow-left me-1"></i> Kembali ke Detail
                            </a>
                            <button type="submit" class="btn btn-send">
                                Kirim Tanggapan <i class="bi bi-send-fill ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="mt-4 p-3 rounded-4 bg-light d-flex align-items-center border">
                <i class="bi bi-shield-check text-success fs-4 me-3"></i>
                <small class="text-muted">Tanggapan Anda akan langsung dapat dilihat oleh pelapor. Pastikan informasi yang diberikan sudah akurat.</small>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>