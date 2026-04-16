<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Data Users</h3>
        <div class="d-flex gap-2">
            <a href="<?= base_url('users/print?' . http_build_query($_GET)) ?>" target="_blank" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-printer me-1"></i> Print
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4" style="background-color: #141824;">
        <div class="card-body">
            <form method="get" action="" class="row g-3">
                <div class="col-md-4">
                    <div class="form-icon-container">
                        <input type="text" name="keyword" class="form-control form-control-sm" placeholder="Cari nama..." value="<?= $_GET['keyword'] ?? '' ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="role" class="form-select form-select-sm">
                        <option value="">-- Semua Role --</option>
                        <option value="admin" <?= (($_GET['role'] ?? '') == 'admin') ? 'selected' : '' ?>>Admin</option>
                        <option value="teknisi" <?= (($_GET['role'] ?? '') == 'teknisi') ? 'selected' : '' ?>>Teknisi</option>
                        <option value="pelapor" <?= (($_GET['role'] ?? '') == 'pelapor') ? 'selected' : '' ?>>Pelapor</option>
                    </select>
                </div>
                <div class="col-md-5 d-flex gap-2">
                    <button type="submit" class="btn btn-primary btn-sm px-4">Cari</button>
                    <a href="<?= base_url('users') ?>" class="btn btn-link btn-sm text-muted text-decoration-none">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show small py-2" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm" style="background-color: #141824;">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" style="color: #eff2f6;">
                <thead style="background-color: rgba(255,255,255,0.03);">
                    <tr>
                        <th class="ps-4">No</th>
                        <th>User</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)): ?>
                        <?php $no = 1 + (10 * ($pager->getCurrentPage() - 1)); ?>
                        <?php foreach ($users as $u): ?>
                            <tr>
                                <td class="ps-4 text-muted small"><?= $no++ ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="<?= $u['foto'] ? base_url('uploads/users/' . $u['foto']) : base_url('assets/img/default-user.png') ?>" 
                                             class="rounded-circle me-3" width="35" height="35" style="object-fit: cover; border: 1px solid #31374a;">
                                        <div>
                                            <div class="fw-bold mb-0"><?= $u['nama'] ?></div>
                                            <div class="text-muted small"><?= $u['email'] ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="small"><?= $u['username'] ?></td>
                                <td>
                                    <?php 
                                        $badge = 'bg-secondary';
                                        if($u['role'] == 'admin') $badge = 'bg-primary';
                                        if($u['role'] == 'teknisi') $badge = 'bg-info text-dark';
                                    ?>
                                    <span class="badge <?= $badge ?> rounded-pill small"><?= ucfirst($u['role']) ?></span>
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-sm text-muted" data-bs-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i></button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow border-secondary">
                                            <li><a class="dropdown-item small" href="<?= base_url('users/detail/' . $u['id_user']) ?>"><i class="bi bi-eye me-2"></i> Detail</a></li>
                                            <?php if (session()->get('role') == 'admin') : ?>
                                                <li><a class="dropdown-item small" href="<?= base_url('users/edit/' . $u['id_user']) ?>"><i class="bi bi-pencil me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item small text-success" href="<?= base_url('users/wa/' . $u['id_user']) ?>" target="_blank"><i class="bi bi-whatsapp me-2"></i> WhatsApp</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item small text-danger" href="<?= base_url('users/delete/' . $u['id_user']) ?>" onclick="return confirm('Hapus user ini?')"><i class="bi bi-trash me-2"></i> Hapus</a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="5" class="text-center py-5 text-muted small">Belum ada data user</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4 d-flex justify-content-center">
        <?= $pager->links() ?>
    </div>
</div>

<?= $this->endSection() ?>