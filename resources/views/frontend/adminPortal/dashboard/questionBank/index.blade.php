@extends('frontend.adminPortal.dashboard.layouts.app')

@section('title', 'Question Bank - Add New Question')
@section('icon', 'bi-patch-question')

@section('content')
<style>
    /* Table Styling */
    .custom-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 15px;
        overflow: hidden;
    }

    .table thead th {
        background-color: rgba(255, 255, 255, 0.03);
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 1px;
        font-weight: 700;
        padding: 1.2rem 1rem;
        border-bottom: 1px solid var(--border-color);
    }

    .table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid var(--border-color);
    }

    .table tbody tr:hover {
        background-color: rgba(255, 255, 255, 0.02) !important;
        transform: scale(1.002);
    }

    .table td {
        padding: 1.2rem 1rem;
        vertical-align: middle;
    }

    /* Badges */
    .badge-soft-primary {
        background-color: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
        padding: 6px 12px;
        border-radius: 6px;
    }

    /* Action Buttons */
    .action-btn {
        width: 35px;
        height: 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        transition: 0.3s;
        border: 1px solid var(--border-color);
        background: transparent;
    }

    .btn-edit:hover {
        background: #0dcaf0;
        color: #000;
        border-color: #0dcaf0;
    }

    .btn-delete:hover {
        background: #bb2d3b;
        color: #fff;
        border-color: #bb2d3b;
    }

    .question-text {
        max-width: 250px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        font-weight: 500;
        color: var(--text-main);
    }

    /* Filters Placeholder Style */
    .filter-section {
        background: rgba(255, 255, 255, 0.02);
        padding: 15px;
        border-radius: 12px;
        border: 1px solid var(--border-color);
    }
</style>

<div class="content-body p-4">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h4 class="fw-bold text-main mb-1">Question Management</h4>
            <p class="--text-muted mb-0 small">Manage your global question bank and difficulty levels.</p>
        </div>
        <a href="{{ route('admin.questions.create') }}" class="btn btn-primary px-4 py-2" style="border-radius: 10px;">
            <i class="bi bi-plus-circle me-2"></i> Add New Question
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="custom-card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr class="text-muted-custom">
                        <th class="ps-4">ID</th>
                        <th>Category Info</th>
                        <th>Question Detail</th>
                        <th>Format</th>
                        <th>Difficulty</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($questions as $q)
                    <tr>
                        <td class="ps-4">
                            <span class="text-muted fw-bold">#{{ $q->id }}</span>
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <span class="badge-soft-primary small d-inline-block mb-1"
                                    style="width: fit-content;">{{ $q->cat_name }}</span>
                                <small class="text-muted">{{ $q->subcat_name }}</small>
                            </div>
                        </td>
                        <td>
                            <div class="question-text" title="{{ $q->question_text }}">
                                {{ $q->question_text }}
                            </div>
                        </td>
                        <td>
                            <span class="text-main small fw-bold"><i class="bi bi-file-earmark-text me-1"></i> {{
                                $q->ans_format }}</span>
                        </td>
                        <td>
                            @php
                            $diffClass = [
                            'easy' => 'bg-success',
                            'medium' => 'bg-warning text-dark',
                            'hard' => 'bg-danger'
                            ][$q->difficulty_level] ?? 'bg-secondary';
                            @endphp
                            <span class="badge {{ $diffClass }} px-3 py-2"
                                style="border-radius: 8px; font-size: 10px; letter-spacing: 0.5px;">
                                {{ strtoupper($q->difficulty_level) }}
                            </span>
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.questions.edit', $q->id) }}"
                                    class="action-btn btn-edit text-info" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <form action="{{ route('admin.questions.destroy', $q->id) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Bhai, pakka delete karna hai?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn btn-delete text-danger" title="Delete">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
