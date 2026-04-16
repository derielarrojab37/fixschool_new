<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

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
<a href="<?= base_url('pengaduan/print') ?>" target="_blank" class="btn btn-success">
    <i class="bi bi-printer"></i> Print
</a>
<br>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: #2b3674;">Data Pengaduan</h3>
            <p class="text-muted small mb-0">Kelola laporan kerusakan dari warga sekolah.</p>
        </div>
        <?php if(session()->get('role') == 'pelapor'): ?>
    <a href="<?= base_url('/pengaduan/create') ?>" class="btn btn-primary">Tambah</a>
<?php endif; ?>
    </div>

    <div class="content-card">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th width="60" class="text-center">No</th>
                        <th>Laporan / Judul</th>
                        <th>Pelapor</th>
                        <th>Lokasi</th>
                        <th class="text-center">Status</th>
                        <th width="100" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pengaduan)): ?>
                        <?php $no=1; foreach ($pengaduan as $p): ?>
                        <tr>
                            <td class="text-center text-muted"><?= $no++ ?></td>
                            <td>
                                <div class="fw-bold"><?= $p['judul'] ?></div>
                                <small class="text-muted">ID: #PGN-0<?= $p['id_pengaduan'] ?></small>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-person-circle me-2 text-primary"></i>
                                    <?= $p['nama'] ?>
                                </div>
                            </td>
                            <td>
                                <span class="text-muted"><i class="bi bi-geo-alt me-1"></i> <?= $p['lokasi'] ?></span>
                            </td>
                            <td class="text-center">
    <?php 
    $status = strtolower($p['status']);
    $class = 'status-pending'; // Default untuk 'menunggu'

    if ($status == 'proses' || $status == 'diproses') {
        $class = 'status-proses';
    } elseif ($status == 'selesai') {
        $class = 'status-selesai';
    } elseif ($status == 'ditolak') {
        $class = 'status-ditolak'; // 🔥 TAMBAHAN INI
    }
?>
    <span class="badge-status <?= $class ?>">
        <i class="bi bi-circle-fill me-1" style="font-size: 0.5rem;"></i>
        <?= ucfirst($p['status']) ?>
    </span>
</td>
                            

<td>

            <?php if(session('role') == 'admin' && $p['status'] != 'selesai'): ?>
    <a href="<?= base_url('pengaduan/delete/'.$p['id_pengaduan']) ?>" 
       class="btn btn-danger btn-sm"
       onclick="return confirm('Yakin hapus?')">
       Hapus
    </a>
<?php endif; ?>
</td>

                            <td class="text-center">
                                <a href="<?= base_url('pengaduan/detail/' . $p['id_pengaduan']) ?>" class="btn-detail">
                                    Detail
                                </a>
                            </td>
                        
                        </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">Belum ada data pengaduan.</td>
                        </tr>
                    <?php endif; ?>
                
                    
                </tbody>
                
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>