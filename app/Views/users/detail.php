<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid py-4">
    <div class="mb-4">
        <a href="<?= base_url('users') ?>" class="btn btn-link text-decoration-none text-muted p-0 mb-2 small">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke daftar
        </a>
        <h3 class="fw-bold">Detail User</h3>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm text-center p-4" style="background-color: #141824;">
                <div class="mb-3">
                    <img src="<?= $user['foto'] ? base_url('uploads/users/' . $user['foto']) : base_url('assets/img/default-user.png') ?>" 
                         class="rounded-circle border border-4 border-primary p-1" width="120" height="120" style="object-fit: cover;">
                </div>
                <h5 class="fw-bold mb-1"><?= $user['nama'] ?></h5>
                <span class="badge bg-primary-subtle text-primary rounded-pill px-3 mb-3"><?= ucfirst($user['role']) ?></span>
                
                <?php if (session()->get('role') == 'admin') : ?>
                    <a href="<?= base_url('users/edit/' . $user['id_user']) ?>" class="btn btn-outline-primary btn-sm w-100">
                        <i class="bi bi-pencil me-2"></i>Edit Profile
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card border-0 shadow-sm" style="background-color: #141824;">
                <div class="card-body p-4">
                    <h6 class="text-primary fw-bold mb-4">Informasi Akun</h6>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted small fw-bold">Email</div>
                        <div class="col-sm-8"><?= $user['email'] ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted small fw-bold">Username</div>
                        <div class="col-sm-8 text-white-50"><?= $user['username'] ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted small fw-bold">Password</div>
                        <div class="col-sm-8 text-muted italic">******** (Tersandi)</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 text-muted small fw-bold">Status Login</div>
                        <div class="col-sm-8 text-success small"><i class="bi bi-check-circle-fill me-1"></i> Akun Aktif</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>