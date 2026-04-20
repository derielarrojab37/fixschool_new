<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* 🎯 Admin One Base Design */
    .admin-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        overflow: hidden;
    }

    .admin-table thead th {
        background-color: #f9fafb;
        color: #6b7280;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 1rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .admin-table tbody td {
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #f3f4f6;
    }

    /* 🎨 Soft Color Palette for Badges & Buttons */
    .bg-primary-soft { background-color: #e0e7ff; color: #4338ca; }
    .bg-info-soft    { background-color: #e0f2fe; color: #0369a1; }
    .bg-warning-soft { background-color: #fef3c7; color: #92400e; }
    .bg-blue-soft    { background-color: #dbeafe; color: #1e40af; }
    .bg-red-soft     { background-color: #fee2e2; color: #991b1b; }

    /* 👤 Avatar Style */
    .avatar-link {
        position: relative;
        display: inline-block;
        width: 40px;
        height: 40px;
        border-radius: 0.6rem;
        overflow: hidden;
        border: 1px solid #e5e7eb;
    }

    .user-avatar {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .avatar-overlay {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(99, 102, 241, 0.85);
        display: flex; align-items: center; justify-content: center;
        color: white; opacity: 0; transition: 0.3s;
    }

    .avatar-link:hover .avatar-overlay { opacity: 1; }
    .avatar-link:hover .user-avatar { transform: scale(1.1); }

    /* 🔘 User Management Styled Buttons (Identik dengan Penugasan) */
    .btn-circle {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.5rem;
        transition: all 0.2s;
        text-decoration: none;
    }

    .btn-circle:hover { transform: translateY(-2px); }

    .role-badge {
        font-size: 0.65rem;
        font-weight: 800;
        padding: 0.4rem 0.75rem;
        border-radius: 50rem;
        text-transform: uppercase;
    }
</style>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-800 text-dark mb-1">Manajemen Pengguna</h4>
            <p class="text-muted small mb-0">Total akun terdaftar yang mengelola sistem pengaduan.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="<?= base_url('users/print?' . http_build_query($_GET)) ?>" target="_blank" class="btn btn-outline-secondary btn-sm fw-bold px-3">
                <i class="bi bi-printer me-1"></i> Cetak
            </a>
            <a href="<?= base_url('users/create') ?>" class="btn btn-primary btn-sm fw-bold px-3 shadow-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah User
            </a>
        </div>
    </div>

    <div class="admin-card mb-4">
        <div class="p-3 bg-light bg-opacity-50 border-bottom">
            <form method="get" action="" class="row g-2">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                        <input type="text" name="keyword" class="form-control border-start-0 shadow-none" placeholder="Cari nama, email, atau username..." value="<?= $_GET['keyword'] ?? '' ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="role" class="form-select shadow-none fw-semibold">
                        <option value="">— Semua Hak Akses —</option>
                        <option value="admin" <?= (($_GET['role'] ?? '') == 'admin') ? 'selected' : '' ?>>Administrator</option>
                        <option value="teknisi" <?= (($_GET['role'] ?? '') == 'teknisi') ? 'selected' : '' ?>>Teknisi</option>
                        <option value="pelapor" <?= (($_GET['role'] ?? '') == 'pelapor') ? 'selected' : '' ?>>Pelapor</option>
                    </select>
                </div>
                <div class="col-md-4 d-flex gap-2">
                    <button type="submit" class="btn btn-dark fw-bold w-100">Filter</button>
                    <a href="<?= base_url('users') ?>" class="btn btn-outline-secondary fw-bold w-100">Reset</a>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table admin-table mb-0">
                <thead>
                    <tr>
                        <th class="text-center" width="70">ID</th>
                        <th>Identitas Pengguna</th>
                        <th>Username</th>
                        <th class="text-center">Hak Akses</th>
                        <th class="text-center" width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)): ?>
                        <?php foreach ($users as $u): ?>
                            <tr>
                                <td class="text-center">
                                    <span class="badge bg-light text-muted font-monospace border">#<?= $u['id_user'] ?></span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="<?= base_url('users/detail/' . $u['id_user']) ?>" class="avatar-link me-3">
                                            <img src="<?= $u['foto'] ? base_url('uploads/users/' . $u['foto']) : base_url('assets/img/default-user.png') ?>" class="user-avatar">
                                            <div class="avatar-overlay"><i class="bi bi-eye-fill"></i></div>
                                        </a>
                                        <div>
                                            <a href="<?= base_url('users/detail/' . $u['id_user']) ?>" class="fw-bold text-dark text-decoration-none d-block small mb-0 lh-1"><?= $u['nama'] ?></a>
                                            <span class="text-muted" style="font-size: 0.75rem;"><?= $u['email'] ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td><code class="text-primary fw-bold" style="font-size: 0.85rem;"><?= $u['username'] ?></code></td>
                                <td class="text-center">
                                    <?php 
                                        $badgeClass = 'bg-light text-dark border';
                                        if($u['role'] == 'admin') $badgeClass = 'bg-primary-soft';
                                        if($u['role'] == 'teknisi') $badgeClass = 'bg-info-soft';
                                        if($u['role'] == 'pelapor') $badgeClass = 'bg-warning-soft';
                                    ?>
                                    <span class="badge role-badge <?= $badgeClass ?>">
                                        <?= $u['role'] ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="<?= base_url('users/detail/' . $u['id_user']) ?>" class="btn-circle bg-light text-dark" title="Lihat Detail">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <?php if (session()->get('role') == 'admin') : ?>
                                            <a href="<?= base_url('users/edit/' . $u['id_user']) ?>" class="btn-circle bg-blue-soft" title="Edit Akun">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                            <a href="<?= base_url('users/delete/' . $u['id_user']) ?>" class="btn-circle bg-red-soft" onclick="return confirm('Hapus user ini?')" title="Hapus Akun">
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
                                <i class="bi bi-people text-muted fs-1"></i>
                                <p class="text-muted mt-2">Tidak ada pengguna ditemukan.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <div class="card-footer bg-white border-top py-3 d-flex justify-content-between align-items-center">
            <span class="small text-muted fw-semibold">Menampilkan <?= count($users) ?> data pengguna</span>
            <div><?= $pager->links() ?></div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>