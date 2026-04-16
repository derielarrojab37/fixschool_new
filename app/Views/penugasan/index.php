<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<form method="get" class="row mb-3">

    <div class="col-md-3">
        <input type="text" name="pengaduan" class="form-control"
        placeholder="Cari judul laporan..."
        value="<?= $_GET['pengaduan'] ?? '' ?>">
    </div>

    <div class="col-md-3">
        <select name="teknisi" class="form-control">
            <option value="">Semua Teknisi</option>
            <?php foreach($teknisiList as $t): ?>
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

    <div class="col-md-3">
        <button class="btn btn-primary">Cari</button>
        <a href="<?= base_url('penugasan') ?>" class="btn btn-secondary">Reset</a>
    </div>

</form>
<br>
<h4>Data Penugasan</h4>

<table class="table">
<tr>
    <th>No</th>
    <th>Pengaduan</th>
    <th>Teknisi</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

<?php $no=1; foreach($penugasan as $p): ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $p['judul'] ?></td>
    <td><?= $p['nama'] ?></td>
    <td><?= $p['status'] ?></td>
    <td>
        <?php if(session('role') == 'admin' && $p['status'] != 'selesai'): ?>
    <a href="<?= base_url('penugasan/delete/'.$p['id_penugasan']) ?>" 
       class="btn btn-danger btn-sm"
       onclick="return confirm('Yakin hapus penugasan?')">
       Hapus
    </a>
<?php endif; ?>
    </td>
    
    <td>
        <a href="<?= base_url('penugasan/edit/'.$p['id_penugasan']) ?>">Update</a>
    </td>
    <td>
        <a href="<?= base_url('penugasan/detail/'.$p['id_penugasan']) ?>" 
   class="btn btn-info btn-sm">
   Detail
</a>
    </td>
</tr>
<?php endforeach; ?>


</table>

<?= $this->endSection() ?>