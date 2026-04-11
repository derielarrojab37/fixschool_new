<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div>
    <div>
        <div>
            <h4>Edit User</h4>
        </div>

        <div>

            <form action="<?= base_url('users/update/' . $user['id']) ?>" method="post" enctype="multipart/form-data">

                <div>
                    <label>Nama Lengkap</label><br>
                    <input type="text" name="nama" value="<?= $user['nama'] ?>" required>
                </div>

                <div>
                    <label>Username</label><br>
                    <input type="text" name="username" value="<?= $user['username'] ?>" required>
                </div>

                <div>
                    <label>Password (kosongkan jika tidak diubah)</label><br>
                    <input type="password" name="password">
                </div>

                <div>
                    <label>Role</label><br>
                    <select name="role">
                        <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                        <option value="teknisi" <?= $user['role'] == 'teknisi' ? 'selected' : '' ?>>teknisi</option>
                        <option value="pelapor" <?= $user['role'] == 'pelapor' ? 'selected' : '' ?>>pelapor</option>
                    </select>
                </div>

                <div>
                    <label>jenis_pelapor</label><br>
                    <select name="jenis_pelapor">
                        <option value="guru" <?= $user['jenis_pelapor'] == 'guru' ? 'selected' : '' ?>>Guru</option>
                        <option value="siswa" <?= $user['jenis_pelapor'] == 'siswa' ? 'selected' : '' ?>>Siwa</option>
                        <option value="staff" <?= $user['jenis_pelapor'] == 'staff' ? 'selected' : '' ?>>Staff</option>
                        <option value="lainnya" <?= $user['jenis_pelapor'] == 'lainnyaSS' ? 'selected' : '' ?>>Lainnya</option>
                    </select>
                </div>


                <div>
                    <label>Foto</label><br>
                    <input type="file" name="foto"><br>
                    <p>Foto sekarang:</p>

                    <?php if ($user['foto']): ?>
                        <img src="<?= base_url('uploads/users/' . $user['foto']) ?>" width="80">
                    <?php else: ?>
                        <span>-</span>
                    <?php endif; ?>
                </div>

                <br>
                <button type="submit">Update</button>
                <a href="<?= base_url('users') ?>">Kembali</a>

            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>