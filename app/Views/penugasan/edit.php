<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h4>Update Penugasan</h4>

<form method="post" action="<?= base_url('penugasan/update/'.$penugasan['id_penugasan']) ?>" enctype="multipart/form-data">

<div class="mb-3">
    <label>Status</label>
    <select name="status" class="form-control">
        <option value="ditugaskan" <?= $penugasan['status']=='ditugaskan'?'selected':'' ?>>Ditugaskan</option>
        <option value="dikerjakan" <?= $penugasan['status']=='dikerjakan'?'selected':'' ?>>Dikerjakan</option>
        <option value="selesai" <?= $penugasan['status']=='selesai'?'selected':'' ?>>Selesai</option>
    </select>
</div>

<div class="mb-3">
    <label>Tanggal Penugasan</label>

    <?php if(session('role') == 'admin'): ?>
        <!-- ADMIN: bisa edit -->
        <input type="date" name="tanggal_penugasan" 
            value="<?= $penugasan['tanggal'] ?>" 
            class="form-control">
    <?php else: ?>
        <!-- TEKNISI: hanya lihat -->
        <input type="text" 
            value="<?= $penugasan['tanggal'] ?>" 
            class="form-control" readonly>
    <?php endif; ?>
</div>

<div class="mb-3">
    <label>Foto Bukti</label>
    <input type="file" name="foto_bukti" class="form-control">
</div>

<button class="btn btn-success">Update</button>

</form>

<?= $this->endSection() ?>