@extends($activeTemplate.'layouts.app2')

@section('panel')
<!-- Account Section -->
<div class="account-section">
    <div class="account__section-wrapper">
        <div class="account__section-content">
            <div class="w-100">
                <div class="logo mb-5">
                    <a href="{{route('home')}}">
                        <img src="{{getImage(imagePath()['logoIcon']['path'] .'/darkLogo.png')}}"  alt="@lang('site-logo')">
                    </a>
                </div>
                <div class="section__header text-white">
                    <h6 class="section__title mb-0 text-white">@lang('Verify your email to get access')</h6>
                    <p class="mt-3">@lang('Your Email:') <strong>{{auth()->user()->email}}</strong></p>
                </div>
                <form class="account--form row g-4" method="post" action="{{ route('user.verify_email') }}">
                    @csrf

                    <div class="col-sm-12">
                        <label for="code" class="form--label-2">@lang('Verification Code')</label>
                        <input type="text" name="code" id="code" placeholder="@lang('Code')" class="form-control form--control-2">
                    </div>

                    <div class="col-sm-12">
                        <button type="submit" class="cmn--btn w-100">@lang('Submit')</button>
                    </div>
                </form>
                <div class="mt-4 text--white">
                    @lang('Please check including your Junk/Spam Folder. if not found, you can')
                        <a href="{{route('user.send_verify_code')}}?type=email" class="text--base">
                            @lang('Resend code')
                        </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Account Section -->
@endsection
