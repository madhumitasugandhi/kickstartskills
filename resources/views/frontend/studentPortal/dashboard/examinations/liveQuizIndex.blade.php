@extends('frontend.studentPortal.dashboard.layouts.app')

@section('title', 'Examination Mode')

@section('content')
<div class="content-body">
    <div class="row">
        <div class="col-lg-9">
            <div class="card-custom border-0 shadow-sm p-4">
                <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                    <div>
                        <span class="text-muted small d-block">Time Remaining</span>
                        <h4 id="timer" class="fw-bold text-primary mb-0">--:--</h4>
                    </div>
                    <div class="text-end">
                        <span class="badge bg-soft-blue text-blue px-3 py-2 fs-6">
                            Question <span id="current-q-num">1</span> of {{ $questions->count() }}
                        </span>
                    </div>
                </div>

                <form id="quiz-form" action="{{ route('student.exam.submit') }}" method="POST">
                    @csrf
                    <input type="hidden" name="exam_id" value="{{ $exam->id }}">

                    <div id="questions-container">
                        @foreach($questions as $index => $question)
                        <div class="question-step" id="step-{{ $index }}" style="display: {{ $index == 0 ? 'block' : 'none' }};">
                            <h5 class="fw-bold mb-4 text-main">{{ $index + 1 }}. {{ $question->question_text }}</h5>

                            <div class="options-list d-grid gap-3">
                                @php
                                    // Fetch options for this specific question
                                    $q_options = DB::table('question_options')->where('question_id', $question->id)->get();
                                @endphp

                                @foreach($q_options as $opt)
                                <label class="option-item">
                                    <input type="radio" name="answer[{{ $question->id }}]" value="{{ $opt->option_letter }}" class="d-none">
                                    <div class="option-box p-3 border rounded-3 border-secondary">
                                        <span class="me-2 fw-bold">{{ $opt->option_letter }})</span> {{ $opt->option_text }}
                                    </div>
                                </label>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-between mt-5 pt-4 border-top">
                        <button type="button" class="btn btn-outline-secondary px-4" id="prev-btn" onclick="changeStep(-1)" disabled>Previous</button>

                        <button type="button" class="btn btn-primary px-5 fw-bold" id="next-btn" onclick="changeStep(1)">Next Question</button>

                        <button type="submit" class="btn btn-success px-5 fw-bold" id="submit-btn" style="display: none;">Submit Final Test</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card-custom p-3 text-center">
                <h6 class="fw-bold mb-3">Question Palette</h6>
                <div class="d-flex flex-wrap gap-2 justify-content-center">
                    @foreach($questions as $index => $q)
                    <div class="palette-item border rounded text-center" id="palette-{{ $index }}" style="width: 35px; height: 35px; line-height: 35px; cursor: pointer;" onclick="goToStep({{ $index }})">
                        {{ $index + 1 }}
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Styling for the radio buttons */
    .option-item { cursor: pointer; display: block; transition: all 0.2s; }
    .option-item input:checked + .option-box {
        background: var(--soft-blue);
        border-color: var(--text-blue) !important;
        color: var(--text-blue);
        font-weight: 600;
    }
    .option-box:hover { background: rgba(255,255,255,0.05); }
    .palette-item.active { background: var(--text-blue); color: white; border-color: var(--text-blue); }
    .palette-item.answered { background: var(--soft-green); color: var(--text-green); border-color: var(--text-green); }
</style>

<script>
    let currentStep = 0;
    const totalSteps = {{ $questions->count() }};
    let timeLeft = {{ $exam->duration_minutes * 60 }};

    function changeStep(n) {
        document.getElementById(`step-${currentStep}`).style.display = 'none';
        currentStep += n;
        showStep(currentStep);
    }

    function goToStep(n) {
        document.getElementById(`step-${currentStep}`).style.display = 'none';
        currentStep = n;
        showStep(currentStep);
    }

    function showStep(n) {
        document.getElementById(`step-${n}`).style.display = 'block';
        document.getElementById('current-q-num').innerText = n + 1;

        // Button Visibility
        document.getElementById('prev-btn').disabled = (n === 0);
        if (n === totalSteps - 1) {
            document.getElementById('next-btn').style.display = 'none';
            document.getElementById('submit-btn').style.display = 'block';
        } else {
            document.getElementById('next-btn').style.display = 'block';
            document.getElementById('submit-btn').style.display = 'none';
        }

        // Palette Highlight
        document.querySelectorAll('.palette-item').forEach(el => el.classList.remove('active'));
        document.getElementById(`palette-${n}`).classList.add('active');
    }

    // Timer Logic
    const timerDisplay = document.getElementById('timer');
    const timerInterval = setInterval(() => {
        let mins = Math.floor(timeLeft / 60);
        let secs = timeLeft % 60;
        timerDisplay.innerText = `${mins}:${secs < 10 ? '0' : ''}${secs}`;

        if (timeLeft <= 0) {
            clearInterval(timerInterval);
            alert('Time is up! Your test will be submitted automatically.');
            document.getElementById('quiz-form').submit();
        }
        timeLeft--;
    }, 1000);

    // Initial Palette Highlight
    showStep(0);
</script>
