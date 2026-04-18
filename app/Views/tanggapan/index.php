<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- FORM FILTER -->
<form method="get" class="row g-2 mb-4">

    <div class="col-md-4">
        <input type="text" name="keyword" class="form-control"
               placeholder="Cari tanggapan / judul..."
               value="<?= $_GET['keyword'] ?? '' ?>">
    </div>

    <div class="col-md-3">
        <input type="date" name="tanggal" class="form-control"
               value="<?= $_GET['tanggal'] ?? '' ?>">
    </div>

    <div class="col-md-3 d-flex gap-2">
        <button class="btn btn-primary w-100">Cari</button>
        <a href="<?= base_url('tanggapan') ?>" class="btn btn-secondary w-100">Reset</a>
    </div>

</form>

<h4 class="mb-3">Data Tanggapan</h4>

<!-- TABLE -->
<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr class="text-center">
            <th>No</th>
            <th>Pengaduan</th>
            <th>Admin</th>
            <th>Isi</th>
            <th width="180">Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php if (!empty($tanggapan)): ?>
            <?php $no = 1; foreach ($tanggapan as $t): ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td><?= $t['judul'] ?></td>
                    <td><?= $t['nama'] ?></td>
                    <td><?= $t['isi_tanggapan'] ?></td>
                    <td class="text-center">

                        <!-- EDIT -->
                        <a href="<?= base_url('tanggapan/edit/' . $t['id_tanggapan']) ?>" 
                           class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <!-- DELETE -->
                        <a href="<?= base_url('tanggapan/delete/' . $t['id_tanggapan']) ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Yakin hapus tanggapan?')">
                            Delete
                        </a>

                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="text-center">Data tidak ditemukan</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?= $this->endSection() ?>