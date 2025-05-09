@extends($activeTemplate.'layouts.master')
@section('content')
@php
    $banner = getContent('banner.content', true);
@endphp
    <div class="wrapper">
      <div class="container">
        <div class="row">
          <!-- 
    ===============================================
                   HERO SECTION
    ===============================================
    -->
          <div class="col-lg-7 col-12">
            <div class="hero-content">
              <div class="animate__animated animate__fadeInLeft">
                <h1 class="hero-heading">
                  {{__(@$banner->data_values->heading)}}  
                  <span class="colored-text">{{__(@$banner->data_values->subheading)}}</span>
                </h1>
              </div>
              <div>
                <p class="hero-text">{{__(@$banner->data_values->description)}}</p>
              </div>
              <div class="py-md-5 py-2 d-flex gap-3">
                <a href="{{__(@$banner->data_values->left_button_link)}}" class="text-decoration-none">
                  <button type="button" class="btn btn-primary">
                    {{__(@$banner->data_values->left_button)}}
                    <i class="fa-solid fa-arrow-right"></i>
                  </button>
                </a>
                <a href="{{__(@$banner->data_values->right_button_link)}}" class="text-decoration-none">
                  <button type="button" class="btn btn-outline-light">
                    {{__(@$banner->data_values->right_button)}}
                    <i class="fa-solid fa-arrow-right"></i>
                  </button>
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-5 col-12 position-relative">
            <div class="hero-wrap d-md-block d-none">
              <div class="hero-img">
                <img src="assets/images/logoIcon/logo.png"  alt="@lang('banner')" class="img-fluid">
              </div>
              <div class="shape"></div>
            </div>
          </div>
          <!-- 
    ===============================================
                   HERO SECTION ENDS
    ===============================================
    -->
    @if($sections->secs != null)
                @foreach(json_decode($sections->secs) as $sec)
                    @include($activeTemplate.'sections.'.$sec)
                @endforeach
            @endif
        </div>
      </div>
    </div>
@endsection