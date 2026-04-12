<table border="1">
<?php foreach($penugasan as $p): ?>
<tr>
<td><?= $p['status'] ?></td>
<td>
<a href="/penugasan/delete/<?= $p['id_penugasan'] ?>">Hapus</a>
</td>
</tr>
<?php endforeach; ?>
</table>

<form method="post" action="/penugasan/assign">
<select name="id_teknisi">
<?php foreach($teknisi as $t): ?>
<option value="<?= $t['id_user'] ?>">
<?= $t['nama'] ?>
</option>
<?php endforeach; ?>
</select>
<button>Tugaskan</button>
</form>