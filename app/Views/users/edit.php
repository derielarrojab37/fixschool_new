<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<link rel="icon" href="<?= base_url('assets/img/FS_No_BG.png') ?>">

<style>
    /* 💎 Elite Form Styling */
    .form-card {
        border: 1px solid #e2e8f0;
        border-radius: 1.25rem;
        background-color: #ffffff;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
    }

    .form-label-admin {
        color: #475569; /* Slate 600 */
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.6rem;
        display: block;
    }

    .form-control-admin, .form-select-admin {
        border: 1.5px solid #e2e8f0;
        border-radius: 0.85rem;
        padding: 0.75rem 1rem;
        font-size: 0.9rem;
        font-weight: 500;
        color: #1e293b;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .form-control-admin:focus, .form-select-admin:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        outline: 0;
        background-color: #fff;
    }

    .input-group-text-admin {
        background-color: #f8fafc;
        border: 1.5px solid #e2e8f0;
        border-right: none;
        color: #94a3b8;
        border-radius: 0.85rem 0 0 0.85rem;
    }

    .form-control-admin.with-group {
        border-left: none;
        border-radius: 0 0.85rem 0.85rem 0;
    }

    /* 📸 Professional Upload Zone */
    .upload-zone {
        background-color: #f8fafc;
        border: 2px dashed #cbd5e1;
        border-radius: 1rem;
        padding: 1.5rem;
        transition: all 0.3s ease;
        position: relative;
    }

    .upload-zone:hover {
        border-color: #2563eb;
        background-color: #eff6ff;
    }

    .avatar-preview {
        width: 80px;
        height: 80px;
        border-radius: 1rem;
        object-fit: cover;
        border: 3px solid #fff;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .btn-save {
        background-color: #2563eb;
        color: #fff;
        font-weight: 700;
        border-radius: 0.85rem;
        padding: 0.8rem 2.5rem;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-save:hover {
        background-color: #1d4ed8;
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3);
        color: #fff;
    }

    .btn-cancel {
        border-radius: 0.85rem;
        padding: 0.8rem 1.5rem;
        font-weight: 600;
        color: #64748b;
    }
</style>

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex align-items-center">
                    <a href="<?= base_url('users') ?>" class="btn btn-white border shadow-sm btn-sm rounded-3 me-3">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                    <div>
                        <h4 class="fw-800 text-dark mb-0" style="letter-spacing: -0.02em;">Edit Profil</h4>
                        <p class="text-muted small mb-0">Kelola informasi personil ID: <span class="badge bg-soft-primary text-primary">#<?= $user['id_user'] ?></span></p>
                    </div>
                </div>
            </div>

            <div class="card form-card border-0">
                <div class="card-header bg-white border-bottom py-4 px-4">
                    <div class="d-flex align-items-center">
                        <div class="p-2 bg-blue-soft rounded-3 me-3">
                            <i class="bi bi-person-gear text-primary fs-4"></i>
                        </div>
                        <h5 class="mb-0 fw-bold text-dark">Informasi Akun & Akses</h5>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form action="<?= base_url('users/update/' . $user['id_user']) ?>" method="post" enctype="multipart/form-data">
                        
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label form-label-admin">Nama Lengkap</label>
                                <div class="input-group">
                                    <span class="input-group-text input-group-text-admin"><i class="bi bi-person"></i></span>
                                    <input type="text" name="nama" class="form-control form-control-admin with-group" value="<?= $user['nama'] ?>" required placeholder="Masukkan nama lengkap...">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label form-label-admin">Alamat Email</label>
                                <div class="input-group">
                                    <span class="input-group-text input-group-text-admin"><i class="bi bi-envelope"></i></span>
                                    <input type="email" name="email" class="form-control form-control-admin with-group" value="<?= $user['email'] ?>" required placeholder="name@school.com">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label form-label-admin">Username Utama</label>
                                <input type="text" name="username" class="form-control form-control-admin" value="<?= $user['username'] ?>" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label form-label-admin">Kata Sandi Baru</label>
                                <input type="password" name="password" class="form-control form-control-admin" placeholder="Kosongkan jika tidak ingin diubah">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label form-label-admin">Otoritas Sistem (Role)</label>
                                <select name="role" class="form-select form-select-admin">
                                    <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Administrator (Full Control)</option>
                                    <option value="teknisi" <?= $user['role'] == 'teknisi' ? 'selected' : '' ?>>Technician (Service Handler)</option>
                                    <option value="pelapor" <?= $user['role'] == 'pelapor' ? 'selected' : '' ?>>Reporter (Standard User)</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label form-label-admin">Foto Profil</label>
                                <div class="upload-zone d-flex align-items-center gap-4">
                                    <div class="position-relative">
                                        <img src="<?= $user['foto'] ? base_url('uploads/users/' . $user['foto']) : base_url('assets/img/default-user.png') ?>" 
                                             class="avatar-preview" id="previewImg">
                                    </div>
                                    <div class="flex-grow-1">
                                        <input type="file" name="foto" class="form-control form-control-admin bg-white" onchange="previewFile(this)">
                                        <div class="mt-2 d-flex align-items-center text-slate-500" style="font-size: 0.75rem;">
                                            <i class="bi bi-info-circle-fill me-2 text-primary"></i> 
                                            Format yang didukung: <strong>JPG, PNG, WEBP</strong>. Maksimal 2MB.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-5 pt-4 border-top d-flex justify-content-between align-items-center">
                            <div class="d-none d-sm-block">
                                <span class="text-muted small fw-bold text-uppercase">Otoritas Modifikasi: <strong><?= session('role') ?></strong></span>
                            </div>
                            <div class="d-flex gap-3">
                                <a href="<?= base_url('users') ?>" class="btn btn-light btn-cancel fw-bold">Batalkan</a>
                                <button type="submit" class="btn btn-save shadow-sm">
                                    <i class="bi bi-check-circle-fill me-2"></i> Perbarui Data
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <p class="text-center mt-4 mb-5 small text-muted">
                <i class="bi bi-shield-check me-1"></i> Data dienkripsi dan diamankan oleh modul inti sistem v2.1
            </p>
        </div>
    </div>
</div>

<script>
    // Preview Gambar Sebelum Upload
    function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];
        if(file){
            var reader = new FileReader();
            reader.onload = function(){
                $("#previewImg").attr("src", reader.result);
            }
            reader.readAsDataURL(file);
        }
    }
</script>

<?= $this->endSection() ?>