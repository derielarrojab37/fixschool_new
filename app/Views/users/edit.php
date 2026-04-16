<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="d-flex align-items-center mb-4">
                <a href="<?= base_url('users') ?>" class="btn btn-outline-secondary btn-sm me-3"><i class="bi bi-chevron-left"></i></a>
                <h3 class="fw-bold mb-0">Edit User</h3>
            </div>

            <div class="card border-0 shadow-sm" style="background-color: #141824;">
                <div class="card-body p-4">
                    <form action="<?= base_url('users/update/' . $user['id_user']) ?>" method="post" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted small fw-bold">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" value="<?= $user['nama'] ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted small fw-bold">Email Address</label>
                                <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted small fw-bold">Username</label>
                                <input type="text" name="username" class="form-control" value="<?= $user['username'] ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted small fw-bold">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diubah">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label text-muted small fw-bold">Role Hak Akses</label>
                                <select name="role" class="form-select">
                                    <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                                    <option value="teknisi" <?= $user['role'] == 'teknisi' ? 'selected' : '' ?>>Teknisi</option>
                                    <option value="pelapor" <?= $user['role'] == 'pelapor' ? 'selected' : '' ?>>Pelapor</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label class="form-label text-muted small fw-bold">Ganti Foto Profil</label>
                                <div class="d-flex align-items-center gap-3">
                                    <img src="<?= $user['foto'] ? base_url('uploads/users/' . $user['foto']) : base_url('assets/img/default-user.png') ?>" 
                                         class="rounded-circle border border-secondary" width="60" height="60" style="object-fit: cover;">
                                    <input type="file" name="foto" class="form-control">
                                </div>
                            </div>
                        </div>
                        
                        <hr class="border-secondary mb-4">
                        
                        <div class="d-flex justify-content-end gap-2">
                            <a href="<?= base_url('users') ?>" class="btn btn-outline-secondary px-4">Batal</a>
                            <button type="submit" class="btn btn-primary px-4">Update Database</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>