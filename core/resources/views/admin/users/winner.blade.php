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
                                <th scope="col">@lang('Reward 1')</th>
                                <th scope="col">@lang('Reward 2')</th>
                                <th scope="col">@lang('Reward 3')</th>
                                <th scope="col">@lang('Reward 4')</th>
                                <th scope="col">@lang('Reward 5')</th>
                                <th scope="col">@lang('Reward 6')</th>
                                <th scope="col">@lang('Reward 7')</th>
                                <th scope="col">@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($users as $user)
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
                                <td data-label="@lang('Reward 1')">{!! ($user->reward_one==1?'<i class="fa fa-check text-success" title="Team Leader"></i></i>':'<i class="fa fa-times text-danger"></i>') !!}</td>
                                <td data-label="@lang('Reward 2')">{!! ($user->reward_two==1?'<i class="fa fa-check text-success" title="Region Leader"></i></i>':'<i class="fa fa-times text-danger"></i>') !!}</td>
                                <td data-label="@lang('Reward 3')">{!! ($user->reward_three==1?'<i class="fa fa-check text-success" title="National Leader"></i></i>':'<i class="fa fa-times text-danger"></i>') !!}</td>
                                <td data-label="@lang('Reward 4')">{!! ($user->reward_four==1?'<i class="fa fa-check text-success" title="Royal Leader"></i></i>':'<i class="fa fa-times text-danger"></i>') !!}</td>
                                <td data-label="@lang('Reward 5')">{!! ($user->reward_five==1?'<i class="fa fa-check text-success" title="Crown Leader"></i></i>':'<i class="fa fa-times text-danger"></i>') !!}</td>
                                <td data-label="@lang('Reward 6')">{!! ($user->reward_six==1?'<i class="fa fa-check text-success" title="Diamond Leader"></i></i>':'<i class="fa fa-times text-danger"></i>') !!}</td>
                                <td data-label="@lang('Reward 7')">{!! ($user->reward_seven==1?'<i class="fa fa-check text-success" title="Avante Leader"></i></i>':'<i class="fa fa-times text-danger"></i>') !!}</td>
                                <td data-label="@lang('Action')">
                                    <a href="{{ route('admin.users.detail', $user->id) }}" class="icon-btn" data-toggle="tooltip" data-original-title="@lang('Details')">
                                        <i class="las la-desktop text--shadow"></i>
                                    </a>
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
            <input type="hidden" name="winner_user" value="1">
            <input type="text" name="search" class="form-control" placeholder="@lang('Username or email')" value="{{ $search ?? '' }}">
            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
@endpush
