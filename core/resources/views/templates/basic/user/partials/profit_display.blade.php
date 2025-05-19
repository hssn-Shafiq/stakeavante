@if (auth()->user()->plan_id > 0 && auth()->user()->plan_expiry > \Carbon\Carbon::now())
    <div class="col-lg-12 col-sm-6 mb-30">
        <div class="card border--light">
            <div class="card-header">
                <h5>@lang('Staking Profit Information')</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="profit-info">
                            <h6 class="mb-3">@lang('Daily Profit Status')</h6>
                            @if ($profit_status == 'credited')
                                <div class="d-flex align-items-center mb-3">
                                    <span class="p-2 bg-success rounded me-3">
                                        <i class="las la-check-circle text-white"></i>
                                    </span>
                                    <div>
                                        <h5 class="text-success mb-0">@lang('Profit Credited Today')</h5>
                                        <small>{{ getAmount($daily_profit) }} {{ $general->cur_text }} added to your
                                            balance</small>
                                    </div>
                                </div>
                            @elseif($profit_status == 'pending')
                                <div class="d-flex align-items-center mb-3">
                                    <span class="p-2 bg-warning rounded me-3">
                                        <i class="las la-clock text-white"></i>
                                    </span>
                                    <div>
                                        <h5 class="text-warning mb-0">@lang('Profit Pending')</h5>
                                        <small>@lang('Expected') {{ getAmount($daily_profit) }} {{ $general->cur_text }}
                                            today</small>
                                    </div>
                                </div>
                            @else
                                <div class="d-flex align-items-center mb-3">
                                    <span class="p-2 bg-secondary rounded me-3">
                                        <i class="las la-times-circle text-white"></i>
                                    </span>
                                    <div>
                                        <h5 class="text-secondary mb-0">@lang('No Active Plan')</h5>
                                        <small>@lang('Purchase a plan to earn daily profits')</small>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="next-profit-info">
                            <h6 class="mb-3">@lang('Next Profit Distribution')</h6>
                            @if (isset($next_profit_hours) && $next_profit_hours !== null)
                                <div class="d-flex align-items-center">
                                    <span class="p-2 bg-primary rounded me-3">
                                        <i class="las la-hourglass-half text-white"></i>
                                    </span>
                                    <div>
                                        <h5 class="text-primary mb-0">
                                            @if ($next_profit_hours > 0)
                                                {{ $next_profit_hours }} @lang('hours')
                                            @endif

                                            @if ($next_profit_minutes > 0)
                                                {{ $next_profit_minutes }} @lang('minutes')
                                            @endif
                                            @lang('remaining')
                                        </h5>
                                        <small>@lang('Next profit distribution on')
                                            {{ \Carbon\Carbon::parse($next_profit_time)->format('M d, Y, h:i A') }}</small>
                                    </div>
                                </div>
                            @else
                                <div class="d-flex align-items-center">
                                    <span class="p-2 bg-secondary rounded me-3">
                                        <i class="las la-ban text-white"></i>
                                    </span>
                                    <div>
                                        <h5 class="text-secondary mb-0">@lang('Not Available')</h5>
                                        <small>@lang('Purchase a plan to see profit distribution schedule')</small>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>                </div>
                @if ($profit_status != 'inactive')
                    <div class="mt-4">
                        <div class="profit-history-link text-center">
                            <a href="{{ route('user.report.profits') }}" class="btn btn-sm btn-primary">
                                <i class="las la-history"></i> @lang('View Profit History')
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endif
