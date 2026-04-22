<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* 💬 Elite Dialogue System */
    .ticket-container {
        max-width: 900px;
        margin: 0 auto;
    }

    /* Header Laporan Utama */
    .main-report-card {
        background: #f8fafc;
        border-left: 5px solid #0f172a;
        border-radius: 1rem;
        padding: 2rem;
        margin-bottom: 3rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    /* Bubble Percakapan */
    .chat-bubble {
        max-width: 85%;
        padding: 1.25rem;
        border-radius: 1.25rem;
        position: relative;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }

    /* Pesan dari Petugas/Admin (Kanan) */
    .bubble-admin {
        background: #1e293b;
        color: white;
        margin-left: auto;
        border-bottom-right-radius: 0.25rem;
    }

    /* Pesan dari User (Kiri) */
    .bubble-user {
        background: white;
        border: 1px solid #e2e8f0;
        color: #1e293b;
        margin-right: auto;
        border-bottom-left-radius: 0.25rem;
    }

    .chat-meta {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.025em;
        margin-bottom: 0.5rem;
        display: flex;
        justify-content: space-between;
    }

    /* Form Input Balasan */
    .reply-box {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 1.25rem;
        padding: 1.5rem;
        box-shadow: 0 -10px 15px -3px rgba(0, 0, 0, 0.02);
    }

    .form-reply-control {
        border: 1px solid #e2e8f0;
        border-radius: 0.75rem;
        padding: 1rem;
        resize: none;
        transition: all 0.2s;
    }

    .form-reply-control:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        outline: none;
    }

    .btn-send-elite {
        background: #3b82f6;
        color: white;
        font-weight: 700;
        padding: 0.75rem 2rem;
        border-radius: 0.75rem;
        border: none;
        transition: all 0.2s;
    }

    .btn-send-elite:hover {
        background: #2563eb;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.2);
    }
</style>

<div class="container py-5 ticket-container">
    
    <div class="main-report-card">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb small fw-bold">
                <li class="breadcrumb-item"><a href="<?= base_url('support') ?>" class="text-muted text-decoration-none">SUPPORT</a></li>
                <li class="breadcrumb-item active text-dark">TIKET DETAIL</li>
            </ol>
        </nav>
        <h2 class="fw-800 text-dark mb-2"><?= $tiket['judul'] ?></h2>
        <p class="text-slate-600 mb-0 lh-lg"><?= $tiket['pesan'] ?></p>
    </div>

    <div class="d-flex align-items-center gap-2 mb-4">
        <hr class="flex-grow-1">
        <span class="badge bg-light text-muted border px-3 py-2 rounded-pill small fw-bold">
            <i class="bi bi-chat-left-text me-1"></i> LOG PERCAKAPAN
        </span>
        <hr class="flex-grow-1">
    </div>

    <div class="conversation-wrapper mb-5">
        <?php if(!empty($reply)): ?>
            <?php foreach($reply as $r): ?>
    <?php 
        // Logika Chatting: 
        // Jika id_user di baris ini SAMA dengan yang sedang login, taruh di KANAN (bubble-admin)
        // Jika BERBEDA, taruh di KIRI (bubble-user)
        $isMe = ($r['id_user'] == session()->get('id_user')); 
    ?>
    
    <div class="chat-bubble <?= $isMe ? 'bubble-admin' : 'bubble-user' ?>">
        <div class="chat-meta">
            <span class="<?= $isMe ? 'text-blue-200' : 'text-primary' ?>">
                <i class="bi <?= $r['id_user'] == 1 ? 'bi-shield-check' : 'bi-person-fill' ?> me-1"></i>
                <?= $r['nama'] ?> <?= $isMe ? '(Anda)' : '' ?>
            </span>
            <span class="opacity-50"><?= date('d M, H:i', strtotime($r['created_at'])) ?></span>
        </div>
        <p class="mb-0 lh-base"><?= $r['pesan'] ?></p>
    </div>
<?php endforeach; ?>
        <?php else: ?>
            <div class="text-center py-5">
                <div class="bg-light d-inline-block p-4 rounded-circle mb-3">
                    <i class="bi bi-chat-dots text-muted fs-1"></i>
                </div>
                <h6 class="fw-bold text-dark">Belum ada balasan</h6>
                <p class="small text-muted">Jadilah yang pertama merespon tiket ini.</p>
            </div>
        <?php endif; ?>

        
    </div>

    <div class="reply-box mt-5 border-top-0">
        <h5 class="fw-800 text-dark mb-3">Tulis Balasan</h5>
        <form action="<?= base_url('support/reply/' . $tiket['id_support']) ?>" method="post">
            <div class="mb-3">
                <textarea name="pesan" class="form-control form-reply-control" rows="4" 
                          placeholder="Ketik pesan Anda di sini secara detail..." required></textarea>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <span class="small text-muted">
                    <i class="bi bi-info-circle me-1"></i> Balasan akan dikirimkan ke email pelapor.
                </span>
                <button type="submit" class="btn btn-send-elite">
                    KIRIM BALASAN <i class="bi bi-send-fill ms-2"></i>
                </button>
            </div>
            <div class="text-center mt-4">
    <a href="<?= base_url('support') ?>" class="btn btn-light border rounded-pill px-4 shadow-sm">
        <i class="bi bi-house-door me-2"></i> Tutup & Kembali
    </a>
</div>
        </form>
    </div>

</div>

<?= $this->endSection() ?>