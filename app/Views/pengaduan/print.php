<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pengaduan - Fix School</title>
    <style>
        body { font-family: sans-serif; padding: 20px; color: #333; line-height: 1.4; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 3px double #333; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; table-layout: fixed; }
        th { background-color: #f2f2f2; text-align: center; padding: 12px; border: 1px solid #000; font-size: 12px; text-transform: uppercase; }
        td { padding: 10px; border: 1px solid #000; font-size: 11px; vertical-align: top; word-wrap: break-word; }
        .text-center { text-align: center; }
        .footer { margin-top: 30px; text-align: right; font-size: 11px; font-style: italic; }
        @media print {
            @page { margin: 1cm; }
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="header">
        <h2 style="margin:0;">FIX SCHOOL MANAGEMENT</h2>
        <p style="margin:5px 0; font-weight: bold;">KELUHAN PENGADUAN MASYARAKAT</p>
        <p style="margin:5px 0;">SMK AL MAMUN SUMEDANG</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Nama Pelapor</th>
                <th width="15%">Tanggal Laporan</th>
                <th width="30%">Uraian Keluhan / Pengaduan</th>
                <th width="35%">Tindak Lanjut Penyelesaian</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($pengaduan)): ?>
                <?php $no = 1; foreach ($pengaduan as $p): ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td><?= $p['nama_pelapor'] ?></td>
                    <td class="text-center"><?= date('d/m/Y', strtotime($p['tanggal'])) ?></td>
                    <td>
                        <strong>[<?= $p['nama_jenis'] ?>]</strong><br>
                        <?= $p['judul'] ?><br>
                        <small>Lokasi: <?= $p['lokasi'] ?></small>
                    </td>
                    <td>
                        <?php if($p['status'] == 'ditolak'): ?>
                            <span style="color: red;">DITOLAK: <?= $p['alasan_ditolak'] ?></span>
                        <?php elseif(!empty($p['isi_tanggapan'])): ?>
                            <?= $p['isi_tanggapan'] ?>
                        <?php else: ?>
                            <span style="color: #666;">Sedang dalam status: <?= strtoupper($p['status']) ?></span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data ditemukan untuk periode/filter ini.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="footer">
        Dicetak otomatis oleh sistem pada: <?= date('d/m/Y H:i:s') ?>
    </div>
</body>
</html>