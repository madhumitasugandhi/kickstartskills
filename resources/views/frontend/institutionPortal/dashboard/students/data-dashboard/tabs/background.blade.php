<div class="ui-card ui-analytics-card mb-4">

    <div class="ui-card-header">
        <div>
            <div class="ui-card-title">Student Background Analysis</div>
            <div class="ui-card-subtitle">Education, Experience & Location</div>
        </div>
    </div>

    {{-- ================= EDUCATIONAL BACKGROUND ================= --}}
    <div class="ui-section">

        <div class="ui-section-title">
            Educational Background Distribution
        </div>

        @php
            $education = [
                '12th Science – CBSE' => 1,
                'B.Tech Information Technology' => 1,
                'B.Com Commerce' => 1,
                '12th Science – State Board' => 1,
                'BCA Computer Applications' => 1,
            ];
        @endphp

        @foreach($education as $label => $count)
            <div class="background-row">
                <div class="background-left">
                    <span class="dot success"></span>
                    <span>{{ $label }}</span>
                </div>
                <div class="background-count">
                    {{ $count }} students
                </div>
            </div>
        @endforeach

    </div>

    {{-- ================= WORK EXPERIENCE ================= --}}
    <div class="ui-section">

        <div class="ui-section-title">
            Work Experience Analysis
        </div>

        @php
            $experience = [
                ['label'=>'None', 'count'=>2, 'color'=>'info'],
                ['label'=>'0–2 years', 'count'=>2, 'color'=>'warning'],
                ['label'=>'2–4 years', 'count'=>1, 'color'=>'success'],
                ['label'=>'4+ years', 'count'=>0, 'color'=>'danger'],
            ];
        @endphp

        @foreach($experience as $exp)
            <div class="background-row">
                <div class="background-left">
                    <span class="dot {{ $exp['color'] }}"></span>
                    <span>{{ $exp['label'] }}</span>
                </div>
                <div class="background-count">
                    {{ $exp['count'] }} students
                </div>
            </div>
        @endforeach

    </div>

    {{-- ================= LOCATION DISTRIBUTION ================= --}}
    <div class="ui-section">

        <div class="ui-section-title">
            Location Distribution
        </div>

        @php
            $locations = [
                ['label'=>'Urban', 'count'=>3, 'width'=>60],
                ['label'=>'Semi-Urban', 'count'=>1, 'width'=>20],
                ['label'=>'Rural', 'count'=>1, 'width'=>20],
            ];
        @endphp

        @foreach($locations as $loc)
            <div class="analytics-row mb-3">

                <div class="analytics-label">
                    {{ $loc['label'] }}
                </div>

                <div class="analytics-bar">
                    <div class="progress-track">
                        <div class="progress-fill"
                             style="width: {{$loc['width']}}%">
                        </div>
                    </div>
                </div>

                <div class="analytics-count">
                    {{ $loc['count'] }} students
                </div>

            </div>
        @endforeach

    </div>

</div>