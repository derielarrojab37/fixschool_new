<h5>Tambah Tanggapan</h5>

<form method="post" action="/tanggapan/store" enctype="multipart/form-data">

<input type="hidden" name="id_pengaduan" value="<?= $pengaduan['id_pengaduan'] ?>">

<div class="mb-2">
    <label>Isi Tanggapan</label>
    <textarea name="isi_tanggapan" class="form-control" required></textarea>
</div>

<div class="mb-2">
    <label>Foto (Opsional)</label>
    <input type="file" name="foto" class="form-control">
</div>

<button class="btn btn-success">Kirim Tanggapan</button>

</form>