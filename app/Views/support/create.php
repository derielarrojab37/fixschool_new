<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* 🎨 Support Ticket Premium Style */
    .ticket-container {
        max-width: 850px;
        margin: 2rem auto;
    }

    .card-support {
        border: none;
        border-radius: 1.5rem;
        background: #ffffff;
        box-shadow: 0 15px 35px rgba(0,0,0,0.05);
        overflow: hidden;
    }

    .header-gradient-support {
        background: linear-gradient(135deg, #4f46e5 0%, #2563eb 100%);
        padding: 2.5rem;
        color: white;
    }

    .form-label {
        font-weight: 700;
        font-size: 0.85rem;
        color: #334155;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.75rem;
    }

    .input-group-ticket {
        background: #f8fafc;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        transition: all 0.3s;
        padding: 0.5rem 0.8rem;
    }

    .input-group-ticket:focus-within {
        border-color: #2563eb;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
    }

    .input-group-ticket input, 
    .input-group-ticket textarea {
        border: none !important;
        background: transparent !important;
        box-shadow: none !important;
        padding-left: 10px;
        font-weight: 500;
    }

    .input-group-ticket textarea {
        min-height: 160px;
    }

    .ticket-icon {
        color: #94a3b8;
        font-size: 1.2rem;
    }

    .btn-send-ticket {
        background: #2563eb;
        color: white;
        font-weight: 800;
        padding: 1rem 2.5rem;
        border-radius: 12px;
        border: none;
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.25);
        transition: all 0.3s;
    }

    .btn-send-ticket:hover {
        background: #1d4ed8;
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(37, 99, 235, 0.35);
    }

    .btn-back-ghost {
        color: #64748b;
        font-weight: 700;
        text-decoration: none;
        transition: 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-back-ghost:hover {
        color: #1e293b;
        transform: translateX(-5px);
    }
</style>

<div class="container py-4">
    <div class="ticket-container">
        
        <div class="mb-4">
            <a href="<?= base_url('support') ?>" class="btn-back-ghost">
                <i class="bi bi-arrow-left-circle-fill fs-5"></i> Kembali ke Daftar Tiket
            </a>
        </div>

        <div class="card card-support">
            <div class="header-gradient-support">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-4">
                        <div class="bg-white bg-opacity-20 rounded-4 p-3 border border-white border-opacity-20 shadow-sm">
                            <i class="bi bi-headset fs-2"></i>
                        </div>
                        <div>
                            <h3 class="fw-bold mb-1">Buat Tiket Baru</h3>
                            <p class="mb-0 opacity-75">Ceritakan kendala Anda, kami siap membantu.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body p-4 p-md-5">
                <form action="<?= base_url('support/store') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="row g-4">
                        <div class="col-12">
                            <label class="form-label">Subjek Keluhan</label>
                            <div class="input-group-ticket d-flex align-items-center">
                                <i class="bi bi-bookmark-plus ticket-icon"></i>
                                <input type="text" name="judul" class="form-control" 
                                       placeholder="Misal: Kendala Login / Request Maintenance" required>
                            </div>
                            <div class="form-text mt-2 text-muted small">
                                Gunakan judul yang singkat namun deskriptif.
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Detail Masalah</label>
                            <div class="input-group-ticket d-flex align-items-start pt-3">
                                <i class="bi bi-chat-dots ticket-icon mt-1"></i>
                                <textarea name="pesan" class="form-control" 
                                          placeholder="Tuliskan keluhan Anda secara detail di sini..." required></textarea>
                            </div>
                        </div>

                        <div class="col-12 mt-4">
                            <div class="p-3 rounded-4 bg-light d-flex gap-3 align-items-center border border-light">
                                <div class="bg-primary bg-opacity-10 p-2 rounded-3 text-primary">
                                    <i class="bi bi-shield-check"></i>
                                </div>
                                <p class="mb-0 small text-muted">
                                    Tiket Anda akan diteruskan ke tim IT dan akan segera diproses sesuai antrean.
                                </p>
                            </div>
                        </div>

                        <div class="col-12 text-end mt-5">
                            <button type="submit" class="btn-send-ticket shadow">
                                <i class="bi bi-send-fill me-2"></i> Kirim Tiket Sekarang
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <p class="text-center mt-4 text-muted small">
            Butuh bantuan mendesak? Hubungi kami via <b>Helpdesk Internal</b>.
        </p>
    </div>
</div>

<?= $this->endSection() ?>