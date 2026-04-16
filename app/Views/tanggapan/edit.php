<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h4>Edit Tanggapan</h4>

<form method="post" action="<?= base_url('tanggapan/update/'.$tanggapan['id_tanggapan']) ?>">

<div class="mb-3">
    <label>Isi Tanggapan</label>
    <textarea name="isi_tanggapan" class="form-control"><?= $tanggapan['isi_tanggapan'] ?></textarea>
</div>

<button class="btn btn-warning">Update</button>

</form>

<?= $this->endSection() ?>