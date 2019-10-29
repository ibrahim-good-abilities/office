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
            <th>{{ __('Employee') }}</th>
            <th>{{ __('User') }}</th>
            <th>{{ __('Date') }}</th>
            <th>{{ __('Time') }}</th>
            <th>{{ __('Status') }}</th>
            <th>{{ __('Feedback') }}</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($tickets as $ticket)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>#{{$ticket->id}}</td>
            <td>{{$ticket->service}}</td>
            <td>{{$ticket->employee}}</td>
            <td>{{$ticket->user}}</td>
            <td>{{$ticket->date}}</td>
            <td>{{$ticket->time}}</td>
            <td>{{$ticket->status}}</td>
            <td data-rate="{{$ticket->rate}}" data-feedback="{{$ticket->feedback}}">
                @if($ticket->status == 'rated')
                <a  href="#feedback" class="modal-trigger">
                    <i class="material-icons">feedback</i>
                </a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!-- feedback modal -->
<div id="feedback" class="modal">
  <form action="{{ route('updateAdmin') }}" method="post">
    @csrf
    <div class="modal-content center-align">
      <h4><i class="material-icons feedbackStar" > star</i><span id="rate">2</span>/5</h4>
      <div class="row">
          <div class="input-field col m12 s6" id="ticket_feedback">
                    <?php $lipsum = simplexml_load_file('http://www.lipsum.com/feed/xml?amount=1&what=paras&start=0')->lipsum;?>
                    {{ $lipsum}};
          </div>

        </div>
    </div>
  </form>
</div>
@section('page_js')
<script src="{{asset('resources/vendors/data-tables/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('resources/js/offcie_tickets.js')}}" type="text/javascript"></script>
@endsection
@endsection
