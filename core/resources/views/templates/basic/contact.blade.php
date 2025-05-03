@extends($activeTemplate.'layouts.master')

@section('content')
<!-- Contact -->
<div class="wrapper">
      <div class="container">
        <div class="row">
          <div class="col-lg-5 align-self-center">
            <div class="adress-wrapper">
              <div class="main-head">
                <h1>{{ __(@$contact->data_values->title) }}</h1>
              </div>
              <div class="about-address">
                <p>
                  {{ __(@$contact->data_values->short_details) }}
                </p>
              </div>
              <div class="sub-head">
                <h4>@lang('More Information')</h4>
              </div>
              <div class="row">
                <div class="col-2 mb-3" style="width: fit-content">
                  <div class="address-icon">
                    <i class="fa-solid fa-location-dot"></i>
                  </div>
                </div>
                <div class="col-10 mb-3">
                  <div class="address-values">
                    <div class="label">@lang('Address')</div>
                    <div class="label-value">{{@$contact->data_values->contact_details}}</div>
                  </div>
                </div>
                <div class="col-2 mb-3" style="width: fit-content">
                  <div class="address-icon">
                    <i class="fa-solid fa-envelope"></i>
                  </div>
                </div>
                <div class="col-10 mb-3">
                  <div class="address-values">
                    <div class="label">@lang('Email')</div>
                    <div class="label-value">{{@$contact->data_values->email_address}}</div>
                  </div>
                </div>
                <div class="col-2 mb-3" style="width: fit-content">
                  <div class="address-icon">
                    <i class="fa-solid fa-phone"></i>
                  </div>
                </div>
                <div class="col-10 mb-3">
                  <div class="address-values">
                    <div class="label">@lang('Phone')</div>
                    <div class="label-value">
                     <a href="tel:{{@$contact->data_values->contact_number}}">
                                        {{@$contact->data_values->contact_number}}
                                    </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-7">
            <div class="form-wrapper text-white">
              <div class="form-heading">
                <h1>@lang('Contact US')</h1>
              </div>
              <form class="row g-4 contact-form" method="post" action="">
                @csrf
                <div class="col-md-6">
                  <label for="name" class="form-label mb-3">@lang('Name')</label>
                  <input type="text" name="name" value="{{old('name')}}" class="form-control form--control" placeholder="@lang('Your Name')" id="name" required>
                </div>
                <div class="col-md-6">
                  <label for="email" class="form-label mb-3">@lang('Email US')</label>
                   <input type="email" name="email"  value="{{old('email')}}" id="email" placeholder="@lang('Enter E-Mail Address')" required class="form-control form--control">
                </div>
                <div class="col-12">
                  <label for="subject" class="form-label mb-3">@lang('Subject')</label>
                  <input type="text" name="subject" placeholder="@lang('Write your subject')" value="{{old('subject')}}" id="subject" required class="form-control form--control">
                </div>
                <div class="col-12">
                  <label for="floatingTextarea2" class="form-label mb-3"
                    >@lang('Message')</label
                  >
                   <textarea name="message" id="message" class="form-control form--control" placeholder="@lang('Write your message')">{{old('message')}}</textarea>
                </div>

                        @php
                            $reCpatcha = reCaptcha();
                        @endphp

                        @if($reCpatcha)
                            <div class="col-lg-12">
                                <div class="form-group preview">
                                    @php echo $reCpatcha @endphp
                                </div>
                            </div>
                        @endif
                        <div class="col-lg-12">
                            @include($activeTemplate.'partials.custom-captcha')
                        </div>

                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary">@lang('Send Message')</button>
                        </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
<!-- Contact -->

    @if($sections->secs != null)
        @foreach(json_decode($sections->secs) as $sec)
            @include($activeTemplate.'sections.'.$sec)
        @endforeach
    @endif
@endsection
