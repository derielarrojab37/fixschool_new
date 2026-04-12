<a href="#">
    <b>Fix</b>School
</a><br>

<a href="<?= base_url('/') ?>">Dashboard</a><br>

<ul>

    <!-- USERS (Admin & Teknisi) -->
    <?php if (session()->get('role') == 'admin' || session()->get('role') == 'teknisi') : ?>
        <li>
            <a href="<?= base_url('/users') ?>">Users</a>
        </li>
    <?php endif; ?>

    <!-- PENGADUAN (SEMUA ROLE) -->
    <li>
        <a href="<?= base_url('/pengaduan') ?>">Pengaduan</a>
    </li>

    <!-- TANGGAPAN (ADMIN ONLY) -->
    <?php if (session()->get('role') == 'admin') : ?>
        <li>
            <a href="<?= base_url('/tanggapan') ?>">Tanggapan</a>
        </li>
    <?php endif; ?>

    <!-- PENUGASAN -->
    <?php if (session()->get('role') == 'admin' || session()->get('role') == 'teknisi') : ?>
        <li>
            <a href="<?= base_url('/penugasan') ?>">Penugasan</a>
        </li>
    <?php endif; ?>

    <!-- NOTIFIKASI (SEMUA ROLE) -->
    <li>
        <a href="<?= base_url('/notifikasi') ?>">Notifikasi</a>
    </li>

    <!-- SETTING -->
    <?php $idu = session('id_user'); ?>
    <li>
        <a href="<?= base_url('users/edit/' . $idu) ?>">Setting</a>
    </li>

    <!-- LOGOUT -->
    <li>
        <a href="<?= base_url('/logout') ?>">Log Out</a>
    </li>

</ul>

<br>
Masuk sebagai:
<b><?= session('nama'); ?> (<?= session('role'); ?>)</b>
<br>

<img src="<?= base_url('uploads/users/' . session()->get('foto')) ?>" height="80" />