@extends('layout')
@section('title', __('Attendance'))
@section('page_css')
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/css/select.dataTables.min.css')}}">
@endsection
@section('middle_content')
<!-- orders table -->
<table id="report" class="subscription-table highlight">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ __('Employee Name') }}</th>
            <th>{{ __('Official Work Days') }}</th>
            <th>{{__('Actual Work Days')}}</th>
            <th>{{__('Absent Days')}}</th>

        </tr>
    </thead>
    <tbody>

        @foreach($employees as $employee)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->official }}</td>
                <td>{{ $employee->actual }}</td>
                <td>{{ $employee->official - $employee->actual }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<!-- orders table -->
@section('page_js')
<script src="{{asset('resources/vendors/data-tables/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/vendors/data-tables/js/dataTables.select.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('resources/js/report.js')}}" type="text/javascript"></script>
@endsection
@endsection
