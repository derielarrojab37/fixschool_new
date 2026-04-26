<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<link rel="icon" href="<?= base_url('assets/img/FS_No_BG.png') ?>">

<style>
    /* 🎯 THEME CUSTOMIZATION */
    :root {
        --primary-gradient: linear-gradient(135deg, #6366f1, #4f46e5);
    }

    .admin-card-wrapper {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 1.25rem;
        overflow: hidden;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
    }

    .form-header-gradient {
        background: var(--primary-gradient);
        padding: 2rem;
        color: #ffffff;
    }

    /* 🎯 FORM STYLING */
    .form-label {
        font-weight: 700;
        font-size: 0.75rem;
        color: #4b5563;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-control, .form-select {
        border: 1px solid #e5e7eb;
        padding: 0.75rem 1rem;
        border-radius: 0.75rem;
        font-size: 0.95rem;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        background-color: #f9fafb;
    }

    .form-control:focus, .form-select:focus {
        background-color: #ffffff;
        border-color: #6366f1;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        outline: none;
    }

    /* 🎯 INTERACTIVE ELEMENTS */
    .input-group-text {
        background-color: #f3f4f6;
        border: 1px solid #e5e7eb;
        color: #6366f1;
        border-radius: 0.75rem 0 0 0.75rem;
        font-weight: bold;
    }

    .btn-assign {
        background: var(--primary-gradient);
        color: #ffffff;
        font-weight: 700;
        padding: 0.8rem 2rem;
        border: none;
        border-radius: 0.75rem;
        transition: all 0.3s ease;
    }

    .btn-assign:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.3);
        color: #fff;
    }

    .btn-outline-custom {
        border: 1px solid #e5e7eb;
        color: #6b7280;
        border-radius: 0.75rem;
        padding: 0.6rem 1.2rem;
        font-weight: 600;
        transition: all 0.2s;
    }

    .btn-outline-custom:hover {
        background-color: #f3f4f6;
        color: #374151;
        border-color: #d1d5db;
    }

    .info-alert {
        background-color: #eef2ff;
        border: 1px solid #e0e7ff;
        border-radius: 1rem;
        padding: 1.25rem;
    }
</style>

<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb bg-transparent p-0">
                    <li class="breadcrumb-item"><a href="<?= base_url('pengaduan') ?>" class="text-decoration-none text-muted fw-medium">Pengaduan</a></li>
                    <li class="breadcrumb-item active fw-bold" style="color: #6366f1;">Penugasan Teknisi</li>
                </ol>
            </nav>

            <div class="admin-card-wrapper shadow-sm">
                <div class="form-header-gradient d-flex align-items-center gap-4">
                    <div class="bg-white bg-opacity-20 rounded-3 p-3">
                        <i class="bi bi-person-plus-fill fs-3 text-white"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0">Manajemen Penugasan</h4>
                        <p class="mb-0 text-white-50 small">Sistem delegasi teknisi lapangan terintegrasi</p>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form method="post" action="<?= base_url('penugasan/store') ?>">
                        <?= csrf_field() ?>

                        <div class="row g-4">
                            <div class="col-md-12">
                                <label class="form-label">
                                    <i class="bi bi-journal-text"></i> Pilih Laporan Pengaduan
                                </label>
                                <select name="id_pengaduan" class="form-select" required>
                                    <option value="" disabled selected>-- Pilih laporan yang perlu ditangani --</option>
                                    <?php foreach($pengaduan as $p): ?>
                                        <option value="<?= $p['id_pengaduan'] ?>">
                                            [#<?= $p['id_pengaduan'] ?>] <?= $p['judul'] ?> — <?= $p['lokasi'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-7">
                                <label class="form-label">
                                    <i class="bi bi-tools"></i> Teknisi Pelaksana
                                </label>
                                <select name="id_teknisi" class="form-select" required>
                                    <option value="" disabled selected>-- Pilih teknisi tersedia --</option>
                                    <?php foreach($teknisi as $t): ?>
                                        <option value="<?= $t['id_user'] ?>">
                                            <?= $t['nama'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-5">
                                <label class="form-label">
                                    <i class="bi bi-calendar-event"></i> Tanggal Tugas
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-calendar3"></i></span>
                                    <input type="date" name="tanggal_penugasan" class="form-control" value="<?= date('Y-m-d') ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-5 pt-4 border-top gap-3">
                            <div class="d-flex gap-2">
                                <a href="<?= base_url('pengaduan') ?>" class="btn btn-outline-custom btn-sm">
                                    <i class="bi bi-clipboard me-1"></i> Data Pengaduan
                                </a>
                                <a href="<?= base_url('penugasan') ?>" class="btn btn-outline-custom btn-sm">
                                    <i class="bi bi-list-task me-1"></i> List Penugasan
                                </a>
                            </div>

                            <button type="submit" class="btn btn-assign">
                                Konfirmasi Penugasan <i class="bi bi-send-check ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="info-alert mt-4 d-flex align-items-start gap-3">
                <i class="bi bi-info-circle-fill text-primary fs-5"></i>
                <div>
                    <h6 class="fw-bold text-primary mb-1">Informasi Otomasi</h6>
                    <p class="small text-muted mb-0">
                        Menyimpan penugasan ini akan otomatis mengubah status laporan menjadi <span class="badge bg-primary">Diproses</span>. 
                        Teknisi akan menerima notifikasi tugas baru di dashboard mereka secara <i>real-time</i>.
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>