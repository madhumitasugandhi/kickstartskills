@php
$tabs = [
    'overview'  => ['label'=>'Overview','icon'=>'bi-clock'],
    'drives'    => ['label'=>'Internship Drives','icon'=>'bi-briefcase'],
    'students'  => ['label'=>'Student Progress','icon'=>'bi-people'],
    'partners'  => ['label'=>'Partner Companies','icon'=>'bi-building'],
    'analytics' => ['label'=>'Analytics','icon'=>'bi-bar-chart']
];
@endphp

<div class="glass-card mb-4">
    <div class="d-flex gap-3 flex-wrap">
        @foreach($tabs as $key => $tabItem)
            <a href="{{ route('institution.internships',$key) }}"
               class="tab-btn {{ $tab === $key ? 'active' : '' }}">
                <i class="bi {{ $tabItem['icon'] }}"></i>
                {{ $tabItem['label'] }}
            </a>
        @endforeach
    </div>
</div>
