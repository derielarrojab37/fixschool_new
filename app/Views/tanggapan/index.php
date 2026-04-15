<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h4>Data Tanggapan</h4>

<table class="table">
<tr>
    <th>No</th>
    <th>Pengaduan</th>
    <th>Admin</th>
    <th>Isi</th>
    <th>Aksi</th>
</tr>

<?php $no=1; foreach($tanggapan as $t): ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $t['judul'] ?></td>
    <td><?= $t['nama'] ?></td>
    <td><?= $t['isi_tanggapan'] ?></td>
    <td>
        <a href="<?= base_url('tanggapan/edit/'.$t['id_tanggapan']) ?>">Edit</a>
        <a href="<?= base_url('tanggapan/delete/'.$t['id_tanggapan']) ?>">Delete</a>
    </td>
</tr>
<?php endforeach; ?>

</table>

<?= $this->endSection() ?>