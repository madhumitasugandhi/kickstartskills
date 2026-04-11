@extends('frontend.institutionPortal.layout.app')
@section('title', 'Financial Management')

@section('content')
<div class="container-fluid py-4">

    {{-- Page Header --}}
    @include('frontend.institutionPortal.dashboard.core-management.financial_management.partials.header')

    {{-- Tabs --}}
    @include('frontend.institutionPortal.dashboard.core-management.financial_management.partials.tabs')

    {{-- Content --}}
    <div class="mt-4">
        @includeIf(
            'frontend.institutionPortal.dashboard.core-management.financial_management.' . $tab
        )
    </div>

</div>
@endsection