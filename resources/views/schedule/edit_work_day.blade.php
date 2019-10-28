@extends('layout')
@section('title',  __('Edit New Work Day'))
@section('page_css')
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
@endsection

@section('settings')
<div class="col s2 m6 l6 right-align">
    <a class="btn mb-1 waves-effect waves-light" href="{{ route('working-days.index') }}">{{__('Back') }}
        <i class="material-icons right">keyboard_return</i>
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
<form action="{{Route('working-days.update',$working_day->id)}}" method="post">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="input-name col s12">
            <input name="date" id="date" type="text" placeholder="{{ __('Select Date') }}" class="days-datepicker" value="{{$working_day->date}}">
            <label for="date">{{ __('Date') }}</label>
        </div>

        <div class="input-field col s12">
            <button class="btn cyan waves-effect waves-light right" type="submit" name="action">{{ __('Submit') }}
                <i class="material-icons right">send</i>
            </button>
        </div>
    </div>
</form>
<h4 class="center-align">{{ __('Work Schedule') }}</h4>
<table id="schedule" class="display">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ __('Employee') }}</th>
            <th>{{ __('Available') }}</th>
            <th>{{ __('Start Time') }}</th>
            <th>{{ __('End Time') }}</th>
            <th>{{ __('Settings') }}</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($schedule_list as $schedule)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$schedule->employee}}</td>
            <td>{{$schedule->available}}</td>
            <td>{{$schedule->start_time}}</td>
            <td>{{$schedule->end_time}}</td>
            <td>
                <a  href="{{ route('schedule.edit',$schedule->id) }}">
                    <i class="material-icons">edit</i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@section('page_js')
<script src="{{asset('resources/vendors/data-tables/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('resources/js/edit_working_day.js')}}" type="text/javascript"></script>
@endsection
@endsection
