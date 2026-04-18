<h5>Tambah Tanggapan</h5>

<form method="post" action="/tanggapan/store" enctype="multipart/form-data">

<input type="hidden" name="id_tanggapan" value="<?= $tanggapan['id_tanggapan'] ?>">

<div class="mb-2">
    <label>Isi Tanggapan</label>
    <textarea name="isi_tanggapan" class="form-control" required></textarea>
</div>

<?php if(!empty($t['foto'])): ?>
    <div class="mt-2">
        <img src="<?= base_url('uploads/tanggapan/' . $t['foto']) ?>" 
             class="img-fluid rounded"
             style="max-height:200px;">
    </div>
<?php endif; ?>

<button class="btn btn-success">Kirim Tanggapan</button>

</form>