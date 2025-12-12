@extends('frontend.studentPortal.dashboard.layouts.app')

@section('title', 'Academic Reports')
@section('icon', 'bi bi-file-earmark-text fs-4 p-2 bg-primary bg-opacity-10 rounded-3 text-primary')

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
        --soft-teal: #e0fbf6; --text-teal: #20c997;
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
    }

    /* 1. Generate Section */
    .generate-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 32px;
    }

    .form-label-custom {
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--text-muted);
        margin-bottom: 6px;
        display: block;
    }

    .custom-select {
        background-color: var(--bg-body);
        border: 1px solid var(--border-color);
        color: var(--text-main);
        border-radius: 8px;
        padding: 10px 12px;
        width: 100%;
        font-size: 0.9rem;
    }
    .custom-select:focus {
        border-color: var(--text-blue);
        outline: none;
    }

    .btn-generate {
        background-color: #0ea5e9; /* Sky Blue */
        color: white;
        border: none;
        width: 100%;
        padding: 10px;
        border-radius: 8px;
        font-weight: 600;
        transition: 0.2s;
    }
    .btn-generate:hover { background-color: #0284c7; }

    .btn-schedule {
        background-color: var(--bg-body);
        color: var(--text-muted);
        border: 1px solid var(--border-color);
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        transition: 0.2s;
    }
    .btn-schedule:hover { border-color: var(--text-blue); color: var(--text-blue); }

    /* 2. Available Report Cards */
    .report-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
        margin-bottom: 32px;
    }
    .report-type-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
    }

    .rt-header { display: flex; gap: 16px; margin-bottom: 16px; }
    .rt-icon {
        width: 48px; height: 48px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem;
    }
    .icon-blue { background-color: var(--soft-blue); color: var(--text-blue); }
    .icon-green { background-color: var(--soft-green); color: var(--text-green); }

    .rt-title { font-weight: 700; color: var(--text-main); margin-bottom: 2px; }
    .rt-sub { color: var(--text-blue); font-size: 0.8rem; font-weight: 500; }

    .rt-desc { color: var(--text-muted); font-size: 0.85rem; margin-bottom: 24px; line-height: 1.5; }

    .rt-meta { font-size: 0.75rem; color: var(--text-muted); margin-bottom: 16px; display: flex; align-items: center; gap: 6px; }

    .btn-block-action {
        width: 100%;
        padding: 10px;
        border-radius: 8px;
        font-weight: 600;
        border: none;
        transition: 0.2s;
    }
    .btn-gen-blue { background-color: #0ea5e9; color: white; }
    .btn-gen-green { background-color: #10b981; color: white; }
    .btn-preview {
        background-color: transparent; border: 1px solid var(--border-color); color: var(--text-muted); width: auto; padding: 10px 20px;
    }

    /* 3. Recent Reports List */
    .recent-list {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 32px;
    }
    .recent-item {
        display: flex; align-items: center; justify-content: space-between;
        padding: 16px 24px;
        border-bottom: 1px solid var(--border-color);
    }
    .recent-item:last-child { border-bottom: none; }

    .file-info { display: flex; align-items: center; gap: 16px; }
    .file-icon {
        width: 40px; height: 40px; border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.2rem;
    }
    .fi-pdf { background-color: rgba(220, 53, 69, 0.1); color: #ef4444; }
    .fi-xls { background-color: rgba(16, 185, 129, 0.1); color: #10b981; }
    .fi-html { background-color: rgba(249, 115, 22, 0.1); color: #f97316; }

    .file-name { font-weight: 600; color: var(--text-main); display: block; margin-bottom: 2px; }
    .file-meta { font-size: 0.75rem; color: var(--text-muted); display: flex; align-items: center; gap: 8px; }

    .badge-ready { background-color: var(--soft-green); color: var(--text-green); font-size: 0.65rem; padding: 2px 8px; border-radius: 4px; font-weight: 700; }
    .badge-expired { background-color: var(--border-color); color: var(--text-muted); font-size: 0.65rem; padding: 2px 8px; border-radius: 4px; font-weight: 700; }

    .action-icons { display: flex; gap: 12px; font-size: 1.1rem; color: var(--text-muted); }
    .action-icons i:hover { color: var(--text-blue); cursor: pointer; }

    /* 4. Preview Section Styles (ADDED) */
    .preview-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
    }
    .preview-list {
        list-style: disc;
        padding-left: 20px;
        margin-bottom: 16px;
        font-size: 0.85rem;
        color: var(--text-muted);
    }
    .preview-list li { margin-bottom: 4px; }
    .preview-heading {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text-blue);
        margin-bottom: 8px;
        display: block;
    }

    @media(max-width: 991px) {
        .report-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="content-body">

    <!-- 1. Generate New Report -->
    <div class="generate-card">
        <h6 class="fw-bold text-main mb-4">Generate New Report</h6>

        <div class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label-custom">Report Type</label>
                <select class="custom-select">
                    <option>Academic Progress</option>
                    <option>Attendance Summary</option>
                    <option>Fee Statement</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label-custom">Period</label>
                <select class="custom-select">
                    <option>Current Semester</option>
                    <option>Last Semester</option>
                    <option>All Time</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label-custom">Format</label>
                <select class="custom-select">
                    <option>PDF</option>
                    <option>Excel</option>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button class="btn-generate"><i class="bi bi-download me-2"></i> Generate</button>
                <button class="btn-schedule"><i class="bi bi-clock-history"></i></button>
            </div>
        </div>
    </div>

    <!-- 2. Available Reports Grid -->
    <h6 class="fw-bold text-main mb-3">Available Reports</h6>
    <div class="report-grid">

        <!-- Card 1 -->
        <div class="report-type-card">
            <div class="rt-header">
                <div class="rt-icon icon-blue"><i class="bi bi-graph-up-arrow"></i></div>
                <div>
                    <h6 class="rt-title">Academic Progress Report</h6>
                    <span class="rt-sub">Academic</span>
                </div>
            </div>
            <p class="rt-desc">Comprehensive overview of your academic performance across all subjects, including GPA and grade breakdown.</p>

            <div class="rt-meta"><i class="bi bi-clock"></i> 2-3 minutes generation time</div>

            <div class="d-flex gap-3">
                <button class="btn-block-action btn-gen-blue">Generate</button>
                <button class="btn-block-action btn-preview">Preview</button>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="report-type-card">
            <div class="rt-header">
                <div class="rt-icon icon-green"><i class="bi bi-file-earmark-check"></i></div>
                <div>
                    <h6 class="rt-title">Official Transcript</h6>
                    <span class="rt-sub">Official</span>
                </div>
            </div>
            <p class="rt-desc">Complete academic record with grades, credits, and GPA calculations suitable for official use.</p>

            <div class="rt-meta"><i class="bi bi-clock"></i> 1-2 minutes generation time</div>

            <div class="d-flex gap-3">
                <button class="btn-block-action btn-gen-green">Generate</button>
                <button class="btn-block-action btn-preview">Preview</button>
            </div>
        </div>

    </div>

    <!-- 3. Recent Reports -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold text-main m-0">Recent Reports</h6>
        <a href="#" class="text-primary small fw-bold text-decoration-none">View All</a>
    </div>

    <div class="recent-list">

        <!-- Item 1 -->
        <div class="recent-item">
            <div class="file-info">
                <div class="file-icon fi-pdf"><i class="bi bi-file-earmark-pdf"></i></div>
                <div>
                    <span class="file-name">Academic Progress Report - Fall 2024</span>
                    <div class="file-meta">
                        <span>PDF • 2.4 MB</span>
                        <span class="badge-ready">Ready</span>
                    </div>
                </div>
            </div>
            <div class="action-icons">
                <i class="bi bi-download"></i>
                <i class="bi bi-share"></i>
            </div>
        </div>

        <!-- Item 2 -->
        <div class="recent-item">
            <div class="file-info">
                <div class="file-icon fi-xls"><i class="bi bi-file-earmark-spreadsheet"></i></div>
                <div>
                    <span class="file-name">Attendance Summary - November 2024</span>
                    <div class="file-meta">
                        <span>Excel • 876 KB</span>
                        <span class="badge-ready">Ready</span>
                    </div>
                </div>
            </div>
            <div class="action-icons">
                <i class="bi bi-download"></i>
                <i class="bi bi-share"></i>
            </div>
        </div>

        <!-- Item 3 -->
        <div class="recent-item">
            <div class="file-info">
                <div class="file-icon fi-pdf"><i class="bi bi-file-earmark-pdf"></i></div>
                <div>
                    <span class="file-name">Internship Progress - Q4 2024</span>
                    <div class="file-meta">
                        <span>PDF • 3.1 MB</span>
                        <span class="badge-ready">Ready</span>
                    </div>
                </div>
            </div>
            <div class="action-icons">
                <i class="bi bi-download"></i>
                <i class="bi bi-share"></i>
            </div>
        </div>

        <!-- Item 4 -->
        <div class="recent-item">
            <div class="file-info">
                <div class="file-icon fi-html"><i class="bi bi-filetype-html"></i></div>
                <div>
                    <span class="file-name">Performance Analysis - Semester 1</span>
                    <div class="file-meta">
                        <span>HTML • 1.2 MB</span>
                        <span class="badge-expired">Expired</span>
                    </div>
                </div>
            </div>
            <div class="action-icons">
                <span class="text-primary small fw-bold" style="cursor: pointer;">Regenerate</span>
            </div>
        </div>

    </div>

    <!-- 4. Academic Progress Report Preview (ADDED) -->
    <div class="preview-card">
        <h6 class="fw-bold text-main mb-4">Academic Progress Report Preview</h6>

        <div class="bg-hover p-4 rounded-3 border border-light">
            <span class="preview-heading">Academic Summary</span>
            <ul class="preview-list">
                <li>Overall GPA: 3.7/4.0</li>
                <li>Credits Completed: 45/120</li>
                <li>Academic Standing: Good</li>
            </ul>

            <span class="preview-heading mt-3">Subject Performance</span>
            <ul class="preview-list">
                <li>Computer Science: A-</li>
                <li>Mathematics: B+</li>
                <li>Physics: A</li>
                <li>English: B</li>
            </ul>

            <span class="preview-heading mt-3">Attendance Analysis</span>
            <ul class="preview-list">
                <li>Overall Attendance: 94%</li>
                <li>Best Subject: Physics (98%)</li>
                <li>Needs Attention: English (90%)</li>
            </ul>

            <span class="preview-heading mt-3">Recommendations</span>
            <ul class="preview-list">
                <li>Focus on English participation</li>
                <li>Maintain current performance level</li>
                <li>Consider advanced courses</li>
            </ul>
        </div>
    </div>

</div>
@endsection
