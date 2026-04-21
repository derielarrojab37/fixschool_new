<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* 💎 Premium Form Design */
    .form-wrapper {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 1.5rem;
        overflow: hidden;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
    }

    .form-header-premium {
        background: #1e293b; /* Deep Slate */
        padding: 2.5rem;
        position: relative;
        overflow: hidden;
    }

    .form-header-premium::after {
        content: "";
        position: absolute;
        top: -50px;
        right: -50px;
        width: 150px;
        height: 150px;
        background: rgba(37, 99, 235, 0.1);
        border-radius: 50%;
    }

    /* 📸 Modern Upload Zone */
    .upload-area {
        border: 2px dashed #cbd5e1;
        border-radius: 1.25rem;
        padding: 3rem 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: #f8fafc;
        position: relative;
    }

    .upload-area:hover {
        border-color: #2563eb;
        background: #eff6ff;
        transform: scale(1.01);
    }

    .upload-icon-wrapper {
        width: 64px;
        height: 64px;
        background: #ffffff;
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        color: #2563eb;
        font-size: 1.75rem;
    }

    /* 🖋️ Typography & Inputs */
    .label-elite {
        font-weight: 800;
        font-size: 0.75rem;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .input-elite {
        border: 1.5px solid #e2e8f0;
        padding: 0.85rem 1.25rem;
        border-radius: 1rem;
        font-weight: 500;
        transition: all 0.2s;
        background-color: #fff;
    }

    .input-elite:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        background-color: #fff;
    }

    .btn-send {
        background: #2563eb;
        color: white;
        font-weight: 700;
        padding: 1rem 2.5rem;
        border-radius: 1rem;
        border: none;
        transition: all 0.3s ease;
        box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.25);
    }

    .btn-send:hover {
        background: #1d4ed8;
        transform: translateY(-2px);
        box-shadow: 0 20px 25px -5px rgba(37, 99, 235, 0.3);
        color: white;
    }

    .breadcrumb-elite .breadcrumb-item + .breadcrumb-item::before {
        content: "→";
        color: #cbd5e1;
    }
</style>

<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-xl-7 col-lg-9">
            
            <nav aria-label="breadcrumb" class="mb-4 ms-2">
                <ol class="breadcrumb breadcrumb-elite small">
                    <li class="breadcrumb-item"><a href="<?= base_url('pengaduan') ?>" class="text-decoration-none text-muted fw-bold">PENGADUAN</a></li>
                    <li class="breadcrumb-item active text-primary fw-800" aria-current="page">BUAT LAPORAN</li>
                </ol>
            </nav>

            <div class="form-wrapper border-0">
                <div class="form-header-premium">
                    <div class="d-flex align-items-center position-relative" style="z-index: 1;">
                        <div class="p-3 bg-primary bg-opacity-25 rounded-4 me-4 border border-white border-opacity-10">
                            <i class="bi bi-send-check-fill text-white fs-3"></i>
                        </div>
                        <div>
                            <h2 class="fw-800 text-white mb-1" style="letter-spacing: -0.02em;">Kirim Pengaduan</h2>
                            <p class="text-white opacity-50 mb-0 small fw-medium">Sampaikan kendala fasilitas sekolah Anda secara langsung.</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form action="<?= base_url('pengaduan/store') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        
                        <div class="row g-4">
                            <div class="col-12">
                                <label class="label-elite"><i class="bi bi-bookmark-fill text-primary"></i> Subjek Kerusakan</label>
                                <input type="text" name="judul" class="form-control input-elite" placeholder="Misal: AC Ruang Guru Mengeluarkan Bunyi" required>
                            </div>

                            <div class="col-md-6">
                                <label class="label-elite"><i class="bi bi-geo-alt-fill text-danger"></i> Titik Lokasi</label>
                                <input type="text" name="lokasi" class="form-control input-elite" placeholder="Gedung, Lantai, atau Ruangan" required>
                            </div>

                            <div class="col-md-6">
                                <label class="label-elite"><i class="bi bi-grid-fill text-warning"></i> Klasifikasi</label>
                                <select name="id_jenis" class="form-select input-elite" required>
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    <?php foreach($jenis as $j): ?>
                                        <option value="<?= $j['id_jenis'] ?>"><?= $j['nama_jenis'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="label-elite"><i class="bi bi-text-paragraph text-primary"></i> Penjelasan Detail</label>
                                <textarea name="deskripsi" class="form-control input-elite" rows="4" placeholder="Ceritakan kronologi atau detail kerusakan untuk mempermudah teknisi..." required></textarea>
                            </div>
                            
                            <div class="col-12">
                                <label class="label-elite"><i class="bi bi-image-fill text-success"></i> Dokumentasi Visual</label>
                                <div class="upload-area" id="dropZone" onclick="document.getElementById('fotoInput').click();">
                                    <div class="upload-icon-wrapper">
                                        <i class="bi bi-cloud-arrow-up-fill"></i>
                                    </div>
                                    <h6 id="fileName" class="fw-bold text-dark mb-1">Pilih atau Drag Foto ke Sini</h6>
                                    <p class="text-muted small mb-0">Hanya format gambar yang diperbolehkan (Maks. 2MB)</p>
                                    <input type="file" name="foto" id="fotoInput" class="d-none" accept="image/*" onchange="updateFileName(this)">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                            <a href="<?= base_url('pengaduan') ?>" class="btn btn-link text-muted fw-bold text-decoration-none small">
                                <i class="bi bi-arrow-left me-2"></i> KEMBALI
                            </a>
                            <button type="submit" class="btn btn-send">
                                Submit Laporan <i class="bi bi-chevron-right ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="mt-4 p-4 rounded-4 bg-white border border-info border-opacity-10 d-flex align-items-start gap-4">
                <div class="p-2 bg-info bg-opacity-10 rounded-3">
                    <i class="bi bi-info-circle-fill text-info fs-4"></i>
                </div>
                <div>
                    <span class="d-block fw-800 small text-dark text-uppercase mb-1">Penting</span>
                    <p class="small text-slate-500 mb-0">Laporan yang masuk akan ditinjau oleh Admin dalam waktu 1x24 jam. Anda akan menerima notifikasi jika teknisi telah ditugaskan.</p>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function updateFileName(input) {
        const dropZone = document.getElementById('dropZone');
        const fileNameSpan = document.getElementById('fileName');
        
        if (input.files[0]) {
            fileNameSpan.innerText = "Berkas Terpilih: " + input.files[0].name;
            dropZone.style.borderColor = "#2563eb";
            dropZone.style.background = "#eff6ff";
            fileNameSpan.classList.remove('text-dark');
            fileNameSpan.classList.add('text-primary');
        } else {
            fileNameSpan.innerText = "Pilih atau Drag Foto ke Sini";
            fileNameSpan.classList.add('text-dark');
            fileNameSpan.classList.remove('text-primary');
        }
    }

    // Drag & Drop Handling (Visual Only)
    const dz = document.getElementById('dropZone');
    ['dragenter', 'dragover'].forEach(eventName => {
        dz.addEventListener(eventName, e => {
            e.preventDefault();
            dz.style.borderColor = "#2563eb";
            dz.style.background = "#eff6ff";
        }, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dz.addEventListener(eventName, e => {
            e.preventDefault();
            if (!document.getElementById('fotoInput').files[0]) {
                dz.style.borderColor = "#cbd5e1";
                dz.style.background = "#f8fafc";
            }
        }, false);
    });
</script>

<?= $this->endSection() ?>