   <a href="#">
        <b>Maldin17</b>App
    </a><br>

    <a href="<?= base_url('/') ?>">
        Dashboard
    </a><br>
    <ul>    
        
        <li>
            <a href="<?= base_url('/logout') ?>">Log Out</a>
        </li>

            <?php if (session()->get('role') == 'admin' || session()->get('role') == 'petugas') : ?>
        <a href="<?= base_url('/users') ?>">
            Users
        </a><br>
    <?php endif; ?>

        <?php $idu = session('id'); ?>
    <a href="<?= base_url('users/edit/' . $idu) ?>">
        Setting
    </a><br>
    </ul>

    <br>
Masuk sebagai: <b><?= session('nama'); ?> (<?= session('role'); ?>)</b>
<br>
<img src="<?= base_url('uploads/users/' . session()->get('foto')) ?>" height="80" />