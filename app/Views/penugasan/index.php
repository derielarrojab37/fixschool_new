<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

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
        <a href="<?= base_url('penugasan/edit/'.$p['id_penugasan']) ?>">Detail / Update</a>
    </td>
</tr>
<?php endforeach; ?>

</table>

<?= $this->endSection() ?>