@extends('frontend.adminPortal.dashboard.layouts.app')

@section('title', 'Question Bank - Manage Your Questions')
@section('icon', 'bi-patch-question')

@section('content')
<style>
    /* Filter Styling */
    .filter-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .form-select-sm,
    .btn-sm-custom {
        background-color: var(--bg-sidebar) !important;
        color: var(--text-main) !important;
        border: 1px solid var(--border-color) !important;
        border-radius: 8px !important;
    }

    .btn-filter {
        background: #0d6efd;
        color: #fff;
        border: none;
        border-radius: 8px;
        transition: 0.3s;
    }

    .btn-filter:hover {
        background: #0b5ed7;
        transform: translateY(-2px);
    }

    .btn-reset {
        background: rgba(255, 255, 255, 0.05);
        color: var(--text-main);
        border: 1px solid var(--border-color);
        border-radius: 8px;
    }

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
        color: var(--text-main)
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
        background: transparent;
    }

    /* Badges */
    .badge-soft-primary {
        background: rgba(220, 53, 69, 0.05);
        color: #dc3545;
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
        color: #fff !important;
        border-color: #0dcaf0;
    }

    .btn-delete:hover {
        background: #bb2d3b;
        color: #fff !important;
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

    .custom-pagination .pagination {
        margin-bottom: 0;
    }

    .custom-pagination .page-link {
        background-color: var(--bg-card);
        border-color: var(--border-color);
        color: var(--text-main);
    }

    .custom-pagination .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .custom-pagination .page-item.disabled .page-link {
        background-color: var(--bg-sidebar);
        border-color: var(--border-color);
        opacity: 0.5;
    }

    .add-option-btn {
        text-decoration: none;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        color: var(--accent-color) !important;
        border: 1px solid var(--accent-color);
        border-radius: 8px;
        padding: 6px 12px;
        background-color: transparent;
    }

    .add-option-btn:hover {
        opacity: 0.8;
        transform: translateY(-2px);
        background-color: var(--accent-color);
        color: #fff !important;
    }
</style>

<div class="content-body p-4">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h4 class="fw-bold text-main mb-1">Question Management</h4>
            <p class="--text-muted mb-0 small">Manage your global question bank and difficulty levels.</p>
        </div>
        <a href="{{ route('admin.questions.create') }}" class="btn add-option-btn px-4 py-2" style="border-radius: 10px;">
            <i class="bi bi-plus-circle me-2"></i> Add New Question
        </a>
    </div>

    <div class="filter-card shadow-sm">
        <form action="{{ route('admin.questions.index') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label small fw-bold --text-muted">Filter by Category</label>
                <select name="category_id" id="filter_category_id" class="form-select form-select-sm">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id')==$cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label small fw-bold --text-muted">Filter by Sub-category</label>
                <select name="subcategory_id" id="filter_subcategory_id" class="form-select form-select-sm">
                    <option value="">All Sub-categories</option>
                    @if(request('category_id'))
                    @endif
                </select>
            </div>
            <div class="col-md-4 d-flex gap-2">
                <button type="submit" class="btn btn-filter px-4 flex-grow-1">
                    <i class="bi bi-funnel me-1"></i> Apply Filter
                </button>
                <a href="{{ route('admin.questions.index') }}" class="btn btn-reset px-3">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>
            </div>
        </form>
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
                        <th class="ps-4">Sr. No.</th>
                        <th>Category Info</th>
                        <th>Question Detail</th>
                        <th>Format</th>
                        <th>Difficulty</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($questions as $index => $q)
                    <tr>
                        <td class="ps-4">
                            <span class="text-main fw-bold">{{ ($questions->currentPage() - 1) * $questions->perPage() +
                                $loop->iteration }} )</span>
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <span class="badge-soft-primary small d-inline-block mb-1"
                                    style="width: fit-content;">{{ $q->cat_name }}</span>
                                <small class="text-main">{{ $q->subcat_name }}</small>
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
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="d-flex flex-column align-items-center justify-content-center">
                                <div class="mb-3">
                                    <i class="bi bi-database-exclamation --text-main"
                                        style="font-size: 3rem; opacity: 0.5;"></i>
                                </div>
                                <h5 class="fw-bold --text-muted">
                                    Oops! No Questions Found.
                                </h5>
                                <p class="--text-muted small mb-3">
                                    It seems like your question bank is empty. Start by adding new questions to build
                                    your global question repository and set difficulty levels for each.
                                </p>
                                <a href="{{ route('admin.questions.index') }}"
                                    class="btn btn-sm btn-outline-primary px-3">
                                    <i class="bi bi-arrow-left me-1"></i> View All Questions
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4 d-flex justify-content-between align-items-center">
        <div class="--text-muted small">
            Showing {{ $questions->firstItem() }} to {{ $questions->lastItem() }} of {{ $questions->total() }} entries
        </div>
        <div class="custom-pagination">
            {{ $questions->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#filter_category_id').on('change', function() {
            let catId = $(this).val();
            let subcatSelect = $('#filter_subcategory_id');
            subcatSelect.html('<option value="">Loading...</option>');

            if(catId) {
                let url = "{{ route('admin.questions.get_subcategories', ':id') }}";
                url = url.replace(':id', catId);
                $.get(url, function(data) {
                    let html = '<option value="">All Sub-categories</option>';
                    $.each(data, function(key, item) {
                        html += `<option value="${item.id}">${item.name}</option>`;
                    });
                    subcatSelect.html(html);
                });
            } else {
                subcatSelect.html('<option value="">All Sub-categories</option>');
            }
        });
    });
</script>

@endsection
