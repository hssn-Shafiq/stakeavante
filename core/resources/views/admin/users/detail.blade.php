@extends('admin.layouts.app')

@section('panel')
    <div class="row mb-none-30">

        <div class="col-xl-3 col-lg-5 col-md-5 mb-30">

            <div class="card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-body p-0">
                    <div class="p-3 bg--white">
                        <div class="">
                            <img src="{{ getImage('assets/images/user/profile/'. $user->image, null, true)}}" alt="@lang('profile-image')"
                                 class="b-radius--10 w-100">
                        </div>
                        <div class="mt-15">
                            <h4 class="">{{$user->fullname}}</h4>
                            <span class="text--small">@lang('Joined At ')<strong>{{showDateTime($user->created_at,'d M, Y h:i A')}}</strong></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card b-radius--10 overflow-hidden mt-30 box--shadow1">
                <div class="card-body">
                    <h5 class="mb-20 text-muted">@lang('User information')</h5>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Username')
                            <span class="font-weight-bold">{{$user->username}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          @lang('Added By')
                            <span class="font-weight-bold"> {{$added_id->username ?? 'N/A'}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          @lang('Tree Head')
                            <span class="font-weight-bold"> {{$ref_id->username ?? 'N/A'}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          @lang('Payment')
                            @switch($user->plan_id)
                                @case(1)
                                <span class="badge badge-pill bg--success">@lang('Paid')</span>
                                @break
                                @case(0)
                                <span class="badge badge-pill bg--danger">@lang('Unpaid')</span>
                                @break
                            @endswitch
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Balance')
                            <span class="font-weight-bold"> {{getAmount($user->balance)}}  {{$general->cur_text}} </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('User Plan')
                            <span class="font-weight-bold">
                                @if($user->plan_type==1)
                                @lang('12 Month')
                                @elseif($user->plan_type==0)
                                @lang('1 Month')
                                @else
                                @lang('No Plan')
                                @endif
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Status')
                            @switch($user->status)
                                @case(1)
                                <span class="badge badge-pill bg--success">@lang('Active')</span>
                                @break
                                @case(2)
                                <span class="badge badge-pill bg--danger">@lang('Banned')</span>
                                @break
                            @endswitch
                        </li>

                    </ul>
                </div>
            </div>
            @if(auth('admin')->user()->access==1)
            <div class="card b-radius--10 overflow-hidden mt-30 box--shadow1">
                <div class="card-body">
                    <h5 class="mb-20 text-muted">@lang('User action')</h5>
                    <a href="{{route('admin.users.login',$user->id)}}" target="_blank" class="btn btn--dark btn--shadow btn-block btn-lg">
                        <i class="las la-sign-in-alt"></i>@lang('Login as User')
                    </a>

                    <a data-toggle="modal" href="#addSubModal" class="btn btn--success btn--shadow btn-block btn-lg">
                        @lang('Add/Subtract Balance')
                    </a>
                    <a href="{{ route('admin.users.login.history.single', $user->id) }}"
                       class="btn btn--primary btn--shadow btn-block btn-lg">
                        @lang('Login Logs')
                    </a>
                    <a href="{{route('admin.users.email.single',$user->id)}}"
                       class="btn btn--danger btn--shadow btn-block btn-lg">
                        @lang('Send Email')
                    </a>
                    <a href="{{route('admin.users.single.tree',$user->username)}}"
                       class="btn btn--primary btn--shadow btn-block btn-lg">
                       @lang('User Tree')
                    </a>
                    <a href="{{route('admin.users.ref',$user->id)}}"
                       class="btn btn--info btn--shadow btn-block btn-lg">
                        @lang('User Referrals')
                    </a>
                </div>
            </div>
            @endif
        </div>

        <div class="col-xl-9 col-lg-7 col-md-7 mb-30">
            <div class="row mb-none-30">
                <div class="col-xl-4 col-lg-6 col-sm-6 mb-30">
                    <div class="dashboard-w1 bg--success b-radius--10 box-shadow has--link">
                        <a  class="item--link"></a>
                        <div class="icon">
                            <i class="fa fa-credit-card"></i>
                        </div>
                        <div class="details">
                            <div class="numbers">
                                <span class="amount">{{getAmount($user->balance)}}</span>
                                <span class="currency-sign">{{$general->cur_text}}</span>
                            </div>
                            <div class="desciption">
                                <span>@lang('Current Balance')</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-sm-6 mb-30">
                    <div class="dashboard-w1 bg--10 b-radius--10 box-shadow has--link">
                        <a href="{{route('admin.users.transactions',$user->id)}}" class="item--link"></a>
                        <div class="icon">
                            <i class="fa fa-credit-card"></i>
                        </div>
                        <div class="details">
                            <div class="numbers">
                                <span class="amount">{{getAmount($user->total_invest)}}</span>
                                <span class="currency-sign">{{$general->cur_text}}</span>
                            </div>
                            <div class="desciption">
                                <span>@lang('Total Invest')</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-sm-6 mb-30">
                    <div class="dashboard-w1 bg--warning b-radius--10 box-shadow has--link">
                        <a href="{{route('admin.users.transactions',$user->id)}}" class="item--link"></a>
                        <div class="icon">
                            <i class="fa fa-credit-card"></i>
                        </div>
                        <div class="details">
                            <div class="numbers">
                                <span class="amount">{{getAmount($user->total_sale)}}</span>
                                <span class="currency-sign">{{$general->cur_text}}</span>
                            </div>
                            <div class="desciption">
                                <span>@lang('Total sale')</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-sm-6 mb-30">
                    <div class="dashboard-w1 bg--primary b-radius--10 box-shadow has--link">
                        <a href="{{route('admin.users.deposits',$user->id)}}" class="item--link"></a>
                        <div class="icon">
                            <i class="fa fa-credit-card"></i>
                        </div>
                        <div class="details">
                            <div class="numbers">
                                <span class="amount">{{getAmount($totalDeposit)}}</span>
                                <span class="currency-sign">{{$general->cur_text}}</span>
                            </div>
                            <div class="desciption">
                                <span>@lang('Total Deposit')</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-sm-6 mb-30">
                    <div class="dashboard-w1 bg--red b-radius--10 box-shadow has--link">
                        <a href="{{route('admin.users.withdrawals',$user->id)}}" class="item--link"></a>
                        <div class="icon">
                            <i class="fa fa-wallet"></i>
                        </div>
                        <div class="details">
                            <div class="numbers">
                                <span class="amount">{{getAmount($totalWithdraw)}}</span>
                                <span class="currency-sign">{{$general->cur_text}}</span>
                            </div>
                            <div class="desciption">
                                <span>@lang('Total Withdraw')</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- dashboard-w1 end -->

                <div class="col-xl-4 col-lg-6 col-sm-6 mb-30">
                    <div class="dashboard-w1 bg--dark b-radius--10 box-shadow has--link">
                        <a href="{{route('admin.users.transactions',$user->id)}}" class="item--link"></a>
                        <div class="icon">
                            <i class="la la-exchange-alt"></i>
                        </div>
                        <div class="details">
                            <div class="numbers">
                                <span class="amount">{{getAmount($user->free_coins)}}</span>
                            </div>
                            <div class="desciption">
                                <span>@lang('Total Free Coins')</span>
                            </div>
                        </div>
                    </div>
                </div><!-- dashboard-w1 end -->


                <div class="col-xl-4 col-lg-6 col-sm-6 mb-30">
                    <div class="dashboard-w1 bg--info b-radius--10 box-shadow has--link">
                        <a href="{{route('admin.report.invest')}}?user={{$user->id}}" class="item--link"></a>
                        <div class="icon">
                            <i class="la la-money"></i>
                        </div>
                        <div class="details">
                            <div class="numbers">
                                <span class="amount">{{getAmount($user->total_invest)}}</span>
                                <span class="currency-sign">{{$general->cur_text}}</span>
                            </div>
                            <div class="desciption">
                                <span>@lang('Total Invest')</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6 col-sm-6 mb-30">
                    <div class="dashboard-w1 bg--indigo b-radius--10 box-shadow has--link">
                        <a href="{{route('admin.report.binarySummery')}}?userID={{$user->id}}" class="item--link"></a>
                        <div class="icon">
                            <i class="la la-user"></i>
                        </div>
                        <div class="details">
                            <div class="numbers">
                                <span class="amount">{{$totalTreeUsers}}</span>
                            </div>
                            <div class="desciption">
                                <span>@lang('Total Tree Users')</span>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-4 col-lg-6 col-sm-6 mb-30">
                    <div class="dashboard-w1 bg--10 b-radius--10 box-shadow has--link">
                        <a href="{{route('admin.report.binaryCom')}}?userID={{$user->id}}" class="item--link"></a>
                        <div class="icon">
                            <i class="la la-tree"></i>
                        </div>
                        <div class="details">
                            <div class="numbers">
                                <span class="amount">{{getAmount($user->total_binary_com)}}</span>
                                <span class="currency-sign">{{$general->cur_text}}</span>
                            </div>
                            <div class="desciption">
                                <span>@lang('Total Tree Commission')</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card mt-50">
                <div class="card-body">
                    <h5 class="card-title mb-50 border-bottom pb-2">@lang('Information')</h5>

                    <form action="{{route('admin.users.update',[$user->id])}}" method="POST"
                          enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('First Name')<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="firstname"
                                           value="{{$user->firstname}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label  font-weight-bold">@lang('Last Name') <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="lastname" value="{{$user->lastname}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Email') <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="email" name="email" value="{{$user->email}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label  font-weight-bold">@lang('Mobile Number') <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="mobile" value="{{$user->mobile}}">
                                </div>
                            </div>
                        </div>


                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Address') </label>
                                    <input class="form-control" type="text" name="address"
                                           value="{{$user->address->address}}">
                                    <small class="form-text text-muted"><i class="las la-info-circle"></i> @lang('House number, street address')
                                    </small>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label font-weight-bold">@lang('City') </label>
                                    <input class="form-control" type="text" name="city"
                                           value="{{$user->address->city}}">
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('State') </label>
                                    <input class="form-control" type="text" name="state"
                                           value="{{$user->address->state}}">
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Zip/Postal') </label>
                                    <input class="form-control" type="text" name="zip"
                                           value="{{$user->address->zip}}">
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Country') </label>
                                    <select name="country" class="form-control"> @include('partials.country') </select>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group col-xl-4 col-md-6  col-sm-3 col-12">
                                <label class="form-control-label font-weight-bold">@lang('Status') </label>
                                <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                       data-toggle="toggle" data-on="Active" data-off="Banned" data-width="100%"
                                       name="status"
                                       @if($user->status) checked @endif>
                            </div>

                            <div class="form-group  col-xl-4 col-md-6  col-sm-3 col-12">
                                <label class="form-control-label font-weight-bold">@lang('Email Verification') </label>
                                <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                       data-toggle="toggle" data-on="Verified" data-off="Unverified" name="ev"
                                       @if($user->ev) checked @endif>

                            </div>

                            <div class="form-group  col-xl-4 col-md-6  col-sm-3 col-12">
                                <label class="form-control-label font-weight-bold">@lang('SMS Verification') </label>
                                <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                       data-toggle="toggle" data-on="Verified" data-off="Unverified" name="sv"
                                       @if($user->sv) checked @endif>

                            </div>
                            <div class="form-group  col-md-6  col-sm-3 col-12">
                                <label class="form-control-label font-weight-bold">@lang('2FA Status') </label>
                                <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                       data-toggle="toggle" data-on="Active" data-off="Deactive" name="ts"
                                       @if($user->ts) checked @endif>
                            </div>

                            <div class="form-group  col-md-6  col-sm-3 col-12">
                                <label class="form-control-label font-weight-bold">@lang('2FA Verification') </label>
                                <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                       data-toggle="toggle" data-on="Verified" data-off="Unverified" name="tv"
                                       @if($user->tv) checked @endif>
                            </div>
                        </div>


                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    @if(auth('admin')->user()->access==1)
                                    <button type="submit" class="btn btn--primary btn-block btn-lg">@lang('Save Changes')
                                    </button>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@if(auth('admin')->user()->access==1)
    {{-- Add Sub Balance MODAL --}}
    <div id="addSubModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Add / Subtract Balance')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('admin.users.addSubBalance', $user->id)}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="checkbox" data-width="100%" data-height="44px" data-onstyle="-success"
                                       data-offstyle="-danger" data-toggle="toggle" data-on="Add Balance"
                                       data-off="Subtract Balance" name="act" checked>
                            </div>


                            <div class="form-group col-md-12">
                                <label>@lang('Amount')<span class="text-danger">*</span></label>
                                <div class="input-group has_append">
                                    <input type="text" name="amount" class="form-control"
                                           placeholder="Please provide positive amount">
                                    <div class="input-group-append">
                                        <div class="input-group-text">{{ $general->cur_text }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--success">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif

@endsection

@push('script')
    <script>
        'use strict';
        (function($){
            $("select[name=country]").val("{{ @$user->address->country }}");
        })(jQuery)
    </script>
@endpush
