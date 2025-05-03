@extends($activeTemplate . 'user.layouts.app')
@section('panel')
<div class="row">
<div class="col-lg-12">
<div class="card b-radius--10 ">
<div class="card-body p-0">
    <div class="table-responsive--md  table-responsive">
        <table class="table table--light style--two">
            <thead>
            <tr>
                <th scope="col" style="width:15%">@lang('User')</th>
                <th scope="col" style="width:10%">@lang('Level')</th>
                <th scope="col" style="width:10%">@lang('Username')</th>
                <th scope="col" style="width:10%">@lang('Tree')<br/>@lang('Users')</th>
                <th scope="col" style="width:55%">@lang('Tree Link')</th>
            </tr>
            </thead>
            <tbody>
            @forelse($users as $user)
            @if(treeAuth($user->id,auth()->id(),'user')==true)
            <tr>
                <td data-label="@lang('User')">
                    <div class="user">
                        <div class="thumb">
                            <img src="{{ getImage(imagePath()['profile']['user']['path'].'/'.$user->image,imagePath()['profile']['user']['size'])}}" alt="@lang('image')">
                        </div>
                        <span class="name">{{$user->fullname}}</span>
                    </div>
                </td>
                <td data-label="@lang('Level')">@if($user->level1_parent==auth()->id())
                {{'Level 1'}}
                @elseif($user->level2_parent==auth()->id())
                {{'Level 2'}}
                @elseif($user->level3_parent==auth()->id())
                {{'Level 3'}}
                @elseif($user->level4_parent==auth()->id())
                {{'Level 4'}}
                @elseif($user->level5_parent==auth()->id())
                {{'Level 5'}}
                @elseif($user->level6_parent==auth()->id())
                {{'Level 6'}}
                @elseif($user->level7_parent==auth()->id())
                {{'Level 7'}}
                @endif</td>
                <td data-label="@lang('Username')"><a href="{{ route('user.other.tree', $user->username) }}">{{ $user->username }}</a></td>
                <td data-label="@lang('Tree Users')">{{$user->userRef()->count()}}/3</td>
                <td data-label="@lang('Tree Link')">
                    <form class="copyBoard" >
                        <div class="form-row align-items-center">
                            <div class="col-md-10 my-1">
                                <input value="{{route('user.register')}}/?ref={{$user->username}}&reg={{auth()->user()->username}}" type="url"  class="form-control from-control-lg" id="ref{{$user->id}}" readonly>
                            </div>
                            <div class="col-md-2 my-1">
                                <button   type="button" class="btn btn--primary btn-block copybtn" data-id="ref{{$user->id}}"> <i class="fa fa-copy"></i> @lang('Copy')</button>
                            </div>
                        </div>
                    </form>
                </td>
            </tr>
            @endif
            @empty
                <tr>
                    <td class="text-muted text-center" colspan="100%">{{ __(@$empty_message) }}</td>
                </tr>
            @endforelse
            </tbody>
        </table><!-- table end -->
    </div>
</div>
<div class="card-footer py-4">
    {{ paginateLinks($users) }}
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
