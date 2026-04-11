@php
$tabs = [
    'overview'  => ['label'=>'Overview','icon'=>'bi-clock'],
    'drives'    => ['label'=>'Internship Drives','icon'=>'bi-briefcase'],
    'students'  => ['label'=>'Student Progress','icon'=>'bi-people'],
    'partners'  => ['label'=>'Partner Companies','icon'=>'bi-building'],
    'analytics' => ['label'=>'Analytics','icon'=>'bi-bar-chart']
];
@endphp

<div class="ui-card">
    <div class="ui-tabs">
        @foreach($tabs as $key => $tabItem)
            <a href="{{ route('institution.core.internships.index', $key) }}"
               class="ui-tab {{ $tab === $key ? 'active' : '' }}">
                <i class="bi {{ $tabItem['icon'] }} me-1"></i>
                {{ $tabItem['label'] }}
            </a>
        @endforeach
    </div>
</div>