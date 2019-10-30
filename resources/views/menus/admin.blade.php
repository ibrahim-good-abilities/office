    <li class="bold">
        <a class="waves-effect waves-cyan " href="{{route('office_tickets')}}"><i class="material-icons">dashboard</i><span class="menu-title" data-i18n="">{{ __('Main') }}</span></a>
    </li>
    <li class="bold"><a class="collapsible-header waves-effect waves-cyan" href="javascript:void(0)"><i class="material-icons">schedule</i>
        <span class="menu-title" data-i18n="">{{ __('Working Days') }}</span></a>
        <div class="collapsible-body">
            <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li>
                        <a class="collapsible-body" href="{{route('working-days.index')}}" data-i18n=""><i class="material-icons">list</i>
                            <span>{{ __('Show All') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="collapsible-body" href="{{route('working-days.create')}}" data-i18n=""><i class="material-icons">alarm_add</i>
                            <span>{{ __('Add New') }}</span>
                        </a>
                    </li>
            </ul>
        </div>
    </li>
    <li class="bold"><a class="collapsible-header waves-effect waves-cyan" href="javascript:void(0)"><i class="material-icons">people</i>
        <span class="menu-title" data-i18n="">{{ __('Users') }}</span></a>
        <div class="collapsible-body">
            <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li>
                        <a class="collapsible-body" href="{{route('admin_all_users')}}" data-i18n=""><i class="material-icons">list</i>
                        <span>{{ __('Users') }}</span>
                    </a>
                    </li>
                    <li>
                        <a class="collapsible-body" href="{{route('admin_add_user')}}" data-i18n=""><i class="material-icons">add_circle</i><span>{{ __('Add New User') }}</span></a>
                    </li>
            </ul>
        </div>
</li>
