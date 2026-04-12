<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h4>Kirim Notifikasi</h4>

<form method="post" action="/notifikasi/store">

<div class="mb-2">
    <label>User</label>
    <select name="id_user" class="form-control">
        <?php foreach($users as $u): ?>
            <option value="<?= $u['id_user'] ?>">
                <?= $u['nama'] ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

<div class="mb-2">
    <label>Pesan</label>
    <textarea name="pesan" class="form-control"></textarea>
</div>

<button class="btn btn-primary">Kirim</button>

</form>

<?= $this->endSection() ?>