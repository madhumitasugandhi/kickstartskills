@extends('frontend.institutionPortal.layout.app')

@section('title','Internship Management')


@section('content')
<div class="container-fluid py-4">

    @include('frontend.institutionPortal.dashboard.core-management.internships.partials.header')

    @include('frontend.institutionPortal.dashboard.core-management.internships.partials.tabs')

    <div class="mt-4">
        @includeIf(
            'frontend.institutionPortal.dashboard.core-management.internships.tabs.' . $tab
        )
    </div>

</div>
@endsection
