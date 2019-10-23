@extends('layout')
@section('title', __('All Offices'))
@section('page_css')
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/css/select.dataTables.min.css')}}">
@endsection
@section('settings')
<div class="col s2 m6 l6 right-align">
    <a class="btn mb-1 waves-effect waves-light" href="{{route('create_office')}}">{{__('ADD NEW') }}
        <i class="material-icons right">add</i>
    </a>
</div>
@endsection
@section('middle_content')
@if ($message = Session::get('success'))
<div class="card-alert card gradient-45deg-green-teal">
    <div class="card-content white-text">
        <p>
        <i class="material-icons">check</i> {{ $message }}</p>
</div>
    <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif
<!-- orders table -->
<table id="offices" class="subscription-table highlight">
    <thead>
        <tr>
            <th>{{ __('#') }}</th>
            <th>{{ __('Office Name') }}</th>
            <th> {{ __('Office Address') }}</th>
            <th> {{ __('Office Phone') }}</th>
            <th>{{__('Office Mobile')}}</th>
            <th>{{ __('Office Email') }}</th>
            <th>{{__('City Id')}}</th>
            <th>{{__('Settings')}}</th>
        </tr>
    </thead>
    <tbody>

        @foreach($offices as $office)
            <tr>
                <td>{{$office->id}}</td>
                <td>{{$office->officeName}}</td>
                <td>{{$office->officeAddress}}</td>
                <td>{{$office->officePhone }}</td>
                <td>{{$office->officeMobile}}</td>
                <td>{{$office->officeEmail}}</td>
                <td>{{$office->cityId}}</td>

                <td class="left-align">
                      <a href="{{route('edit_office',$office->id)}}"><i class="material-icons">visibility</i></a>
                      <a class="delete-with-confirmation" href="{{route('delete_office',$office->id)}}"><i class="material-icons pink-text">clear</i></a>
                </td>
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
