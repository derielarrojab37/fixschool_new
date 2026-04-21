<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* ✨ Elite Amber Edit System */
    .edit-wrapper {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 1.5rem;
        overflow: hidden;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
    }

    .form-header-edit {
        background: #1e293b; /* Slate Dark */
        padding: 2.5rem;
        position: relative;
        overflow: hidden;
    }

    /* Efek aksen warna Amber di header */
    .form-header-edit::after {
        content: "";
        position: absolute;
        top: -20px;
        right: -20px;
        width: 120px;
        height: 120px;
        background: rgba(245, 158, 11, 0.15);
        border-radius: 50%;
    }

    .label-elite {
        font-weight: 800;
        font-size: 0.75rem;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .input-elite {
        border: 1.5px solid #e2e8f0;
        padding: 1rem 1.25rem;
        border-radius: 1rem;
        font-weight: 500;
        transition: all 0.2s;
        background-color: #f8fafc;
    }

    .input-elite:focus {
        border-color: #f59e0b;
        background-color: #fff;
        box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1);
        outline: none;
    }

    .btn-update {
        background: #f59e0b;
        color: white;
        font-weight: 700;
        padding: 1rem 2.5rem;
        border-radius: 1rem;
        border: none;
        transition: all 0.3s ease;
        box-shadow: 0 10px 15px -3px rgba(245, 158, 11, 0.3);
    }

    .btn-update:hover {
        background: #d97706;
        transform: translateY(-2px);
        box-shadow: 0 20px 25px -5px rgba(217, 119, 6, 0.4);
        color: white;
    }

    .breadcrumb-elite .breadcrumb-item + .breadcrumb-item::before {
        content: "→";
        color: #cbd5e1;
    }

    .id-badge {
        background: rgba(245, 158, 11, 0.2);
        color: #d97706;
        padding: 4px 12px;
        border-radius: 6px;
        font-family: 'Monaco', 'Consolas', monospace;
        font-size: 0.8rem;
        font-weight: 700;
    }
</style>

<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-8">
            
            <nav aria-label="breadcrumb" class="mb-4 ms-2">
                <ol class="breadcrumb breadcrumb-elite small">
                    <li class="breadcrumb-item"><a href="<?= base_url('tanggapan') ?>" class="text-decoration-none text-muted fw-bold">TANGGAPAN</a></li>
                    <li class="breadcrumb-item active text-warning fw-800" aria-current="page">EDIT DATA</li>
                </ol>
            </nav>

            <div class="edit-wrapper border-0">
                <div class="form-header-edit">
                    <div class="d-flex align-items-center position-relative" style="z-index: 1;">
                        <div class="bg-warning bg-opacity-25 rounded-4 p-3 me-4 border border-warning border-opacity-10">
                            <i class="bi bi-pencil-fill text-warning fs-3"></i>
                        </div>
                        <div>
                            <h3 class="fw-800 text-white mb-1" style="letter-spacing: -0.02em;">Perbarui Tanggapan</h3>
                            <div class="d-flex align-items-center gap-2">
                                <span class="text-white opacity-50 small fw-medium">Dokumen Referensi:</span>
                                <span class="id-badge">#TGP-<?= $tanggapan['id_tanggapan'] ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form method="post" action="<?= base_url('tanggapan/update/'.$tanggapan['id_tanggapan']) ?>">
                        <?= csrf_field() ?>

                        <div class="mb-5">
                            <label class="label-elite">
                                <i class="bi bi-chat-square-text-fill text-warning"></i> Koreksi Isi Tanggapan
                            </label>
                            <textarea 
                                name="isi_tanggapan" 
                                class="form-control input-elite" 
                                rows="10" 
                                placeholder="Tuliskan revisi tanggapan secara profesional..."
                                required><?= $tanggapan['isi_tanggapan'] ?></textarea>
                            <div class="form-text mt-3 d-flex align-items-center gap-2 text-muted small">
                                <i class="bi bi-info-circle-fill text-primary"></i>
                                Tips: Gunakan bahasa yang santun dan solutif bagi pelapor.
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pt-4 border-top">
                            <a href="<?= base_url('tanggapan') ?>" class="btn btn-link text-muted fw-bold text-decoration-none small">
                                <i class="bi bi-arrow-left me-2"></i> KEMBALI
                            </a>
                            <button type="submit" class="btn btn-update">
                                SIMPAN PERUBAHAN <i class="bi bi-cloud-arrow-up-fill ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="mt-5 text-center">
                <div class="d-inline-flex align-items-center gap-2 px-4 py-2 bg-light rounded-pill border">
                    <span class="position-relative d-flex h-2 w-2">
                      <span class="animate-ping position-absolute inline-flex h-full w-full rounded-full bg-warning opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2 w-2 bg-warning"></span>
                    </span>
                    <span class="small text-muted fw-medium">Sistem sinkronisasi otomatis aktif</span>
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>