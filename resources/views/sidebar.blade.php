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
        @include('menus.super_admin') 
    @elseif(Auth::user()->role->slug == 'admin')
        @include('menus.admin') 
    @endif
    @if(Auth::user()->role->slug == 'employee')
        @include('menus.employee') 
    @endif
    </ul>
</aside>
