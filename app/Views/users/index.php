<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* 💎 Elite Management Table Design */
    .admin-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 1rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        overflow: hidden;
    }

    .admin-table thead th {
        background-color: #f8fafc; /* Slate 50 */
        color: #64748b; /* Slate 500 */
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
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
        font-size: 0.875rem;
    }

    /* 🎨 Refined Soft Color Palette */
    .bg-primary-soft { background-color: #e0e7ff; color: #4338ca; } /* Admin */
    .bg-info-soft    { background-color: #f0f9ff; color: #0369a1; } /* Teknisi */
    .bg-warning-soft { background-color: #fffbeb; color: #92400e; } /* Pelapor */
    .bg-blue-soft    { background-color: #eff6ff; color: #1d4ed8; } /* Action Edit */
    .bg-red-soft     { background-color: #fef2f2; color: #b91c1c; } /* Action Delete */

    /* 👤 Modern Avatar Link */
    .avatar-link {
        position: relative;
        display: inline-block;
        width: 44px;
        height: 44px;
        border-radius: 12px;
        overflow: hidden;
        border: 2px solid #f1f5f9;
        background: #fff;
    }

    .user-avatar {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .avatar-overlay {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(15, 23, 42, 0.7);
        display: flex; align-items: center; justify-content: center;
        color: white; opacity: 0; transition: 0.3s;
    }

    .avatar-link:hover .avatar-overlay { opacity: 1; }
    .avatar-link:hover .user-avatar { transform: scale(1.15); }

    /* 🔘 Refined Action Buttons */
    .btn-circle {
        width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
        border: none;
    }

    .btn-circle:hover { 
        transform: translateY(-3px);
        filter: brightness(0.95);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .role-badge {
        font-size: 0.65rem;
        font-weight: 700;
        padding: 0.45rem 0.85rem;
        border-radius: 8px;
        text-transform: uppercase;
        letter-spacing: 0.025em;
    }

    .form-select, .form-control {
        border-radius: 0.75rem;
        padding: 0.6rem 1rem;
        border: 1.5px solid #e2e8f0;
        font-size: 0.9rem;
    }

    .form-control:focus, .form-select:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
    }
</style>

<div class="container-fluid py-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h4 class="fw-800 text-dark mb-1" style="letter-spacing: -0.02em;">Manajemen Pengguna</h4>
            <p class="text-muted small mb-0">Kelola kredensial dan hak akses seluruh personil sistem.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="<?= base_url('users/print?' . http_build_query($_GET)) ?>" target="_blank" class="btn btn-white border fw-bold px-3 py-2 small shadow-sm">
                <i class="bi bi-printer me-2 text-muted"></i> Cetak
            </a>
            <a href="<?= base_url('users/create') ?>" class="btn btn-primary fw-bold px-3 py-2 small shadow-sm">
                <i class="bi bi-person-plus-fill me-2"></i> Akun Baru
            </a>
        </div>
    </div>

    <div class="admin-card mb-4 border-0">
        <div class="p-4 bg-white">
            <form method="get" action="" class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label class="form-label small fw-800 text-muted text-uppercase" style="letter-spacing: 0.1em;">Pencarian</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-search"></i></span>
                        <input type="text" name="keyword" class="form-control border-start-0 shadow-none" placeholder="Nama, no_hp, atau username..." value="<?= $_GET['keyword'] ?? '' ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-800 text-muted text-uppercase" style="letter-spacing: 0.1em;">Filter Peran</label>
                    <select name="role" class="form-select shadow-none fw-semibold">
                        <option value="">Semua Akses</option>
                        <option value="admin" <?= (($_GET['role'] ?? '') == 'admin') ? 'selected' : '' ?>>Administrator</option>
                        <option value="teknisi" <?= (($_GET['role'] ?? '') == 'teknisi') ? 'selected' : '' ?>>Teknisi</option>
                        <option value="pelapor" <?= (($_GET['role'] ?? '') == 'pelapor') ? 'selected' : '' ?>>Pelapor</option>
                    </select>
                </div>
                <div class="col-md-4 d-flex gap-2">
                    <button type="submit" class="btn btn-dark fw-bold px-4 py-2 w-100">Search</button>
                    <a href="<?= base_url('users') ?>" class="btn btn-light border fw-bold px-4 py-2 w-100">Reset</a>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table admin-table mb-0">
                <thead>
                    <tr>
                        <th class="text-center" width="80">UID</th>
                        <th>Personil</th>
                        <th>Username</th>
                        <th class="text-center">Otoritas</th>
                        <th class="text-center" width="160">Aksi Cepat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)): ?>
                        <?php foreach ($users as $u): ?>
                            <tr>
                                <td class="text-center">
                                    <span class="text-muted font-monospace small fw-bold">#<?= $u['id_user'] ?></span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="<?= base_url('users/detail/' . $u['id_user']) ?>" class="avatar-link me-3">
                                            <img src="<?= $u['foto'] ? base_url('uploads/users/' . $u['foto']) : base_url('assets/img/default-user.png') ?>" class="user-avatar">
                                            <div class="avatar-overlay"><i class="bi bi-qr-code"></i></div>
                                        </a>
                                        <div>
                                            <a href="<?= base_url('users/detail/' . $u['id_user']) ?>" class="fw-bold text-dark text-decoration-none d-block lh-1 mb-1"><?= $u['nama'] ?></a>
                                            <span class="text-muted small"><?= $u['no_hp'] ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="p-2 bg-light rounded-3 me-2">
                                            <i class="bi bi-shield-lock-fill text-muted" style="font-size: 0.8rem;"></i>
                                        </div>
                                        <span class="fw-600 text-primary font-monospace" style="font-size: 0.85rem;"><?= $u['username'] ?></span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <?php 
                                        $badgeClass = 'bg-light text-dark';
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
                                        <a href="<?= base_url('users/detail/' . $u['id_user']) ?>" class="btn-circle bg-light text-secondary" title="View Profile">
                                            <i class="bi bi-grid-fill"></i>
                                        </a>
                                        <?php if (session()->get('role') == 'admin') : ?>
                                            <a href="<?= base_url('users/edit/' . $u['id_user']) ?>" class="btn-circle bg-blue-soft" title="Edit Access">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a href="<?= base_url('users/delete/' . $u['id_user']) ?>" class="btn-circle bg-red-soft" onclick="return confirm('Hapus personil ini secara permanen?')" title="Terminate Account">
                                                <i class="bi bi-person-x-fill"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="py-4">
                                    <i class="bi bi-people text-light display-1"></i>
                                    <p class="text-muted mt-3 fw-bold">Data pengguna tidak tersedia atau tidak ditemukan.</p>
                                    <a href="<?= base_url('users') ?>" class="btn btn-sm btn-outline-primary rounded-pill px-4">Refresh Data</a>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <div class="px-4 py-3 bg-white border-top d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
            <span class="small text-muted fw-bold">TOTAL RECORD: <span class="text-dark"><?= count($users) ?> PERSONIL</span></span>
            <div class="modern-pagination small">
                <?= $pager->links() ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>