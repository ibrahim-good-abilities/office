@extends('layout')
@section('title', __('All Tickets'))
@section('page_css')
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
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
<table id="tickets" class="display">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ __('Ticket Code') }}</th>
            <th>{{ __('Service Name') }}</th>
            <th>{{ __('User') }}</th>
            <th>{{ __('Time') }}</th>
            <th>{{ __('Files') }}</th>
            <th>{{__('Mark As Done')}}</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($tickets as $ticket)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>#{{$ticket->id}}</td>
            <td>{{$ticket->service}}</td>
            <td>{{$ticket->user}}</td>
            <td>{{$ticket->time}}</td>
            <td>
                <a href="#"> تحميل</a>
            </td>
            <td>
                <a href="{{route('update_ticket_status',$ticket->id)}}">
                    <i class="material-icons">done</i>
                </a>
            </td>

        </tr>
        @endforeach
    </tbody>
</table>

@section('page_js')
<script src="{{asset('resources/vendors/data-tables/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('resources/js/employee_tickets.js')}}" type="text/javascript"></script>
@endsection
@endsection
