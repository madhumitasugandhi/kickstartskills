@extends('frontend.studentPortal.dashboard.layouts.app')

@section('title', 'Examination - Live Quiz')
@section('icon', 'bi bi-play-circle fs-4 p-2 bg-primary bg-opacity-10 rounded-3 text-primary')

@section('content')
<div class="content-body">
    <div class="row">
        <div class="col-lg-9">
            <div class="card-custom border-0 shadow-sm p-4">
                <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                    <div>
                        <span class="--text-muted small d-block">Time Remaining</span>
                        <h4 id="timer" class="fw-bold text-primary mb-0">--:--</h4>
                    </div>
                    <div class="text-end">
                        <span class="badge bg-soft-blue text-blue px-3 py-2 fs-6">
                        Question <span id="current-q-num">1</span> of {{ $groupedQuestions->flatten()->count() }}                        </span>
                    </div>
                </div>

                <form id="quiz-form" action="{{ route('student.exam.submit') }}" method="POST">
                    @csrf
                    <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                    <input type="hidden" name="time_taken" id="time_taken">

                    <div id="questions-container">
                    @php $stepIndex = 0; @endphp

@foreach($groupedQuestions as $subcategory => $sectionQuestions)
    @foreach($sectionQuestions as $question)
        <div class="question-step" id="step-{{ $stepIndex }}"
            style="display: {{ $stepIndex == 0 ? 'block' : 'none' }};">

            <div class="mb-2 text-primary fw-bold">
                Section: {{ $subcategory ?? 'General' }}
            </div>

            <h5 class="fw-bold mb-4 text-main">
                {{ $stepIndex + 1 }}. {{ $question->question_text }}
            </h5>

            <div class="options-list d-grid gap-3">
                @foreach($question->options as $index => $opt)
                    <label class="option-item">
                        <input type="radio"
                            name="answer[{{ $question->id }}]"
                            value="{{ $opt->id }}"
                            class="d-none">

                        <div class="option-box p-3 border rounded-3 border-secondary">
                            <span class="me-2 fw-bold">{{ chr(65 + $index) }})</span>
                            {{ $opt->option_text }}
                        </div>
                    </label>
                @endforeach
            </div>
        </div>

        @php $stepIndex++; @endphp
    @endforeach
@endforeach
                        </div>

                      

                    <div class="d-flex justify-content-between mt-5 pt-4 border-top">
                        <button type="button" class="btn btn-outline-secondary px-4" id="prev-btn"
                            onclick="changeStep(-1)" disabled>Previous</button>

                        <button type="button" class="btn btn-primary px-5 fw-bold" id="next-btn"
                            onclick="changeStep(1)">Next Question</button>

                        <button type="button" class="btn btn-success px-5 fw-bold" id="submit-btn"
                            onclick="confirmSubmit()" style="display: none;">
                            Submit Final Test
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card-custom p-3">
                <h6 class="fw-bold mb-3 text-center">Question Palette</h6>

                @php $globalIndex = 0; @endphp

@foreach($groupedQuestions as $subcategory => $sectionQuestions)
    <div class="mb-3">
        <div class="fw-bold text-primary mb-2">
            {{ $subcategory ?? 'General' }}
        </div>

        <div class="d-flex flex-wrap gap-2">
            @foreach($sectionQuestions as $q)
                <div class="palette-item border rounded text-center"
                    id="palette-{{ $globalIndex }}"
                    style="width:35px;height:35px;line-height:35px;cursor:pointer;"
                    onclick="goToStep({{ $globalIndex }})">
                    {{ $globalIndex + 1 }}
                </div>
                @php $globalIndex++; @endphp
            @endforeach
        </div>
    </div>
@endforeach
            </div>
        </div>
    </div>
</div>

<style>
    /* Styling for the radio buttons */
    .option-item {
        cursor: pointer;
        display: block;
        transition: all 0.2s;
    }

    .option-item input:checked+.option-box {
        background: var(--soft-blue);
        border-color: var(--text-blue) !important;
        color: var(--text-blue);
        font-weight: 600;
    }

    .option-box:hover {
        background: rgba(255, 255, 255, 0.05);
    }

    .palette-item.active {
        background: var(--text-blue);
        color: white;
        border-color: var(--text-blue);
    }

    .palette-item.answered {
        background: var(--soft-green);
        color: var(--text-green);
        border-color: var(--text-green);
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let currentStep = 0;
    const totalSteps = {{ $groupedQuestions->flatten()->count() }};
    let timeLeft = {{$exam -> duration_minutes * 60}};
    let formSubmitting = false;
    let startTime = Date.now();

    // Step Navigation
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

        document.getElementById('prev-btn').disabled = (n === 0);

        if (n === totalSteps - 1) {
            document.getElementById('next-btn').style.display = 'none';
            document.getElementById('submit-btn').style.display = 'block';
        } else {
            document.getElementById('next-btn').style.display = 'block';
            document.getElementById('submit-btn').style.display = 'none';
        }

        document.querySelectorAll('.palette-item').forEach(el => el.classList.remove('active'));
        document.getElementById(`palette-${n}`).classList.add('active');
    }

    // Timer
    const timerDisplay = document.getElementById('timer');
    const timerInterval = setInterval(() => {
        let mins = Math.floor(timeLeft / 60);
        let secs = timeLeft % 60;
        timerDisplay.innerText = `${mins}:${secs < 10 ? '0' : ''}${secs}`;

        if (timeLeft <= 0) {
            clearInterval(timerInterval);
            Swal.fire({
                icon: 'info',
                title: 'Time Up!',
                text: 'Your test is being submitted automatically.',
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                formSubmitting = true;
                submitQuizAjax();
            });
            formSubmitting = true;
            submitQuizAjax();
        }
        timeLeft--;
    }, 1000);

    // Palette answered color
    document.querySelectorAll('input[type=radio]').forEach(radio => {
        radio.addEventListener('change', function() {
            let stepIndex = currentStep;
            document.getElementById('palette-' + stepIndex).classList.add('answered');
        });
    });

    // Prevent leaving page
    window.addEventListener('beforeunload', function(e) {
        if (!formSubmitting) {
            e.preventDefault();
            e.returnValue = '';
        }
    });

    // Prevent back button
    history.pushState(null, null, location.href);
    window.onpopstate = function() {
        history.go(1);
    };

    // Tab switch warning
    document.addEventListener("visibilitychange", function() {
        if (document.hidden && !formSubmitting) {
            alert("Warning: Tab switching detected.");
        }
    });

    // Init
    showStep(0);

    function confirmSubmit() {
        Swal.fire({
            title: 'Submit Test?',
            text: "You won't be able to change answers after submission.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, Submit Test'
        }).then((result) => {
            if (result.isConfirmed) {
                formSubmitting = true;
                submitQuizAjax();
            }
        });
    }

    function submitQuizAjax() {
        formSubmitting = true;

        let endTime = Date.now();
        let timeTakenSeconds = Math.floor((endTime - startTime) / 1000);

        document.getElementById('time_taken').value = timeTakenSeconds;

        let form = document.getElementById('quiz-form');
        let formData = new FormData(form);

        fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                Swal.fire({
                    title: 'Test Submitted!',
                    html: `
                <div style="text-align:left;font-size:15px">
                    <p><b>Score:</b> ${data.score}%</p>
                    <p><b>Status:</b> ${data.status}</p>
                    <p><b>Correct:</b> ${data.correct}</p>
                    <p><b>Wrong:</b> ${data.wrong}</p>
                    <p><b>Skipped:</b> ${data.skipped}</p>
                    <p><b>Time Taken:</b> ${Math.floor(data.time_taken/60)}m ${data.time_taken%60}s</p>
                    <p><b>Attempt:</b> ${data.attempt}</p>
                </div>
            `,
                    icon: data.status === 'Passed' ? 'success' : 'error',
                    confirmButtonText: 'View Results'
                }).then(() => {
                    window.location.href = "{{ route('student.exam.results') }}";
                });
            });
    }
</script>
@endsection