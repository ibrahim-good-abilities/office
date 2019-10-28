@extends('layout')
@section('title',  __('Edit Schedule'))
@section('page_css')
@endsection

@section('settings')
<div class="col s2 m6 l6 right-align">
    <a class="btn mb-1 waves-effect waves-light" href="javascript:history.back()">{{__('Back') }}
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
<form action="{{route('schedule.update',$schedule->id)}}" method="post">
    @csrf
    @method('PUT')
    <div class="input-name col s12">
        <input  name="startTime" id="startTime" type="text" class="validate" value="{{$schedule->startTime}}" placeholder="{{ __('Add Schedule Start Time') }}">
        <label for="startTime">{{ __('Start Time') }}</label>
    </div>


    <div class="input-name col s12">
        <input  name="endTime" id="endTime" type="text" class="validate" value="{{$schedule->endTime}}"placeholder="{{ __('Add Schedule End Time') }}">
        <label for="endTime">{{ __('End Time') }}</label>
    </div>

    <div class="input-name col s3">
        <br/>
        <br/>
        <!-- Switch -->
        <div class="switch">
            <label>
            الموظف متاح
            <input type="checkbox" name="available" {{ $schedule->available ? 'checked':'' }}>
            <span class="lever"></span>
            غير متاح
            </label>
        </div>
    </div>

    <div class="input-name col s3">
        <br/>
        <br/>
        <!-- Switch -->
        <div class="switch">
            <label>
            وقت عمل رسمى
            <input type="checkbox"  name="officailTime" {{ $schedule->officailTime ? 'checked':'' }}>
            <span class="lever"></span>
            غير رسمى
            </label>
        </div>
    </div>

    <div class="input-field col s12">
        <button class="btn cyan waves-effect waves-light right" type="submit" name="action">{{ __('Submit') }}
            <i class="material-icons right">send</i>
        </button>
    </div>  
</form>
@section('page_js')
@endsection
@endsection
