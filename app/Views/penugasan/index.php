<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- FORM FILTER -->
<form method="get" class="row g-2 mb-4">

    <div class="col-md-3">
        <input type="text" name="pengaduan" class="form-control"
               placeholder="Cari judul laporan..."
               value="<?= $_GET['pengaduan'] ?? '' ?>">
    </div>

    <div class="col-md-3">
        <select name="teknisi" class="form-select">
            <option value="">Semua Teknisi</option>
            <?php foreach ($teknisiList as $t): ?>
                <option value="<?= $t['id_user'] ?>"
                    <?= (($_GET['teknisi'] ?? '') == $t['id_user']) ? 'selected' : '' ?>>
                    <?= $t['nama'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-md-3">
        <input type="date" name="tanggal" class="form-control"
               value="<?= $_GET['tanggal'] ?? '' ?>">
    </div>

    <div class="col-md-3 d-flex gap-2">
        <button class="btn btn-primary w-100">Cari</button>
        <a href="<?= base_url('penugasan') ?>" class="btn btn-secondary w-100">Reset</a>
    </div>

</form>

<h4 class="mb-3">Data Penugasan</h4>

<!-- TABLE -->
<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr class="text-center">
            <th>No</th>
            <th>Pengaduan</th>
            <th>Teknisi</th>
            <th>Status</th>
            <th width="220">Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php if (!empty($penugasan)): ?>
            <?php $no = 1; foreach ($penugasan as $p): ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td><?= $p['judul'] ?></td>
                    <td><?= $p['nama'] ?></td>
                    <td class="text-center"><?= $p['status'] ?></td>
                    <td class="text-center">

                        <!-- DETAIL -->
                        <a href="<?= base_url('penugasan/detail/' . $p['id_penugasan']) ?>" 
                           class="btn btn-info btn-sm">
                            Detail
                        </a>

                        <!-- UPDATE -->
                        <a href="<?= base_url('penugasan/edit/' . $p['id_penugasan']) ?>" 
                           class="btn btn-warning btn-sm">
                            Update
                        </a>

                        <!-- DELETE (ADMIN ONLY) -->
                        <?php if (session('role') == 'admin' && $p['status'] != 'selesai'): ?>
                            <a href="<?= base_url('penugasan/delete/' . $p['id_penugasan']) ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Yakin hapus penugasan?')">
                                Hapus
                            </a>
                        <?php endif; ?>

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