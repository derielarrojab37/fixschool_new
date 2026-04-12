<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h4>Update Tugas</h4>

<form method="post" action="/penugasan/update/<?= $penugasan['id_penugasan'] ?>" enctype="multipart/form-data">

<div class="mb-2">
    <label>Status</label>
    <select name="status" class="form-control">
        <option value="ditugaskan">Ditugaskan</option>
        <option value="dikerjakan">Dikerjakan</option>
        <option value="selesai">Selesai</option>
    </select>
</div>

<div class="mb-2">
    <label>Foto Bukti</label>
    <input type="file" name="foto_bukti" class="form-control">
</div>

<button class="btn btn-success">Update</button>

</form>

<?= $this->endSection() ?>