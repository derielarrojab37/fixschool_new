<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h4>Tugaskan Teknisi</h4>

<form method="post" action="<?= base_url('penugasan/store') ?>">

<!-- PILIH PENGADUAN -->
<div class="mb-3">
    <label>Pilih Pengaduan</label>
    <select name="id_pengaduan" class="form-control" required>
        <option value="">-- pilih laporan --</option>
        <?php foreach($pengaduan as $p): ?>
            <option value="<?= $p['id_pengaduan'] ?>">
                <?= $p['judul'] ?> - <?= $p['lokasi'] ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

<!-- PILIH TEKNISI -->
<div class="mb-3">
    <label>Pilih Teknisi</label>
    <select name="id_teknisi" class="form-control" required>
        <option value="">-- pilih teknisi --</option>
        <?php foreach($teknisi as $t): ?>
            <option value="<?= $t['id_user'] ?>">
                <?= $t['nama'] ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

<!-- TANGGAL -->
<div class="mb-3">
    <label>Tanggal Penugasan</label>
    <input type="date" name="tanggal_penugasan" class="form-control" required>
</div>

<button class="btn btn-primary">Tugaskan</button>

</form>

<?= $this->endSection() ?>