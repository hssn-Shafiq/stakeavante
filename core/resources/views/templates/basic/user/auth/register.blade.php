@extends($activeTemplate.'layouts.app2')
@section('panel')
@php
$policyElements =  getContent('policy_pages.element');
@endphp
<!-- Account Section -->
<div class="account-section ">
    <div class="account__section-wrapper">
        <div class="account__section-content sign-up">
            <div class="w-100">
                <div class="logo mb-4">
                    <a href="{{route('home')}}">
                        <img src="{{getImage(imagePath()['logoIcon']['path'] .'/darkmainlogo.png')}}" alt="@lang('site-logo')">
                    </a>
                </div>
                <div class="section__header  mb-4">
                    <h5 class="section__title mb-0 ">@lang('Sign Up')</h5>
                </div>
                <form class="account--form row gy-3" method="post" action="{{route('user.register')}}" onsubmit="return submitUserForm();">
                    @csrf
            @if(session()->get('sponsor') != null)
            <div class="col-sm-6">
                <label for="reg_name" class="form--label-2">@lang('Referal User ID')</label>
                <input type="text" name="registrant" class="referral form-control form--control-2 check_referal" id="reg_name" value="{{$sponsorId->username}}" placeholder="@lang('Enter Referal User ID')*" required>
                <p class="referal_msg"></p>
                <span class="text-success">@php echo $addedBy; @endphp</span>
            </div>
            @if(session()->get('position') != null)
            <div class="col-sm-6">
                <label for="ref_name" class="form--label-2">@lang('Network Tree ID')</label>
                <input type="text" name="referral" class="referral form-control form--control-2 check_referal" id="ref_name" value="{{$treeId->username}}" placeholder="@lang('Enter Network Tree ID')*" required>
                <p class="tree_msg"></p>
                <span class="text-success">@php echo $joining; @endphp</span>
            </div>
            @endif
            @endif
            <div class="col-sm-6">
                <label for="firstname" class="form--label-2">@lang('First Name')</label>
                <input type="text" name="firstname" id="firstname" value="{{old('firstname')}}" autocomplete="off" placeholder="@lang('First Name')" required class="form-control form--control-2">
            </div>
            <div class="col-sm-6">
                <label for="lastname" class="form--label-2">@lang('Last Name')</label>
                <input type="text" name="lastname" id="lastname" value="{{old('lastname')}}" placeholder="@lang('Last Name')" required class="form-control form--control-2">
            </div>
            <div class="col-sm-6">
                <label for="email" class="form--label-2">@lang('Email')</label>
                <input type="email" name="email" id="email" value="{{old('email')}}" placeholder="@lang('Email')" required class="form-control form--control-2">
            </div>
            <div class="col-sm-6">
                <label for="email" class="form--label-2">@lang('Phone Number')</label>
                <div class="input-group input-group-custom">
                    <div class="input-group-prepend">
                        <select name="country_code" class="input-group-text form-control form--control-2">
                            @include('partials.country_code')
                        </select>
                    </div>
                    <input type="text" class="form-control form--control-2" name="mobile" placeholder="@lang('Phone Number')" required>
                </div>
            </div>
            <div class="col-sm-6 hover-input-popup">
                <label for="password" class="form--label-2">@lang('Password')</label>
                <input type="password" id="password" name="password" placeholder="@lang('Password')" class="form-control form--control-2">
                @if($general->secure_password)
                <div class="input-popup">
                    <p class="text-danger my-1 capital">@lang('At least 1 capital letter is required')</p>
                    <p class="text-danger my-1 number">@lang('At least 1 number is required')</p>
                    <p class="text-danger my-1 special">@lang('At least 1 special character is required')</p>
                </div>
                @endif
            </div>
            <div class="col-sm-6">
                <label for="password_confirmation" class="form--label-2">@lang('Confirm Password')</label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="@lang('Confirm Password')"  class="form-control form--control-2">
            </div>
            @if(reCaptcha())
                <div class="col-lg-12">
                    @php echo reCaptcha(); @endphp
                </div>
            @endif
            <div class="col-lg-12">
                @include($activeTemplate.'partials.custom-captcha')
            </div>
            @if($general->agree_policy)
                <div class="col-md-12">
                    <div class="d-flex flex-wrap justify-content-between">
                        <div class="checkgroup d-flex flex-wrap align-items-center">
                            <input type="checkbox" class="border-0" id="agree" name="agree">
                            &nbsp;
                            <label for="agree" class="m-0 pl-2 ">@lang('I agree with')&nbsp;</label>
                            @foreach ($policyElements as $item)
                                <a href="{{route('policy.details',[slug(@$item->data_values->title),$item->id])}}" class="text--base"> {{__($item->data_values->title)}} </a> @if(!$loop->last) ,&nbsp; @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-sm-12">
                <button type="submit" class="cmn--btn w-100">@lang('Sign Up')</button>
            </div>
            </form>
            <div class="mt-4 text--white">
                <span class="d-block">
                    @lang('Already Have an Account') ? <a href="{{ route('user.login') }}" class="text--base">@lang('Sign In')</a>
                </span>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Account Section -->
@endsection
@push('script')
<script>
    (function($) {
        "use strict";
        $(document).on('blur', '.check_referal', function() {
            var ref_id = $('#ref_name').val();
            var reg_id = $('#reg_name').val();
            var token = "{{csrf_token()}}";
            $.ajax({
                type: "POST",
                url: "{{route('check.referral')}}",
                data: {
                    'ref_id': ref_id,
                    'reg_id' : reg_id,
                    '_token': token
                },
                success: function(data) {
                    if(data.success && data.field==1){
                        $('.tree_msg').html('');
                        $('.referal_msg').html(data.msg);
                    }
                    else if (data.success && data.field==2) {
                        $('.referal_msg').html();
                        $('.tree_msg').html(data.msg);
                    }
                    else if (data.success==false && data.field==1){
                      $('.tree_msg').html('');
                        $('.referal_msg').html(data.msg);
                    } else if (data.success==false && data.field==2)
                    {
                      $('.referal_msg').html();
                      $('.tree_msg').html(data.msg);
                    }else{
                        alert('Some Error');
                    }
                }
            });
        });
        @if(@$country_code)
        $(`option[data-code={{ $country_code }}]`).attr('selected', '');
        @endif
        $('select[name=country_code]').change(function() {
            $('input[name=country]').val($('select[name=country_code] :selected').data('country'));
        }).change();
        function submitUserForm() {
            var response = grecaptcha.getResponse();
            if (response.length == 0) {
                document.getElementById('g-recaptcha-error').innerHTML = '<span style="color:red;">@lang("Captcha field is required.")</span>';
                return false;
            }
            return true;
        }
        function verifyCaptcha() {
            document.getElementById('g-recaptcha-error').innerHTML = '';
        }
        @if($general -> secure_password)
        $('input[name=password]').on('input', function() {
            var password = $(this).val();
            var capital = /[ABCDEFGHIJKLMNOPQRSTUVWXYZ]/;
            var capital = capital.test(password);
            if (!capital) {
                $('.capital').removeClass('text--success');
            } else {
                $('.capital').addClass('text--success');
            }
            var number = /[123456790]/;
            var number = number.test(password);
            if (!number) {
                $('.number').removeClass('text--success');
            } else {
                $('.number').addClass('text--success');
            }
            var special = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
            var special = special.test(password);
            if (!special) {
                $('.special').removeClass('text--success');
            } else {
                $('.special').addClass('text--success');
            }
        });
        @endif
    })(jQuery);
</script>
@endpush
@push('style')
<style>
    .form-control:disabled,
    .form-control[readonly] {
        background-color: transparent !important;
    }
</style>
@endpush