<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* Admin One Edit Style */
    .admin-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        overflow: hidden;
    }

    .form-header-edit {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        padding: 1.5rem 2rem;
        color: white;
    }

    .form-label {
        font-weight: 700;
        font-size: 0.85rem;
        color: #374151;
        text-transform: uppercase;
        letter-spacing: 0.025em;
        margin-bottom: 0.6rem;
        display: block;
    }

    .form-control {
        border: 1px solid #e5e7eb;
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        transition: all 0.2s;
    }

    .form-control:focus {
        border-color: #f59e0b;
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
        outline: none;
    }

    .btn-update {
        background: #f59e0b;
        color: white;
        font-weight: 700;
        padding: 0.7rem 2rem;
        border: none;
        border-radius: 0.5rem;
        transition: all 0.2s;
    }

    .btn-update:hover {
        background: #d97706;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(217, 119, 6, 0.2);
    }
</style>

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb small fw-bold">
                    <li class="breadcrumb-item"><a href="<?= base_url('tanggapan') ?>" class="text-decoration-none text-muted">Tanggapan</a></li>
                    <li class="breadcrumb-item active text-warning" aria-current="page">Edit Tanggapan</li>
                </ol>
            </nav>

            <div class="admin-card shadow-sm">
                <div class="form-header-edit">
                    <div class="d-flex align-items-center">
                        <div class="bg-white bg-opacity-20 rounded-circle p-3 me-3">
                            <i class="bi bi-pencil-square fs-4"></i>
                        </div>
                        <div>
                            <h4 class="fw-800 mb-0">Perbarui Tanggapan</h4>
                            <p class="mb-0 opacity-75 small">ID Tanggapan: #TGP-<?= $tanggapan['id_tanggapan'] ?></p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form method="post" action="<?= base_url('tanggapan/update/'.$tanggapan['id_tanggapan']) ?>">
                        <?= csrf_field() ?>

                        <div class="mb-4">
                            <label class="form-label">
                                <i class="bi bi-chat-left-dots me-2"></i> Isi Tanggapan
                            </label>
                            <textarea 
                                name="isi_tanggapan" 
                                class="form-control" 
                                rows="8" 
                                placeholder="Masukkan perubahan tanggapan di sini..."
                                required><?= $tanggapan['isi_tanggapan'] ?></textarea>
                        </div>

                        <div class="d-flex justify-content-between align-items-center border-top pt-4">
                            <a href="<?= base_url('tanggapan') ?>" class="btn btn-link text-muted fw-bold text-decoration-none">
                                <i class="bi bi-arrow-left me-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-update">
                                Simpan Perubahan <i class="bi bi-check2-all ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="mt-4 text-center">
                <p class="small text-muted italic">
                    <i class="bi bi-info-circle me-1"></i> 
                    Perubahan pada tanggapan akan langsung terlihat oleh pelapor pada detail pengaduan.
                </p>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>