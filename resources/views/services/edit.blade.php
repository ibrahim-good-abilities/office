@extends('layout')
@section('title',  __('Edit Service'))
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
<form action="{{route('update_service',$service->id)}}" method="post" enctype="multipart/form-data" >
   @csrf

         <div class="row">
            <div class="input-name col s12">
               <input  name="serviceName" id="serviceName" type="text" class="validate" placeholder="{{ __('Add Service Name') }}" value="{{$service->serviceName}}">
               <label for="serviceName">{{ __('Service Name') }}</label>
            </div>


            <div class="input-name col s12">
               <input  name="servicePrice" id="servicePrice" type="number" class="validate" placeholder="{{ __('Add Service Price') }}"value="{{$service->servicePrice}}">
               <label for="servicePrice">{{ __('Service Price') }}</label>
            </div>

            <div class="input-name col s12">
               <input  name="serviceTime" id="serviceTime" type="text" class="validate" placeholder="{{ __('Add serviceTime') }}" value="{{$service->serviceTime}}">
               <label for="serviceTime">{{ __('Service Time') }}</label>
            </div>

            <div class="input-name col s12">
               <input  name="serviceDescription" id="serviceDescription" type="text" class="validate" placeholder="{{ __('Add Service Description') }}" value="{{ $service->serviceDescription }}">
               <label for="serviceDescription">{{ __('Service Descrption') }}</label>
            </div>

            <div class="input-name col s12">
               <input  name="serviceAllowedCancelTime" id="serviceAllowedCancelTime" type="text" class="validate" placeholder="{{ __('Add Service  Cancel Time') }}" value="{{ $service->serviceAllowedCancelTime}}">
               <label for="serviceAllowedCancelTime">{{ __('Service Cancelation Time') }}</label>
            </div>
            <div class="input-field col s12">
               <button class="btn cyan waves-effect waves-light right" type="submit" name="action">{{ __('Submit') }}
                  <i class="material-icons right">send</i>
               </button>
            </div>
         </div>

</form>
<div id="inline-form" class="card card card-default scrollspy">
    <div class="card-content">
       <h4 class="card-title"> {{__('Requirements')}}</h4>
       <form action="{{route('store_requirement')}}" method="post"  class="col s12">
           @csrf
           <input type="hidden" name="serviceId" value="{{ $service->id }}"/>
          <div class="row">

             <div class="input-field col m4 s6">
                <input  name="requirementName" id="requirementName" type="text" class="validate" placeholder="{{ __('Add Requirement Name') }}">
                <label  >{{__('Requirement Name')}}</label>
             </div>
             <div class="input-field col m4 s6">
                <input  name="requirementDescription" id="requirementDescription" type="text" class="validate" placeholder="{{ __('Add Requirement Description') }}">
                <label  >{{__('Requirement Description')}}</label>
             </div>
             <div class="input-field col m4 s6">
             <select class="icons" name="requirementType">
                  <option value="" disabled selected>{{ __('Choose Requirement Type') }}</option>
                        <option  name="requirementType" class="circle"> PDF </option>
                        <option  name="requirementType" class="circle"> Document </option>
                        <option  name="requirementType" class="circle"> Image </option>
               </select>
               <label  >{{__('Requirement Type')}}</label>
             </div>
             <div class="input-field col m4 s12">
                   <button class="btn cyan waves-effect waves-light " type="submit" name="action">
                   <i class="material-icons left">add</i>اضافه</button>
             </div>
          </div>
       </form>

       <table>
          <thead>
             <tr>
                <th>{{__('Requirement Name')}}</th>
                <th>{{__('Requirement Description')}}</th>
                <th>{{__('Requirement Type')}}</th>
                <th>حذف</th>
             </tr>
          </thead>

          <tbody>
              @foreach($requirements as $requirement)
             <tr>
                <td>{{$requirement->requirementName}}</td>
                <td>{{$requirement->requirementDescription}}</td>
                <td>{{$requirement->requirementType}}</td>

                <td>
                   <a class="delete-with-confirmation" href="{{route('delete_requirement',$requirement->id)}}">
                      <i class="material-icons pink-text">clear</i>
                   </a>
                </td>
             </tr>
             @endforeach
          </tbody>
       </table>
    </div>
 </div>
@section('page_js')
@endsection
@endsection
