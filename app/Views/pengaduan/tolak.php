<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<link rel="icon" href="<?= base_url('assets/img/FS_No_BG.png') ?>">

<style>
    /* 🔴 Danger Slate Design System */
    .admin-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 1.25rem;
        overflow: hidden;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
    }

    .form-header-danger {
        background: #7f1d1d; /* Dark Red Slate */
        padding: 2.5rem;
        color: white;
        position: relative;
    }

    .form-header-danger::before {
        content: "";
        position: absolute;
        top: 0; right: 0; bottom: 0; left: 0;
        background: linear-gradient(45deg, rgba(239, 68, 68, 0.2) 0%, transparent 100%);
    }

    .info-summary-box {
        background-color: #fff1f2;
        border: 1.5px solid #fecaca;
        padding: 1.5rem;
        border-radius: 1rem;
        position: relative;
    }

    .label-danger-elite {
        font-weight: 800;
        font-size: 0.75rem;
        color: #991b1b;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .input-danger-focus:focus {
        border-color: #ef4444;
        box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
    }

    .btn-danger-confirm {
        background: #ef4444;
        color: white;
        font-weight: 700;
        padding: 1rem 2rem;
        border: none;
        border-radius: 0.75rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 6px -1px rgba(239, 68, 68, 0.2);
    }

    .btn-danger-confirm:hover {
        background: #b91c1c;
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(239, 68, 68, 0.3);
        color: white;
    }

    .breadcrumb-danger .breadcrumb-item + .breadcrumb-item::before {
        content: "›";
        color: #f87171;
    }
</style>

<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-8">
            
            <nav aria-label="breadcrumb" class="mb-4 ms-2">
                <ol class="breadcrumb breadcrumb-danger small fw-bold">
                    <li class="breadcrumb-item"><a href="<?= base_url('pengaduan') ?>" class="text-decoration-none text-muted">PENGADUAN</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('pengaduan/detail/'.$pengaduan['id_pengaduan']) ?>" class="text-decoration-none text-muted">DETAIL</a></li>
                    <li class="breadcrumb-item active text-danger" aria-current="page">KONFIRMASI PENOLAKAN</li>
                </ol>
            </nav>

            <div class="admin-card border-0">
                <div class="form-header-danger">
                    <div class="d-flex align-items-center position-relative" style="z-index: 1;">
                        <div class="bg-white bg-opacity-10 rounded-circle p-3 me-4 border border-white border-opacity-20">
                            <i class="bi bi-shield-fill-x fs-3 text-white"></i>
                        </div>
                        <div>
                            <h3 class="fw-800 text-white mb-1" style="letter-spacing: -0.02em;">Tolak Laporan</h3>
                            <p class="mb-0 text-white opacity-50 small fw-medium">Tindakan ini akan menghentikan proses perbaikan laporan ini.</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    <div class="info-summary-box mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <span class="badge bg-danger text-white px-3 py-2 rounded-pill fw-800" style="font-size: 0.7rem; letter-spacing: 0.05em;">
            <i class="bi bi-file-earmark-text-fill me-1"></i> RINGKASAN LAPORAN
        </span>
        <span class="text-danger fw-bold font-monospace small bg-white px-2 py-1 rounded border border-danger border-opacity-25">
            #PGN-<?= str_pad($pengaduan['id_pengaduan'], 4, '0', STR_PAD_LEFT) ?>
        </span>
    </div>
    
    <div class="ps-2 border-start border-danger border-3">
        <h5 class="fw-800 text-dark mb-2"><?= $pengaduan['judul'] ?></h5>
        <p class="text-muted small mb-0 lh-base">
            <?= (strlen($pengaduan['deskripsi']) > 150) ? substr($pengaduan['deskripsi'], 0, 150) . '...' : $pengaduan['deskripsi'] ?>
        </p>
    </div>
</div>

                    <form method="post" action="<?= base_url('pengaduan/tolak/'.$pengaduan['id_pengaduan']) ?>">
                        <?= csrf_field() ?>

                        <div class="mb-5">
                            <label class="label-danger-elite">
                                <i class="bi bi-chat-left-dots-fill"></i> Alasan Penolakan Resmi
                            </label>
                            <textarea 
                                name="alasan" 
                                class="form-control input-danger-focus rounded-4 border-2 p-3" 
                                rows="5" 
                                placeholder="Jelaskan secara objektif mengapa laporan ini tidak dapat diproses (misal: data tidak valid, duplikasi laporan, dsb)..." 
                                required></textarea>
                            <div class="d-flex align-items-center mt-3 p-3 bg-light rounded-3 text-muted">
                                <i class="bi bi-info-circle me-2 fs-5 text-danger"></i>
                                <span class="small fw-medium">Alasan ini akan dikirimkan dan dapat dibaca oleh pelapor secara permanen.</span>
                            </div>
                        </div>

                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 pt-4 border-top">
                            <a href="<?= base_url('pengaduan/detail/'.$pengaduan['id_pengaduan']) ?>" class="btn btn-link text-muted fw-bold text-decoration-none order-2 order-md-1">
                                <i class="bi bi-x-lg me-1"></i> BATALKAN
                            </a>
                            <button type="submit" class="btn btn-danger-confirm w-100 w-md-auto order-1 order-md-2 shadow-sm">
                                KONFIRMASI PENOLAKAN <i class="bi bi-slash-circle ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="mt-4 p-4 rounded-4 bg-white border border-secondary border-opacity-10 d-flex align-items-start gap-3 shadow-sm">
                <div class="p-2 bg-secondary bg-opacity-10 rounded-3">
                    <i class="bi bi-database-fill-exclamation text-secondary fs-4"></i>
                </div>
                <div>
                    <span class="d-block fw-800 small text-dark text-uppercase mb-1">Catatan Audit</span>
                    <p class="small text-slate-500 mb-0 lh-base">
                        Status laporan akan berubah menjadi <b>Ditolak</b> dan tidak dapat diubah kembali ke status Menunggu/Diproses demi integritas data sistem.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>