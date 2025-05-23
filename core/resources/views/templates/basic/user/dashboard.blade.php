@extends($activeTemplate . 'user.layouts.app')

@section('panel') <div class="row mb-none-30">
        <div class="col-lg-12">
            <div class="card border--light mb-5">
                @include($activeTemplate . 'user.partials.countdown')
            </div>
        </div>

        @if (auth()->user()->plan_id > 0 && auth()->user()->plan_expiry > \Carbon\Carbon::now())
            @include($activeTemplate . 'user.partials.profit_summary')
        @endif
 
        @if (isUserPiad() == true)
            @if (auth()->user()->reward_one != 0)
                <div class="col-lg-12 col-sm-6 mb-10">
                    <div class="card border--light">
                        <div class="card-body">
                            <div class="bg--white">
                                @if (auth()->user()->reward_one == 1)
                                    <img id="output"
                                        src="{{ getImage('assets/images/user/awards/reward1-main.png', null, true) }}"
                                        alt="@lang('reward-1-image')" class="img-responsive b-radius--10"
                                        title="Team Leader Achieved" style="width:10%;">
                                @endif
                                @if (auth()->user()->reward_two == 1)
                                    <img id="output"
                                        src="{{ getImage('assets/images/user/awards/reward2-main.png', null, true) }}"
                                        alt="@lang('reward-2-image')" class="img-responsive b-radius--10"
                                        title="Region Leader Achieved" style="width:10%;">
                                @endif
                                @if (auth()->user()->reward_three == 1)
                                    <img id="output"
                                        src="{{ getImage('assets/images/user/awards/reward3-main.png', null, true) }}"
                                        alt="@lang('reward-3-image')" class="img-responsive b-radius--10"
                                        title="National Leader Achieved" style="width:10%;">
                                @endif
                                @if (auth()->user()->reward_four == 1)
                                    <img id="output"
                                        src="{{ getImage('assets/images/user/awards/reward4-main.png', null, true) }}"
                                        alt="@lang('reward-4-image')" class="img-responsive b-radius--10"
                                        title="Royal Leader Achieved" style="width:10%;">
                                @endif
                                @if (auth()->user()->reward_five == 1)
                                    <img id="output"
                                        src="{{ getImage('assets/images/user/awards/reward5-main.png', null, true) }}"
                                        alt="@lang('reward-5-image')" class="img-responsive b-radius--10"
                                        title="Crown Leader Achieved" style="width:10%;">
                                @endif
                                @if (auth()->user()->reward_six == 1)
                                    <img id="output"
                                        src="{{ getImage('assets/images/user/awards/reward6-main.png', null, true) }}"
                                        alt="@lang('reward-6-image')" class="img-responsive b-radius--10"
                                        title="Diamond Leader Achieved" style="width:10%;">
                                @endif
                                @if (auth()->user()->reward_seven == 1)
                                    <img id="output"
                                        src="{{ getImage('assets/images/user/awards/reward7-main.png', null, true) }}"
                                        alt="@lang('reward-7-image')" class="img-responsive b-radius--10"
                                        title="The Nobel Leader Achieved" style="width:10%;">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if ($general->notice != null)
                <div class="col-lg-12 col-sm-6 mb-30">
                    <div class="card border--light">
                        <div class="card-header">@lang('Notice Board')
                            @if (auth()->user()->plan_type != 0)
                                <marquee behavior="scroll" direction="left" scrollamount="2">
                                    <h4 class="text-danger" style="font-family:Cursive;">
                                        @if (auth()->user()->plan_id < 1)
                                            @lang('Your Staking plan is expired on '){{ auth()->user()->plan_expiry }}
                                        @else
                                            @lang(' Your Staking will expire on '){{ auth()->user()->plan_expiry }}
                                        @endif
                                    </h4>
                                </marquee>
                            @endif
                        </div>
                        <div class="card-body">
                            <p class="card-text">@php echo $general->notice; @endphp</p>
                        </div>
                    </div>
                </div>
            @endif
        @else
            @if ($general->free_user_notice != null)
                <div class="col-lg-12 col-sm-6 mb-30">
                    <div class="card border--light">
                        @if ($general->notice == null)
                            <div class="card-header">@lang(' Notice')</div>
                        @endif
                        <div class="card-body">
                            <p class="card-text"> @php echo $general->free_user_notice; @endphp </p>
                        </div>
                    </div>
                </div>
            @endif
        @endif
        <div class="col-xl-3 col-lg-3 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--success b-radius--10 box-shadow has--link">
                <div class="icon">
                    <i class="las la-wallet"></i>
                </div>
                <div class="details">
                    <div class="numbers mb-2">
                        @if (isset($daily_profit) && $profit_status == 'pending')
                            <div class=" flex-row align-items-baseline ">
                                <span class="amount">{{ getAmount(auth()->user()->balance + $daily_profit) }}</span>
                                <span class="currency-sign ml-2">{{ $general->cur_text }}</span>
                            </div>
                            <small class="d-block text--xxsmall mt-1 text--white">
                                <i class="las la-info-circle"></i> @lang('Includes expected profit of') +{{ getAmount($daily_profit) }}
                                {{ $general->cur_text }}
                            </small>
                            <span class="badge bg--warning ms-2">
                                <i class="las la-info-circle"></i> @lang('Pending')
                            </span>
                        @else
                            <span class="amount">{{ getAmount(auth()->user()->balance) }}</span>
                        @endif

                    </div>
                    {{-- <div class="desciption mb-1">
                        <span class="text--small">@lang('Current Balance')</span>
                    </div> --}}
                    {{-- @if (isset($daily_profit) && $daily_profit != 'NA')
                        <div class="daily-profit mt-1">
                            <div class="d-flex align-items-center">
                                <span class="badge bg--primary me-1">
                                    <i class="las la-chart-line"></i>
                                </span>
                                <small>
                                    @if ($profit_status == 'credited')
                                        <span class="text-white">@lang('Today\'s Profit:')</span>
                                        <span class="text-white fw-bold">+{{ getAmount($daily_profit) }} {{ $general->cur_text }}</span>
                                    @elseif($profit_status == 'pending')
                                        <span class="text-white">@lang('Expected Profit:')</span>
                                        <span class="text-white fw-bold">+{{ getAmount($daily_profit) }} {{ $general->cur_text }}</span>
                                    @endif
                                </small>
                            </div>
                        </div>
                    @endif --}}
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--10 b-radius--10 box-shadow has--link">
                <div class="icon">
                    <i class="las la-wallet"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{ getAmount(auth()->user()->total_invest) }}</span>
                        <span class="currency-sign">{{ $general->cur_text }}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Invest')</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--warning b-radius--10 box-shadow has--link">
                <div class="icon">
                    <i class="las la-wallet"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{ getAmount(auth()->user()->total_sale) }}</span>
                        <span class="currency-sign">{{ $general->cur_text }}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Sale')</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--primary b-radius--10 box-shadow has--link">
                <div class="icon">
                    <i class="las la-cloud-upload-alt "></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{ getAmount($totalDeposit) }}</span>
                        <span class="currency-sign">{{ $general->cur_text }}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Deposit')</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--red b-radius--10 box-shadow has--link">
                <div class="icon">
                    <i class="las la-cloud-download-alt"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{ getAmount($totalWithdraw) }}</span>
                        <span class="currency-sign">{{ $general->cur_text }}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Withdraw')</span>
                    </div>
                    @if (isUserPiad() == true)
                        <a href="{{ route('user.report.withdraw') }}"
                            class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--dark b-radius--10 box-shadow has--link">
                <div class="icon">
                    <i class="fa fa-tree"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <div class="d-flex flex-row  justify-content-between">
                            <div class="comissions_amount">
                                <span class="amount">
                                    <i class="las la-arrow-circle-up" data-toggle="tooltip" data-placement="top"
                                        title="@lang('Indirect Referrals Commission')"></i>{{ getAmount(auth()->user()->total_indir_com) }}
                                </span>
                                <span class="amount">
                                    <i class="las la-user-circle" data-toggle="tooltip" data-placement="top"
                                        title="@lang('Direct Referrals Commission')"></i>{{ getAmount(auth()->user()->total_binary_com) }}
                                </span>
                            </div>
                            <span class="currency-sign ms-2"> {{ $general->cur_text }}</span>
                        </div>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Tree Commission')</span>
                    </div>
                    @if (isUserPiad() == true)
                        <a href="{{ route('user.report.binaryCom') }}"
                            class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--info b-radius--10 box-shadow has--link">
                <div class="icon">
                    <i class="las la-money-bill"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{ $totalTreeUsers }}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Tree Users')</span>
                    </div>
                    @if (isUserPiad() == true)
                        <a href="{{ route('user.binary.summery') }}"
                            class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--primary b-radius--10 box-shadow has--link">
                <div class="icon">
                    <i class="las la-chart-line"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        @if (isset($daily_profit) && $daily_profit != 'NA')
                            <span class="amount">{{ getAmount($daily_profit) }}</span>
                            <span class="currency-sign">{{ $general->cur_text }}</span>
                        @else
                            <span class="amount">0.00</span>
                            <span class="currency-sign">{{ $general->cur_text }}</span>
                        @endif
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Daily Profit')</span>
                    </div>
                    @if (isset($next_profit_hours) && $next_profit_hours !== null)
                        <div class="mt-2">
                            <span class="badge bg--white text--primary">
                                @if ($profit_status == 'credited')
                                    <i class="las la-check-circle"></i> @lang('Next:') {{ $next_profit_hours }}h
                                    {{ $next_profit_minutes }}m
                                @elseif($profit_status == 'pending')
                                    <i class="las la-clock"></i> @lang('Expected In:') {{ $next_profit_hours }}h
                                    {{ $next_profit_minutes }}m
                                @endif
                            </span>
                        </div>
                    @endif
                    @if (isUserPiad() == true && $profit_status != 'inactive')
                        <a href="{{ route('user.report.profits') }}"
                            class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--indigo b-radius--10 box-shadow has--link">
                <div class="icon">
                    <i class="las la-users"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{ $total_ref }}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Referral')</span>
                    </div>
                    @if (isUserPiad() == true)
                        <a href="{{ route('user.my.ref') }}"
                            class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if (auth()->user()->social_count < 6)
        @include($activeTemplate . 'user.partials.socialFollowModal')
    @endif
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $("#myModal").modal('show');
        });
    </script>
    <script>
        'use strict';
        (function($) {
            document.body.addEventListener('click', copy, true);

            function copy(e) {
                var
                    t = e.target,
                    c = t.dataset.copytarget,
                    inp = (c ? document.querySelector(c) : null);
                if (inp && inp.select) {
                    inp.select();
                    try {
                        document.execCommand('copy');
                        inp.blur();
                        t.classList.add('copied');
                        setTimeout(function() {
                            t.classList.remove('copied');
                        }, 1500);
                    } catch (err) {
                        alert(`@lang('Please press Ctrl/Cmd+C to copy')`);
                    }
                }
            }
        })(jQuery);
    </script>
@endpush
