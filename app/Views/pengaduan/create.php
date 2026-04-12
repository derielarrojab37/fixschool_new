<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h4>Buat Pengaduan</h4>

<form method="post" action="<?= base_url('/pengaduan/store') ?>" enctype="multipart/form-data">

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('pengaduan') ?>" class="text-decoration-none">Pengaduan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Buat Laporan</li>
                </ol>
            </nav>

            <div class="form-card">
                <div class="form-header d-flex align-items-center">
                    <div class="bg-white bg-opacity-20 rounded-3 p-3 me-3">
                        <i class="bi bi-megaphone-fill fs-3 text-white"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0">Buat Laporan Pengaduan</h4>
                        <p class="mb-0 opacity-75 small">Sampaikan keluhan atau kerusakan fasilitas sekolah Anda</p>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form action="<?= base_url('pengaduan/store') ?>" method="post" enctype="multipart/form-data">
                        
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <label class="form-label"><i class="bi bi-type"></i> Subjek / Judul Laporan</label>
                                <input type="text" name="judul" class="form-control" placeholder="Contoh: AC Kelas XI-A Mati" required>
                            </div>

                            <div class="col-md-12 mb-4">
                                <label class="form-label"><i class="bi bi-geo-alt"></i> Lokasi Kejadian</label>
                                <input type="text" name="lokasi" class="form-control" placeholder="Contoh: Gedung B Lantai 2">
                            </div>

                            <div class="col-md-12 mb-4">
                                <label class="form-label"><i class="bi bi-card-text"></i> Detail Kerusakan</label>
                                <textarea name="deskripsi" class="form-control" placeholder="Jelaskan secara detail mengenai kerusakan atau keluhan Anda..." required></textarea>
                            </div>
                            
                            <div class="col-md-12 mb-4">
                                <label class="form-label">
                                    <i class="bi bi-person-badge"></i> Jenis Pelapor
                                </label>
                                <select name="id_jenis" class="form-control" required>
                                    <option value="">-- Pilih Jenis Pelapor --</option>
                                <?php foreach($jenis as $j): ?>
                                    <option value="<?= $j['id_jenis'] ?>">
                                <?= $j['nama_jenis'] ?>
                                    </option>
                                <?php endforeach; ?>
                                 </select>
                            </div>
                            <div class="col-md-12 mb-5">
                            <label class="form-label"><i class="bi bi-camera"></i> Bukti Foto</label>
                                <div class="upload-box" onclick="document.getElementById('fotoInput').click();" style="cursor: pointer;">
                                     <i class="bi bi-cloud-arrow-up display-6 text-muted mb-2 d-block"></i>
                                    <span id="fileName" class="text-muted small">Klik untuk unggah foto atau drag & drop</span>
                                    <input type="file" name="foto" id="fotoInput" class="form-control d-none" onchange="document.getElementById('fileName').innerText = this.files[0].name">
                                    <p class="small text-muted mt-2 mb-0">Format: JPG, PNG, WEBP (Maksimal 2MB)</p>
                                 </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center border-top pt-4">
                            <a href="<?= base_url('pengaduan') ?>" class="text-muted text-decoration-none fw-semibold">
                                <i class="bi bi-arrow-left me-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-submit px-5">
                                Kirim Laporan <i class="bi bi-send-fill ms-2"></i>
                            </button>
                        </div>

                    </form>
                </div>
            </div>

            <div class="mt-4 p-3 rounded-4 bg-primary-subtle border-0 d-flex align-items-center">
                <i class="bi bi-lightbulb text-primary fs-4 me-3"></i>
                <small class="text-primary-emphasis"><b>Tips:</b> Lampirkan foto yang jelas agar tim teknisi kami dapat mengidentifikasi masalah lebih cepat.</small>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>