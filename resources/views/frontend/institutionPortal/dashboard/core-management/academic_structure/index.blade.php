@extends('frontend.institutionPortal.layout.app')
@section('content')

@php
    $tab = request('tab', 'overview');
@endphp

<div class="container-fluid py-4 academic-structure">

    <!-- ================= HEADER ================= -->
    <div class="glass-card mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon info">
                    <i class="bi bi-mortarboard"></i>
                </div>
                <div>
                    <h5 class="fw-semibold mb-1">Academic Management</h5>
                    <p class="small mb-0 ">
                        Manage departments, programs, faculty, and academic structure
                    </p>
                </div>
            </div>

            <button class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-lightning-charge me-1"></i>
                Quick Actions
            </button>
        </div>
    </div>

    <!-- ================= TABS ================= -->
    <div class="glass-card mb-4">
        <div class="course-tabs">

            @php
                $tabs = [
                    'overview'     => ['icon' => 'pie-chart', 'label' => 'Overview'],
                    'departments'  => ['icon' => 'layers', 'label' => 'Departments'],
                    'programs'     => ['icon' => 'book', 'label' => 'Programs'],
                    'faculty'      => ['icon' => 'people', 'label' => 'Faculty'],
                    'curriculum'   => ['icon' => 'file-earmark-text', 'label' => 'Curriculum'],
                ];
            @endphp

            @foreach($tabs as $key => $t)
                <a href="{{ route('institution.academic-structure', ['tab' => $key]) }}"
                   class="tab-btn {{ $tab === $key ? 'active' : '' }}">
                    <i class="bi bi-{{ $t['icon'] }}"></i>
                    {{ $t['label'] }}
                </a>
            @endforeach

        </div>
    </div>

    <!-- ================= TAB CONTENT ================= -->
    <div class="course-tab-content">
        @includeIf(
            'frontend.institutionPortal.dashboard.core-management.academic_structure.' . $tab
        )
    </div>

</div>
@endsection
