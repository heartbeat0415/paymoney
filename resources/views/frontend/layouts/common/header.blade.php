
<?php
$user = Auth::user();
$socialList = getSocialLink();
$menusHeader = getMenuContent('Header');
//$logo = getCompanyLogo(); //from session
$logo = getCompanyLogoWithoutSession(); //direct query
?>
<header id="js-header-old"
    class="<?= isset( $menu ) && ( $menu == 'home' ) ? 'home-header': '' ?>">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container navbar-container">
            <a class="navbar-brand" 
                href="@if (request()->path() != 'merchant/payment') {{ url('/') }} @else {{ '#' }} @endif">
                <img src="@if (isset( $menu ) && ( $menu == 'home' )) 
                    {{ url('public/images/logos/logo_yellow.png') }} 
                    @else {{ url('public/images/logos/logo_dark.png') }} 
                    @endif" 
                    alt="logo" 
                    class="img-responsive img-fluid">
            </a>

            @if (request()->path() != 'merchant/payment')
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="hamburger-menu"><i class="fas fa-bars"></i></span>
                </button>
                <div class="collapse navbar-collapse navbar-toggler-right" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto my-navbar">
                        <li class="nav-item <?= isset( $menu ) && ( $menu == 'home' ) ? 'nav_active': '' ?>"><a href="{{url('/')}}" class="nav-link">@lang('message.home.title-bar.home')</a></li>
                        <li class="nav-item <?= isset( $menu ) && ( $menu == 'send-money' ) ? 'nav_active': '' ?>"><a href="{{url('/send-money')}}" class="nav-link">@lang('message.home.title-bar.send')</a></li>
                        <li class="nav-item <?= isset( $menu ) && ( $menu == 'request-money' ) ? 'nav_active': '' ?>"><a href="{{url('/request-money')}}" class="nav-link">@lang('message.home.title-bar.request')</a></li>
                        <li class="nav-item <?= isset( $menu ) && ( $menu == 'about-us' ) ? 'nav_active': '' ?>"><a href="{{url('/about-us')}}" class="nav-link">@lang('message.home.title-bar.about')</a></li>
                        <li class="nav-item <?= isset( $menu ) && ( $menu == 'contact-us' ) ? 'nav_active': '' ?>"><a href="{{url('/contact-us')}}" class="nav-link">@lang('message.home.title-bar.contact')</a></li>
                        @if(!empty($menusHeader))
                            @foreach($menusHeader as $top_navbar)
                                <li class="nav-item <?= isset( $menu ) && ( $menu == $top_navbar->url ) ? 'nav_active': '' ?>"><a href="{{url($top_navbar->url)}}" class="nav-link"> {{ $top_navbar->name }}</a></li>
                            @endforeach
                        @endif
                        @if( !Auth::check() )
                            <li class="nav-item auth-menu"> <a href="{{url('/login')}}" class="nav-link">@lang('message.home.title-bar.login')</a></li>
                            <li class="nav-item auth-menu"> <a href="{{url('/register')}}" class="nav-link">@lang('message.home.title-bar.register')</a></li>
                        @else
                            <li class="nav-item auth-menu"> <a href="{{url('/dashboard')}}" class="nav-link">@lang('message.home.title-bar.dashboard')</a> </li>
                            <li class="nav-item auth-menu"> <a href="{{url('/logout')}}" class="nav-link">@lang('message.home.title-bar.logout')</a> </li>
                        @endif
                        <li class="nav-item">
                            <div class="lang-select-wrap nav-link auth-menu">
                                <form>
                                    <select class="form-control" id="lang">
                                        @foreach (getLanguagesListAtFooterFrontEnd() as $lang)
                                            <option {{ Session::get('dflt_lang') == $lang->short_name ? 'selected' : '' }} value='{{ $lang->short_name }}'> {{ $lang->short_name }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            @endif

            <div id="quick-contact" class="collapse navbar-collapse">
                <ul class="ml-auto">
                    @if( !Auth::check())
                        @if (request()->path() == 'merchant/payment')
                            {{-- @php
                                $grandId = $_GET['grant_id'];
                                $urlToken = $_GET['token'];
                            @endphp
                            <li> <a href="{{ url("merchant/payment?grant_id=$grandId&token=$urlToken") }}">@lang('message.home.title-bar.login')</a> </li> --}}
                        @else
                            <li> <a href="{{url('/login')}}">@lang('message.home.title-bar.login')</a> </li>
                            <li> <a href="{{url('/register')}}">@lang('message.home.title-bar.register')</a> </li>
                        @endif
                    @else
                        <li><a href="{{url('/dashboard')}}">@lang('message.home.title-bar.dashboard')</a> </li>
                        <li><a href="{{url('/logout')}}">@lang('message.home.title-bar.logout')</a> </li>
                    @endif
                </ul>
            </div>
            <div class="lang-select-wrap collapse navbar-collapse">
                <form>
                    <select class="form-control" id="lang">
                        @foreach (getLanguagesListAtFooterFrontEnd() as $lang)
                            <option {{ Session::get('dflt_lang') == $lang->short_name ? 'selected' : '' }} value='{{ $lang->short_name }}'> {{ $lang->short_name }}</option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>
    </nav>
</header>