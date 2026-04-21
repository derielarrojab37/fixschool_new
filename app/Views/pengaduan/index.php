<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* 💎 Elite Table Design */
    .admin-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 1rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .admin-table thead th {
        background-color: #f8fafc;
        color: #64748b;
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        padding: 1.25rem 1rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .admin-table tbody td {
        padding: 1.1rem 1rem;
        vertical-align: middle;
        color: #334155;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.875rem;
    }

    /* 🎨 Premium Badge Status */
    .badge-status {
        font-size: 0.65rem;
        font-weight: 700;
        padding: 0.4rem 0.8rem;
        border-radius: 8px;
        text-transform: uppercase;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        letter-spacing: 0.025em;
    }

    .status-pending { background-color: #fffbeb; color: #92400e; border: 1px solid #fde68a; }
    .status-proses  { background-color: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; }
    .status-selesai { background-color: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; }
    .status-ditolak { background-color: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; }

    /* 🔘 Action Buttons */
    .btn-action {
        width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        border: none;
        text-decoration: none;
    }
    
    .btn-action:hover {
        transform: translateY(-2px);
        filter: brightness(0.95);
    }

    .bg-info-soft { background-color: #f0f9ff; color: #0369a1; }
    .bg-red-soft  { background-color: #fef2f2; color: #dc2626; }

    /* Form Filter Styling */
    .filter-input {
        border: 1.5px solid #e2e8f0;
        border-radius: 0.75rem;
        font-size: 0.85rem;
        font-weight: 500;
    }
    
    .filter-input:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }
</style>

<div class="container-fluid py-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 gap-3">
        <div>
            <h3 class="fw-800 text-dark mb-1" style="letter-spacing: -0.02em;">Data Pengaduan</h3>
            <p class="text-muted small mb-0">Monitor dan kelola laporan kerusakan infrastruktur secara real-time.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="<?= base_url('pengaduan/print?' . http_build_query($_GET)) ?>" target="_blank" class="btn btn-white border fw-bold px-3 py-2 small shadow-sm">
    <i class="bi bi-printer me-2 text-muted"></i> Cetak Laporan
</a>
            <?php if(session()->get('role') == 'pelapor'): ?>
                <a href="<?= base_url('/pengaduan/create') ?>" class="btn btn-primary fw-bold px-3 py-2 small shadow-sm">
                    <i class="bi bi-plus-lg me-2"></i> Buat Laporan
                </a>
            <?php endif; ?>
        </div>
    </div>

    <div class="admin-card mb-4 border-0 shadow-none" style="background: #f1f5f9;">
        <div class="card-body p-3">
            <form method="get" action="" class="row g-2 align-items-center">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 filter-input"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" name="keyword" class="form-control border-start-0 filter-input shadow-none" placeholder="Cari judul laporan..." value="<?= $_GET['keyword'] ?? '' ?>">
                    </div>
                </div>
                <div class="col-md-2">
                    <select name="jenis" class="form-select filter-input shadow-none fw-semibold">
                        <option value="">Semua Jenis</option>
                        <?php if(!empty($jenis)): foreach($jenis as $j): ?>
                            <option value="<?= $j['id_jenis'] ?>" <?= (($_GET['jenis'] ?? '') == $j['id_jenis']) ? 'selected' : '' ?>>
                                <?= $j['nama_jenis'] ?>
                            </option>
                        <?php endforeach; endif; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="date" name="tanggal" class="form-control filter-input shadow-none" value="<?= $_GET['tanggal'] ?? '' ?>">
                </div>
                <div class="col-md-auto d-flex gap-2">
                    <button type="submit" class="btn btn-dark fw-bold px-4 filter-input">Filter</button>
                    <a href="<?= base_url('pengaduan') ?>" class="btn btn-outline-secondary border-0 fw-bold filter-input">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="admin-card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table admin-table mb-0">
                <thead>
                    <tr>
                        <th class="text-center" width="70">No</th>
                        <th>Informasi Laporan</th>
                        <th>Pelapor</th>
                        <th>Kategori & Lokasi</th>
                        <th class="text-center">Status Laporan</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pengaduan)): ?>
                        <?php $no=1; foreach ($pengaduan as $p): ?>
                        
                        <?php 
                            $statusRaw = strtolower($p['status']);
                            $statusClass = 'status-pending';
                            $iconStatus = 'bi-clock-history';
                            
                            if (in_array($statusRaw, ['proses', 'diproses'])) {
                                $statusClass = 'status-proses';
                                $iconStatus = 'bi-gear-wide-connected';
                            } elseif ($statusRaw == 'selesai') {
                                $statusClass = 'status-selesai';
                                $iconStatus = 'bi-check2-circle';
                            } elseif ($statusRaw == 'ditolak') {
                                $statusClass = 'status-ditolak';
                                $iconStatus = 'bi-x-circle';
                            }
                        ?>

                        <tr>
                            <td class="text-center">
                                <span class="text-muted font-monospace fw-bold">#<?= $no++ ?></span>
                            </td>
                            <td>
                                <div class="fw-bold text-dark mb-0"><?= $p['judul'] ?></div>
                                <div class="text-muted font-monospace" style="font-size: 0.7rem; letter-spacing: 0.05em;">ID: <?= str_pad($p['id_pengaduan'], 5, '0', STR_PAD_LEFT) ?></div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-blue-soft rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 32px; height: 32px; border: 1px solid #bfdbfe;">
                                        <i class="bi bi-person-fill small"></i>
                                    </div>
                                    <span class="fw-bold text-dark" style="font-size: 0.85rem;"><?= $p['nama'] ?></span>
                                </div>
                            </td>
                            <td>
                                <div class="mb-1">
                                    <span class="badge bg-light text-primary border fw-bold" style="font-size: 0.65rem;">
                                        <i class="bi bi-tag-fill me-1"></i><?= $p['nama_jenis'] ?>
                                    </span>
                                </div>
                                <span class="text-muted small"><i class="bi bi-geo-alt-fill me-1 text-danger"></i><?= $p['lokasi'] ?></span>
                            </td>
                            <td class="text-center">
                                <span class="badge-status <?= $statusClass ?>">
                                    <i class="bi <?= $iconStatus ?> fs-6"></i>
                                    <?= ucfirst($p['status']) ?>
                                </span>
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="<?= base_url('pengaduan/detail/' . $p['id_pengaduan']) ?>" class="btn-action bg-info-soft" title="Lihat Detail">
                                        <i class="bi bi-arrow-right-short fs-4"></i>
                                    </a>
                                    <?php if(session('role') == 'admin' && $p['status'] != 'selesai'): ?>
                                        <a href="<?= base_url('pengaduan/delete/'.$p['id_pengaduan']) ?>" 
                                           class="btn-action bg-red-soft" 
                                           onclick="return confirm('Hapus laporan ini dari database?')"
                                           title="Hapus Laporan">
                                            <i class="bi bi-trash-fill small"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="py-4">
                                    <i class="bi bi-inbox text-light display-1"></i>
                                    <p class="text-muted mt-3 fw-bold">Belum ada pengaduan yang terdaftar.</p>
                                    <a href="<?= base_url('pengaduan') ?>" class="btn btn-sm btn-outline-primary rounded-pill px-4">Muat Ulang</a>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
<div>
                    <?php 
$warna = 'secondary';

if ($p['status_sla'] == 'aman') $warna = 'success';
elseif ($p['status_sla'] == 'hampir') $warna = 'warning';
elseif ($p['status_sla'] == 'terlambat') $warna = 'danger';
?>

<span class="badge bg-<?= $warna ?>">
    <?= strtoupper($p['status_sla']) ?>
</span>
</div>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>