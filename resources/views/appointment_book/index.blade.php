@extends('layouts.master')

@section('title') @lang('translation.Calendar') @endsection

@section('css')
    <link rel="stylesheet" type="text/css"
          href="{{ URL::asset('/assets/libs/tui-time-picker/tui-time-picker.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ URL::asset('/assets/libs/tui-date-picker/tui-date-picker.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/tui-calendar/tui-calendar.min.css') }}"/>
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Skote @endslot
        @slot('title') Calendar @endslot
    @endcomponent
    @include('appointment_book.tabs.appointment_tabs')
    @include('appointment_book.new_schedule_modal')
@endsection

@section('script')
    <script src="https://uicdn.toast.com/tui.code-snippet/latest/tui-code-snippet.min.js"></script>
    <script src="{{ URL::asset('/assets/libs/tui-dom/tui-dom.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/libs/tui-time-picker/tui-time-picker.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/tui-date-picker/tui-date-picker.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/libs//moment/moment.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/chance/chance.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/libs/tui-calendar/tui-calendar.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/pages/calendars.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/schedules.js') }}"></script>
    @include('appointment_book.script')
    @include('appointment_book.custom_script')
    @include('appointment_book.form_script')

@endsection
