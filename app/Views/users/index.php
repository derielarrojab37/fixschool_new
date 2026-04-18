<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* Custom Styling Argon untuk Tabel */
    .card-argon {
        border: none;
        border-radius: 1rem;
        background-color: #ffffff;
        box-shadow: 0 0 2rem 0 rgba(136, 152, 170, .15) !important;
    }
    
    .table thead th {
        background-color: #f6f9fc;
        color: #8898aa;
        text-transform: uppercase;
        font-size: .65rem;
        padding-top: .75rem;
        padding-bottom: .75rem;
        letter-spacing: 1px;
        border-bottom: 1px solid #e9ecef;
    }

    .table tbody td {
        font-size: .8125rem;
        white-space: nowrap;
        padding: 1rem;
    }

    .avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #fff;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .badge-dot {
        padding-left: 0;
        padding-right: 0;
        background: transparent;
        color: #525f7f;
        font-size: .875rem;
        font-weight: 400;
        text-transform: none;
    }

    .badge-dot i {
        display: inline-block;
        vertical-align: middle;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        margin-right: .5rem;
    }

    /* Argon Button & Form */
    .btn-argon-primary {
        background-color: #5e72e4;
        color: #fff;
        border: none;
        box-shadow: 0 4px 6px rgba(50,50,93,.11), 0 1px 3px rgba(0,0,0,.08);
    }

    .form-argon {
        border-radius: 0.5rem;
        border: 1px solid #cad1d7;
        transition: box-shadow .15s ease;
    }
    .form-argon:focus {
        box-shadow: 0 4px 6px rgba(50,50,93,.11), 0 1px 3px rgba(0,0,0,.08);
        border-color: #5e72e4;
    }
</style>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0" style="color: #32325d;">Data Users</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-links bg-transparent p-0 m-0">
                    <li class="breadcrumb-item small"><a href="#"><i class="bi bi-house-door-fill text-primary"></i></a></li>
                    <li class="breadcrumb-item small active" aria-current="page text-muted">Users List</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex gap-2">
            <a href="<?= base_url('users/print?' . http_build_query($_GET)) ?>" target="_blank" class="btn btn-sm btn-outline-primary shadow-sm px-3">
                <i class="bi bi-printer me-1"></i> Print
            </a>
            <a href="<?= base_url('users/create') ?>" class="btn btn-sm btn-argon-primary px-3">
                <i class="bi bi-plus-lg me-1"></i> Tambah User
            </a>
        </div>
    </div>

    <div class="card card-argon mb-4">
        <div class="card-body">
            <form method="get" action="" class="row g-2 align-items-center">
                <div class="col-md-4">
                    <div class="input-group input-group-merge">
                        <span class="input-group-text border-end-0 bg-transparent text-muted"><i class="bi bi-search"></i></span>
                        <input type="text" name="keyword" class="form-control form-control-sm form-argon border-start-0" placeholder="Cari nama..." value="<?= $_GET['keyword'] ?? '' ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="role" class="form-select form-select-sm form-argon">
                        <option value="">-- Semua Role --</option>
                        <option value="admin" <?= (($_GET['role'] ?? '') == 'admin') ? 'selected' : '' ?>>Admin</option>
                        <option value="teknisi" <?= (($_GET['role'] ?? '') == 'teknisi') ? 'selected' : '' ?>>Teknisi</option>
                        <option value="pelapor" <?= (($_GET['role'] ?? '') == 'pelapor') ? 'selected' : '' ?>>Pelapor</option>
                    </select>
                </div>
                <div class="col-md-5 d-flex gap-2">
                    <button type="submit" class="btn btn-argon-primary btn-sm px-4">Filter</button>
                    <a href="<?= base_url('users') ?>" class="btn btn-link btn-sm text-muted text-decoration-none">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success border-0 text-white alert-dismissible fade show small" role="alert" style="background-color: #2dce89;">
            <i class="bi bi-check-circle-fill me-2"></i> <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card card-argon shadow border-0">
        <div class="card-header border-0 bg-transparent py-3">
            <h6 class="mb-0 fw-bold" style="color: #32325d;">User Management Table</h6>
        </div>
        <div class="table-responsive">
            <table class="table table-flush align-middle mb-0">
                <thead class="thead-light">
                    <tr>
                        <th class="ps-4">No</th>
                        <th>User Profile</th>
                        <th>Username</th>
                        <th>Role Status</th>
                        <th class="text-center">Action</th>
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
                                             class="avatar me-3 shadow-sm">
                                        <div>
                                            <span class="mb-0 text-sm fw-bold d-block text-dark"><?= $u['nama'] ?></span>
                                            <span class="text-muted text-xs"><?= $u['email'] ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-muted"><?= $u['username'] ?></span>
                                </td>
                                <td>
                                    <?php 
                                        $dotColor = 'bg-secondary';
                                        if($u['role'] == 'admin') $dotColor = 'bg-primary';
                                        if($u['role'] == 'teknisi') $dotColor = 'bg-info';
                                        if($u['role'] == 'pelapor') $dotColor = 'bg-warning';
                                    ?>
                                    <span class="badge badge-dot">
                                        <i class="<?= $dotColor ?>"></i>
                                        <span class="status"><?= ucfirst($u['role']) ?></span>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-icon-only text-light" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical text-muted"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow shadow border-0 p-2" style="border-radius: 0.5rem;">
                                            <li><a class="dropdown-item py-2" href="<?= base_url('users/detail/' . $u['id_user']) ?>"><i class="bi bi-eye text-info me-2"></i> Detail</a></li>
                                            <?php if (session()->get('role') == 'admin') : ?>
                                                <li><a class="dropdown-item py-2" href="<?= base_url('users/edit/' . $u['id_user']) ?>"><i class="bi bi-pencil text-primary me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item py-2 text-success" href="<?= base_url('users/wa/' . $u['id_user']) ?>" target="_blank"><i class="bi bi-whatsapp me-2"></i> WhatsApp</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item py-2 text-danger" href="<?= base_url('users/delete/' . $u['id_user']) ?>" onclick="return confirm('Hapus user ini?')"><i class="bi bi-trash me-2"></i> Hapus</a></li>
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
        
        <div class="card-footer py-4 bg-transparent border-0 d-flex justify-content-center">
            <?= $pager->links() ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>