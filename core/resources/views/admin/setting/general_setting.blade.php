@extends('admin.layouts.app')

@section('panel')
<div class="row mb-30">
<div class="col-lg-12 col-md-12 mb-30">
<div class="card">
    <div class="card-body">
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group ">
                        <label class="form-control-label font-weight-bold"> @lang('Site Title') </label>
                        <input class="form-control form-control-lg" type="text" name="sitename" value="{{$general->sitename}}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group ">
                        <label class="form-control-label font-weight-bold">@lang('Currency')</label>
                        <input class="form-control  form-control-lg" type="text" name="cur_text"
                               value="{{$general->cur_text}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        <label class="form-control-label font-weight-bold">@lang('Currency Symbol')</label>
                        <input class="form-control  form-control-lg" type="text" name="cur_sym" value="{{$general->cur_sym}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group ">
                        <label class="form-control-label font-weight-bold">@lang('Secondary Currency')</label>
                        <input class="form-control  form-control-lg" type="text" name="sec_cur_text"
                               value="{{$general->sec_cur_text}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group ">
                        <label class="form-control-label font-weight-bold">@lang('Secondary Currency Symbol')</label>
                        <input class="form-control  form-control-lg" type="text" name="sec_cur_sym"
                               value="{{$general->sec_cur_sym}}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group ">
                        <label class="form-control-label font-weight-bold">@lang('Balance Transfer Carge') (@lang('Fixed'))</label>
                        <div class="input-group">
                            <input class="form-control  form-control-lg" type="text" name="bal_trans_fixed_charge" value="{{getAmount($general->bal_trans_fixed_charge)}}">
                            <div class="input-group-append">
                                <span class="input-group-text">{{ $general->cur_text }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        <label class="form-control-label font-weight-bold">@lang('Balance Transfer Carge') (@lang('Percent'))</label>
                        <div class="input-group">
                            <input class="form-control  form-control-lg" type="text" name="bal_trans_per_charge" value="{{getAmount($general->bal_trans_per_charge)}}">
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="col-md-4">
                    <div class="form-group ">
                        <label class="form-control-label font-weight-bold">@lang('Free Coin Limit')</label>
                        <div class="input-group">
                            <input class="form-control  form-control-lg" type="text" name="coin_limit" value="{{getAmount($general->coin_limit)}}">
                            <div class="input-group-append">
                                <span class="input-group-text">USDT</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        <label class="form-control-label font-weight-bold">@lang('Free Coin Commission')</label>
                        <div class="input-group">
                            <input class="form-control  form-control-lg" type="text" name="coin_commission" value="{{getAmount($general->coin_commission)}}">
                            <div class="input-group-append">
                                <span class="input-group-text">USDT</span>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="col-md-4">
                    <div class="form-group ">
                        <label class="form-control-label font-weight-bold">@lang('Free Coin Daily')</label>
                        <div class="input-group">
                            <input class="form-control  form-control-lg" type="text" name="coin_daily" value="{{getAmount($general->coin_daily)}}">
                            <div class="input-group-append">
                                <span class="input-group-text">USDT</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        <label class="form-control-label font-weight-bold">@lang('Free Coin Multiple')</label>
                        <div class="input-group">
                            <input class="form-control  form-control-lg" type="text" name="coin_multiple" value="{{getAmount($general->coin_multiple)}}">
                            <div class="input-group-append">
                                <span class="input-group-text">USDT</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label class="form-control-label font-weight-bold">@lang('Site Base Color')</label>
                    <div class="input-group">
                    <span class="input-group-addon ">
                        <input type='text' class="form-control  form-control-lg colorPicker"
                               value="{{$general->base_color}}"/>
                    </span>
                        <input type="text" class="form-control form-control-lg colorCode" name="base_color"
                               value="{{ $general->base_color }}"/>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label class="form-control-label font-weight-bold"> @lang('Site Secondary Color')</label>
                    <div class="input-group">
                    <span class="input-group-addon">
                        <input type='text' class="form-control form-control-lg colorPicker" value="{{$general->secondary_color}}"/>
                    </span>
                        <input type="text" class="form-control form-control-lg colorCode" name="secondary_color" value="{{ $general->secondary_color }}"/>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-control-label font-weight-bold">@lang('User Registration')</label>
                        <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Enable')" data-off="@lang('Disabled')" name="registration" @if($general->registration) checked @endif>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-control-label font-weight-bold">@lang('Force Secure Password')</label>
                        <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Enable')" data-off="@lang('Disabled')" name="secure_password" @if($general->secure_password) checked @endif>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-control-label font-weight-bold">@lang('Force SSL')</label>
                        <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Enable')" data-off="@lang('Disabled')" name="force_ssl" @if($general->force_ssl) checked @endif>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-control-label font-weight-bold">@lang('Agree Policy on Registration')</label>
                        <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Enable')" data-off="@lang('Disabled')" name="agree_policy" @if($general->agree_policy) checked @endif>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-lg-3 col-sm-6 col-md-4">
                    <label class="form-control-label font-weight-bold">@lang('Email Verification')</label>
                    <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Enable')" data-off="Disable" name="ev" @if($general->ev) checked @endif>
                </div>
                <div class="form-group col-lg-3 col-sm-6 col-md-4">
                    <label class="form-control-label font-weight-bold">@lang('Email Notification')</label>
                    <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Enable')" data-off="Disable" name="en" @if($general->en) checked @endif>
                </div>
                <div class="form-group col-lg-3 col-sm-6 col-md-4">
                    <label class="form-control-label font-weight-bold">@lang('SMS Verification')</label>
                    <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Enable')" data-off="Disable" name="sv" @if($general->sv) checked @endif>
                </div>
                <div class="form-group col-lg-3 col-sm-6 col-md-4">
                    <label class="form-control-label font-weight-bold">@lang('SMS Notification')</label>
                    <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Enable')" data-off="Disable" name="sn" @if($general->sn) checked @endif>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-3 col-sm-6 col-md-4">
                    <label class="form-control-label font-weight-bold">@lang('Crypto Widget')</label>
                    <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Enable')" data-off="Disable" name="cryp_widget" @if($general->cryp_widget) checked @endif>
                </div>
                <div class="form-group col-lg-3 col-sm-6 col-md-4">
                    <label class="form-control-label font-weight-bold">@lang('Crypto Calculator')</label>
                    <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Enable')" data-off="Disable" name="cryp_calculator" @if($general->cryp_calculator) checked @endif>
                </div>
                <div class="form-group col-lg-3 col-sm-6 col-md-4">
                    <label class="form-control-label font-weight-bold">@lang('Profit')</label>
                    <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Enable')" data-off="Disable" name="profit" @if($general->profit_status) checked @endif>
                </div>
                <div class="form-group col-lg-3 col-sm-6 col-md-4">
                    <label class="form-control-label font-weight-bold">@lang('Reward')</label>
                    <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Enable')" data-off="Disable" name="reward" @if($general->reward_status) checked @endif>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn--primary btn-block btn-lg">@lang('Update')</button>
            </div>
        </form>
    </div>
</div>
</div>
</div>
@endsection

@push('script-lib')
<script src="{{ asset('assets/admin/js/spectrum.js') }}"></script>
@endpush

@push('style-lib')
<link rel="stylesheet" href="{{ asset('assets/admin/css/spectrum.css') }}">
@endpush
@push('style')
<style>
.sp-replacer {
padding: 0;
border: 1px solid rgba(0, 0, 0, .125);
border-radius: 5px 0 0 5px;
border-right: none;
}

.sp-preview {
width: 100px;
height: 46px;
border: 0;
}

.sp-preview-inner {
width: 110px;
}

.sp-dd {
display: none;
}
</style>
@endpush

@push('script')
<script>
'use strict';
(function($){
$('.colorPicker').spectrum({
    color: $(this).data('color'),
    change: function (color) {
        $(this).parent().siblings('.colorCode').val(color.toHexString().replace(/^#?/, ''));
    }
});

$('.colorCode').on('input', function () {
    var clr = $(this).val();
    $(this).parents('.input-group').find('.colorPicker').spectrum({
        color: clr,
    });
});
})(jQuery)

</script>
@endpush

