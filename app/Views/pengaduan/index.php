<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- 🔍 FORM SEARCH -->
<form method="get" class="row g-2 align-items-center mb-4">

    <!-- INPUT -->
    <div class="col-md-3">
        <input type="text" name="keyword" class="form-control" 
               placeholder="Cari judul..."
               value="<?= $_GET['keyword'] ?? '' ?>">
    </div>

    <!-- JENIS -->
    <div class="col-md-3">
        <select name="jenis" class="form-select">
            <option value="">Semua Jenis</option>
            <?php foreach($jenis as $j): ?>
                <option value="<?= $j['id_jenis'] ?>">
                    <?= $j['nama_jenis'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- TANGGAL -->
    <div class="col-md-2">
        <input type="date" name="tanggal" class="form-control"
               value="<?= $_GET['tanggal'] ?? '' ?>">
    </div>

    <!-- TOMBOL -->
    <div class="col-md-4 d-flex gap-2">

        <button class="btn btn-primary flex-fill">
            <i class="bi bi-search me-1"></i> Cari
        </button>

        <a href="<?= base_url('pengaduan') ?>" 
           class="btn btn-secondary flex-fill">
            Reset
        </a>

        <a href="<?= base_url('pengaduan/print') ?>" 
           target="_blank" 
           class="btn btn-success flex-fill">
            <i class="bi bi-printer"></i>
        </a>

    </div>

</form>

<!-- 📦 CONTENT -->
<div class="container-fluid py-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: #9297b4;">Data Pengaduan</h3>
            <p class="text-muted small mb-0">
                Kelola laporan kerusakan dari warga sekolah.
            </p>
        </div>

        <?php if(session()->get('role') == 'pelapor'): ?>
            <a href="<?= base_url('/pengaduan/create') ?>" 
               class="btn btn-primary px-4">
                + Tambah
            </a>
        <?php endif; ?>
    </div>

    <!-- TABLE -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-3">

            <div class="table-responsive">
                <table class="table align-middle">

                    <!-- HEADER -->
                    <thead class="table-light">
                        <tr>
                            <th width="60" class="text-center">No</th>
                            <th>Laporan</th>
                            <th>Pelapor</th>
                            <th>Jenis</th>
                            <th>Lokasi</th>
                            <th class="text-center">Status</th>
                            <th class="text-center" width="160">Aksi</th>
                        </tr>
                    </thead>

                    <!-- BODY -->
                    <tbody>
                    <?php if (!empty($pengaduan)): ?>
                        <?php $no=1; foreach ($pengaduan as $p): ?>

                        <?php 
                            $status = strtolower($p['status']);
                            $class = 'status-pending';

                            if ($status == 'proses' || $status == 'diproses') {
                                $class = 'status-proses';
                            } elseif ($status == 'selesai') {
                                $class = 'status-selesai';
                            } elseif ($status == 'ditolak') {
                                $class = 'status-ditolak';
                            }
                        ?>

                        <tr>
                            <!-- NO -->
                            <td class="text-center text-muted"><?= $no++ ?></td>

                            <!-- JUDUL -->
                            <td>
                                <div class="fw-semibold"><?= $p['judul'] ?></div>
                                <small class="text-muted">
                                    ID: #PGN-0<?= $p['id_pengaduan'] ?>
                                </small>
                            </td>

                            <!-- NAMA -->
                            <td>
                                <i class="bi bi-person-circle me-1 text-primary"></i>
                                <?= $p['nama'] ?>
                            </td>

                            <!-- JENIS -->
                            <td>
                                <span class="badge bg-info text-dark">
                                    <?= $p['nama_jenis'] ?>
                                </span>
                            </td>

                            <!-- LOKASI -->
                            <td>
                                <i class="bi bi-geo-alt me-1"></i>
                                <?= $p['lokasi'] ?>
                            </td>

                            <!-- STATUS -->
                            <td class="text-center">
                                <span class="badge-status <?= $class ?>">
                                    <i class="bi bi-circle-fill me-1" style="font-size: 0.5rem;"></i>
                                    <?= ucfirst($p['status']) ?>
                                </span>
                            </td>

                            <!-- AKSI -->
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    <a href="<?= base_url('pengaduan/detail/' . $p['id_pengaduan']) ?>" 
                                       class="btn btn-sm btn-info px-3">
                                        Detail
                                    </a>

                                    <?php if(session('role') == 'admin' && $p['status'] != 'selesai'): ?>
                                        <a href="<?= base_url('pengaduan/delete/'.$p['id_pengaduan']) ?>" 
                                           class="btn btn-sm btn-danger px-3"
                                           onclick="return confirm('Yakin hapus?')">
                                           Hapus
                                        </a>
                                    <?php endif; ?>

                                </div>
                            </td>
                        </tr>

                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                Belum ada data pengaduan.
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>