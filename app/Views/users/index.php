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

    /* --- Interactive Avatar Section --- */
    .avatar-link {
        position: relative;
        display: inline-block;
        width: 42px;
        height: 42px;
        border-radius: 0.5rem;
        overflow: hidden;
    }

    .user-avatar {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .avatar-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(37, 99, 235, 0.8); /* Warna biru Admin One */
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .avatar-link:hover .avatar-overlay {
        opacity: 1;
    }

    .avatar-link:hover .user-avatar {
        transform: scale(1.1);
    }
    /* ---------------------------------- */

    .role-badge {
        font-size: 0.7rem;
        font-weight: 800;
        padding: 0.35rem 0.75rem;
        border-radius: 0.375rem;
    }

    .btn-action {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.375rem;
        transition: all 0.2s;
    }
</style>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h2 class="fw-800 text-dark mb-1">User Management</h2>
            <p class="text-muted small mb-0">Kelola hak akses dan informasi akun pengguna sistem.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="<?= base_url('users/print?' . http_build_query($_GET)) ?>" target="_blank" class="btn btn-outline-secondary btn-sm fw-bold px-3">
                <i class="bi bi-printer me-1"></i> Cetak Laporan
            </a>
            <a href="<?= base_url('users/create') ?>" class="btn btn-primary btn-sm fw-bold px-3">
                <i class="bi bi-plus-lg me-1"></i> Tambah User baru
            </a>
        </div>
    </div>

    <div class="admin-card mb-4">
        <div class="card-body p-3">
            <form method="get" action="" class="row g-2 align-items-center">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" name="keyword" class="form-control border-start-0" placeholder="Cari nama atau email..." value="<?= $_GET['keyword'] ?? '' ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="role" class="form-select">
                        <option value="">— Semua Hak Akses —</option>
                        <option value="admin" <?= (($_GET['role'] ?? '') == 'admin') ? 'selected' : '' ?>>Administrator</option>
                        <option value="teknisi" <?= (($_GET['role'] ?? '') == 'teknisi') ? 'selected' : '' ?>>Teknisi</option>
                        <option value="pelapor" <?= (($_GET['role'] ?? '') == 'pelapor') ? 'selected' : '' ?>>Pelapor</option>
                    </select>
                </div>
                <div class="col-md-auto">
                    <button type="submit" class="btn btn-dark fw-bold px-4">Filter</button>
                    <a href="<?= base_url('users') ?>" class="btn btn-link text-muted small">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="admin-card">
        <div class="table-responsive">
            <table class="table admin-table mb-0">
                <thead>
                    <tr>
                        <th class="text-center" width="50">ID</th>
                        <th>Identitas User</th>
                        <th>Username</th>
                        <th>Hak Akses</th>
                        <th class="text-end">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)): ?>
                        <?php foreach ($users as $u): ?>
                            <tr>
                                <td class="text-center text-muted font-monospace small">#<?= $u['id_user'] ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="<?= base_url('users/detail/' . $u['id_user']) ?>" class="avatar-link border me-3" title="Lihat Detail">
                                            <img src="<?= $u['foto'] ? base_url('uploads/users/' . $u['foto']) : base_url('assets/img/default-user.png') ?>" class="user-avatar">
                                            <div class="avatar-overlay">
                                                <i class="bi bi-eye-fill"></i>
                                            </div>
                                        </a>
                                        <div>
                                            <a href="<?= base_url('users/detail/' . $u['id_user']) ?>" class="fw-bold text-dark text-decoration-none d-block"><?= $u['nama'] ?></a>
                                            <span class="text-muted small"><?= $u['email'] ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td><code class="text-primary"><?= $u['username'] ?></code></td>
                                <td>
                                    <?php 
                                        $badgeClass = 'bg-light text-dark border';
                                        if($u['role'] == 'admin') $badgeClass = 'bg-primary-soft text-primary';
                                        if($u['role'] == 'teknisi') $badgeClass = 'bg-info-soft text-info';
                                        if($u['role'] == 'pelapor') $badgeClass = 'bg-warning-soft text-warning';
                                    ?>
                                    <span class="badge role-badge <?= $badgeClass ?>">
                                        <?= strtoupper($u['role']) ?>
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-1">
                                        <?php if (session()->get('role') == 'admin') : ?>
                                            <a href="<?= base_url('users/edit/' . $u['id_user']) ?>" class="btn-action bg-blue-soft text-primary" title="Edit Akun">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a href="<?= base_url('users/delete/' . $u['id_user']) ?>" class="btn-action bg-red-soft text-danger" onclick="return confirm('Hapus user ini?')" title="Hapus Akun">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="5" class="text-center py-5 text-muted small">Data tidak ditemukan dalam database.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <div class="card-footer bg-white border-top py-3 d-flex justify-content-between align-items-center">
            <span class="small text-muted">Showing results from database</span>
            <div><?= $pager->links() ?></div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>