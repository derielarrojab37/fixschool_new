<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h4>Tolak Laporan</h4>

    <div class="card p-4">
        <h5><?= $pengaduan['judul'] ?></h5>
        <p><?= $pengaduan['deskripsi'] ?></p>

        <form method="post" action="<?= base_url('pengaduan/tolak/'.$pengaduan['id_pengaduan']) ?>">

            <div class="mb-3">
                <label>Alasan Penolakan</label>
                <textarea name="alasan" class="form-control" required></textarea>
            </div>

            <button class="btn btn-danger">Tolak Laporan</button>
            <a href="<?= base_url('pengaduan') ?>" class="btn btn-secondary">Batal</a>

        </form>
    </div>
</div>

<?= $this->endSection() ?>