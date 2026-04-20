<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* Admin One Penugasan Update Style */
    .admin-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        overflow: hidden;
    }

    .form-header-update {
        background: linear-gradient(135deg, #4f46e5 0%, #10b981 100%);
        padding: 2rem;
        color: white;
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

    .form-control, .form-select {
        border: 1px solid #e5e7eb;
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        transition: all 0.2s;
    }

    .form-control:focus, .form-select:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    .form-control[readonly] {
        background-color: #f9fafb;
        color: #6b7280;
        cursor: not-allowed;
    }

    .btn-update-task {
        background: #10b981;
        color: white;
        font-weight: 700;
        padding: 0.75rem 2.5rem;
        border: none;
        border-radius: 0.5rem;
        transition: all 0.2s;
    }

    .btn-update-task:hover {
        background: #059669;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.2);
    }

    .status-hint {
        font-size: 0.75rem;
        color: #6b7280;
        margin-top: 0.5rem;
    }
</style>

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb small fw-bold">
                    <li class="breadcrumb-item"><a href="<?= base_url('penugasan') ?>" class="text-decoration-none text-muted">Penugasan</a></li>
                    <li class="breadcrumb-item active text-dark" aria-current="page">Update Status Kerja</li>
                </ol>
            </nav>

            <div class="admin-card shadow-sm">
                <div class="form-header-update">
                    <div class="d-flex align-items-center">
                        <div class="bg-white bg-opacity-20 rounded-circle p-3 me-3">
                            <i class="bi bi-arrow-repeat fs-3"></i>
                        </div>
                        <div>
                            <h4 class="fw-800 mb-0">Update Penugasan</h4>
                            <p class="mb-0 opacity-75 small">Kelola perkembangan pengerjaan laporan</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form method="post" action="<?= base_url('penugasan/update/'.$penugasan['id_penugasan']) ?>" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <label class="form-label"><i class="bi bi-flag me-2"></i> Status Progress</label>
                                <select name="status" class="form-select fw-semibold">
                                    <option value="ditugaskan" <?= $penugasan['status']=='ditugaskan'?'selected':'' ?>>🔘 Ditugaskan (Pending)</option>
                                    <option value="dikerjakan" <?= $penugasan['status']=='dikerjakan'?'selected':'' ?>>🚧 Sedang Dikerjakan</option>
                                    <option value="selesai" <?= $penugasan['status']=='selesai'?'selected':'' ?>>✅ Selesai Dikerjakan</option>
                                </select>
                                <div class="status-hint">Pilih 'Selesai' jika perbaikan telah diverifikasi.</div>
                            </div>

                            <div class="col-md-12 mb-4">
                                <label class="form-label"><i class="bi bi-calendar-event me-2"></i> Tanggal Penugasan</label>
                                <?php if(session('role') == 'admin'): ?>
                                    <input type="date" name="tanggal_penugasan" value="<?= $penugasan['tanggal'] ?>" class="form-control">
                                    <small class="text-muted">Admin dapat menyesuaikan ulang tanggal jika diperlukan.</small>
                                <?php else: ?>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                        <input type="text" value="<?= date('d M Y', strtotime($penugasan['tanggal'])) ?>" class="form-control" readonly>
                                    </div>
                                    <small class="text-muted">Hanya Admin yang dapat mengubah tanggal ini.</small>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-12 mb-5">
                                <label class="form-label"><i class="bi bi-camera me-2"></i> Foto Bukti Hasil Kerja</label>
                                <input type="file" name="foto_bukti" class="form-control">
                                <p class="small text-muted mt-2 mb-0">
                                    <i class="bi bi-info-circle me-1"></i> Format: JPG/PNG/WEBP. Maksimal 2MB.
                                </p>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center border-top pt-4">
                            <a href="<?= base_url('penugasan') ?>" class="btn btn-link text-muted fw-bold text-decoration-none">
                                <i class="bi bi-x-lg me-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-update-task">
                                Simpan Perubahan <i class="bi bi-check-all ms-2"></i>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>