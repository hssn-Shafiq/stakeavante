@extends($activeTemplate . 'user.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('Date')</th>
                                    <th>@lang('Amount')</th>
                                    <th>@lang('Transaction')</th>
                                    <th>@lang('Post Balance')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($profits as $k=>$data)
                                    <tr>
                                        <td data-label="@lang('Date')">{{ showDateTime($data->created_at) }}</td>                                        <td data-label="@lang('Amount')">
                                            <span class="font-weight-bold text-success">
                                                + {{ getAmount($data->amount ?? $data->profit) }} {{ $general->cur_text }}
                                            </span>
                                        </td>
                                        <td data-label="@lang('Transaction')">
                                            <span class="badge badge--success">@lang('Daily Profit')</span>
                                        </td>
                                        <td data-label="@lang('Post Balance')">
                                            {{ getAmount($data->user->balance) }} {{ $general->cur_text }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($empty_message) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer py-4">
                    {{ $profits->links('admin.partials.paginate') }}
                </div>
            </div>
        </div>
    </div>
@endsection
