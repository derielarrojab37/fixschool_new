<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* Admin One Table Design */
    .admin-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
    }

    .table thead th {
        background-color: #f9fafb;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
        color: #6b7280;
        border-top: none;
        padding: 1rem;
    }

    .table tbody td {
        padding: 1rem;
        vertical-align: middle;
        color: #374151;
        border-color: #f3f4f6;
    }

    .filter-section {
        background-color: #f9fafb;
        border-bottom: 1px solid #e5e7eb;
        padding: 1.5rem;
    }

    .form-control {
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
    }

    .btn-action {
        padding: 0.4rem 0.8rem;
        border-radius: 0.4rem;
        font-weight: 600;
        font-size: 0.85rem;
    }

    .truncate-text {
        max-width: 300px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-800 text-dark mb-1">Riwayat Tanggapan</h4>
            <p class="text-muted small mb-0">Kelola semua tanggapan yang telah dikirim oleh petugas/admin.</p>
        </div>
    </div>

    <div class="admin-card shadow-sm overflow-hidden">
        <div class="filter-section">
            <form method="get" class="row g-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-muted">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" name="keyword" class="form-control border-start-0" 
                               placeholder="Cari kata kunci..." value="<?= $_GET['keyword'] ?? '' ?>">
                    </div>
                </div>

                <div class="col-md-3">
                    <input type="date" name="tanggal" class="form-control" 
                           value="<?= $_GET['tanggal'] ?? '' ?>">
                </div>

                <div class="col-md-5 d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4 fw-bold">
                        <i class="bi bi-filter me-1"></i> Terapkan Filter
                    </button>
                    <a href="<?= base_url('tanggapan') ?>" class="btn btn-outline-secondary px-4 fw-bold">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                    </a>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th class="text-center" width="60">No</th>
                        <th>Laporan Pengaduan</th>
                        <th>Petugas</th>
                        <th>Isi Tanggapan</th>
                        <th class="text-center" width="200">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($tanggapan)): ?>
                        <?php $no = 1; foreach ($tanggapan as $t): ?>
                            <tr>
                                <td class="text-center fw-bold text-muted"><?= $no++ ?></td>
                                <td>
                                    <div class="fw-bold text-dark"><?= $t['judul'] ?></div>
                                    <small class="text-primary">#ID-<?= $t['id_pengaduan'] ?></small>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded-circle p-2 me-2">
                                            <i class="bi bi-person text-muted"></i>
                                        </div>
                                        <span class="fw-semibold small"><?= $t['nama'] ?></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="truncate-text small text-muted">
                                        <?= $t['isi_tanggapan'] ?>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="<?= base_url('tanggapan/edit/' . $t['id_tanggapan']) ?>" 
                                           class="btn btn-warning btn-action text-white">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        <a href="<?= base_url('tanggapan/delete/' . $t['id_tanggapan']) ?>" 
                                           class="btn btn-danger btn-action"
                                           onclick="return confirm('Apakah Anda yakin ingin menghapus tanggapan ini?')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <img src="https://illustrations.popsy.co/amber/no-results.svg" alt="Empty" style="height: 120px;" class="mb-3">
                                <p class="text-muted mb-0">Data tanggapan tidak ditemukan.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>