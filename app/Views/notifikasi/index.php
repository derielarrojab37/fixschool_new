<table border="1">
<?php foreach($notifikasi as $n): ?>
<tr>
<td><?= $n['pesan'] ?></td>
<td><?= $n['status'] ?></td>
</tr>
<?php endforeach; ?>
</table>