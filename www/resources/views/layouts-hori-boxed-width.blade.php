@extends('admin.layouts.master-layouts')

@section('title') @lang('translation.Boxed_Width') @endsection

@section('body')
    <body data-layout-size="boxed" data-layout="horizontal">
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Layouts @endslot
        @slot('title') Boxed Width @endslot
    @endcomponent


@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- dashboard init -->
    <script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>

@endsection

