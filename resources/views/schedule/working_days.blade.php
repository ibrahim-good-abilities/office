@extends('layout')
@section('title', __('Working Days'))
@section('page_css')
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/css/select.dataTables.min.css')}}">
@endsection
@section('settings')
<div class="col s2 m6 l6 right-align">
    <a class="btn mb-1 waves-effect waves-light" href="{{route('working-days.create')}}">{{__('ADD NEW') }}
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
@if($errors->any())
      <div class="card-alert card red lighten-5 card-content red-text">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
@endif
<table id="working_days" class="display">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ __('Date') }}</th>
            <th>{{ __('Settings') }}</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($working_days as $day)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{ $day->date}}</td>
            <td>
                <a  href="#">
                    <i class="material-icons">edit</i>
                </a>
                <a  class="delete-with-confirmation" href="#">
                    <i class="material-icons pink-text delete-with-confirmation">clear</i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@section('page_js')
<script src="{{asset('resources/vendors/data-tables/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/vendors/data-tables/js/dataTables.select.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('resources/js/working_days.js')}}" type="text/javascript"></script>
@endsection
@endsection
