<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* Admin One Task Design */
    .admin-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        overflow: hidden;
    }

    .form-header-task {
        background: linear-gradient(135deg, #6366f1 0%, #4338ca 100%);
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

    .form-control:focus, .form-select:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }

    .btn-assign {
        background: #6366f1;
        color: white;
        font-weight: 700;
        padding: 0.75rem 2rem;
        border: none;
        border-radius: 0.5rem;
        transition: all 0.2s;
    }

    .btn-assign:hover {
        background: #4f46e5;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2);
    }

    .input-group-text {
        background-color: #f9fafb;
        border-color: #e5e7eb;
        color: #6b7280;
    }
</style>

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb small fw-bold">
                    <li class="breadcrumb-item"><a href="<?= base_url('pengaduan') ?>" class="text-decoration-none text-muted">Pengaduan</a></li>
                    <li class="breadcrumb-item active text-indigo" aria-current="page" style="color: #6366f1;">Penugasan Teknisi</li>
                </ol>
            </nav>

            <div class="admin-card shadow-sm">
                <div class="form-header-task">
                    <div class="d-flex align-items-center">
                        <div class="bg-white bg-opacity-20 rounded-circle p-3 me-3">
                            <i class="bi bi-tools fs-3"></i>
                        </div>
                        <div>
                            <h3 class="fw-800 mb-0">Tugaskan Teknisi</h3>
                            <p class="mb-0 opacity-75 small">Delegasikan laporan kepada tim teknis yang tersedia</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form method="post" action="<?= base_url('penugasan/store') ?>">
                        <?= csrf_field() ?>

                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <label class="form-label">
                                    <i class="bi bi-clipboard-check me-2"></i> Pilih Laporan Pengaduan
                                </label>
                                <select name="id_pengaduan" class="form-select" required>
                                    <option value="" disabled selected>-- Cari judul laporan atau lokasi --</option>
                                    <?php foreach($pengaduan as $p): ?>
                                        <option value="<?= $p['id_pengaduan'] ?>">
                                            [#<?= $p['id_pengaduan'] ?>] <?= $p['judul'] ?> — <?= $p['lokasi'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="form-text small">Hanya menampilkan laporan dengan status 'Menunggu' atau 'Diproses'.</div>
                            </div>

                            <div class="col-md-7 mb-4">
                                <label class="form-label">
                                    <i class="bi bi-person-badge me-2"></i> Pilih Teknisi
                                </label>
                                <select name="id_teknisi" class="form-select" required>
                                    <option value="" disabled selected>-- Pilih anggota tim --</option>
                                    <?php foreach($teknisi as $t): ?>
                                        <option value="<?= $t['id_user'] ?>">
                                            <?= $t['nama'] ?> (Teknisi)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-5 mb-4">
                                <label class="form-label">
                                    <i class="bi bi-calendar-event me-2"></i> Tanggal Penugasan
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-calendar3"></i></span>
                                    <input type="date" name="tanggal_penugasan" class="form-control" value="<?= date('Y-m-d') ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center border-top pt-4 mt-2">
                            <a href="<?= base_url('pengaduan') ?>" class="btn btn-link text-muted fw-bold text-decoration-none">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-assign">
                                Simpan Penugasan <i class="bi bi-chevron-right ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="admin-card bg-light border-0 mt-4 p-3 d-flex align-items-center">
                <div class="bg-indigo bg-opacity-10 p-2 rounded-3 me-3" style="background-color: rgba(99, 102, 241, 0.1);">
                    <i class="bi bi-info-circle text-indigo fs-5" style="color: #6366f1;"></i>
                </div>
                <div>
                    <p class="small text-muted mb-0">
                        Setelah ditugaskan, status pengaduan akan otomatis berubah menjadi <b>"Diproses"</b> dan teknisi akan menerima notifikasi di dashboard mereka.
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>