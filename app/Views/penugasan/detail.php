<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">

    <h4>Detail Penugasan</h4>

    <div class="card p-4 shadow-sm">

        <p><b>Judul Pengaduan:</b> <?= $penugasan['judul'] ?></p>
        <p><b>Teknisi:</b> <?= $penugasan['nama'] ?></p>
        <p><b>Status:</b> <?= $penugasan['status'] ?></p>
        <p><b>Tanggal:</b> <?= $penugasan['tanggal'] ?></p>

        <?php if(!empty($penugasan['foto_bukti'])): ?>
            <div class="mt-3">
                <label><b>Foto Bukti:</b></label><br>
                <img src="<?= base_url('uploads/bukti/' . $penugasan['foto_bukti']) ?>" 
                     class="img-fluid rounded"
                     style="max-height:300px;">
            </div>
        <?php endif; ?>

    </div>

    <a href="<?= base_url('penugasan') ?>" class="btn btn-secondary mt-3">Kembali</a>

</div>

<?= $this->endSection() ?>