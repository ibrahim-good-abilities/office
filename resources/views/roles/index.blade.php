@extends('layout')
@section('title', __('Roles'))
@section('page_css')
<link rel="stylesheet" type="text/css" href="{{asset('resources/vendors/data-tables/css/jquery.dataTables.min.css')}}">
@endsection
@section('settings')
<div class="col s2 m6 l6 right-align">
    <a class="btn mb-1 waves-effect waves-light" href="{{route('add_role')}}">{{__('ADD NEW') }}
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

        <table id="roles" class="display">
            <thead>
                <tr>
                    <th># </th>
                    <th>الاسم</th>
                    <th>الاعدادات</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->id}}</td>
                    <td>{{ $role->role_name}}</td>
                    <td>
                        <a  href="{{route('edit_role',$role->id)}}">
                            <i class="material-icons">edit</i>
                        </a>

                        <a  class="delete-with-confirmation" href="{{route('delete_role',$role->id)}}">
                            <i class="material-icons pink-text delete-with-confirmation">clear</i>
                        </a>

                         <!-- <a>
                            <i class="material-icons">not_interested</i>
                         </a> -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


@section('page_js')
<script src="{{asset('resources/js/roles.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/vendors/data-tables/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}" type="text/javascript"></script>
@endsection
@endsection
