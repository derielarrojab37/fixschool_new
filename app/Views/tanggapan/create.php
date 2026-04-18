<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h4>Tambah Tanggapan</h4>

<form method="post" action="<?= base_url('tanggapan/store') ?>" enctype="multipart/form-data">

<input type="hidden" name="id_pengaduan" value="<?= $pengaduan['id_pengaduan'] ?>">

<div class="mb-3">
    <label>Pengaduan</label>
    <input type="text" class="form-control" value="<?= $pengaduan['judul'] ?>" readonly>
</div>

<div class="mb-3">
    <label>Isi Tanggapan</label>
    <textarea name="isi_tanggapan" class="form-control" required></textarea>
</div>

<div class="mb-3">
    <label>Foto (opsional)</label>
    <input type="file" name="foto" class="form-control">
</div>

<a href="<?= base_url('tanggapan') ?>" 
                       class="btn btn-light btn-sm rounded-pill px-3">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>

<button class="btn btn-success">Kirim</button>

</form>

<?= $this->endSection() ?>