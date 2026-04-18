<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* Argon Specific Styles for Form Edit */
    .card-argon {
        border: none;
        border-radius: 1rem;
        background-color: #ffffff;
        box-shadow: 0 0 2rem 0 rgba(136, 152, 170, .15) !important;
    }

    .form-label-argon {
        color: #8898aa;
        font-size: .75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .025em;
        margin-bottom: 0.5rem;
    }

    .form-control-argon {
        border: 1px solid #cad1d7;
        border-radius: 0.5rem;
        color: #495057;
        padding: 0.625rem 0.75rem;
        transition: all 0.2s ease;
    }

    .form-control-argon:focus {
        border-color: #5e72e4;
        box-shadow: 0 3px 9px rgba(50, 50, 93, 0.1), 0 1px 7px rgba(0, 0, 0, 0.08);
        outline: 0;
    }

    .btn-argon-primary {
        background-color: #5e72e4;
        color: #fff;
        border: none;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .025em;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08);
        transition: all 0.15s ease;
    }

    .btn-argon-primary:hover {
        background-color: #324cdd;
        transform: translateY(-1px);
        color: #fff;
    }

    .avatar-edit {
        width: 74px;
        height: 74px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #fff;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }

    .input-group-argon-text {
        background-color: #f6f9fc;
        border-right: none;
        color: #adb5bd;
    }
</style>

<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-8">
            
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex align-items-center">
                    <a href="<?= base_url('users') ?>" class="btn btn-sm btn-icon-only rounded-circle btn-outline-primary me-3">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                    <div>
                        <h4 class="fw-bold mb-0" style="color: #ffffff;">Edit User Profile</h4>
                        <p class="text-muted small mb-0" style="color: #ffffff;">Ubah informasi akun untuk user <strong><?= $user['nama'] ?></strong></p>
                    </div>
                </div>
            </div>

            <div class="card card-argon">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h6 class="text-uppercase text-muted ls-1 mb-1">User Information</h6>
                </div>
                <div class="card-body p-4">
                    <form action="<?= base_url('users/update/' . $user['id_user']) ?>" method="post" enctype="multipart/form-data">
                        
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label form-label-argon">Nama Lengkap</label>
                                <div class="input-group">
                                    <span class="input-group-text input-group-argon-text"><i class="bi bi-person"></i></span>
                                    <input type="text" name="nama" class="form-control form-control-argon" value="<?= $user['nama'] ?>" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label form-label-argon">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text input-group-argon-text"><i class="bi bi-envelope"></i></span>
                                    <input type="email" name="email" class="form-control form-control-argon" value="<?= $user['email'] ?>" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label form-label-argon">Username</label>
                                <input type="text" name="username" class="form-control form-control-argon" value="<?= $user['username'] ?>" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label form-label-argon">Password</label>
                                <input type="password" name="password" class="form-control form-control-argon" placeholder="Kosongkan jika tidak diubah">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label form-label-argon">Role Hak Akses</label>
                                <select name="role" class="form-select form-control-argon">
                                    <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                                    <option value="teknisi" <?= $user['role'] == 'teknisi' ? 'selected' : '' ?>>Teknisi</option>
                                    <option value="pelapor" <?= $user['role'] == 'pelapor' ? 'selected' : '' ?>>Pelapor</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label form-label-argon">Ganti Foto Profil</label>
                                <div class="d-flex align-items-center gap-4 p-3 rounded" style="background-color: #f8f9fe; border: 1px dashed #cad1d7;">
                                    <img src="<?= $user['foto'] ? base_url('uploads/users/' . $user['foto']) : base_url('assets/img/default-user.png') ?>" 
                                         class="avatar-edit">
                                    <div class="flex-grow-1">
                                        <input type="file" name="foto" class="form-control form-control-argon bg-white">
                                        <small class="text-muted mt-2 d-block">Format: JPG, PNG. Ukuran maksimal 2MB.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-5 pt-4 border-top d-flex justify-content-between align-items-center">
                            <span class="text-xs text-muted">ID User: #<?= $user['id_user'] ?></span>
                            <div class="d-flex gap-3">
                                <a href="<?= base_url('users') ?>" class="btn btn-link text-muted fw-bold text-decoration-none">Batal</a>
                                <button type="submit" class="btn btn-argon-primary px-5 py-2">Simpan Perubahan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <p class="text-center mt-4 small text-muted">© 2026 Argon Dashboard System</p>
        </div>
    </div>
</div>

<?= $this->endSection() ?>