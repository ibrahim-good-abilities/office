<li class="bold">

        <a class="waves-effect waves-cyan " href="{{route('dashboard')}}"><i class="material-icons">dashboard</i><span class="menu-title" data-i18n="">{{ __('Welcome') }}</span></a>
    </li>
    <li class="bold"><a class="collapsible-header waves-effect waves-cyan" href="javascript:void(0)"><i class="material-icons">location_on</i>
        <span class="menu-title" data-i18n="">{{ __('Cities') }}</span></a>
        <div class="collapsible-body">
            <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li>
                        <a class="collapsible-body" href="{{route('all_cities')}}" data-i18n=""><i class="material-icons">list</i>
                                <span> {{ __('Cities') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="collapsible-body" href="{{route('create_city')}}" data-i18n=""><i class="material-icons">add_circle</i>
                                <span> {{ __('Add New City') }}</span>
                        </a>
                    </li>
            </ul>
        </div>
</li>
<li class="bold"><a class="collapsible-header waves-effect waves-cyan" href="javascript:void(0)"><i class="material-icons">home</i>
        <span class="menu-title" data-i18n="">{{ __('Offices') }}</span></a>
        <div class="collapsible-body">
            <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li>
                        <a class="collapsible-body" href="{{route('all_offices')}}" data-i18n=""><i class="material-icons">list</i>
                                <span> {{ __('Offices') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="collapsible-body" href="{{route('create_office')}}" data-i18n=""><i class="material-icons">add_circle</i>
                                <span> {{ __('Add New Office') }}</span>
                        </a>
                    </li>
            </ul>
        </div>
</li>
<li class="bold"><a class="collapsible-header waves-effect waves-cyan" href="javascript:void(0)"><i class="material-icons">lightbulb_outline</i>
        <span class="menu-title" data-i18n="">{{ __('Services') }}</span></a>
        <div class="collapsible-body">
            <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li>
                        <a class="collapsible-body" href="{{route('all_services')}}" data-i18n=""><i class="material-icons">list</i>
                                <span> {{ __('Services') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="collapsible-body" href="{{route('create_service')}}" data-i18n=""><i class="material-icons">add_circle</i>
                                <span> {{ __('Add New Service') }}</span>
                        </a>
                    </li>
            </ul>
        </div>
</li>
<li class="bold"><a class="collapsible-header waves-effect waves-cyan" href="javascript:void(0)"><i class="material-icons">security</i>
        <span class="menu-title" data-i18n="">{{ __('Roles') }}</span></a>
        <div class="collapsible-body">
            <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li>
                        <a class="collapsible-body" href="{{route('all_roles')}}" data-i18n=""><i class="material-icons">list</i>
                                <span> {{ __('Roles') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="collapsible-body" href="{{route('add_role')}}" data-i18n=""><i class="material-icons">add_circle</i>
                                <span> {{ __('Add New Role') }}</span>
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
                        <a class="collapsible-body" href="{{route('all_users')}}" data-i18n=""><i class="material-icons">list</i>
                        <span>{{ __('Users') }}</span>
                    </a>
                    </li>
                    <li>
                        <a class="collapsible-body" href="{{route('add_user')}}" data-i18n=""><i class="material-icons">add_circle</i><span>{{ __('Add New User') }}</span></a>
                    </li>
            </ul>
        </div>
</li>
