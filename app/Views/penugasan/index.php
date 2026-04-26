<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<link rel="icon" href="<?= base_url('assets/img/FS_No_BG.png') ?>">

<style>
    /* Admin One Table & Status Design */
    .admin-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        overflow: hidden;
    }

    .filter-section {
        background-color: #f9fafb;
        border-bottom: 1px solid #e5e7eb;
        padding: 1.5rem;
    }

    .table thead th {
        background-color: #f9fafb;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
        color: #6b7280;
        padding: 1rem;
        border-top: none;
    }

    .table tbody td {
        padding: 1rem;
        vertical-align: middle;
        border-color: #f3f4f6;
    }

    /* Status Badges */
    .badge-status {
        padding: 0.4rem 0.75rem;
        border-radius: 50rem;
        font-weight: 700;
        font-size: 0.7rem;
        text-transform: uppercase;
    }
    .status-ditugaskan { background: #e0e7ff; color: #4338ca; }
    .status-dikerjakan { background: #fef3c7; color: #92400e; }
    .status-selesai { background: #d1fae5; color: #065f46; }

    /* 🎯 User Management Style Buttons */
    .btn-action-group {
        display: flex;
        gap: 0.4rem;
        justify-content: center;
    }

    .btn-circle {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.5rem; /* Kotak membulat khas Admin One */
        transition: all 0.2s;
        border: 1px solid transparent;
    }

    .btn-view {
        background-color: #f3f4f6;
        color: #374151;
    }
    .btn-view:hover {
        background-color: #e5e7eb;
        color: #111827;
    }

    .btn-edit {
        background-color: #fef3c7;
        color: #92400e;
    }
    .btn-edit:hover {
        background-color: #fde68a;
    }

    .btn-delete {
        background-color: #fee2e2;
        color: #991b1b;
    }
    .btn-delete:hover {
        background-color: #fecaca;
    }
</style>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-800 text-dark mb-1">Daftar Penugasan Teknisi</h4>
            <p class="text-muted small mb-0">Pantau dan kelola pengerjaan laporan oleh tim teknis.</p>
        </div>
        <?php if (session('role') == 'admin'): ?>
        <a href="<?= base_url('penugasan/create') ?>" class="btn btn-primary fw-bold shadow-sm px-4">
            <i class="bi bi-plus-lg me-1"></i> Tambah Tugas
        </a>
        <?php endif; ?> 
    </div>

    <div class="admin-card shadow-sm">
        <div class="filter-section">
            <form method="get" class="row g-2">
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                        <input type="text" name="pengaduan" class="form-control border-start-0" 
                               placeholder="Judul laporan..." value="<?= $_GET['pengaduan'] ?? '' ?>">
                    </div>
                </div>

                <div class="col-md-3">
                    <select name="teknisi" class="form-select fw-semibold">
                        <option value="">Semua Teknisi</option>
                        <?php foreach ($teknisiList as $t): ?>
                            <option value="<?= $t['id_user'] ?>" <?= (($_GET['teknisi'] ?? '') == $t['id_user']) ? 'selected' : '' ?>>
                                <?= $t['nama'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-2">
                    <input type="date" name="tanggal" class="form-control" value="<?= $_GET['tanggal'] ?? '' ?>">
                </div>

                <div class="col-md-4 d-flex gap-2">
                    <button type="submit" class="btn btn-dark w-100 fw-bold">Cari</button>
                    <a href="<?= base_url('penugasan') ?>" class="btn btn-outline-secondary w-100 fw-bold">Reset</a>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th class="text-center" width="60">No</th>
                        <th>Informasi Laporan</th>
                        <th>Teknisi</th>
                        <th class="text-center">Status Progress</th>
                        <th class="text-center" width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($penugasan)): ?>
                        <?php $no = 1; foreach ($penugasan as $p): ?>
                            <tr>
                                <td class="text-center text-muted fw-bold"><?= $no++ ?></td>
                                <td>
                                    <div class="fw-bold text-dark"><?= $p['judul'] ?></div>
                                    <div class="small text-muted"><i class="bi bi-geo-alt me-1"></i><?= $p['lokasi'] ?? 'Lokasi tidak diset' ?></div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-indigo bg-opacity-10 text-indigo rounded-circle p-2 me-2" style="width:30px; height:30px; display:flex; align-items:center; justify-content:center;">
                                            <i class="bi bi-person-gear small"></i>
                                        </div>
                                        <span class="fw-semibold small"><?= $p['nama'] ?></span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <?php 
                                        $statusClass = 'status-' . strtolower($p['status']);
                                        $statusLabel = ucfirst($p['status']);
                                    ?>
                                    <span class="badge-status <?= $statusClass ?>"><?= $statusLabel ?></span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-action-group">
                                        <a href="<?= base_url('penugasan/detail/' . $p['id_penugasan']) ?>" 
                                           class="btn btn-circle btn-view" title="Detail">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>

                                        <a href="<?= base_url('penugasan/edit/' . $p['id_penugasan']) ?>" 
                                           class="btn btn-circle btn-edit" title="Update Status">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>

                                        <?php if (session('role') == 'admin' && $p['status'] == 'selesai'): ?>
                                            <a href="<?= base_url('penugasan/delete/' . $p['id_penugasan']) ?>" 
                                               class="btn btn-circle btn-delete"
                                               onclick="return confirm('Yakin hapus penugasan ini?')" title="Hapus">
                                                <i class="bi bi-trash-fill"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="bi bi-inbox display-4 d-block mb-2"></i>
                                    Tidak ada data penugasan.
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>