@extends($activeTemplate . 'user.layouts.app')
@section('panel')
<div class="row">
<div class="col-lg-12">
<div class="card b-radius--10 ">
<div class="card-body p-0">
    <div class="table-responsive--md  table-responsive">
        @if(auth()->user()->plan_type==0)
    <div class="modal-content">
        <div class="modal-body">
            <h5 class=" text-danger">@lang('When you subscribe 24 month plan') , @lang('you will get rewards as well as your sale will be counted.')</h5>
            </h5>
        </div>
    </div>
    @elseif(auth()->user()->plan_type==1)
        <table class="table table--light style--two">
            <thead>
            <tr>
                <th scope="col">@lang('User')</th>
                <th scope="col">@lang('Username')</th>
                <th scope="col">@lang('User Type')</th>
                <th scope="col">@lang('Total Invest:')</th>
                <th scope="col">@lang('Each Leg Sale')</th>
                <th scope="col">@lang('Reward 1 Required')</th>
                <th scope="col">@lang('Reward 2 Required')</th>
                <th scope="col">@lang('Reward 3 Required')</th>
                <th scope="col">@lang('Reward 4 Required')</th>
                <th scope="col">@lang('Reward 5 Required')</th>
                <th scope="col">@lang('Reward 6 Required')</th>
                <th scope="col">@lang('Reward 7 Required')</th>
            </tr>
            </thead>
            <tbody>
            @php
                $user1Sale=0;
                $user2Sale=0;
                $user3Sale=0;
                $firstRequired = null;
                $secondRequired = null;
                $thirdRequired = null;
                $fourthRequired = null;
                $fifthRequired = null;
                $sixthRequired = null;
                $seventhRequired = null;
            @endphp
            @forelse($users->children as $key => $user)
            @php
                $userSale=\App\Models\User::getTotalSaleInner($user->id,null,$users->id);
                if($key==0){
                   $user1Sale=$userSale;
                   $firstRequired = 1000;
                   $secondRequired = 2500;
                   $thirdRequired = 5000;
                   $fourthRequired = 10000;
                   $fifthRequired = 50000;
                   $sixthRequired = 100000;
                   $seventhRequired = 500000;
                }else if($key==1){
                   $user2Sale=$userSale;
                   $firstRequired = 1000;
                   $secondRequired = 2500;
                   $thirdRequired = 5000;
                   $fourthRequired = 10000;
                   $fifthRequired = 50000;
                   $sixthRequired = 100000;
                   $seventhRequired = 500000;
                }else if($key==2){
                   $user3Sale=$userSale;
                   $firstRequired = 1000;
                   $secondRequired = 2500;
                   $thirdRequired = 5000;
                   $fourthRequired = 10000;
                   $fifthRequired = 50000;
                   $sixthRequired = 100000;
                   $seventhRequired = 500000;
                }
            @endphp
            <tr>
                <td data-label="@lang('User')">
                    <div class="user">
                        <div class="thumb">
                            <img src="{{ getImage(imagePath()['profile']['user']['path'].'/'.$user->image,imagePath()['profile']['user']['size'])}}" alt="@lang('image')">
                        </div>
                        <span class="name">{{$user->fullname}}</span>
                    </div>
                </td>
                <td data-label="@lang('Username')"><a href="{{ route('user.other.tree', $user->username) }}">{{ $user->username }}</a></td>
                <td data-label="@lang('User Type')">@lang('Sub User')</td>
                <td data-label="@lang('Total Invest:')">{{$user->total_invest}} {{$general->cur_text}}</td>
                <td data-label="@lang('Each Leg Sale')">
                    {{$userSale}}
                {{$general->cur_text}}</td>
                <td data-label="@lang('Reward 1')">@if($userSale >= $firstRequired) {!!'<i class="fa fa-check text-success"></i>'!!}@else {!!'<i class="fa fa-times text-danger"></i>'!!} @endif {{$firstRequired}}</td>
                <td data-label="@lang('Reward 2')">@if($userSale >= $secondRequired) {!!'<i class="fa fa-check text-success"></i>'!!}@else {!!'<i class="fa fa-times text-danger"></i>'!!} @endif {{$secondRequired}}</td>
                <td data-label="@lang('Reward 3')">@if($userSale >= $thirdRequired) {!!'<i class="fa fa-check text-success"></i>'!!}@else {!!'<i class="fa fa-times text-danger"></i>'!!} @endif {{$thirdRequired}}</td>
                <td data-label="@lang('Reward 4')">@if($userSale >= $fourthRequired) {!!'<i class="fa fa-check text-success"></i>'!!}@else {!!'<i class="fa fa-times text-danger"></i>'!!} @endif {{$fourthRequired}}</td>
                <td data-label="@lang('Reward 5')">@if($userSale >= $fifthRequired) {!!'<i class="fa fa-check text-success"></i>'!!}@else {!!'<i class="fa fa-times text-danger"></i>'!!} @endif {{$fifthRequired}}</td>
                <td data-label="@lang('Reward 6')">@if($userSale >= $sixthRequired) {!!'<i class="fa fa-check text-success"></i>'!!}@else {!!'<i class="fa fa-times text-danger"></i>'!!} @endif {{$sixthRequired}}</td>
                <td data-label="@lang('Reward 7')">@if($userSale >= $seventhRequired) {!!'<i class="fa fa-check text-success"></i>'!!}@else {!!'<i class="fa fa-times text-danger"></i>'!!} @endif {{$seventhRequired}}</td>
            </tr>
            @empty
                <tr>
                    <td class="text-muted text-center" colspan="100%">{{ __(@$empty_message) }}</td>
                </tr>
            @endforelse
            <tr style="background-color:#cbae88;">
                <td data-label="@lang('User')"><div class="user">
                        <div class="thumb">
                            <img src="{{ getImage(imagePath()['profile']['user']['path'].'/'.$users->image,imagePath()['profile']['user']['size'])}}" alt="@lang('image')">
                        </div>
                        <span class="name"><strong class="text--dark">{{$users->fullname}}</strong></span>
                    </div></td>
                    <td data-label="@lang('Username')"><a href="{{ route('user.other.tree', $users->username) }}"><strong class="text--dark">{{ $users->username }}</a></strong></td>
                <td data-label="@lang('User Type')"><strong class="text--dark">@lang('Main User')</strong></td>
                <td data-label="@lang('Total Invest:')"><strong class="text--dark">{{$users->total_invest}} {{$general->cur_text}}</strong></td>
                <td data-label="@lang('Total Sale')"><strong class="text--dark">{{$users->total_sale}} {{$general->cur_text}}</strong></td>
                <td data-label="@lang('Reward 1')"><strong class="text--dark">
                        @if($user1Sale >= 1000 && $user2Sale >= 1000 && $user3Sale >= 1000 && $users->children_count==3) {!!'<i class="fa fa-check text-success"></i>'!!}@else {!!'<i class="fa fa-times text-danger"></i>'!!} @endif @lang('3000')</strong></td>
                <td data-label="@lang('Reward 2')"><strong class="text--dark">@if($user1Sale >= 2500 && $user2Sale >= 2500 && $user3Sale >= 2500 && $users->children_count==3) {!!'<i class="fa fa-check text-success"></i>'!!}@else {!!'<i class="fa fa-times text-danger"></i>'!!} @endif @lang('7500')</strong></td>
                <td data-label="@lang('Reward 3')"><strong class="text--dark">@if($user1Sale >= 5000 && $user2Sale >= 5000 && $user3Sale >= 5000 && $users->children_count==3) {!!'<i class="fa fa-check text-success"></i>'!!}@else {!!'<i class="fa fa-times text-danger"></i>'!!} @endif @lang('15000')</strong></td>
                <td data-label="@lang('Reward 4')"><strong class="text--dark">@if($user1Sale >= 10000 && $user2Sale >= 10000 && $user3Sale >= 10000 && $users->children_count==3) {!!'<i class="fa fa-check text-success"></i>'!!}@else {!!'<i class="fa fa-times text-danger"></i>'!!} @endif @lang('30000')</strong></td>
                <td data-label="@lang('Reward 5')"><strong class="text--dark">@if($user1Sale >= 50000 && $user2Sale >= 50000 && $user3Sale >= 50000 && $users->children_count==3) {!!'<i class="fa fa-check text-success"></i>'!!}@else {!!'<i class="fa fa-times text-danger"></i>'!!} @endif @lang('150000')</strong></td>
                <td data-label="@lang('Reward 6')"><strong class="text--dark">@if($user1Sale >= 100000 && $user2Sale >= 100000 && $user3Sale >= 100000 && $users->children_count==3) {!!'<i class="fa fa-check text-success"></i>'!!}@else {!!'<i class="fa fa-times text-danger"></i>'!!} @endif @lang('300000')</strong></td>
                <td data-label="@lang('Reward 7')"><strong class="text--dark">@if($user1Sale >= 500000 && $user2Sale >= 500000 && $user3Sale >= 500000 && $users->children_count==3) {!!'<i class="fa fa-check text-success"></i>'!!}@else {!!'<i class="fa fa-times text-danger"></i>'!!} @endif @lang('1500000')</strong></td>
                </tr>
            </tbody>
        </table>
    @else
    <div class="modal-content">
        <div class="modal-body">
            <h5 class=" text-danger">@lang('No chart available.')</h5>
            </h5>
        </div>
    </div>
    @endif

        <!-- table end -->
    </div>
</div>
</div><!-- card end -->
</div>
</div>
@endsection
@push('script')

    <script>
        'use strict';
        (function($) {
            (function($) {
$(document).on('click', '.copybtn', function(){
     var targetField = $(this).attr("data-id");
    if (targetField) {
    const area = document.querySelector('#'+targetField)
        area.select();
        document.execCommand('copy');
            //area.blur();
            $(this).addClass('copied');
            setTimeout(function() { 
                $(this).removeClass('copied'); 
            }, 1500);
        }
    });
})(jQuery);
        })(jQuery);
    </script>

@endpush
