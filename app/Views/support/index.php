<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* 🎫 Elite Ticket Monitoring System */
    .admin-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 1.25rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    /* Styling Table */
    .table-ticket thead th {
        background-color: #f8fafc;
        text-transform: uppercase;
        font-size: 0.7rem;
        font-weight: 800;
        letter-spacing: 0.075em;
        color: #64748b;
        border: none;
        padding: 1.25rem 1rem;
    }

    .table-ticket tbody tr {
        transition: all 0.2s ease;
        border-bottom: 1px solid #f1f5f9;
    }

    .table-ticket tbody tr:hover {
        background-color: #fdfdfd;
    }

    .table-ticket tbody td {
        padding: 1.25rem 1rem;
        vertical-align: middle;
        color: #1e293b;
    }

    /* Badge Customization */
    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        font-weight: 700;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.025em;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .badge-open {
        background-color: #fffbeb;
        color: #b45309;
        border: 1px solid #fde68a;
    }

    .badge-closed {
        background-color: #f0fdf4;
        color: #15803d;
        border: 1px solid #bbf7d0;
    }

    /* Action Button */
    .btn-detail-elite {
        background: #f1f5f9;
        color: #475569;
        font-weight: 700;
        font-size: 0.75rem;
        padding: 0.5rem 1.25rem;
        border-radius: 0.6rem;
        border: 1px solid #e2e8f0;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }

    .btn-detail-elite:hover {
        background: #1e293b;
        color: white;
        border-color: #1e293b;
        transform: translateY(-1px);
    }

    .truncate-pesan {
        max-width: 350px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        color: #64748b;
        font-size: 0.85rem;
    }
</style>

<div class="container-fluid py-5">
    <div class="mb-4">
        <h3 class="fw-800 text-dark mb-1">Tiket Dukungan</h3>
        <p class="text-muted small">Kelola dan respon kendala teknis dari pengguna secara real-time.</p>
    </div>

    <div class="admin-card">
        <div class="table-responsive">
            <table class="table table-ticket mb-0">
                <thead>
                    <tr>
                        <th width="250">Judul Masalah</th>
                        <th>Ringkasan Pesan</th>
                        <th class="text-center" width="150">Status</th>
                        <th class="text-center" width="120">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($ticket)): ?>
                        <?php foreach($ticket as $t): ?>
                        <tr>
                            <td>
                                <div class="fw-800 text-dark"><?= $t['judul'] ?></div>
                                <small class="text-muted font-monospace">Ref: #TK-<?= str_pad($t['id_support'], 4, '0', STR_PAD_LEFT) ?></small>
                            </td>
                            <td>
                                <div class="truncate-pesan">
                                    <i class="bi bi-chat-right-dots me-2 opacity-50"></i><?= $t['pesan'] ?>
                                </div>
                            </td>
                            <td class="text-center">
                                <?php if($t['status'] == 'open'): ?>
                                    <span class="status-badge badge-open">
                                        <i class="bi bi-clock-history"></i> OPEN
                                    </span>
                                <?php else: ?>
                                    <span class="status-badge badge-closed">
                                        <i class="bi bi-check-circle-fill"></i> CLOSED
                                    </span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <a href="<?= base_url('support/detail/' . $t['id_support']) ?>" class="btn-detail-elite">
                                Detail <i class="bi bi-arrow-right-short ms-1"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <i class="bi bi-inbox text-light display-1 mb-3 d-block"></i>
                                <span class="text-muted fw-bold">Tidak ada tiket aktif saat ini.</span>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>