<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h4>Buat Tiket Support</h4>

<form action="<?= base_url('support/store') ?>" method="post">
    <input type="text" name="judul" class="form-control mb-2" placeholder="Judul keluhan">

    <textarea name="pesan" class="form-control mb-2" placeholder="Tulis keluhan..."></textarea>

    <button class="btn btn-primary">Kirim</button>
</form>

<?= $this->endSection() ?>