<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* 📊 Elite Table Design System */
    .admin-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 1.25rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
    }

    .filter-wrapper {
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        padding: 1.5rem;
    }

    /* Table Styling */
    .table-elite thead th {
        background-color: #f1f5f9;
        text-transform: uppercase;
        font-size: 0.7rem;
        font-weight: 800;
        letter-spacing: 0.075em;
        color: #475569;
        border: none;
        padding: 1.25rem 1rem;
    }

    .table-elite tbody tr {
        transition: all 0.2s;
    }

    .table-elite tbody tr:hover {
        background-color: #f8fafc;
        transform: scale(1.002);
    }

    .table-elite tbody td {
        padding: 1.25rem 1rem;
        vertical-align: middle;
        color: #1e293b;
        border-color: #f1f5f9;
    }

    /* Components */
    .input-elite {
        border: 1.5px solid #e2e8f0;
        border-radius: 0.75rem;
        padding: 0.6rem 1rem;
        font-size: 0.9rem;
        transition: all 0.2s;
    }

    .input-elite:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .btn-elite-primary {
        background: #1e293b;
        color: white;
        font-weight: 700;
        border-radius: 0.75rem;
        padding: 0.6rem 1.5rem;
        border: none;
    }

    .btn-elite-primary:hover {
        background: #0f172a;
        color: white;
    }

    .btn-action-icon {
        width: 35px;
        height: 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.6rem;
        transition: all 0.2s;
    }

    .truncate-elite {
        max-width: 280px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        font-size: 0.85rem;
        color: #64748b;
    }

    .avatar-placeholder {
        width: 32px;
        height: 32px;
        background: #e2e8f0;
        color: #475569;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-weight: bold;
    }

    
</style>

<div class="container-fluid py-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5 gap-3">
        <div>
            <nav aria-label="breadcrumb" class="mb-2">
                <ol class="breadcrumb small fw-bold mb-0">
                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>" class="text-decoration-none text-muted">ADMIN</a></li>
                    <li class="breadcrumb-item active text-primary" aria-current="page">RIWAYAT TANGGAPAN</li>
                </ol>
            </nav>
            <h3 class="fw-800 text-dark mb-0" style="letter-spacing: -0.02em;">Log Tanggapan Petugas</h3>
            <p class="text-muted small mb-0">Memantau efektivitas dan detail respon yang diberikan kepada pelapor.</p>
        </div>
        
    </div>

    <div class="admin-card overflow-hidden">
        <div class="filter-wrapper">
            <form method="get" class="row g-3">
                <div class="col-lg-4 col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-muted ps-3 rounded-start-3">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" name="keyword" class="form-control input-elite border-start-0 ps-0" 
                               placeholder="Cari judul laporan atau petugas..." value="<?= $_GET['keyword'] ?? '' ?>">
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <input type="date" name="tanggal" class="form-control input-elite" 
                           value="<?= $_GET['tanggal'] ?? '' ?>">
                </div>

                <div class="col-lg-5 d-flex gap-2 align-items-center">
                    <button type="submit" class="btn btn-elite-primary px-4">
                        <i class="bi bi-funnel-fill me-2"></i> Filter
                    </button>
                    <a href="<?= base_url('tanggapan') ?>" class="btn btn-light border fw-bold px-4 rounded-3 text-muted">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </a>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-elite mb-0">
                <thead>
                    <tr>
                        <th class="text-center" width="70">NO</th>
                        <th>INFORMASI LAPORAN</th>
                        <th>PETUGAS RESPONDEN</th>
                        <th>DRAFT TANGGAPAN</th>
                        <th class="text-center" width="150">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($tanggapan)): ?>
                        <?php $no = 1; foreach ($tanggapan as $t): ?>
                            <tr>
                                <td class="text-center fw-bold text-muted small"><?= $no++ ?></td>
                                <td>
    <div class="fw-800 text-dark mb-0"><?= $t['judul'] ?></div>
    <div class="d-flex align-items-center gap-2 mt-1">
        <span class="badge bg-primary text-white fw-bold px-2 py-1" style="font-size: 0.65rem; border-radius: 4px;">
            ID: #<?= $t['id_pengaduan'] ?>
        </span>
    </div>
</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-placeholder me-2 small">
                                            <?= strtoupper(substr($t['nama'], 0, 1)) ?>
                                        </div>
                                        <div>
                                            <div class="fw-bold small mb-0"><?= $t['nama'] ?></div>
                                            <div class="text-muted" style="font-size: 0.75rem;">Petugas Resmi</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="truncate-elite">
                                        <i class="bi bi-quote me-1 opacity-50"></i><?= $t['isi_tanggapan'] ?>
                                    </div>
                                </td>
                                <td class="text-center">
    <div class="d-flex justify-content-center gap-2">
        <a href="<?= base_url('tanggapan/edit/' . $t['id_tanggapan']) ?>" 
           class="btn btn-warning btn-sm d-flex align-items-center justify-content-center" 
           style="width: 32px; height: 32px; border: none; border-radius: 8px;"
           title="Edit">
            <i class="bi bi-pencil-square text-dark fs-6"></i>
        </a>

        <a href="<?= base_url('tanggapan/delete/' . $t['id_tanggapan']) ?>" 
           class="btn btn-danger btn-sm d-flex align-items-center justify-content-center"
           style="width: 32px; height: 32px; border: none; border-radius: 8px;"
           onclick="return confirm('Hapus tanggapan ini?')"
           title="Hapus">
            <i class="bi bi-trash3-fill text-white fs-6"></i>
        </a>
    </div>
</td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="py-4">
                                    <i class="bi bi-chat-left-dots text-light display-1 mb-3 d-block"></i>
                                    <h5 class="fw-bold text-dark">Belum Ada Tanggapan</h5>
                                    <p class="text-muted small">Data tanggapan akan muncul di sini setelah petugas merespon laporan.</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Inisialisasi Tooltip Bootstrap (Opsional)
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>

<?= $this->endSection() ?>