@extends('admin.layouts.app')

@section('panel')

<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body p-0">
    <div class="table-responsive--md table-responsive">
        <table class="table table--light style--two">
            <thead>
            <tr>
                <th scope="col">@lang('Sl')</th>
                <th scope="col">@lang('Name')</th>
                <th scope="col">@lang('Price')</th>
                <th scope="col">@lang('Action')</th>
            </tr>
            </thead>
            <tbody>
            @forelse($rewards as $key => $reward)
                <tr>
                    <td data-label="@lang('Sl')">{{$key+1}}</td>
                    <td data-label="@lang('Name')">{{ __($reward->name) }}</td>
                    <td data-label="@lang(' Price')">{{ getAmount($reward->price) }} {{$general->cur_text}}</td>
                    <td data-label="@lang('Action')">
                        <button type="button" class="icon-btn edit" data-toggle="tooltip"
                                data-id="{{ $reward->id }}"
                                data-name="{{ $reward->name }}"
                                data-price="{{ getAmount($reward->price) }}"
                                data-level="{{ $reward->level }}"
                                data-original-title="Edit">
                            <i class="la la-pencil"></i>
                        </button>
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
    {{ $rewards->links('admin.partials.paginate') }}
</div>
</div>
</div>
</div>


{{--    edit modal--}}
<div id="edit-plan" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title">@lang('Edit Rewards')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form method="post" action="{{route('admin.rewards.update')}}">
    @csrf
    <div class="modal-body">

        <input class="form-control plan_id" type="hidden" name="id">

        <div class="form-row">
            <div class="form-group col-md-6">
                <label class="font-weight-bold"> @lang('Name') :</label>
                <input class="form-control name" name="name" required>
            </div>
            <div class="form-group col-md-6">
                    <label class="font-weight-bold"> @lang('Price') </label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span
                                class="input-group-text">{{$general->cur_sym}} </span></div>
                        <input type="text" class="form-control price" name="price" required>
                    </div>
                </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-block btn--primary">@lang('Update')</button>
    </div>
</form>
</div>
</div>
</div>
@endsection

@push('breadcrumb-plugins')
@endpush

@push('script')
<script>
"use strict";
(function ($) {
$('.edit').on('click', function () {
var modal = $('#edit-plan');
modal.find('.name').val($(this).data('name'));
modal.find('.price').val($(this).data('price'));
modal.find('input[name=id]').val($(this).data('id'));
modal.modal('show');
});

$('.add-plan').on('click', function () {
var modal = $('#add-plan');
modal.modal('show');
});
})(jQuery);
</script>
@endpush

