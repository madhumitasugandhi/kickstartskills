@extends('frontend.adminPortal.dashboard.layouts.app')

@section('title', 'Exam management - Edit Exam Paper')
@section('icon', 'bi-journal-check')
@section('content')
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

    .table th,
    td {
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
    <div class="mb-4">
        <h4 class="fw-bold text-main mb-1">Edit Exam: {{ $exam->exam_title }}</h4>
        <p class="--text-muted small">Update exam details or change selected questions.</p>
    </div>

    <form action="{{ route('admin.exams.update', $exam->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card shadow-sm border-0 mb-4 bg-transparent">
            <div class="card-body"
                style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px;">
                <div class="row g-3 text-main">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Exam Title</label>
                        <input type="text" name="exam_title" class="form-control" value="{{ $exam->exam_title }}"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Skill Category</label>
                        <select name="skill_category_id" id="exam_category_id" class="form-select" required>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $exam->skill_category_id == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Duration (Minutes)</label>
                        <input type="number" name="duration_minutes" class="form-control"
                            value="{{ $exam->duration_minutes }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Passing Score (%)</label>
                        <input type="number" name="passing_score" class="form-control"
                            value="{{ $exam->passing_score }}" required>
                    </div>
                </div>

                <div id="questions_section" class="mt-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold text-main mb-0">Modify Questions</h6>
                        <div class="text-main small">Selected: <span id="selected_count" class="badge bg-primary">{{
                                count($selectedQuestions) }}</span></div>
                    </div>

                    <div class="table-responsive border rounded p-3"
                        style="background: var(--bg-sidebar); border-color: var(--border-color) !important;">
                        <table id="questionsTable" class="table table-hover align-middle mb-0 w-100">
                            <thead>
                                <tr>
                                    <th width="50"><input type="checkbox" id="select_all_q" class="form-check-input">
                                    </th>
                                    <th class="text-main">Question Text</th>
                                    <th class="text-main">Sub-Category</th>
                                    <th width="120" class="text-main">Difficulty</th>
                                </tr>
                            </thead>
                            <tbody id="questions_list">
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <a href="{{ route('admin.exams.index') }}" class="btn btn-secondary px-4 me-2">Cancel</a>
                    <button type="submit" class="btn btn-primary px-5">
                        <i class="bi bi-cloud-check-fill me-2"></i> Update Exam
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        let selectedFromDB = @json($selectedQuestions); // Puraane selected IDs

        function loadQuestions(catId) {
            let container = $('#questions_list');
            container.html('<tr><td colspan="3" class="text-center py-3 text-main">Loading...</td></tr>');

            let url = "{{ route('admin.exams.get_questions', ':id') }}".replace(':id', catId);

            // Is hisse ko editExam.blade.php ke script mein replace karo
$.get(url, function(data) {
    if ($.fn.DataTable.isDataTable('#questionsTable')) {
        $('#questionsTable').DataTable().destroy();
    }

    let html = '';
    $.each(data, function(i, q) {
        let isChecked = selectedFromDB.includes(q.id.toString()) || selectedFromDB.includes(q.id) ? 'checked' : '';
        // Subcategory handle karo
        let subCategory = q.sub_name ? q.sub_name : '<span class="text-danger">N/A</span>';

        html += `
            <tr>
                <td><input type="checkbox" name="questions_id[]" value="${q.id}" class="form-check-input q-checkbox" ${isChecked}></td>
                <td class="text-white small">${q.question_text}</td>
                <td>
                    <div class="text-info fw-bold" style="font-size: 0.72rem;">${subCategory}</div>
                </td>
                <td><span class="badge bg-soft-primary text-primary border border-primary small">${q.difficulty_level}</span></td>
            </tr>`;
    });
    container.html(html);

    // DataTable init
    qTable = $('#questionsTable').DataTable({
        "pageLength": 10,
        "language": { "search": "Filter:", "lengthMenu": "_MENU_ entries" },
        "columnDefs": [{ "orderable": false, "targets": 0 }]
    });
    updateCount();
});
        }

        // Page load hote hi questions load karo
        loadQuestions($('#exam_category_id').val());

        // Category change hone par reload
        $('#exam_category_id').on('change', function() {
            loadQuestions($(this).val());
        });

        $(document).on('change', '.q-checkbox, #select_all_q', function() { updateCount(); });

        function updateCount() {
            $('#selected_count').text($('.q-checkbox:checked').length);
        }
    });
</script>
@endsection
