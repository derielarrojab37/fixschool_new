<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h4>Edit Pengaduan</h4>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?= base_url('pengaduan') ?>">Pengaduan</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Laporan</li>
                </ol>
            </nav>

            <div class="form-card">
                <div class="form-header d-flex align-items-center">
                    <div class="bg-white bg-opacity-20 rounded-3 p-3 me-3">
                        <i class="bi bi-pencil-square fs-3 text-white"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0">Edit Laporan Pengaduan</h4>
                        <p class="mb-0 opacity-75 small">Perbaiki atau lengkapi laporan Anda</p>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">

                    <form method="post" action="<?= base_url('/pengaduan/update/' . $pengaduan['id_pengaduan']) ?>" enctype="multipart/form-data">

                        <div class="row">

                            <!-- JUDUL -->
                            <div class="col-md-12 mb-4">
                                <label class="form-label">
                                    <i class="bi bi-type"></i> Judul Laporan
                                </label>
                                <input type="text" name="judul" class="form-control"
                                    value="<?= $pengaduan['judul'] ?>" required>
                            </div>

                            <!-- LOKASI -->
                            <div class="col-md-12 mb-4">
                                <label class="form-label">
                                    <i class="bi bi-geo-alt"></i> Lokasi
                                </label>
                                <input type="text" name="lokasi" class="form-control"
                                    value="<?= $pengaduan['lokasi'] ?>">
                            </div>

                            <!-- JENIS PELAPOR -->
                            <div class="col-md-12 mb-4">
                                <label class="form-label">
                                    <i class="bi bi-person-badge"></i> Jenis Pelapor
                                </label>
                                <select name="id_jenis" class="form-control" required>
                                    <?php foreach($jenis as $j): ?>
                                        <option value="<?= $j['id_jenis'] ?>"
                                            <?= $j['id_jenis'] == $pengaduan['id_jenis'] ? 'selected' : '' ?>>
                                            <?= $j['nama_jenis'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- DESKRIPSI -->
                            <div class="col-md-12 mb-4">
                                <label class="form-label">
                                    <i class="bi bi-card-text"></i> Deskripsi
                                </label>
                                <textarea name="deskripsi" class="form-control" required><?= $pengaduan['deskripsi'] ?></textarea>
                            </div>

                            <!-- FOTO -->
                            <div class="col-md-12 mb-5">
                                <label class="form-label">
                                    <i class="bi bi-camera"></i> Foto
                                </label>

                                <?php if($pengaduan['foto']): ?>
                                    <div class="mb-2">
                                        <img src="<?= base_url('uploads/pengaduan/'.$pengaduan['foto']) ?>" 
                                             width="150" class="rounded shadow-sm">
                                    </div>
                                <?php endif; ?>

                                <input type="file" name="foto" class="form-control">
                                <small class="text-muted">Kosongkan jika tidak ingin mengubah foto</small>
                            </div>

                        </div>

                        <!-- BUTTON -->
                        <div class="d-flex justify-content-between border-top pt-4">
                            <a href="<?= base_url('pengaduan') ?>" class="btn btn-light">
                                <i class="bi bi-arrow-left"></i> Batal
                            </a>

                            <button type="submit" class="btn btn-warning px-4">
                                <i class="bi bi-save"></i> Update
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>