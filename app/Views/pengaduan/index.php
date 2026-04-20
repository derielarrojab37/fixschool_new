<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* Admin One Table Design */
    .admin-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
    }

    .admin-table thead th {
        background-color: #f9fafb;
        color: #4b5563;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 1rem;
        border-bottom: 2px solid #e5e7eb;
    }

    .admin-table tbody td {
        padding: 1rem;
        vertical-align: middle;
        color: #374151;
        border-bottom: 1px solid #f3f4f6;
    }

    /* Soft Badge Status */
    .badge-soft {
        font-size: 0.7rem;
        font-weight: 800;
        padding: 0.35rem 0.75rem;
        border-radius: 0.375rem;
        text-transform: uppercase;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .status-pending { background-color: #fef3c7; color: #92400e; } /* Amber */
    .status-proses { background-color: #e0e7ff; color: #3730a3; }  /* Indigo */
    .status-selesai { background-color: #d1fae5; color: #065f46; } /* Emerald */
    .status-ditolak { background-color: #fee2e2; color: #991b1b; } /* Red */

    /* Action Buttons */
    .btn-action {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.375rem;
        transition: all 0.2s;
        border: none;
    }
    
    .bg-info-soft { background-color: #e0f2fe; color: #0369a1; }
    .bg-red-soft { background-color: #fee2e2; color: #dc2626; }
</style>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h2 class="fw-800 text-dark mb-1">Data Pengaduan</h2>
            <p class="text-muted small mb-0">Monitor dan kelola laporan kerusakan infrastruktur sekolah.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="<?= base_url('pengaduan/print?' . http_build_query($_GET)) ?>" target="_blank" class="btn btn-outline-secondary btn-sm fw-bold px-3">
                <i class="bi bi-printer me-1"></i> Cetak Laporan
            </a>
            <?php if(session()->get('role') == 'pelapor'): ?>
                <a href="<?= base_url('/pengaduan/create') ?>" class="btn btn-primary btn-sm fw-bold px-3">
                    <i class="bi bi-plus-lg me-1"></i> Buat Laporan
                </a>
            <?php endif; ?>
        </div>
    </div>

    <div class="admin-card mb-4">
        <div class="card-body p-3">
            <form method="get" action="" class="row g-2 align-items-center">
                <div class="col-md-3">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" name="keyword" class="form-control border-start-0" placeholder="Cari judul laporan..." value="<?= $_GET['keyword'] ?? '' ?>">
                    </div>
                </div>
                <div class="col-md-2">
                    <select name="jenis" class="form-select form-select-sm">
                        <option value="">Semua Jenis</option>
                        <?php foreach($jenis as $j): ?>
                            <option value="<?= $j['id_jenis'] ?>" <?= (($_GET['jenis'] ?? '') == $j['id_jenis']) ? 'selected' : '' ?>>
                                <?= $j['nama_jenis'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="date" name="tanggal" class="form-control form-control-sm" value="<?= $_GET['tanggal'] ?? '' ?>">
                </div>
                <div class="col-md-auto">
                    <button type="submit" class="btn btn-dark btn-sm fw-bold px-3">Filter</button>
                    <a href="<?= base_url('pengaduan') ?>" class="btn btn-link btn-sm text-muted">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="admin-card">
        <div class="table-responsive">
            <table class="table admin-table mb-0">
                <thead>
                    <tr>
                        <th class="text-center" width="60">No</th>
                        <th>Informasi Laporan</th>
                        <th>Pelapor</th>
                        <th>Kategori & Lokasi</th>
                        <th class="text-center">Status</th>
                        <th class="text-end">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pengaduan)): ?>
                        <?php $no=1; foreach ($pengaduan as $p): ?>
                        
                        <?php 
                            $statusRaw = strtolower($p['status']);
                            $statusClass = 'status-pending';
                            if (in_array($statusRaw, ['proses', 'diproses'])) $statusClass = 'status-proses';
                            elseif ($statusRaw == 'selesai') $statusClass = 'status-selesai';
                            elseif ($statusRaw == 'ditolak') $statusClass = 'status-ditolak';
                        ?>

                        <tr>
                            <td class="text-center text-muted font-monospace small"><?= $no++ ?></td>
                            <td>
                                <div class="fw-bold text-dark mb-0"><?= $p['judul'] ?></div>
                                <div class="text-muted" style="font-size: 0.75rem;">ID: #PGN-<?= str_pad($p['id_pengaduan'], 4, '0', STR_PAD_LEFT) ?></div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 30px; height: 30px;">
                                        <i class="bi bi-person text-primary"></i>
                                    </div>
                                    <span class="small fw-semibold"><?= $p['nama'] ?></span>
                                </div>
                            </td>
                            <td>
                                <span class="d-block small fw-bold text-info"><i class="bi bi-tag me-1"></i><?= $p['nama_jenis'] ?></span>
                                <span class="d-block small text-muted"><i class="bi bi-geo-alt me-1"></i><?= $p['lokasi'] ?></span>
                            </td>
                            <td class="text-center">
                                <span class="badge-soft <?= $statusClass ?>">
                                    <i class="bi bi-dot fs-4"></i>
                                    <?= ucfirst($p['status']) ?>
                                </span>
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="<?= base_url('pengaduan/detail/' . $p['id_pengaduan']) ?>" class="btn-action bg-info-soft" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <?php if(session('role') == 'admin' && $p['status'] != 'selesai'): ?>
                                        <a href="<?= base_url('pengaduan/delete/'.$p['id_pengaduan']) ?>" 
                                           class="btn-action bg-red-soft" 
                                           onclick="return confirm('Yakin ingin menghapus laporan ini?')"
                                           title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="60" class="opacity-25 mb-3" alt="Empty">
                                <p class="text-muted small">Tidak ada data pengaduan yang ditemukan.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>