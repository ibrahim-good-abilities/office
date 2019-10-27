    <li class="bold">
        <a class="waves-effect waves-cyan " href="{{route('home')}}"><i class="material-icons">dashboard</i><span class="menu-title" data-i18n="">{{ __('Main') }}</span></a>
    </li>
    <li class="bold"><a class="collapsible-header waves-effect waves-cyan" href="javascript:void(0)"><i class="material-icons">schedule</i>
        <span class="menu-title" data-i18n="">{{ __('Working Days') }}</span></a>
        <div class="collapsible-body">
            <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li>
                        <a class="collapsible-body" href="#" data-i18n=""><i class="material-icons">list</i>
                            <span>{{ __('Show All') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="collapsible-body" href="#" data-i18n=""><i class="material-icons">alarm_add</i>
                            <span>{{ __('Add New') }}</span>
                        </a>
                    </li>

            </ul>
        </div>
    </li>