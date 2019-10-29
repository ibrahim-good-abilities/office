@extends('layout')
@section('title', __('Offices Tickets'))
@section('page_css')
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/css/select.dataTables.min.css')}}">
@endsection
@section('middle_content')
<!-- orders table -->
<table id="offices" class="subscription-table highlight">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ __('Office Name') }}</th>
            <th>{{__('City Name')}}</th>
            <th>{{__('All Tickets')}}</th>
        </tr>
    </thead>
    <tbody>

        @foreach($offices as $office)
            <tr  data-office_id="{{$office->id}}">
                <td>{{$loop->iteration}}</td>
                <td>{{ $office->office }}</td>
                <td>{{ $office->city }}</td>
                <td><a href="{{ route('retrieve_office_tickets',$office->id) }}">{{ $office->total_tickets }}</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
<!-- feedback modal -->
<div id="feedback" class="modal">
  <form action="{{ route('updateAdmin') }}" method="post">
    @csrf
    <div class="modal-content">
      <h4>{{ __('Change Admin') }}</h4>
      <div class="row">
          <div class="input-field col m12 s6">
                <select name="admin">
                    <option value="" disabled selected>المدراء</option>
                    @foreach($admins as $admin)
                        <option value="{{ $admin->id }}" >{{$admin->name}}</option>
                    @endforeach
                </select>
                <label>{{__('Choose New Admin')}}</label>
          </div>
                 <input type="hidden" name="office_id" value=""/>
          <div class="button-wrapper">
                <button class="btn cyan waves-effect waves-light right" type="submit">{{ __('Change') }}
                      <i class="material-icons right">send</i>
                </button>
          </div>
        </div>
    </div>
  </form>
</div>
<!-- orders table -->
@section('page_js')
<script src="{{asset('resources/vendors/data-tables/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/vendors/data-tables/js/dataTables.select.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('resources/js/offices.js')}}" type="text/javascript"></script>
@endsection
@endsection
