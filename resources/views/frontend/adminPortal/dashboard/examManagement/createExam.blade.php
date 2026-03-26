@extends('frontend.adminPortal.dashboard.layouts.app')

@section('title', 'Exam management - Add New Exam')
@section('icon', 'bi-journal-check')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<style>
    .bg-soft-primary {
        background-color: rgba(13, 110, 253, 0.1);
    }

    .text-muted-custom {
        color: rgba(255, 255, 255, 0.5);
    }

    /* DataTables Dark Theme Fix */
    .dataTables_wrapper .dataTables_length select,
    .dataTables_wrapper .dataTables_filter input {
        background-color: var(--bg-card) !important;
        border: 1px solid var(--border-color) !important;
        color: white !important;
        border-radius: 6px;
        padding: 4px 8px;
    }

    .dataTables_info,
    .dataTables_paginate {
        color: var(--text-main) !important;
        font-size: 0.8rem;
        margin-top: 10px;
    }

    .table th td {
        border-bottom: 1px solid var(--border-color) !important;
        color: var(--text-main) !important;
        background-color: transparent !important;
    }

    .page-link {
        background-color: var(--bg-card) !important;
        border-color: var(--border-color) !important;
        color: white !important;
    }

    .page-item.active .page-link {
        background-color: var(--accent-color) !important;
        border-color: var(--accent-color) !important;
    }

    .label {
        color: var(--text-main) !important;
    }

    .dataTables_length label,
    .dataTables_filter label,
    .dataTables_info {
        color: #ffffff !important;
        font-weight: 500;
    }

    /* Search input box ka background aur text color */
    .dataTables_filter input {
        background-color: #2a3038 !important;
        border: 1px solid #444 !important;
        color: #ffffff !important;
        border-radius: 4px;
        padding: 4px 8px;
    }

    /* Dropdown (Show entries) ka color */
    .dataTables_length select {
        background-color: #2a3038 !important;
        color: #ffffff !important;
        border: 1px solid #444 !important;
    }
</style>

<div class="content-body p-4">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h4 class="fw-bold text-main mb-1">Create Exam Paper</h4>
            <p class="text-muted-custom mb-0 small">Select a category to pick questions for this assessment.</p>
        </div>
    </div>

    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

    <form action="{{ route('admin.exams.store') }}" method="POST">
        @csrf
        <div class="card shadow-sm border-0 mb-4 bg-transparent">
            <div class="card-body"
                style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px;">
                <div class="row g-3 text-main">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Exam Title</label>
                        <input type="text" name="exam_title" class="form-control" placeholder="e.g. PHP Basic Test"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Skill Category</label>
                        <select name="skill_category_id" id="exam_category_id" class="form-select" required>
                            <option value="">-- Choose Category --</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Duration (Minutes)</label>
                        <input type="number" name="duration_minutes" class="form-control" value="30" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Passing Score (%)</label>
                        <input type="number" name="passing_score" class="form-control" value="50" required>
                    </div>
                </div>

                <div id="questions_section" class="mt-5" style="display:none;">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold text-main mb-0">Select Questions for Exam</h6>
                        <div class="text-main small">Selected: <span id="selected_count"
                                class="badge bg-primary">0</span></div>
                    </div>

                    <div class="table-responsive border rounded p-3"
                        style="background: var(--bg-sidebar); border-color: var(--border-color) !important;">
                        <table id="questionsTable" class="table table-hover align-middle mb-0 w-100">
                            <thead>
                                <tr>
                                    <th width="50"><input type="checkbox" id="select_all_q" class="form-check-input">
                                    </th>
                                    <th class="--text-main">Question Text</th>
                                    <th width="120" class="--text-main">Difficulty</th>
                                </tr>
                            </thead>
                            <tbody id="questions_list"></tbody>
                        </table>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary px-5 py-2">
                        <i class="bi bi-cloud-arrow-up-fill me-2"></i> Create Exam Now
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        let qTable = null;

        $('#exam_category_id').on('change', function() {
            let catId = $(this).val();
            let container = $('#questions_list');

            if(!catId) { $('#questions_section').hide(); return; }

            $('#questions_section').show();
            container.html('<tr><td colspan="3" class="text-center py-3 text-main">Loading questions...</td></tr>');

            let url = "{{ route('admin.exams.get_questions', ':id') }}".replace(':id', catId);

            $.get(url, function(data) {
                if ($.fn.DataTable.isDataTable('#questionsTable')) {
                    $('#questionsTable').DataTable().destroy();
                }

                let html = '';
                if(data.length > 0) {
                    $.each(data, function(i, q) {
                        html += `
                            <tr>
                                <td><input type="checkbox" name="questions_id[]" value="${q.id}" class="form-check-input q-checkbox"></td>
                                <td class=" small" style="white-space: normal;">${q.question_text}</td>
                                <td><span class="badge bg-soft-primary text-primary border border-primary small">${q.difficulty_level}</span></td>
                            </tr>`;
                    });
                    container.html(html);

                    qTable = $('#questionsTable').DataTable({
                        "pageLength": 10,
                        "language": { "search": "Filter:", "lengthMenu": "_MENU_ entries" },
                        "columnDefs": [{ "orderable": false, "targets": 0 }]
                    });
                } else {
                    container.html('<tr><td colspan="3" class="text-center py-4 text-danger">No questions found.</td></tr>');
                }
            });
        });

        // Select All (Handles all pages in DataTable)
        $(document).on('change', '#select_all_q', function() {
            let rows = qTable.rows({ 'search': 'applied' }).nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
            updateCount();
        });

        $(document).on('change', '.q-checkbox', function() {
            updateCount();
        });

        function updateCount() {
            let count = $('.q-checkbox:checked').length;
            $('#selected_count').text(count);
        }
    });
</script>
@endsection
