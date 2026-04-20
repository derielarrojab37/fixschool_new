<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* Admin One Danger Design */
    .admin-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        overflow: hidden;
    }

    .form-header-danger {
        background: linear-gradient(135deg, #ef4444 0%, #b91c1c 100%);
        padding: 2rem;
        color: white;
    }

    .info-summary {
        background-color: #fff1f2;
        border-left: 4px solid #f43f5e;
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
    }

    .form-control:focus {
        border-color: #ef4444;
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
    }

    .btn-danger-action {
        background: #ef4444;
        color: white;
        font-weight: 700;
        padding: 0.75rem 2rem;
        border: none;
        border-radius: 0.5rem;
        transition: all 0.2s;
    }

    .btn-danger-action:hover {
        background: #dc2626;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(220, 38, 38, 0.2);
    }
</style>

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb small fw-bold">
                    <li class="breadcrumb-item"><a href="<?= base_url('pengaduan') ?>" class="text-decoration-none text-muted">Pengaduan</a></li>
                    <li class="breadcrumb-item text-muted">Detail</li>
                    <li class="breadcrumb-item active text-danger" aria-current="page">Konfirmasi Penolakan</li>
                </ol>
            </nav>

            <div class="admin-card shadow-sm">
                <div class="form-header-danger">
                    <div class="d-flex align-items-center">
                        <div class="bg-white bg-opacity-20 rounded-circle p-3 me-3">
                            <i class="bi bi-exclamation-triangle-fill fs-3"></i>
                        </div>
                        <div>
                            <h3 class="fw-800 mb-0">Tolak Laporan</h3>
                            <p class="mb-0 opacity-75 small">Pastikan alasan penolakan dapat dipahami oleh pelapor</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    <div class="info-summary mb-4">
                        <span class="text-danger fw-bold small text-uppercase d-block mb-1">Laporan yang ditolak:</span>
                        <h5 class="fw-bold text-dark mb-2"><?= $pengaduan['judul'] ?></h5>
                        <p class="text-muted small mb-0 text-truncate"><?= $pengaduan['deskripsi'] ?></p>
                    </div>

                    <form method="post" action="<?= base_url('pengaduan/tolak/'.$pengaduan['id_pengaduan']) ?>">
                        <?= csrf_field() ?>

                        <div class="mb-4">
                            <label class="form-label">
                                <i class="bi bi-chat-dots-fill me-2"></i> Alasan Penolakan
                            </label>
                            <textarea 
                                name="alasan" 
                                class="form-control" 
                                rows="4" 
                                placeholder="Contoh: Laporan tidak jelas, foto tidak relevan, atau sudah dilaporkan sebelumnya..." 
                                required></textarea>
                            <div class="form-text mt-2 small">
                                * Alasan ini akan muncul di halaman detail laporan milik pelapor.
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center border-top pt-4 mt-2">
                            <a href="<?= base_url('pengaduan') ?>" class="btn btn-link text-muted fw-bold text-decoration-none">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-danger-action">
                                Konfirmasi Tolak Laporan <i class="bi bi-send-x-fill ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="alert bg-light border-0 mt-4 p-3 d-flex align-items-start">
                <i class="bi bi-info-circle-fill text-muted me-3 fs-5 mt-1"></i>
                <p class="small text-muted mb-0">
                    Menolak laporan akan mengubah status pengaduan menjadi <b>"Ditolak"</b> secara permanen. Pelapor masih bisa melihat laporan ini tetapi tidak dapat mengeditnya kembali kecuali diizinkan oleh sistem.
                </p>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>