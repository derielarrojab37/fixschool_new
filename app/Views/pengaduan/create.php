<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* Admin One Form Design */
    .admin-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        overflow: hidden;
    }

    .form-header-gradient {
        background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        padding: 2rem;
        color: white;
    }

    .upload-box {
        border: 2px dashed #e5e7eb;
        border-radius: 0.5rem;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
        background: #f9fafb;
    }

    .upload-box:hover {
        border-color: #2563eb;
        background: #f0f7ff;
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
        gap: 0.5 mil;
    }

    .form-control, .form-select {
        border: 1px solid #e5e7eb;
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        transition: border-color 0.2s;
    }

    .form-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .btn-submit {
        background: #2563eb;
        color: white;
        font-weight: 700;
        padding: 0.75rem 2rem;
        border-radius: 0.5rem;
        border: none;
        transition: all 0.2s;
    }

    .btn-submit:hover {
        background: #1d4ed8;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('pengaduan') ?>" class="text-decoration-none text-muted">Pengaduan</a></li>
                    <li class="breadcrumb-item active fw-bold text-dark" aria-current="page">Buat Laporan</li>
                </ol>
            </nav>

            <div class="admin-card shadow-sm">
                <div class="form-header-gradient">
                    <div class="d-flex align-items-center">
                        <div class="bg-white bg-opacity-20 rounded-circle p-3 me-3">
                            <i class="bi bi-megaphone-fill fs-3"></i>
                        </div>
                        <div>
                            <h3 class="fw-800 mb-0">Buat Pengaduan</h3>
                            <p class="mb-0 opacity-75">Lengkapi formulir di bawah untuk mengirim laporan Anda.</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form action="<?= base_url('pengaduan/store') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <label class="form-label"><i class="bi bi-chat-left-text me-2"></i> Subjek / Judul Laporan</label>
                                <input type="text" name="judul" class="form-control" placeholder="Contoh: Lampu Ruang Lab Komputer Pecah" required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label"><i class="bi bi-geo-alt me-2"></i> Lokasi Kejadian</label>
                                <input type="text" name="lokasi" class="form-control" placeholder="Contoh: Gedung C Lantai 1" required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label"><i class="bi bi-tag me-2"></i> Kategori Laporan</label>
                                <select name="id_jenis" class="form-select" required>
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    <?php foreach($jenis as $j): ?>
                                        <option value="<?= $j['id_jenis'] ?>"><?= $j['nama_jenis'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-12 mb-4">
                                <label class="form-label"><i class="bi bi-justify-left me-2"></i> Deskripsi Kerusakan</label>
                                <textarea name="deskripsi" class="form-control" rows="5" placeholder="Gambarkan kondisi kerusakan secara lengkap agar mudah dipahami petugas..." required></textarea>
                            </div>
                            
                            <div class="col-md-12 mb-5">
                                <label class="form-label"><i class="bi bi-camera me-2"></i> Lampiran Bukti Foto</label>
                                <div class="upload-box" onclick="document.getElementById('fotoInput').click();">
                                    <i class="bi bi-cloud-arrow-up display-6 text-primary mb-2 d-block"></i>
                                    <span id="fileName" class="fw-bold text-dark">Klik untuk pilih berkas</span>
                                    <p class="small text-muted mt-1 mb-0">Atau seret foto ke sini (JPG, PNG, WEBP max 2MB)</p>
                                    <input type="file" name="foto" id="fotoInput" class="d-none" accept="image/*" onchange="updateFileName(this)">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center border-top pt-4">
                            <a href="<?= base_url('pengaduan') ?>" class="btn btn-link text-muted fw-bold text-decoration-none">
                                <i class="bi bi-x-lg me-1"></i> Batalkan
                            </a>
                            <button type="submit" class="btn btn-submit">
                                Kirim Laporan Sekarang <i class="bi bi-send-fill ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="admin-card bg-light border-0 mt-4 p-3 d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3">
                    <i class="bi bi-lightbulb-fill text-primary fs-4"></i>
                </div>
                <div>
                    <span class="d-block fw-bold small text-dark">Tips Cepat</span>
                    <p class="small text-muted mb-0">Pastikan pencahayaan cukup saat mengambil foto bukti agar teknisi bisa langsung mengidentifikasi alat yang diperlukan.</p>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function updateFileName(input) {
        const fileName = input.files[0] ? input.files[0].name : "Klik untuk pilih berkas";
        document.getElementById('fileName').innerText = fileName;
        document.getElementById('fileName').classList.add('text-primary');
    }
</script>

<?= $this->endSection() ?>