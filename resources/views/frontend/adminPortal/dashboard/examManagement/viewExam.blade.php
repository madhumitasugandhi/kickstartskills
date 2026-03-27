@extends('frontend.adminPortal.dashboard.layouts.app')

@section('title', 'Exam management - View Exam Details')
@section('icon', 'bi-journal-check')
@section('content')

<style>
    .breadcrumb-item+.breadcrumb-item::before
    {
        color: var(--text-main);
    }
</style>
<div class="content-body p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="{{ route('admin.exams.index') }}"
                            class="text-accent text-decoration-none small">Exams</a></li>
                    <li class="breadcrumb-item active small text-main" aria-current="page">View Details</li>
                </ol>
            </nav>
            <h4 class="fw-bold text-main mb-0">{{ $exam->exam_title }}</h4>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.exams.edit', $exam->id) }}" class="btn btn-outline-info ">
                <i class="bi bi-pencil me-2"></i> Edit Exam
            </a>
            <button onclick="window.print()" class="btn btn-outline-secondary">
                <i class="bi bi-printer me-2"></i> Print Paper
            </button>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-3">
            <div class="card border-0 shadow-sm mb-4" style="background-color: var(--bg-card); border-radius: 15px;">
                <div class="card-body">
                    <h6 class="fw-bold text-accent mb-3">Exam Summary</h6>
                    <div class="mb-3">
                        <label class="text-main small d-block">Category</label>
                        <span class="text-main fw-bold">{{ $exam->skill_name }}</span>
                    </div>
                    <div class="mb-3">
                        <label class="text-main small d-block">Total Questions</label>
                        <span class="text-main fw-bold">{{ count($questions) }} Questions</span>
                    </div>
                    <div class="mb-3">
                        <label class="text-main small d-block">Duration</label>
                        <span class="text-main fw-bold"><i class="bi bi-clock me-1"></i> {{ $exam->duration_minutes }}
                            Minutes</span>
                    </div>
                    <div class="mb-0">
                        <label class="text-main small d-block">Passing Requirement</label>
                        <span class="text-main fw-bold">{{ $exam->passing_score }}% Score</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="card border-0 shadow-sm" style="background-color: var(--bg-card); border-radius: 15px;">
                <div class="card-body p-4">
                    <h6 class="fw-bold text-main mb-4">Questions Paper Preview</h6>

                    @foreach($questions as $index => $q)
                    <div class="question-block mb-5 p-4 rounded" style=" border-left: 4px solid var(--accent-color);">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="badge bg-soft-primary text-primary px-3 py-2">Question {{ $index + 1 }}</span>
                            <span class="badge border border-secondary text-info small">{{ $q->difficulty_level
                                }}</span>
                        </div>
                        <h5 class="text-main mb-4" style="line-height: 1.6;">{{ $q->question_text }}</h5>

                        <div class="options-grid row g-3 mb-4">
                            @foreach($q->options as $option)
                            <div class="col-md-6">
                                <div class="p-3 rounded border {{ $option->is_correct ? 'border-success bg-soft-success' : 'border-secondary' }}"
                                    style="background: {{ $option->is_correct ? 'rgba(40, 167, 69, 0.1)' : 'rgba(255,255,255,0.02)' }};">
                                    <div class="d-flex align-items-center">
                                        <span
                                            class="fw-bold me-2 {{ $option->is_correct ? 'text-success' : 'text-main' }}">
                                            {{ $loop->iteration }}.
                                        </span>
                                        <span
                                            class="{{ $option->is_correct ? 'text-success fw-bold' : 'text-main' }}">
                                            {{ $option->option_text }}
                                        </span>
                                        @if($option->is_correct)
                                        <i class="bi bi-check-circle-fill ms-auto text-success"></i>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="row g-2 pt-3 border-top border-secondary">
                            <div class="col-md-4">
                                <small class="text-main">Format:
                                    <span class="text-main">{{ $q->ans_format
                                        }}</span></small>
                            </div>
                            <div class="col-md-4 text-center">
                                <small class="text-main">Type:
                                    <span class="text-main">
                                        {{ $q->question_type ?? 'Multiple Choice' }} </span>
                                </small>
                            </div>
                            <div class="col-md-4 text-end">
                                <small class="text-main">Marks:
                                    <span class="text-main">{{ $q->marks ?? 1
                                        }}</span></small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
