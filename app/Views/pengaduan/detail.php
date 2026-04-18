<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid py-4">
    <div class="row g-4">

        <!-- 🔥 KIRI (DETAIL) -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-md-5">

                    <!-- HEADER -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <span class="badge bg-primary px-3 py-2">
                                <i class="bi bi-info-circle-fill me-1"></i> Detail Laporan
                            </span>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="<?= base_url('pengaduan') ?>" 
                               class="btn btn-outline-secondary btn-sm rounded-pill">
                                <i class="bi bi-arrow-left"></i>
                            </a>

                            
                        </div>
                    </div>

                    <!-- JUDUL -->
                    <h2 class="fw-bold mb-3"><?= $pengaduan['judul'] ?></h2>

                    <!-- META -->
                    <div class="row text-muted small mb-4">
                        <div class="col-md-4">
                            <i class="bi bi-person-circle me-1"></i>
                            <?= $pengaduan['nama'] ?>
                        </div>
                        <div class="col-md-4">
                            <i class="bi bi-geo-alt-fill me-1"></i>
                            <?= $pengaduan['lokasi'] ?>
                        </div>
                        <div class="col-md-4">
                            <i class="bi bi-flag-fill me-1"></i>
                            <span class="badge bg-info text-dark text-uppercase">
                                <?= $pengaduan['status'] ?>
                            </span>
                        </div>
                    </div>

                    <!-- DESKRIPSI -->
                    <div class="mb-4" style="line-height: 1.7;">
                        <?= nl2br($pengaduan['deskripsi']) ?>
                    </div>

                    <!-- 🔴 DITOLAK -->
                    <?php if (strtolower($pengaduan['status']) == 'ditolak'): ?>
                        <div class="alert alert-danger rounded-3">
                            <b>Laporan Ditolak</b><br>
                            <?= $pengaduan['alasan_ditolak'] ?>
                        </div>
                    <?php endif; ?>

                    <hr class="my-4">

                    <!-- 💬 TANGGAPAN -->
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0 fw-semibold">
                                <i class="bi bi-chat-left-text-fill me-2 text-primary"></i>
                                Tanggapan (<?= count($tanggapan) ?>)
                            </h5>

                            <?php if(session('role') == 'admin'): ?>
                                <a href="<?= base_url('tanggapan/create/' . $pengaduan['id_pengaduan']) ?>" 
                                   class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus-lg"></i>
                                </a>
                            <?php endif; ?>
                        </div>

                        <?php if (!empty($tanggapan)): ?>
                            <?php foreach ($tanggapan as $t): ?>
                                <div class="card border-0 shadow-sm mb-3 rounded-3">
                                    <div class="card-body p-3">

                                        <div class="d-flex justify-content-between mb-2">
                                            <div>
                                                <span class="fw-semibold"><?= $t['nama'] ?></span>
                                                <small class="text-muted d-block">Admin/Petugas</small>
                                            </div>
                                        </div>

                                        <p class="mb-2"><?= $t['isi_tanggapan'] ?></p>

                                        <!-- FOTO (FIXED) -->
                                        <?php if (!empty($t['foto'])): ?>
                                            <img src="<?= base_url('uploads/tanggapan/' . $t['foto']) ?>" 
                                                 class="img-fluid rounded mt-2"
                                                 style="max-height: 200px;">
                                        <?php endif; ?>

                                    </div>
                                </div>
                            <?php endforeach ?>
                        <?php else: ?>
                            <div class="text-center py-5 bg-light rounded-4">
                                <i class="bi bi-chat-dots display-6 text-muted mb-2"></i>
                                <p class="text-muted mb-0">Belum ada tanggapan</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- ✏️ EDIT -->
                    <?php 
                        $bolehEdit = (
                            session('role') == 'pelapor' &&
                            $pengaduan['status'] == 'menunggu' &&
                            empty($tanggapan)
                        );
                    ?>

                    <?php if($bolehEdit): ?>
                        <div class="mt-4">
                            <a href="<?= base_url('pengaduan/edit/' . $pengaduan['id_pengaduan']) ?>" 
                               class="btn btn-warning">
                                <i class="bi bi-pencil-square me-1"></i> Edit Pengaduan
                            </a>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>

        <!-- 🔧 KANAN -->
        <?php if(strtolower(session('role')) == 'admin'): ?>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">

                    <h5 class="fw-bold mb-3">Moderasi</h5>

                    <?php 
                        $status = strtolower($pengaduan['status']);
                        if ($status == 'menunggu' || $status == 'diproses'): 
                    ?>

                        <div class="d-grid gap-2">
                            <a href="<?= base_url('penugasan/create/' . $pengaduan['id_pengaduan']) ?>" 
                               class="btn btn-primary">
                                Tugaskan Teknisi
                            </a>

                            <a href="<?= base_url('pengaduan/tolak/' . $pengaduan['id_pengaduan']) ?>" 
                               class="btn btn-danger">
                                Tolak Laporan
                            </a>
                        </div>

                    <?php else: ?>

                        <div class="alert alert-light text-center">
                            Status: <b><?= $pengaduan['status'] ?></b>
                        </div>

                    <?php endif; ?>

                </div>
            </div>
        </div>
        <?php endif; ?>

    </div>
</div>

<?= $this->endSection() ?>