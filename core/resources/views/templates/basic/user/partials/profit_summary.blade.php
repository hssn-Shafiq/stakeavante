@php
    use App\Models\UserProfit;
    use Carbon\Carbon;

    // Check if there's already a profit for today
    $todayProfit = UserProfit::getUserProfitForDate(auth()->id());
    $profitCredited = $todayProfit != null;

    // Get expected profit if not credited yet
    if (!$profitCredited) {
        $expectedProfit = UserProfit::getExpectedProfit(auth()->id());
    }

    // Calculate next profit time
    if ($profitCredited) {
        // If profit already received, next is tomorrow at same time
        $lastProfitTime = Carbon::parse($todayProfit->created_at);
        $nextProfitTime = $lastProfitTime->copy()->addDay();
    } else {
        // If not yet received, next is at midnight
        $nextProfitTime = Carbon::tomorrow()->startOfDay();
    }

    // Calculate remaining time
    $hoursRemaining = Carbon::now()->diffInHours($nextProfitTime, false);
    $minutesRemaining = Carbon::now()->diffInMinutes($nextProfitTime, false) % 60;
@endphp

<div class="" style="width: 100% ; margin-bottom: 30px;">
    <div class="card  b-radius--10">
        <div class="card-header">
            <h5>@lang('Daily Profit Summary')</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3 mb-md-0">
                    <h6 class="text-muted mb-2">@lang('Today\'s Profit Status')</h6>

                    @if (isset($todayProfit))
                        <div class="profit-status credited">
                            <div class="d-flex align-items-center">
                                <span class="icon-circle bg-success me-2">
                                    <i class="las la-check-circle text-white"></i>
                                </span>
                                <div>
                                    <h5 class="mb-0 text-success">
                                        {{ getAmount($todayProfit->amount ?? $todayProfit->profit) }}
                                        {{ $general->cur_text }}</h5>
                                    <small class="text-muted">@lang('Credited at')
                                        {{ showDateTime($todayProfit->created_at, 'h:i A') }}</small>
                                </div>
                            </div>
                        </div>
                    @elseif(isset($expectedProfit) && $expectedProfit > 0)
                        <div class="profit-status pending">
                            <div class="d-flex align-items-center">
                                <span class="icon-circle bg-warning me-2">
                                    <i class="las la-clock text-white"></i>
                                </span>
                                <div class="ml-4">
                                    <h5 class="mb-0 text-warning">{{ getAmount($expectedProfit) }}
                                        {{ $general->cur_text }}</h5>
                                    <small class="text-muted">@lang('Expected today')</small>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="profit-status inactive">
                            <div class="d-flex align-items-center">
                                <span class="icon-circle bg-secondary me-2">
                                    <i class="las la-ban text-white"></i>
                                </span>
                                <div class="ml-4">
                                    <h5 class="mb-0 text-secondary">@lang('No Active Investment')</h5>
                                    <small class="text-muted">@lang('Invest to earn daily profits')</small>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-md-6">
                    <h6 class="text-muted mb-2">@lang('Next Profit')</h6>

                    @if (isset($expectedProfit) || isset($todayProfit))
                        <div class="next-profit">
                            <div class="d-flex align-items-center">
                                <span class="icon-circle bg-primary me-2">
                                    <i class="las la-hourglass-half text-white"></i>
                                </span>
                                <div class="ml-4">
                                    <h5 class="mb-0 text-primary">
                                        {{ $hoursRemaining }}h {{ $minutesRemaining }}m
                                    </h5>
                                    <small class="text-muted">
                                        @lang('Next credit on') {{ $nextProfitTime->format('M d, Y h:i A') }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="next-profit inactive">
                            <div class="d-flex align-items-center">
                                <span class="icon-circle bg-secondary me-2">
                                    <i class="las la-clock text-white"></i>
                                </span>
                                <div class="ml-4">
                                    <h5 class="mb-0 text-secondary">@lang('Not Available')</h5>
                                    <small class="text-muted">@lang('Purchase a plan first')</small>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            @if (isset($expectedProfit) || isset($todayProfit))
                <div class="text-center mt-4">
                    <a href="{{ route('user.report.profits') }}" class="btn btn-sm btn-primary">
                        <i class="las la-history"></i> @lang('View Profit History')
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .icon-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .icon-circle i {
        font-size: 1.5em;
    }

    .card {
        width: 100%;
        margin: 0 auto;
    }
</style>
