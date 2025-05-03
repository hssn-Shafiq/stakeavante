@extends($activeTemplate . 'user.layouts.app')

@section('panel')
<div class="row mb-none-30">
@foreach($plans as $data)
    <div class="col-xl-4 col-md-6 mb-30">
        <div class="card"> 
            <div class="card-body pt-5 pb-5 ">
                <div class="pricing-table text-center mb-4">
                    <h2 class="package-name mb-20 text-"><strong>@lang($data->name)</strong></h2>
                    <span class="text--dark font-weight-bold d-block">@lang('Min Price') {{$general->cur_sym}} {{getAmount($data->min_price)}}</span><br/>
                    <span class="text--dark font-weight-bold d-block">@lang('Max Price') {{$general->cur_sym}} {{getAmount($data->max_price)}}</span>
                    <hr>
                    <ul class="package-features-list mt-30">
                        <li><i class="fas fa-check bg--success"></i> <span>@lang('Total  Level 7')</span>   <span class="icon" data-toggle="modal" data-target="#bvInfoModal"><i
                                    class="fas fa-question-circle"></i></span></li>
                        <li><i class="fas fa-check bg--success"></i> <span> @lang('Referral Commission'): {{getAmount($data->ref_com)}} % </span>
                            <span class="icon" data-toggle="modal" data-target="#refComInfoModal"><i
                            class="fas fa-question-circle"></i></span>
                        </li>
                        <li>
                            <i class="fas fa-check bg--success"></i>  <span>@lang('Monthly Profit'): {{getAmount($data->profit)}} %</span>
                             <span class="icon" data-toggle="modal" data-target="#treeComInfoModal"><i
                            class="fas fa-question-circle"></i></span>
                        </li>
                    </ul>
                </div>
                @if(Auth::user()->plan_id != $data->id)
                    <a href="#confBuyModal{{$data->id}}" data-toggle="modal" class="btn w-100 btn-outline--primary  mt-20 py-2 box--shadow1">@lang('Stake')</a>
                @else
                    <a href="#confRestakeModal{{$data->id}}" data-toggle="modal" class="btn w-100 btn-outline--primary  mt-20 py-2 box--shadow1">@lang('Re Stake')</a>
                @endif
            </div>

        </div><!-- card end -->
    </div>


    <div class="modal fade" id="confBuyModal{{$data->id}}" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"> @lang('Confirm Purchase '.$data->name)?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <form method="post" action="{{route('user.plan.purchase')}}">
                    @csrf
                <div class="modal-body">
                    <h5 class="text-danger text-center">@lang('Minimum '){{getAmount($data->min_price)}} {{$general->cur_text}} @lang(' are required to purchase this plan.')</h5>
                    <div class="form-group">
                        <label>@lang('With 24 Month Plan avail  rewards benifits')</label>
                        <select class="form-control" name="mplan" required>
                            <option value="1">@lang('24 Months')</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>@lang('Membership will unlock more level')</label>
                        <select class="form-control" name="membership" required>
                            @foreach($memberships as $membership)
                            <option value="{{$membership->id}}">{{$membership->name}} -- {{$general->cur_text}} {{$membership->price}} -- @lang('Levels') {{$membership->level}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--danger" data-dismiss="modal"><i
                            class="fa fa-times"></i> @lang('Close')</button>

                    <button type="submit" name="plan_id" value="{{$data->id}}" class="btn btn--success"><i
                            class="lab la-telegram-plane"></i> @lang('Subscribe')</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Re stake -->
    <div class="modal fade" id="confRestakeModal{{$data->id}}" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"> @lang('Confirm Order')?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <form method="post" action="{{route('user.plan.restake')}}">
                    @csrf
                <div class="modal-body">
                    @if(auth()->user()->membership_id < 7)
                    <h5 class="text-danger text-center">@lang('Minimum '){{(1000-getAmount(auth()->user()->total_invest))}} {{$general->cur_text}} @lang(' are required to unlock all levels.')</h5>
                    @else
                    <h5 class="text-danger text-center">@lang('Congratulations ! You have unlocked all levels.Re stake more and more to get more profit and commission.')</h5>
                    @endif
                    @if(auth()->user()->plan_type==0)
                    <div class="form-group">
                        <label>@lang('With 24 Month Plan avail  rewards benifits')</label>
                        <select class="form-control" name="mplan" required>
                            <option value="1">@lang('24 Months')</option>
                        </select>
                    </div>
                    @endif
                    <div class="form-group">
                        <label>@lang('Add amount')</label>
                        <input class="form-control" name="amount" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--danger" data-dismiss="modal"><i
                            class="fa fa-times"></i> @lang('Close')</button>

                    <button type="submit" name="plan_id" value="{{$data->id}}" class="btn btn--success"><i
                            class="lab la-telegram-plane"></i> @lang('Subscribe')</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
</div>

<div class="modal fade" id="bvInfoModal">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">@lang("7 Level info")</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="@lang('Close')">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
                <table class="table">
                <tr>
                    <th>@lang("Name")</th>
                    <th>@lang("Price")</th>
                    <th>@lang("Unlock Level")</th>
                </tr>
                @foreach($memberships as $membership)
                <tr class="text-danger">
                    <td>{{$membership->name}}</td>
                    <td>{{$general->cur_sym}} {{$membership->price}}</td>
                    <td>{{$membership->level}}</td>
                </tr>
                @endforeach
                </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="refComInfoModal">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">@lang('Plan Referral Commission info')</h5>
            <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <h5 class=" text-danger">@lang('When you subscribe 24 month plan') , @lang('you will get rewards as well as your sale will be counted.')</h5>
            </h5>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="treeComInfoModal">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">@lang('Monthly Profit Info')</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <h5 class=" text-danger">@lang('Every user will get mentioned % profit on monthly base.'). </h5>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
        </div>
    </div>
</div>
</div>
@endsection
