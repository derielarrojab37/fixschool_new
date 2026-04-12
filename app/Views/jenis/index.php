<a href="/jenis/create">Tambah</a>

<table border="1">
<?php foreach($jenis as $j): ?>
<tr>
<td><?= $j['nama_jenis'] ?></td>
<td>
<a href="/jenis/edit/<?= $j['id_jenis'] ?>">Edit</a>
<a href="/jenis/delete/<?= $j['id_jenis'] ?>">Delete</a>
</td>
</tr>
<?php endforeach; ?>
</table>