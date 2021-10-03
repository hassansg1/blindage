@extends('components.datatable')
@section('table_header')
    <th>Branch</th>
    <th>Date</th>
    <th>Total Amount</th>
    <th>Comment</th>
@endsection
@section('table_rows')
    @include($route.'.form_rows')
@endsection
