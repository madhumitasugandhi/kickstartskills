@extends('frontend.institutionPortal.layout.app')
@section('title', 'Financial Management')

@section('content')
<div class="container-fluid py-4">

    {{-- Header --}}
    @include('frontend.institutionPortal.dashboard.core-management.financial_management.partials.header')

    {{-- Tabs --}}
    @include('frontend.institutionPortal.dashboard.core-management.financial_management.partials.tabs')

    {{-- Tab Content --}}
    <div class="mt-4">

        @switch($tab)

            @case('overview')
                @include('frontend.institutionPortal.dashboard.core-management.financial_management.overview')
                @break

            @case('fee-structure')
                @include('frontend.institutionPortal.dashboard.core-management.financial_management.fee-structure')
                @break

            @case('payments')
                @include('frontend.institutionPortal.dashboard.core-management.financial_management.payments')
                @break

            @case('expenses')
                @include('frontend.institutionPortal.dashboard.core-management.financial_management.expenses')
                @break

            @case('reports')
                @include('frontend.institutionPortal.dashboard.core-management.financial_management.reports')
                @break

            @default
                @include('frontend.institutionPortal.dashboard.core-management.financial_management.overview')

        @endswitch

    </div>

</div>
@endsection
