@extends('frontend.adminPortal.dashboard.layouts.app')

@section('title', 'Exam management - View All Exam')
@section('icon', 'bi-journal-check')
@section('content')
<div class="content-body p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-main mb-1">Exam Management</h4>
            <p class="--text-muted small mb-0">Manage all created assessments and their questions.</p>
        </div>
        <a href="{{ route('admin.exams.create') }}" class="btn btn-primary px-4">
            <i class="bi bi-plus-circle me-2"></i> Create New Exam
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success border-0 shadow-sm mb-4">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0 bg-transparent">
        <div class="card-body p-0"
            style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; overflow: hidden;">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-dark">
                        <tr class="text-muted-custom">
                            <th class="ps-4">Sr. No.</th>
                            <th>Exam Title</th>
                            <th>Category</th>
                            <th>Questions</th>
                            <th>Duration</th>
                            <th>Passing %</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($exams as $index => $exam)
                        <tr>
                            <td class="ps-4">{{ $exams->firstItem() + $index }}</td>
                            <td>
                                <span class="fw-bold --text-main">{{ $exam->exam_title }}</span>
                            </td>
                            <td>
                                <span class="badge bg-soft-primary text-primary px-2 py-1">{{ $exam->skill_name
                                    }}</span>
                            </td>
                            <td>
                                @php
                                $qIds = json_decode($exam->questions_id, true) ?? [];
                                @endphp
                                <span class="fw-bold">{{ count($qIds) }}</span> Questions
                            </td>
                            <td><i class="bi bi-clock me-1"></i> {{ $exam->duration_minutes }} min</td>
                            <td>{{ $exam->passing_score }}%</td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.exams.edit', $exam->id) }}"
                                        class="btn btn-sm btn-outline-info">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.exams.delete', $exam->id) }}" method="POST"
                                        onsubmit="return confirm('Bhai, delete kar doon?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="bi bi-journal-x fs-1 text-muted d-block mb-2"></i>
                                <span class="text-muted">No exams found. Click "Create New Exam" to get started!</span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-3">
                {{ $exams->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
