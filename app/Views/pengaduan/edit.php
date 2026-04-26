<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<link rel="icon" href="<?= base_url('assets/img/FS_No_BG.png') ?>">

<style>
    /* Admin One Design Consistency */
    .admin-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        overflow: hidden;
    }

    .form-header-edit {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        padding: 2rem;
        color: white;
    }

    .form-label {
        font-weight: 700;
        font-size: 0.85rem;
        color: #374151;
        text-transform: uppercase;
        letter-spacing: 0.025em;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
    }

    .form-control, .form-select {
        border: 1px solid #e5e7eb;
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
    }

    .form-control:focus {
        border-color: #f59e0b;
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
    }

    .preview-img-container {
        position: relative;
        display: inline-block;
        border: 4px solid #f3f4f6;
        border-radius: 0.5rem;
        margin-bottom: 1rem;
    }

    .btn-update {
        background: #f59e0b;
        color: white;
        font-weight: 700;
        padding: 0.75rem 2.5rem;
        border-radius: 0.5rem;
        border: none;
        transition: all 0.2s;
    }

    .btn-update:hover {
        background: #d97706;
        transform: translateY(-1px);
    }
</style>

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb small fw-bold">
                    <li class="breadcrumb-item"><a href="<?= base_url('pengaduan') ?>" class="text-decoration-none text-muted">Pengaduan</a></li>
                    <li class="breadcrumb-item active text-warning" aria-current="page">Edit Laporan</li>
                </ol>
            </nav>

            <div class="admin-card shadow-sm">
                <div class="form-header-edit">
                    <div class="d-flex align-items-center">
                        <div class="bg-white bg-opacity-20 rounded-circle p-3 me-3">
                            <i class="bi bi-pencil-square fs-3"></i>
                        </div>
                        <div>
                            <h3 class="fw-800 mb-0">Edit Laporan</h3>
                            <p class="mb-0 opacity-75 small">ID Laporan: #PGN-<?= str_pad($pengaduan['id_pengaduan'], 4, '0', STR_PAD_LEFT) ?></p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form method="post" action="<?= base_url('/pengaduan/update/' . $pengaduan['id_pengaduan']) ?>" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <label class="form-label"><i class="bi bi-type me-2"></i> Subjek / Judul Laporan</label>
                                <input type="text" name="judul" class="form-control" value="<?= $pengaduan['judul'] ?>" required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label"><i class="bi bi-geo-alt me-2"></i> Lokasi</label>
                                <input type="text" name="lokasi" class="form-control" value="<?= $pengaduan['lokasi'] ?>" required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label"><i class="bi bi-tag me-2"></i> Kategori</label>
                                <select name="id_jenis" class="form-select" required>
                                    <?php foreach($jenis as $j): ?>
                                        <option value="<?= $j['id_jenis'] ?>" <?= $j['id_jenis'] == $pengaduan['id_jenis'] ? 'selected' : '' ?>>
                                            <?= $j['nama_jenis'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-12 mb-4">
                                <label class="form-label"><i class="bi bi-justify-left me-2"></i> Detail Laporan</label>
                                <textarea name="deskripsi" class="form-control" rows="5" required><?= $pengaduan['deskripsi'] ?></textarea>
                            </div>

                            <div class="col-md-12 mb-5">
                                <label class="form-label"><i class="bi bi-camera me-2"></i> Foto Bukti</label>
                                
                                <?php if($pengaduan['foto']): ?>
                                    <div class="preview-img-container">
                                        <img src="<?= base_url('uploads/pengaduan/'.$pengaduan['foto']) ?>" width="200" class="rounded shadow-sm">
                                        <div class="small text-muted mt-2 text-center italic">Foto saat ini</div>
                                    </div>
                                <?php endif; ?>

                                <div class="mt-2">
                                    <input type="file" name="foto" class="form-control">
                                    <p class="small text-muted mt-2">
                                        <i class="bi bi-info-circle me-1"></i> Biarkan kosong jika tidak ingin mengganti foto lama.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center border-top pt-4">
                            <a href="<?= base_url('pengaduan') ?>" class="btn btn-link text-muted fw-bold text-decoration-none">
                                <i class="bi bi-arrow-left me-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-update">
                                Simpan Perubahan <i class="bi bi-check-circle-fill ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>