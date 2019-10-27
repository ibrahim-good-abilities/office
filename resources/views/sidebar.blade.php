<script>
    var logo_url="{{asset('public/logo/logo.png')}}";
</script>
<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square">
    <div class="brand-sidebar">
        <h1 class="logo-wrapper">
            <a class="brand-logo darken-1" href="{{ route('home') }}">

                <img src="#" alt="logo" />
                <span class="logo-text hide-on-med-and-down">خدماتك بمواعيد</span>
            </a>
            <a class="navbar-toggler" href="#"><i class="material-icons">radio_button_checked</i></a></h1>
    </div>

    <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
    @if(Auth::user()->role->slug == 'superadmin')

        <li class="bold">

                <a class="waves-effect waves-cyan " href="{{route('home')}}"><i class="material-icons">settings_input_svideo</i><span class="menu-title" data-i18n="">{{ __('Welcome') }}</span></a>
            </li>
            <li class="bold"><a class="collapsible-header waves-effect waves-cyan" href="javascript:void(0)"><i class="material-icons">playlist_add_check</i>
                <span class="menu-title" data-i18n="">{{ __('Cities') }}</span></a>
                <div class="collapsible-body">
                    <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                            <li>
                                <a class="collapsible-body" href="{{route('all_cities')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i>
                                     <span> {{ __('Cities') }}</span>
                                </a>
                            </li>
                            <li>
                                <a class="collapsible-body" href="{{route('create_city')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i>
                                     <span> {{ __('Add New City') }}</span>
                                </a>
                            </li>
                    </ul>
                </div>
        </li>
        <li class="bold"><a class="collapsible-header waves-effect waves-cyan" href="javascript:void(0)"><i class="material-icons">playlist_add_check</i>
                <span class="menu-title" data-i18n="">{{ __('Offices') }}</span></a>
                <div class="collapsible-body">
                    <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                            <li>
                                <a class="collapsible-body" href="{{route('all_offices')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i>
                                     <span> {{ __('Offices') }}</span>
                                </a>
                            </li>
                            <li>
                                <a class="collapsible-body" href="{{route('create_office')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i>
                                     <span> {{ __('Add New Office') }}</span>
                                </a>
                            </li>
                    </ul>
                </div>
        </li>
        <li class="bold"><a class="collapsible-header waves-effect waves-cyan" href="javascript:void(0)"><i class="material-icons">playlist_add_check</i>
                <span class="menu-title" data-i18n="">{{ __('Services') }}</span></a>
                <div class="collapsible-body">
                    <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                            <li>
                                <a class="collapsible-body" href="{{route('all_services')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i>
                                     <span> {{ __('Services') }}</span>
                                </a>
                            </li>
                            <li>
                                <a class="collapsible-body" href="{{route('create_service')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i>
                                     <span> {{ __('Add New Service') }}</span>
                                </a>
                            </li>
                    </ul>
                </div>
        </li>
        <li class="bold"><a class="collapsible-header waves-effect waves-cyan" href="javascript:void(0)"><i class="material-icons">playlist_add_check</i>
                <span class="menu-title" data-i18n="">{{ __('Roles') }}</span></a>
                <div class="collapsible-body">
                    <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                            <li>
                                <a class="collapsible-body" href="{{route('all_roles')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i>
                                     <span> {{ __('Roles') }}</span>
                                </a>
                            </li>
                            <li>
                                <a class="collapsible-body" href="{{route('add_role')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i>
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
                              <a class="collapsible-body" href="{{route('all_users')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i>
                                <span>{{ __('Users') }}</span>
                            </a>
                            </li>
                            <li>
                              <a class="collapsible-body" href="{{route('add_user')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>{{ __('Add New User') }}</span></a>
                            </li>
                    </ul>
                </div>
        </li>
    </ul>
    @endif
    @if(Auth::user()->role->slug == 'admin')
        <li class="bold"><a class="collapsible-header waves-effect waves-cyan" href="javascript:void(0)"><i class="material-icons">people</i>
                    <span class="menu-title" data-i18n="">{{ __('Tickets') }}</span></a>
                    <div class="collapsible-body">
                        <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                                <li>
                                    <a class="collapsible-body" href="#" data-i18n=""><i class="material-icons">radio_button_unchecked</i>
                                    <span>{{ __('Tickets') }}</span>
                                </a>
                                </li>

                        </ul>
                    </div>
            </li>
    @endif
    @if(Auth::user()->role->slug == 'employee')

    @endif
    @if(Auth::user()->role->slug == 'user')

    @endif

</aside>
