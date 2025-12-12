@extends('frontend.studentPortal.dashboard.layouts.app')

@section('title', 'Digital Certificates')
@section('icon', 'bi bi-award fs-4 p-2 bg-primary bg-opacity-10 rounded-3 text-primary')

@section('content')
<style>
    /* Theme Variables */
    :root {
        --bg-body: #f8f9fa;
        --bg-sidebar: #ffffff;
        --bg-card: #ffffff;
        --bg-hover: #f8f9fa;

        --text-main: #343a40;
        --text-muted: #6c757d;

        --border-color: #e9ecef;

        /* Soft Colors */
        --soft-blue: #e7f1ff; --text-blue: #0d6efd;
        --soft-green: #d1e7dd; --text-green: #0f5132;
        --soft-orange: #ffecb5; --text-orange: #664d03;
        --soft-red: #f8d7da; --text-red: #842029;
        --soft-teal: #e0fbf6; --text-teal: #107c6f;
        --soft-purple: #e0cffc; --text-purple: #6f42c1;
    }

    [data-theme="dark"] {
        --bg-body: #0f1626;
        --bg-sidebar: #1e293b;
        --bg-card: #2e333f;
        --bg-hover: #2e333f;

        --text-main: #e9ecef;
        --text-muted: #adb5bd;

        --border-color: #767677;

        --soft-blue: rgba(13, 110, 253, 0.15); --text-blue: #6ea8fe;
        --soft-green: rgba(25, 135, 84, 0.15); --text-green: #75b798;
        --soft-orange: rgba(255, 193, 7, 0.15); --text-orange: #ffda6a;
        --soft-red: rgba(220, 53, 69, 0.15); --text-red: #ea868f;
        --soft-teal: rgba(32, 201, 151, 0.15); --text-teal: #a9e5d6;
        --soft-purple: rgba(111, 66, 193, 0.15); --text-purple: #a370f7;
    }

    /* 1. Overview Section */
    .overview-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 32px;
    }

    .stat-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        text-align: center;
        transition: transform 0.2s;
        border-bottom: 4px solid transparent;
    }
    .stat-card:hover { transform: translateY(-4px); }

    .sc-blue { background-color: var(--soft-blue); border-bottom-color: var(--text-blue); }
    .sc-green { background-color: var(--soft-green); border-bottom-color: var(--text-green); }
    .sc-orange { background-color: var(--soft-orange); border-bottom-color: var(--text-orange); }
    .sc-purple { background-color: var(--soft-purple); border-bottom-color: var(--text-purple); }

    .sc-icon { font-size: 1.5rem; margin-bottom: 8px; display: block; }
    .sc-val { font-size: 1.8rem; font-weight: 700; color: var(--text-main); line-height: 1.2; }
    .sc-lbl { font-size: 0.8rem; color: var(--text-muted); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }

    /* 2. Quick Actions */
    .action-row {
        display: flex; gap: 16px; margin-bottom: 32px;
    }
    .btn-quick {
        flex: 1;
        padding: 12px;
        border-radius: 20px; /* Pill shape */
        font-weight: 600;
        font-size: 0.9rem;
        border: none;
        color: white;
        text-align: center;
        transition: 0.2s;
        display: flex; align-items: center; justify-content: center; gap: 8px;
    }
    .btn-q-blue { background-color: #0ea5e9; }
    .btn-q-blue:hover { background-color: #0284c7; }

    .btn-q-dark-blue { background-color: #3b82f6; }
    .btn-q-dark-blue:hover { background-color: #2563eb; }

    .btn-q-green { background-color: #10b981; }
    .btn-q-green:hover { background-color: #059669; }

    /* 3. Certificate Cards */
    .cert-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        overflow: hidden;
        margin-bottom: 24px;
        position: relative;
    }
    /* Gradient Background Top */
    .cert-header-bg {
        height: 100px;
        background: linear-gradient(90deg, #e0f2fe 0%, #f0f9ff 100%);
        position: relative;
    }
    .bg-gradient-orange { background: linear-gradient(90deg, #ffedd5 0%, #fff7ed 100%); }

    [data-theme="dark"] .cert-header-bg { background: linear-gradient(90deg, rgba(14, 165, 233, 0.15) 0%, rgba(14, 165, 233, 0.05) 100%); }
    [data-theme="dark"] .bg-gradient-orange { background: linear-gradient(90deg, rgba(249, 115, 22, 0.15) 0%, rgba(249, 115, 22, 0.05) 100%); }

    .cert-body {
        padding: 24px;
        position: relative;
        padding-top: 40px; /* Space for icon */
    }

    .cert-icon-box {
        width: 64px; height: 64px;
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.8rem;
        position: absolute;
        top: -32px; left: 24px;
        color: #0ea5e9;
    }
    [data-theme="dark"] .cert-icon-box { background-color: #1e293b; color: #38bdf8; }
    .text-orange-box { color: #f97316; }
    [data-theme="dark"] .text-orange-box { color: #fb923c; }

    .badge-verified {
        position: absolute; top: 24px; right: 24px;
        background-color: #10b981; color: white;
        padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 700;
        display: flex; align-items: center; gap: 4px;
    }

    .cert-title { font-size: 1.1rem; font-weight: 700; color: var(--text-main); margin-bottom: 4px; }
    .cert-issuer { font-size: 0.85rem; color: var(--text-blue); font-weight: 600; margin-bottom: 12px; display: block; }

    .cert-meta { font-size: 0.8rem; color: var(--text-muted); display: flex; gap: 16px; margin-bottom: 16px; }

    .skills-row { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 20px; }
    .skill-pill {
        background-color: var(--soft-blue); color: var(--text-blue);
        font-size: 0.75rem; padding: 4px 12px; border-radius: 6px; font-weight: 600;
    }
    .sp-orange { background-color: var(--soft-orange); color: var(--text-orange); }

    .score-badge {
        background-color: var(--bg-hover);
        border: 1px solid var(--border-color);
        padding: 4px 10px; border-radius: 6px;
        font-size: 0.75rem; font-weight: 600; color: var(--text-main);
        display: inline-flex; align-items: center; gap: 6px; margin-right: 8px;
    }
    .score-icon { color: #f59e0b; }

    .cert-footer {
        display: flex; justify-content: space-between; align-items: center;
        border-top: 1px solid var(--border-color);
        padding-top: 16px; margin-top: 8px;
    }
    .btn-action-light {
        background-color: transparent; border: 1px solid var(--border-color);
        color: var(--text-muted); font-size: 0.85rem; font-weight: 600;
        padding: 8px 16px; border-radius: 6px; transition: 0.2s;
    }
    .btn-action-light:hover { border-color: var(--text-blue); color: var(--text-blue); }

    .btn-main-dl {
        background-color: #0ea5e9; color: white; border: none;
        padding: 8px 24px; border-radius: 6px; font-weight: 600; font-size: 0.85rem;
        flex-grow: 1; margin-right: 12px;
    }
    .btn-main-orange { background-color: #f97316; }

    @media(max-width: 991px) {
        .overview-grid { grid-template-columns: 1fr 1fr; }
        .action-row { flex-direction: column; }
    }
</style>

<div class="content-body">

    <!-- 1. Certificate Overview -->
    <h6 class="fw-bold text-main mb-3">Certificate Overview</h6>
    <div class="overview-grid">
        <div class="stat-card sc-blue">
            <i class="bi bi-award sc-icon text-primary"></i>
            <span class="sc-val">12</span>
            <span class="sc-lbl">Total</span>
        </div>
        <div class="stat-card sc-green">
            <i class="bi bi-patch-check sc-icon text-success"></i>
            <span class="sc-val">10</span>
            <span class="sc-lbl">Verified</span>
        </div>
        <div class="stat-card sc-orange">
            <i class="bi bi-clock-history sc-icon text-warning"></i>
            <span class="sc-val">3</span>
            <span class="sc-lbl">In Progress</span>
        </div>
        <div class="stat-card sc-purple">
            <i class="bi bi-briefcase sc-icon text-purple"></i>
            <span class="sc-val">7</span>
            <span class="sc-lbl">Portfolio Ready</span>
        </div>
    </div>

    <!-- 2. Quick Actions -->
    <h6 class="fw-bold text-main mb-3">Quick Actions</h6>
    <div class="action-row">
        <button class="btn-quick btn-q-blue"><i class="bi bi-briefcase"></i> Create Digital Portfolio</button>
        <button class="btn-quick btn-q-dark-blue"><i class="bi bi-linkedin"></i> Share to LinkedIn</button>
        <button class="btn-quick btn-q-green"><i class="bi bi-shield-check"></i> Verify Certificates</button>
    </div>

    <!-- 3. My Certificates List -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h6 class="fw-bold text-main m-0">My Certificates</h6>
        <select class="form-select form-select-sm w-auto border-0 bg-light shadow-sm">
            <option>Recent</option>
            <option>Oldest</option>
        </select>
    </div>

    <!-- Certificate 1 -->
    <div class="cert-card">
        <div class="cert-header-bg"></div>

        <div class="cert-body">
            <div class="cert-icon-box">
                <i class="bi bi-award"></i>
            </div>
            <span class="badge-verified"><i class="bi bi-check-circle-fill"></i> VERIFIED</span>

            <h5 class="cert-title">Flutter Mobile Development Certification</h5>
            <span class="cert-issuer">Issued by Google Developers</span>

            <div class="cert-meta">
                <span><i class="bi bi-calendar-event me-1"></i> Issued: 12/11/2025</span>
                <span><i class="bi bi-hourglass-split me-1"></i> Expires: 12/12/2026</span>
            </div>

            <p class="--text-muted small mb-3">Comprehensive certification in Flutter mobile app development covering widgets, state management, and deployment.</p>

            <div class="skills-row">
                <span class="skill-pill">Flutter</span>
                <span class="skill-pill">Dart</span>
                <span class="skill-pill">Mobile Development</span>
                <span class="skill-pill">UI/UX</span>
            </div>

            <div class="mb-4">
                <span class="score-badge"><i class="bi bi-star-fill score-icon"></i> Score: 95%</span>
                <span class="score-badge text-success"><i class="bi bi-graph-up-arrow"></i> Industry Recognized</span>
            </div>

            <div class="cert-footer">
                <button class="btn-main-dl"><i class="bi bi-download me-2"></i> Download</button>
                <div class="d-flex gap-2">
                    <button class="btn-action-light"><i class="bi bi-share"></i> Share</button>
                    <button class="btn-action-light"><i class="bi bi-eye"></i> Verify</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Certificate 2 -->
    <div class="cert-card">
        <div class="cert-header-bg bg-gradient-orange"></div>

        <div class="cert-body">
            <div class="cert-icon-box text-orange-box">
                <i class="bi bi-patch-check"></i>
            </div>
            <span class="badge-verified"><i class="bi bi-check-circle-fill"></i> VERIFIED</span>

            <h5 class="cert-title">AWS Cloud Practitioner</h5>
            <span class="cert-issuer text-orange-box">Issued by Amazon Web Services</span>

            <div class="cert-meta">
                <span><i class="bi bi-calendar-event me-1"></i> Issued: 13/10/2025</span>
                <span><i class="bi bi-hourglass-split me-1"></i> Expires: 11/12/2028</span>
            </div>

            <p class="--text-muted small mb-3">Foundational certification demonstrating understanding of AWS Cloud concepts and services.</p>

            <div class="skills-row">
                <span class="skill-pill sp-orange">AWS</span>
                <span class="skill-pill sp-orange">Cloud Computing</span>
                <span class="skill-pill sp-orange">Infrastructure</span>
                <span class="skill-pill sp-orange">Security</span>
            </div>

            <div class="mb-4">
                <span class="score-badge"><i class="bi bi-star-fill score-icon"></i> Score: 98%</span>
                <span class="score-badge text-success"><i class="bi bi-graph-up-arrow"></i> Industry Recognized</span>
            </div>

            <div class="cert-footer">
                <button class="btn-main-dl btn-main-orange"><i class="bi bi-download me-2"></i> Download</button>
                <div class="d-flex gap-2">
                    <button class="btn-action-light"><i class="bi bi-share"></i> Share</button>
                    <button class="btn-action-light"><i class="bi bi-eye"></i> Verify</button>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
