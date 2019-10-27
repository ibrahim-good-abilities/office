@extends('layout')
@section('title',  __('Add Service'))
@section('page_css')
@endsection

@section('settings')
<div class="col s2 m6 l6 right-align">
    <a class="btn mb-1 waves-effect waves-light" href="{{ route('all_services') }}">{{__('Back') }}
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
<form action="{{route('store_service')}}" method="post" enctype="multipart/form-data" >
   @csrf

         <div class="row">
            <div class="input-name col s12">
               <input  name="serviceName" id="serviceName" type="text" class="validate" placeholder="{{ __('Add Service Name') }}">
               <label for="serviceName">{{ __('Service Name') }}</label>
            </div>


            <div class="input-name col s12">
               <input  name="servicePrice" id="servicePrice" type="number" step="0.25" class="validate" placeholder="{{ __('Add Service price') }}">
               <label for="servicePrice">{{ __('Service Price') }}</label>
            </div>

            <div class="input-name col s12">
               <input  name="serviceTime" id="serviceTime" type="text" class="validate" placeholder="{{ __('Add Service Time') }}">
               <label for="serviceTime">{{ __('Service Time') }}</label>
            </div>
            <div class="input-name col s12">
               <input  name="serviceDescription" id="serviceDescription" type="text" class="validate" placeholder="{{ __('Add Service Description') }}">
               <label for="serviceDescription">{{ __('Service Descrption') }}</label>
            </div>
            <div class="input-name col s12">
               <input  name="serviceAllowedCancelTime" id="serviceAllowedCancelTime" type="text" class="validate" placeholder="{{ __('Add Service  Cancel Time') }}">
               <label for="serviceAllowedCancelTime">{{ __('Service Cancelation Time') }}</label>
            </div>
            <div class="input-field col s12">
               <button class="btn cyan waves-effect waves-light right" type="submit" name="action">{{ __('Submit') }}
                  <i class="material-icons right">send</i>
               </button>
            </div>
         </div>

</form>
@section('page_js')
@endsection
@endsection
