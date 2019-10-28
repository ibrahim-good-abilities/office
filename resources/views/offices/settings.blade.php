@extends('layout')
@section('title',  __('Office Settings'))
@section('page_css')
@endsection

@section('settings')
<div class="col s2 m6 l6 right-align">
    <a class="btn mb-1 waves-effect waves-light" href="#">{{__('Back') }}
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
<form action="{{route('storeSettings')}}" method="post" enctype="multipart/form-data" >
   @csrf

         <div class="row">
            <div class="input-name col s12">
               <input  name="officeStartTime" id="officeStartTime" class="timepicker validate" type="text"  value="{{$office->officeStartTime}}" placeholder="{{ __('Add Office Start Time') }}">
               <label for="officeStartTime">{{ __('Office Start Time') }}</label>
            </div>


            <div class="input-name col s12">
               <input  name="officeBreak" id="officeBreak" type="text" class="timepicker validate" value="{{$office->officeBreak}}" placeholder="{{ __('Add Office Break') }}">
               <label for="officeBreak">{{ __('Office Break') }}</label>
            </div>

            <div class="input-name col s12">
               <input  name="officeEndTime" id="officeEndTime" type="text"class="timepicker validate" value="{{$office->officeEndTime}}"placeholder="{{ __('Add Office End Time') }}">
               <label for="officeEndTime">{{ __('Office End Time') }}</label>
            </div>

            <div class="input-field col s12">
               <button class="btn cyan waves-effect waves-light right" type="submit" name="action">{{ __('Submit') }}
                  <i class="material-icons right">send</i>
               </button>
            </div>
         </div>



</form>
@section('page_js')
<script src="{{ asset('resources/js/settings.js')}}" type="text/javascript"></script>
@endsection
@endsection
