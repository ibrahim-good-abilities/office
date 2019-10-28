@extends('layout')
@section('title',  __('Edit New Work Day'))
@section('page_css')
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
@section('page_js')
<script src="{{ asset('resources/js/add_working_day.js')}}" type="text/javascript"></script>
@endsection
@endsection
