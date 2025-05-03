@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th scope="col">@lang('User')</th>
                                <th scope="col">@lang('Username')</th>
                                <th scope="col">@lang('Email')</th>
                                <th scope="col">@lang('Real sale')</th>
                                <th scope="col">@lang('Display sale')</th><th scope="col">@lang('Difference')</th>
                                <th scope="col">@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($users as $user)
                            @php
                            $realSale=0;
                            $realSale = \App\Models\User::getTotalSaleInner($user->id,1);
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
                                <td data-label="@lang('Username')"><a href="{{ route('admin.users.detail', $user->id) }}">{{ $user->username }}</a></td>
                                <td data-label="@lang('Email')">{{ $user->email }}</td>
                                <td data-label="@lang('Real Sale')">{{ $realSale }}</td>
                                <td data-label="@lang('display Sale')">{{ $user->total_sale }}</td>
                                <td data-label="@lang('Difference')"><strong class="text-danger">{{ ($realSale-$user->total_sale) }}</strong></td>
                                <td data-label="@lang('Action')">
                                    @if($realSale!=$user->total_sale && $user->status==1 &&  $user->plan_id > 0)
                                    <a href="{{ route('admin.users.sale-fix', $user->id) }}" class="icon-btn bg--danger" data-toggle="tooltip" data-original-title="@lang('Details')">
                                        <i class="las la-clock text--shadow"></i>
                                    </a>
                                    @else
                                    <i class="las la-check  text--shadow"></i>
                                    @endif
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ __($empty_message) }}</td>
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



@push('breadcrumb-plugins')
    <form action="{{ route('admin.users.search', $scope ?? str_replace('admin.users.', '', request()->route()->getName())) }}" method="GET" class="form-inline float-sm-right bg--white">
        <div class="input-group has_append">
            <input type="hidden" name="def_sale" value="1">
            <input type="text" name="search" class="form-control" placeholder="@lang('Username or email')" value="{{ $search ?? '' }}">
            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
@endpush
