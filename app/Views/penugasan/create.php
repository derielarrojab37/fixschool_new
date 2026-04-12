<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h4>Penugasan Teknisi</h4>

<form method="post" action="/penugasan/assign">

<input type="hidden" name="id_pengaduan" value="<?= $pengaduan['id_pengaduan'] ?>">
<input type="hidden" name="id_tanggapan" value="<?= $tanggapan['id_tanggapan'] ?>">

<div class="mb-2">
    <label>Pilih Teknisi</label>
    <select name="id_teknisi" class="form-control" required>
        <option value="">-- Pilih Teknisi --</option>
        <?php foreach($teknisi as $t): ?>
            <option value="<?= $t['id_user'] ?>">
                <?= $t['nama'] ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

<button class="btn btn-primary">Tugaskan</button>

</form>

<?= $this->endSection() ?>