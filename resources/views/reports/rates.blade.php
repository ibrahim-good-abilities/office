@extends('layout')
@section('title', __('Rates'))
@section('page_css')
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/css/select.dataTables.min.css')}}">
@endsection
@section('middle_content')
<!-- orders table -->
<table id="offices" class="subscription-table highlight">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ __('Employee Name') }}</th>
            <th>{{__('All Tickets')}}</th>
            <th>{{__('All Rates')}}</th>

        </tr>
    </thead>
    <tbody>

            <tr>
                <td>1</td>
                <td>ali</td>
                <td>23</td>
                <td>0</td>

            </tr>

    </tbody>
</table>
<!-- orders table -->
@section('page_js')
<script src="{{asset('resources/vendors/data-tables/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/vendors/data-tables/js/dataTables.select.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('resources/js/offices.js')}}" type="text/javascript"></script>
@endsection
@endsection
