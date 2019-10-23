@extends('layout')
@section('title',  __('Add Office'))
@section('page_css')
@endsection

@section('settings')
<div class="col s2 m6 l6 right-align">
    <a class="btn mb-1 waves-effect waves-light" href="{{ route('all_offices') }}">{{__('Back') }}
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
<form action="{{route('store_office')}}" method="post" enctype="multipart/form-data" >
   @csrf

         <div class="row">
            <div class="input-name col s12">
               <input  name="officeName" id="officeName" type="text" class="validate" placeholder="{{ __('Add Office Name') }}">
               <label for="officeName">{{ __('Office Name') }}</label>
            </div>


            <div class="input-name col s12">
               <input  name="officeAddress" id="officeAddress" type="text" class="validate" placeholder="{{ __('Add Office Address') }}">
               <label for="officeAddress">{{ __('Office Address') }}</label>
            </div>

            <div class="input-name col s12">
               <input  name="officePhone" id="officePhone" type="text" class="validate" placeholder="{{ __('Add Office Phone') }}">
               <label for="officePhone">{{ __('Office Phone') }}</label>
            </div>

            <div class="input-name col s12">
               <input  name="officeNumber" id="officeNumber" type="text" class="validate" placeholder="{{ __('Add Office Mobile') }}">
               <label for="officeNumber">{{ __('Office Mobile') }}</label>
            </div>


            <div class="input-name col s12">
               <input  name="officeEmail" id="officeEmail" type="email" class="validate" placeholder="{{ __('Add Office Email') }}">
               <label for="officeEmail">{{ __('Office Email') }}</label>
            </div>

            <div class="city  col s12 ">
               <select class="icons" name="cityId">
                  <option value="" disabled selected>{{ __('Choose City') }}</option>
                  @foreach($cities as $city)
                        <option  value="{{$city->id}}" name="cityId" class="circle"> {{$city->cityName}} </option>
                  @endforeach
               </select>
               <label>{{ __('City') }}</label>
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
