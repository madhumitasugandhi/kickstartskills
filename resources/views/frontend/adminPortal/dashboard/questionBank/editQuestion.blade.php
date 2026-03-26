@extends('frontend.adminPortal.dashboard.layouts.app')

@section('title', 'Question Bank - Edit Question')
@section('icon', 'bi-patch-question')

@section('content')
<style>
    /* Placeholder Visibility Fix */
    ::placeholder { color: rgba(255, 255, 255, 0.5) !important; }
    input::-webkit-input-placeholder { color: rgba(255, 255, 255, 0.5) !important; }

    .form-label { color: var(--text-muted); }

    /* Image Preview Box - Match Existing Design */
    .img-preview-box {
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--bg-sidebar);
        border: 1px solid var(--border-color);
        border-left: none;
        padding: 0 10px;
        cursor: pointer;
    }

    /* Option Row Styling */
    .option-row { width: 100%; max-width: 800px; }

    .input-group-text {
        border-top-left-radius: 8px !important;
        border-bottom-left-radius: 8px !important;
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
                            <option value="{{ $cat->id }}" {{ $question->skills_category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Sub-category</label>
                        <select name="subcategory_id" id="subcategory_id" class="form-select" required>
                            <option value="{{ $question->skills_subcategory_id }}" selected>Keep Current Subcategory</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-bold">Question Text</label>
                        <textarea name="question_text" class="form-control" rows="3" required>{{ $question->question_text }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Answer Format</label>
                        <select name="ans_format" id="ans_format" class="form-select">
                            <option value="MCQ" {{ $question->ans_format == 'MCQ' ? 'selected' : '' }}>MCQ (Multiple Choice)</option>
                            <option value="Text" {{ $question->ans_format == 'Text' ? 'selected' : '' }}>Written (Textarea)</option>
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
                        @foreach($options as $index => $opt)
                        <div class="option-row mb-3" data-index="{{ $index }}">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <input type="radio" name="correct_option" value="{{ $index }}" {{ $opt->is_correct ? 'checked' : '' }}>
                                </span>
                                <input type="text" name="options[]" class="form-control" value="{{ $opt->option_text }}" required>

                                <div class="img-preview-box" onclick="openImageModal('{{ asset($opt->path_format ?? 'assets/img/no-img.png') }}', {{ $index }})">
                                    <img src="{{ asset($opt->path_format ?? 'assets/img/no-img.png') }}" id="thumb_{{ $index }}" width="30" height="30" class="rounded">
                                </div>

                                <button type="button" class="btn btn-outline-danger remove-option-btn"><i class="bi bi-trash3"></i></button>
                            </div>
                            <input type="file" name="option_images[{{ $index }}]" id="file_input_{{ $index }}" class="d-none" onchange="previewInModal(this, {{ $index }})">
                            <input type="hidden" name="old_option_images[]" value="{{ $opt->path_format }}">
                        </div>
                        @endforeach
                    </div>

                    <button type="button" class="add-option-btn mt-2" id="add_new_option_edit">
                        <i class="bi bi-plus-circle"></i> Add More Option
                    </button>
                </div>

                <div id="text_section" style="{{ $question->ans_format == 'Text' ? '' : 'display:none;' }}">
                    <label class="form-label fw-bold">Correct Answer / Explanation</label>
                    <textarea name="correct_answer_text" class="form-control" rows="3">{{ $question->answer_text ?? '' }}</textarea>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary px-5">Update Question</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="imageEditModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark border-secondary text-white">
            <div class="modal-header border-secondary">
                <h6 class="modal-title">Update Option Image</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img src="" id="modal_preview_img" class="img-fluid rounded shadow mb-3" style="max-height: 300px;">
            </div>
            <div class="modal-footer border-secondary justify-content-center">
                <button type="button" class="btn btn-outline-info btn-sm" onclick="triggerFileInput()">Change Image</button>
                <button type="button" class="btn btn-primary btn-sm px-4" data-bs-dismiss="modal">Done</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let currentIdx = null;

    $(document).ready(function() {
        let questionIndex = $('.option-row').length;

        // Add More Option
        $('#add_new_option_edit').on('click', function(e) {
            e.preventDefault();
            let noImgPath = "{{ asset('assets/img/no-img.png') }}";

            let html = `
                <div class="option-row mb-3" data-index="${questionIndex}">
                    <div class="input-group">
                        <span class="input-group-text">
                            <input type="radio" name="correct_option" value="${questionIndex}">
                        </span>
                        <input type="text" name="options[]" class="form-control" placeholder="New Option" required>
                        <div class="img-preview-box" onclick="openImageModal('${noImgPath}', ${questionIndex})">
                            <img src="${noImgPath}" id="thumb_${questionIndex}" width="30" height="30" class="rounded">
                        </div>
                        <button type="button" class="btn btn-outline-danger remove-option-btn"><i class="bi bi-trash3"></i></button>
                    </div>
                    <input type="file" name="option_images[${questionIndex}]" id="file_input_${questionIndex}" class="d-none" onchange="previewInModal(this, ${questionIndex})">
                    <input type="hidden" name="old_option_images[]" value="">
                </div>`;
            $('#options_container').append(html);
            questionIndex++;
        });

        // Remove Option
        $(document).on('click', '.remove-option-btn', function() {
            if ($('.option-row').length > 2) { $(this).closest('.option-row').remove(); }
            else { alert("Kam se kam 2 options zaruri hain."); }
        });

        // Answer Format Toggle
        $('#ans_format').on('change', function() {
            if($(this).val() == 'MCQ') { $('#mcq_section').show(); $('#text_section').hide(); }
            else { $('#mcq_section').hide(); $('#text_section').show(); }
        });
    });

    function openImageModal(imgSrc, index) {
        currentIdx = index;
        $('#modal_preview_img').attr('src', imgSrc);
        $('#imageEditModal').modal('show');
    }

    function triggerFileInput() {
        $(`#file_input_${currentIdx}`).click();
    }

    function previewInModal(input, index) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(`#thumb_${index}`).attr('src', e.target.result);
                if ($('#imageEditModal').hasClass('show')) {
                    $('#modal_preview_img').attr('src', e.target.result);
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
