@extends('frontend.adminPortal.dashboard.layouts.app')

@section('title', 'Edit Question')

@section('content')
<div class="content-body p-4">
    <h5 class="fw-bold mb-4 text-main">Edit Question #{{ $question->id }}</h5>

    <form action="{{ route('admin.questions.update', $question->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card shadow-sm border-0 mb-4 bg-transparent">
            <div class="card-body" style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px;">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Category</label>
                        <select name="category_id" id="category_id" class="form-select" required>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $question->skills_category_id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Sub-category</label>
                        <select name="subcategory_id" id="subcategory_id" class="form-select" required>
                             <option value="{{ $question->skills_subcategory_id }}">Keep Current Subcategory</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-bold">Question Text</label>
                        <textarea name="question_text" class="form-control" rows="3" required>{{ $question->question_text }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Answer Format</label>
                        <select name="ans_format" id="ans_format" class="form-select">
                            <option value="MCQ" {{ $question->ans_format == 'MCQ' ? 'selected' : '' }}>MCQ</option>
                            <option value="Text" {{ $question->ans_format == 'Text' ? 'selected' : '' }}>Written</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Difficulty Level</label>
                        <select name="difficulty_level" class="form-select">
                            <option value="easy" {{ $question->difficulty_level == 'easy' ? 'selected' : '' }}>Easy</option>
                            <option value="medium" {{ $question->difficulty_level == 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="hard" {{ $question->difficulty_level == 'hard' ? 'selected' : '' }}>Hard</option>
                        </select>
                    </div>
                </div>

                <hr class="my-4 opacity-25">

                <div id="mcq_section" style="{{ $question->ans_format == 'MCQ' ? '' : 'display:none;' }}">
                    <h6 class="fw-bold text-accent mb-3">Options</h6>
                    <div id="options_container">
                        @if($question->ans_format == 'MCQ')
                            @foreach($options as $index => $opt)
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <input type="radio" name="correct_option" value="{{ $index }}" {{ $opt->is_correct ? 'checked' : '' }}>
                                    </span>
                                    <input type="text" name="options[]" class="form-control" value="{{ $opt->option_text }}" required>
                                    @if($opt->path_format)
                                        <img src="{{ asset($opt->path_format) }}" width="40" class="ms-2 rounded">
                                    @endif
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div id="text_section" style="{{ $question->ans_format == 'Text' ? '' : 'display:none;' }}">
                    <label class="form-label fw-bold">Correct Answer</label>
                    <textarea name="correct_answer_text" class="form-control" rows="3">{{ $question->answer_text ?? '' }}</textarea>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary px-5">Update Question</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
