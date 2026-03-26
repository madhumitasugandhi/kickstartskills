@extends('frontend.adminPortal.dashboard.layouts.app')

@section('title', 'Question Bank - Add New Question')
@section('icon', 'bi-patch-question')

@section('content')

<style>
    .form-label {
        color: var(--text-muted);
    }

    ::placeholder {
        color: rgba(255, 255, 255, 0.1) !important;
        /* White with 50% opacity */
        font-size: 0.9rem;
    }

    /* Chrome, Safari, Edge ke liye */
    input::-webkit-input-placeholder,
    textarea::-webkit-input-placeholder {
        color: rgba(255, 255, 255, 0.1) !important;
    }

    /* Add Option Link Styling */
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
    }

    .add-option-btn:hover {
        opacity: 0.8;
        transform: translateY(-2px);
        background-color: var(--accent-color);
        color: #fff !important;
    }

    /* Bulk Add Question Button Styling */
    #add_more_question_btn {
        border: 2px dashed #dc3545;
        background: rgba(220, 53, 69, 0.05);
        color: #dc3545;
        border-radius: 12px;
        padding: 10px;
        width: 100%;
        font-weight: 700;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    #add_more_question_btn:hover {
        background: rgba(220, 53, 69, 0.1);
        border-color: #ff4d5e;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(220, 53, 69, 0.1);
    }

    /* Save All Button & Sticky Footer */
    .sticky-footer {
        position: sticky;
        bottom: 0;
        backdrop-filter: blur(10px);
        padding: 1.5rem 2.5rem;
        margin: 0 -2.5rem -2.5rem -2.5rem;
        z-index: 100;
        border-bottom-left-radius: 12px;
        border-bottom-right-radius: 12px;
    }

    .btn-save-all {
        background: #0d6efd;
        border: none;
        padding: 12px 45px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
    }

    .btn-save-all:hover {
        background: #0b5ed7;
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(13, 110, 253, 0.4);
    }
</style>

<div class="content-body p-4">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h4 class="fw-bold text-main mb-1">Add Question</h4>
            <p class="--text-muted mb-0 small">Add new questions to your global question bank and set difficulty levels for each.</p>
        </div>
    </div>

    <form action="{{ route('admin.questions.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="card shadow-sm border-0 mb-4 bg-transparent">
            <div class="card-body"
                style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px;">
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Select Category</label>
                        <select name="category_id" id="category_id" class="form-select" required>
                            <option value="">-- Choose Category --</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Select Sub-category</label>
                        <select name="subcategory_id" id="subcategory_id" class="form-select" required>
                            <option value="">-- First Select Category --</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div id="questions_wrapper">
            <div class="question-block card shadow-sm border-0 mb-4 bg-transparent" data-index="0">
                <div class="card-body"
                    style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px;">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold text-main mb-0">Question #1</h6>
                        <button type="button" class="btn btn-sm btn-outline-danger remove-question-btn"
                            style="display:none;">
                            <i class="bi bi-trash"></i> Remove
                        </button>
                    </div>

                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-bold">Question Text</label>
                            <textarea name="questions[0][text]" class="form-control" rows="2" required
                                placeholder="Enter question here..."></textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Answer Format</label>
                            <select name="questions[0][format]" class="form-select ans-format-select">
                                <option value="MCQ">MCQ (Multiple Choice)</option>
                                <option value="Text">Write Down (Textarea)</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Difficulty Level</label>
                            <select name="questions[0][difficulty]" class="form-select">
                                <option value="easy">Easy</option>
                                <option value="medium">Medium</option>
                                <option value="hard">Hard</option>
                            </select>
                        </div>

                        <div class="mcq-section col-12 mt-3">
                            <h6 class="small fw-bold text-accent mb-2">Options (Select radio for correct)</h6>
                            <div class="options-container">
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <input type="radio" name="questions[0][correct_option]" value="0" checked>
                                    </span>
                                    <input type="text" name="questions[0][options][]" class="form-control"
                                        placeholder="Option 1" required>
                                    <input type="file" name="questions[0][option_images][]" class="form-control"
                                        accept="image/*">
                                </div>
                            </div>
                            <a href="javascript:void(0)" class="add-option-btn mt-2">
                                <i class="bi bi-plus-circle me-1"></i> Add Another Option
                            </a>
                        </div>

                        <div class="text-section col-12 mt-3" style="display:none;">
                            <label class="form-label fw-bold">Correct Answer / Explanation</label>
                            <textarea name="questions[0][correct_answer_text]" class="form-control" rows="2"
                                placeholder="Write the correct answer here..."></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-1 mb-1 ">
            <button type="button" id="add_more_question_btn" class="w-100">
                <div class="d-flex align-items-center justify-content-center ">
                    <i class="bi bi-patch-plus fs-4 me-2"></i>
                    <span>Add Another Question for this Category</span>
                </div>
            </button>
        </div>

        <div class="sticky-footer text-end">
            <button type="submit" class="btn btn-primary btn-save-all">
                <i class="bi bi-cloud-arrow-up-fill me-2"></i> Save All Questions
            </button>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        console.log("JQuery is working!");
        let questionIndex = 1;

        // 1. AJAX: Fetch Subcategories
        $('#category_id').on('change', function() {
            let catId = $(this).val();
            let subcatSelect = $('#subcategory_id');
            subcatSelect.html('<option value="">Loading...</option>');

            if(catId) {
                let url = "{{ route('admin.questions.get_subcategories', ':id') }}";
                url = url.replace(':id', catId);
                $.get(url, function(data) {
                    let html = '<option value="">-- Choose Sub-category --</option>';
                    $.each(data, function(key, item) {
                        html += `<option value="${item.id}">${item.name}</option>`;
                    });
                    subcatSelect.html(html);
                });
            }
        });

        // 2. Add More Question Logic
        $('#add_more_question_btn').on('click', function(e) {
            e.preventDefault();
            console.log("Adding new question block...");

            let newBlock = $('.question-block').first().clone();

            // Clean up the clone
            newBlock.attr('data-index', questionIndex);
            newBlock.find('h6:first').text('Question #' + (questionIndex + 1));
            newBlock.find('textarea, input[type="text"]').val('');
            newBlock.find('input[type="file"]').val('');
            newBlock.find('.remove-question-btn').show();

            // Fix Names
            newBlock.find('[name]').each(function() {
                let oldName = $(this).attr('name');
                let newName = oldName.replace(/questions\[\d+\]/, 'questions[' + questionIndex + ']');
                $(this).attr('name', newName);
            });

            // Reset MCQ/Text Visibility
            newBlock.find('.mcq-section').show();
            newBlock.find('.text-section').hide();

            $('#questions_wrapper').append(newBlock);
            questionIndex++;
        });

        // 3. Handle Format Toggle (Delegated)
        $(document).on('change', '.ans-format-select', function() {
            let block = $(this).closest('.question-block');
            if($(this).val() === 'MCQ') {
                block.find('.mcq-section').show();
                block.find('.text-section').hide();
            } else {
                block.find('.mcq-section').hide();
                block.find('.text-section').show();
            }
        });

        // 4. Add Option Logic (Delegated)
        $(document).on('click', '.add-option-btn', function() {
            let block = $(this).closest('.question-block');
            let qIdx = block.attr('data-index');
            let container = block.find('.options-container');
            let optIdx = container.find('.input-group').length;

            let html = `
                <div class="input-group mb-2 mt-2">
                    <span class="input-group-text"><input type="radio" name="questions[${qIdx}][correct_option]" value="${optIdx}"></span>
                    <input type="text" name="questions[${qIdx}][options][]" class="form-control" placeholder="Option ${optIdx + 1}" required>
                    <input type="file" name="questions[${qIdx}][option_images][]" class="form-control" accept="image/*">
                    <button type="button" class="btn btn-danger remove-opt"><i class="bi bi-x"></i></button>
                </div>`;
            container.append(html);
        });

        // 5. Remove Handlers
        $(document).on('click', '.remove-question-btn', function() { $(this).closest('.question-block').remove(); });
        $(document).on('click', '.remove-opt', function() { $(this).closest('.input-group').remove(); });
    });
</script>
@endsection
