@extends('layout')
@section('title', __('Offices Tickets'))
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
            <th>{{ __('Office Name') }}</th>
            <th>{{__('City Name')}}</th>
            <th>{{__('All Tickets')}}</th>
        </tr>
    </thead>
    <tbody>

        @foreach($offices as $office)
            <tr  data-office_id="{{$office->id}}">
                <td>{{$loop->iteration}}</td>
                <td>{{ $office->office }}</td>
                <td>{{ $office->city }}</td>
                <td><a href="{{ route('retrieve_office_tickets',$office->id) }}">{{ $office->total_tickets }}</a></td>
            </tr>
        @endforeach
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
