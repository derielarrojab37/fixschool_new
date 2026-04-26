<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<link rel="icon" href="<?= base_url('assets/img/FS_No_BG.png') ?>">

<style>
    /* 🎨 Elite Update Assignment Style */
    .admin-card {
        background: #ffffff;
        border: none;
        border-radius: 1.5rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.04);
        overflow: hidden;
    }

    .form-header-update {
        background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
        padding: 2.5rem;
        color: white;
    }

    .form-label {
        font-weight: 700;
        font-size: 0.8rem;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
    }

    /* Elegant Form Controls */
    .form-control, .form-select {
        border: 1.5px solid #e2e8f0;
        padding: 0.8rem 1rem;
        border-radius: 12px;
        transition: all 0.2s;
        font-weight: 500;
    }

    .form-control:focus, .form-select:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        background: #fff;
    }

    /* Readonly Styling */
    .form-control[readonly] {
        background-color: #f8fafc;
        border-color: #f1f5f9;
        color: #64748b;
        font-weight: 600;
        cursor: not-allowed;
    }

    /* Success Theme Button */
    .btn-update-task {
        background: #10b981;
        color: white;
        font-weight: 800;
        padding: 0.8rem 2rem;
        border: none;
        border-radius: 12px;
        letter-spacing: 0.5px;
        transition: all 0.3s;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
    }

    .btn-update-task:hover {
        background: #059669;
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(16, 185, 129, 0.3);
        color: white;
    }

    .breadcrumb-custom .breadcrumb-item + .breadcrumb-item::before {
        content: "›";
        font-size: 1.2rem;
        color: #cbd5e1;
    }

    .info-box {
        background: #f0fdf4;
        border: 1px solid #dcfce7;
        border-radius: 12px;
        padding: 1rem;
    }
</style>

<div class="container-fluid py-4 px-lg-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb breadcrumb-custom bg-transparent p-0">
                    <li class="breadcrumb-item">
                        <a href="<?= base_url('penugasan') ?>" class="text-decoration-none text-muted fw-medium">
                            <i class="bi bi-briefcase me-1"></i> Penugasan
                        </a>
                    </li>
                    <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Update Progress</li>
                </ol>
            </nav>

            <div class="admin-card">
                <div class="form-header-update">
                    <div class="d-flex align-items-center">
                        <div class="bg-white bg-opacity-20 rounded-4 p-3 me-4 border border-white border-opacity-10">
                            <i class="bi bi-arrow-repeat fs-3"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-1">Update Penugasan</h4>
                            <p class="mb-0 opacity-75">Update status dan unggah bukti pengerjaan laporan</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form method="post" action="<?= base_url('penugasan/update/'.$penugasan['id_penugasan']) ?>" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <div class="row g-4">
                            <?php if(session('role') == 'teknisi'): ?>
                            <div class="col-12">
                                <label class="form-label text-primary">
                                    <i class="bi bi-reception-4 me-2"></i> Status Progress Kerja
                                </label>
                                <select name="status" class="form-select shadow-sm">
                                    <option value="ditugaskan" <?= $penugasan['status']=='ditugaskan'?'selected':'' ?>>🔘 Ditugaskan</option>
                                    <option value="dikerjakan" <?= $penugasan['status']=='dikerjakan'?'selected':'' ?>>⏳ Sedang Dikerjakan</option>
                                    <option value="selesai" <?= $penugasan['status']=='selesai'?'selected':'' ?>>✅ Selesai</option>
                                </select>
                                <div class="status-hint mt-2 p-2 bg-light rounded-3 small text-muted">
                                    <i class="bi bi-info-circle me-1"></i> Pastikan status sesuai dengan kondisi lapangan.
                                </div>
                            </div>
                            <?php else: ?>
                            <div class="col-12">
                                <label class="form-label">Current Status</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0"><i class="bi bi-tag-fill text-muted"></i></span>
                                    <input type="text" class="form-control" value="<?= ucfirst($penugasan['status']) ?>" readonly>
                                </div>
                            </div>
                            <?php endif; ?>

                            <div class="col-12">
                                <label class="form-label"><i class="bi bi-calendar-check me-2"></i> Tanggal Penugasan</label>
                                <?php if(session('role') == 'admin'): ?>
                                    <input type="date" name="tanggal_penugasan" value="<?= $penugasan['tanggal'] ?>" class="form-control shadow-sm">
                                    <p class="small text-muted mt-2 mb-0">Admin memiliki akses untuk menjadwalkan ulang tanggal penugasan.</p>
                                <?php else: ?>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0"><i class="bi bi-lock-fill text-muted"></i></span>
                                        <input type="text" value="<?= date('d M Y', strtotime($penugasan['tanggal'])) ?>" class="form-control" readonly>
                                    </div>
                                    <p class="small text-muted mt-2 mb-0">Tanggal penugasan bersifat tetap bagi teknisi.</p>
                                <?php endif; ?>
                            </div>

                            <div class="col-12">
                                <label class="form-label"><i class="bi bi-camera-fill me-2"></i> Foto Bukti Hasil Kerja</label>
                                <div class="p-4 border-dashed border-2 rounded-4 text-center bg-light border-secondary border-opacity-10">
                                    <input type="file" name="foto_bukti" class="form-control mb-2 shadow-sm">
                                    <div class="d-flex align-items-center justify-content-center gap-3 mt-3">
                                        <span class="badge bg-white text-muted border px-2 py-1"><i class="bi bi-image me-1"></i> JPG/PNG</span>
                                        <span class="badge bg-white text-muted border px-2 py-1"><i class="bi bi-hdd me-1"></i> Max 2MB</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-5">
                                <div class="d-flex justify-content-between align-items-center border-top pt-4">
                                    <a href="<?= base_url('penugasan') ?>" class="btn btn-link text-decoration-none text-muted fw-bold p-0">
                                        <i class="bi bi-arrow-left me-1"></i> Batal & Kembali
                                    </a>
                                    <button type="submit" class="btn btn-update-task">
                                        Simpan Perubahan <i class="bi bi-check2-all ms-2"></i>
                                    </button>
                                </div>
                            </div>

                        </div> </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>