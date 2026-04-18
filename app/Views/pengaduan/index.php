<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- 🔍 FORM SEARCH -->
<form method="get" class="row mb-3">

    <div class="col-md-3">
        <input type="text" name="keyword" class="form-control" 
        placeholder="Cari judul..." value="<?= $_GET['keyword'] ?? '' ?>">
    </div>

    <div class="col-md-3">
        <select name="jenis" class="form-control">
            <option value="">Semua Jenis</option>
            <?php foreach($jenis as $j): ?>
                <option value="<?= $j['id_jenis'] ?>">
                    <?= $j['nama_jenis'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-md-3">
        <input type="date" name="tanggal" class="form-control"
        value="<?= $_GET['tanggal'] ?? '' ?>">
    </div>

    <div class="col-md-3">
        <button class="btn btn-primary">Cari</button>
        <a href="<?= base_url('pengaduan') ?>" class="btn btn-secondary">Reset</a>
    </div>

</form>

<!-- 📦 CONTENT -->
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: #9297b4;">Data Pengaduan</h3>
            <p class="text-muted small mb-0">Kelola laporan kerusakan dari warga sekolah.</p>
        </div>

        <?php if(session()->get('role') == 'pelapor'): ?>
            <a href="<?= base_url('/pengaduan/create') ?>" class="btn btn-primary">Tambah</a>
        <?php endif; ?>
    </div>

    <div class="content-card">
        <div class="table-responsive">
            <table class="table align-middle">

                <!-- 🔥 HEADER -->
                <thead>
                    <tr>
                        <th width="60" class="text-center">No</th>
                        <th>Laporan / Judul</th>
                        <th>Nama Pelapor</th>
                        <th>Melapor Sebagai</th>
                        <th>Lokasi</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <!-- 🔥 BODY -->
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
                            <div class="fw-bold"><?= $p['judul'] ?></div>
                            <small class="text-muted">ID: #PGN-0<?= $p['id_pengaduan'] ?></small>
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

                            <a href="<?= base_url('pengaduan/detail/' . $p['id_pengaduan']) ?>" 
                               class="btn btn-sm btn-info mb-1">
                                Detail
                            </a>

                            <?php if(session('role') == 'admin' && $p['status'] != 'selesai'): ?>
                                <a href="<?= base_url('pengaduan/delete/'.$p['id_pengaduan']) ?>" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Yakin hapus?')">
                                   Hapus
                                </a>
                            <?php endif; ?>

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

<?= $this->endSection() ?>