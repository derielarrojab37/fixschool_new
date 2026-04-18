<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* Admin One Profile Styling */
    .profile-card {
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        background-color: #ffffff;
        overflow: hidden;
    }

    .profile-cover {
        height: 100px;
        background-color: var(--admin-one-primary);
        background-image: linear-gradient(rgba(0,0,0,0.1), rgba(0,0,0,0.1));
    }

    .profile-avatar-wrapper {
        margin-top: -50px;
        display: flex;
        justify-content: center;
    }

    .profile-avatar {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        border: 4px solid #fff;
        object-fit: cover;
        background-color: #f3f4f6;
    }

    .info-label {
        color: #6b7280;
        font-size: .7rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .05em;
    }

    .info-value {
        font-size: .95rem;
        color: #1f2937;
        font-weight: 500;
    }

    .detail-section {
        border-bottom: 1px solid #f3f4f6;
        padding: 1rem 0;
    }

    .detail-section:last-child {
        border-bottom: none;
    }

    .btn-admin-one {
        background-color: var(--admin-one-primary);
        color: #fff;
        border-radius: 0.5rem;
        font-weight: 700;
        padding: 0.6rem 1.5rem;
        transition: all 0.2s;
    }

    .btn-admin-one:hover {
        background-color: #1d4ed8;
        color: #fff;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        background-color: #ecfdf5;
        color: #059669;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 700;
    }
</style>

<div class="container-fluid">
    <div class="mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1">
                <li class="breadcrumb-item"><a href="<?= base_url('users') ?>" class="text-decoration-none">Users</a></li>
                <li class="breadcrumb-item active">Profile Detail</li>
            </ol>
        </nav>
        <h2 class="fw-800 text-dark">User Account</h2>
    </div>

    <div class="row">
        <div class="col-xl-4 col-md-5">
            <div class="profile-card shadow-sm mb-4">
                <div class="profile-cover"></div>
                <div class="profile-avatar-wrapper">
                    <img src="<?= $user['foto'] ? base_url('uploads/users/' . $user['foto']) : base_url('assets/img/default-user.png') ?>" 
                         class="profile-avatar shadow-sm">
                </div>
                
                <div class="card-body text-center pt-3">
                    <h4 class="fw-bold text-dark mb-1"><?= $user['nama'] ?></h4>
                    <p class="text-muted small mb-3"><?= $user['email'] ?></p>
                    
                    <div class="d-flex justify-content-center gap-2 mb-4">
                        <span class="badge bg-primary px-3 py-2 rounded-pill">
                            <?= strtoupper($user['role']) ?>
                        </span>
                        <div class="status-badge">
                            <i class="bi bi-patch-check-fill me-1"></i> ACTIVE
                        </div>
                    </div>

                    <div class="row border-top border-bottom py-3 mb-4 bg-light mx-0">
                        <div class="col-6 border-end">
                            <span class="d-block info-label">User ID</span>
                            <span class="fw-bold">#<?= $user['id_user'] ?></span>
                        </div>
                        <div class="col-6">
                            <span class="d-block info-label">Joined</span>
                            <span class="fw-bold">2026</span>
                        </div>
                    </div>

                    <?php if (session()->get('role') == 'admin') : ?>
                        <div class="px-2">
                            <a href="<?= base_url('users/edit/' . $user['id_user']) ?>" class="btn btn-admin-one w-100">
                                <i class="bi bi-pencil-square me-2"></i> Edit Account
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-md-7">
            <div class="card border-0 shadow-sm" style="border-radius: 0.75rem;">
                <div class="card-header bg-white border-bottom py-3 px-4">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-person-lines-fill me-2 text-primary"></i>Personal Information</h5>
                </div>
                <div class="card-body p-4">
                    <div class="detail-section">
                        <div class="row align-items-center">
                            <div class="col-sm-4 info-label">Full Name</div>
                            <div class="col-sm-8 info-value fw-bold"><?= $user['nama'] ?></div>
                        </div>
                    </div>
                    
                    <div class="detail-section">
                        <div class="row align-items-center">
                            <div class="col-sm-4 info-label">Email Address</div>
                            <div class="col-sm-8 info-value text-primary font-monospace"><?= $user['email'] ?></div>
                        </div>
                    </div>

                    <div class="detail-section">
                        <div class="row align-items-center">
                            <div class="col-sm-4 info-label">Username</div>
                            <div class="col-sm-8 info-value"><?= $user['username'] ?></div>
                        </div>
                    </div>

                    <div class="detail-section">
                        <div class="row align-items-center">
                            <div class="col-sm-4 info-label">Security Status</div>
                            <div class="col-sm-8 info-value">
                                <span class="text-success small fw-bold">
                                    <i class="bi bi-shield-lock-fill me-1"></i> Password Encrypted (SHA-256)
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="detail-section">
                        <div class="row align-items-center">
                            <div class="col-sm-4 info-label">System Permissions</div>
                            <div class="col-sm-8 info-value">
                                <div class="d-flex align-items-center">
                                    <div class="bg-blue-soft p-2 rounded me-2">
                                        <i class="bi bi-unlock-fill text-primary"></i>
                                    </div>
                                    <span>Authorized as <strong><?= ucfirst($user['role']) ?></strong></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light border-0 py-3">
                    <div class="d-flex align-items-center justify-content-center text-muted">
                        <i class="bi bi-info-circle me-2"></i>
                        <span class="small italic">This data is managed by the internal IT infrastructure.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>