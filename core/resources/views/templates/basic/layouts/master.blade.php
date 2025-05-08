@extends($activeTemplate.'layouts.app')
@php
    $topMenu=\App\Models\Menu::getAllMenus('Top');
$bottomMenu=\App\Models\Menu::getAllMenus('Bottom');
@endphp
@section('panel')
    <!-- 
    ===============================================
                   TOP HEADER
    ===============================================
    -->
    @if(crypt_widget()==1)
    <header class="top-header">
      <div class="container">
     <script type="text/javascript" src="https://files.coinmarketcap.com/static/widget/coinMarquee.js"></script><div id="coinmarketcap-widget-marquee" coins="25923,1,1027,825,1839" currency="PKR" theme="dark" transparent="true" show-symbol-logo="true"></div>
      </div>
    </header>
    @endif
    <!-- 
    ===============================================
                   TOP HEADER ENDS
    ===============================================
    -->
    <!-- Header -->
    <!--
    ===============================================
                   NAVIGATION
    ===============================================
    -->
    <nav class="navbar navbar-expand-lg bg-transparent sticky-top">
      <div class="container">
        <a class="navbar-brand" href="{{route('home')}}">
          <img src="{{getImage(imagePath()['logoIcon']['path'] .'/mainlogo.png')}}" alt="@lang('site-logo')" width="60" height="auto" />
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav mx-auto gap-4">
            @if($topMenu)
            @foreach($topMenu as $top)
            @if($top->children_count > 0)
             <li class="nav-item dropdown">
              <a
                class="nav-link text-white"
                href="#"
                id="navbarDropdownMenuLink"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >{{$top->name}}</a>
              <ul
                class="dropdown-menu"
                aria-labelledby="navbarDropdownMenuLink"
              >
               @foreach($top->children as $child)
                <li><a class="dropdown-item" href="{{$child->link}}">{{$child->name}}</a></li>
               @endforeach
              </ul>
            </li>
            @else
            <li class="nav-item">
              <a
                class="nav-link active text-white"
                aria-current="page"
                href="{{$top->link}}"
                >{{$top->name}}</a
              >
            </li>
            @endif
            @endforeach
            @endif
          </ul>
          @auth
          <div>
              <a href="{{route('user.home')}}">
                <button type="button" class="btn text-white">@lang('Dashboard')</button>
              </a>
          </div>
          <div>
              <a href="{{route('user.logout')}}">
                <button type="button" class="btn text-white">@lang('Logout')</button>
              </a>
          </div>
        @else
          <div>
              <a href="{{route('user.login')}}">
                <button type="button" class="btn text-white">@lang('Sign In')</button>
              </a>
          </div>
          <div>
              <a href="{{route('user.register')}}">
                <button type="button" class="btn text-white">@lang('Sign Up')</button>
              </a>
          </div>
           @endauth
        </div>
      </div>
    </nav>
    <!-- 
    ===============================================
                   NAVIGATION ENDS
    ===============================================
    Header -->
    @yield('content')
<!-- 
    ===============================================
                 FOOTER
    ===============================================
    -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-12 text-center">
            <hr class="my-5" />
            <div
              class="d-flex align-items-center justify-content-md-center justify-content-between gap-md-3 mb-3"
            >
            @if($bottomMenu)
            @foreach($bottomMenu as $key  => $bottom)
              <a
                href="{{$bottom->link}}"
                class="text-capitalize text-white text-decoration-none"
                >{{$bottom->name}}</a
              >
              @if(($key+1) != count($bottomMenu))
              <hr
                style="
                  opacity: 1;
                  border: 1px solid rgb(112, 97, 97);
                  height: 15px;
                "
              />
              @endif
            @endforeach
            @endif
            </div>
            <div
              class="d-flex align-items-center justify-content-md-center justify-content-between gap-md-3 mb-5"
            >
              <span class="text-white">{{__(@$footer->data_values->copyright)}}</span>
              <hr
                style="
                  opacity: 1;
                  border: 1px solid rgb(112, 97, 97);
                  height: 15px;
                "
              />
               @foreach($socials as $social)
                <a href="{{@$social->data_values->url}}" target="_blank" class="social-link"
                  title="{{@$social->data_values->title}}">@php echo @$social->data_values->social_icon; @endphp</a>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- 
    ===============================================
                 FOOTER ENDS
    ===============================================
    -->
@endsection
