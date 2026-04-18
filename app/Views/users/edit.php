<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* Admin One Form Styling */
    .form-card {
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        background-color: #ffffff;
    }

    .form-label-admin {
        color: #374151;
        font-size: .85rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .form-control-admin {
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        padding: 0.6rem 0.75rem;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }

    .form-control-admin:focus {
        border-color: var(--admin-one-primary);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        outline: 0;
    }

    .input-group-text-admin {
        background-color: #f9fafb;
        border: 1px solid #d1d5db;
        color: #6b7280;
    }

    .upload-zone {
        background-color: #f9fafb;
        border: 2px dashed #d1d5db;
        border-radius: 0.75rem;
        padding: 1.5rem;
        transition: border-color 0.2s;
    }

    .upload-zone:hover {
        border-color: var(--admin-one-primary);
    }

    .avatar-preview {
        width: 64px;
        height: 64px;
        border-radius: 0.5rem;
        object-fit: cover;
        border: 2px solid #fff;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    .btn-save {
        background-color: var(--admin-one-primary);
        color: #fff;
        font-weight: 700;
        border-radius: 0.5rem;
        padding: 0.6rem 2rem;
        border: none;
    }

    .btn-save:hover {
        background-color: #1d4ed8;
        color: #fff;
    }
</style>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex align-items-center">
                    <a href="<?= base_url('users') ?>" class="btn btn-light border btn-sm rounded me-3">
                        <i class="bi bi-chevron-left me-1"></i> Back
                    </a>
                    <div>
                        <h3 class="fw-800 text-dark mb-0">Update Profile</h3>
                        <p class="text-muted small mb-0">Modifikasi identitas akun untuk <strong><?= $user['nama'] ?></strong></p>
                    </div>
                </div>
            </div>

            <div class="card form-card shadow-sm">
                <div class="card-header bg-white border-bottom py-3 px-4">
                    <h5 class="mb-0 fw-bold text-dark"><i class="bi bi-pencil-square me-2 text-primary"></i>Account Details</h5>
                </div>
                <div class="card-body p-4">
                    <form action="<?= base_url('users/update/' . $user['id_user']) ?>" method="post" enctype="multipart/form-data">
                        
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label form-label-admin">Full Name</label>
                                <div class="input-group">
                                    <span class="input-group-text input-group-text-admin"><i class="bi bi-person"></i></span>
                                    <input type="text" name="nama" class="form-control form-control-admin" value="<?= $user['nama'] ?>" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label form-label-admin">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text input-group-text-admin"><i class="bi bi-envelope"></i></span>
                                    <input type="email" name="email" class="form-control form-control-admin" value="<?= $user['email'] ?>" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label form-label-admin">Username</label>
                                <input type="text" name="username" class="form-control form-control-admin" value="<?= $user['username'] ?>" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label form-label-admin">Password</label>
                                <input type="password" name="password" class="form-control form-control-admin" placeholder="Leave blank to keep current">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label form-label-admin">System Role</label>
                                <select name="role" class="form-select form-control-admin">
                                    <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Administrator</option>
                                    <option value="teknisi" <?= $user['role'] == 'teknisi' ? 'selected' : '' ?>>Technician</option>
                                    <option value="pelapor" <?= $user['role'] == 'pelapor' ? 'selected' : '' ?>>Reporter</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label form-label-admin">Profile Photo</label>
                                <div class="upload-zone d-flex align-items-center gap-4">
                                    <img src="<?= $user['foto'] ? base_url('uploads/users/' . $user['foto']) : base_url('assets/img/default-user.png') ?>" 
                                         class="avatar-preview">
                                    <div class="flex-grow-1">
                                        <input type="file" name="foto" class="form-control form-control-admin bg-white">
                                        <div class="mt-2 d-flex align-items-center text-muted" style="font-size: 0.75rem;">
                                            <i class="bi bi-info-circle me-1"></i> Max size 2MB (JPG or PNG)
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-5 pt-4 border-top d-flex justify-content-between align-items-center">
                            <div class="text-muted small">
                                <span class="badge bg-light text-dark border">UID: <?= $user['id_user'] ?></span>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="<?= base_url('users') ?>" class="btn btn-light px-4 fw-bold">Cancel</a>
                                <button type="submit" class="btn btn-save shadow-sm">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <p class="text-center mt-4 small text-muted font-monospace">SYSTEM v2.0 - SECURE MODULE</p>
        </div>
    </div>
</div>

<?= $this->endSection() ?>