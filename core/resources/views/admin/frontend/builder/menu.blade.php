
@extends('admin.layouts.app')

@section('panel')

<div class="row">
<div class="col-lg-12 col-md-12 mb-30">
<div class="card">
<div class="card-body p-0">
<div class="table-responsive--md table-responsive">
<table class="table table--light style--two">
<thead>
    <tr>
        <th scope="col">@lang('SL')</th>
        <th scope="col">@lang('Name')</th>
        <th scope="col">@lang('Parent')</th>
        <th scope="col">@lang('Position')</th>
        <th scope="col">@lang('Link')</th>
        <th scope="col">@lang('Status')</th>
        <th scope="col">@lang('Action')</th>
    </tr>
</thead>
<tbody class="list">
    @forelse ($menus as $key => $item)
        <tr>
            <td data-label="@lang('SL')">{{ $key+1 }}</td>
            <td data-label="@lang('Name')">{{ $item->name }}</td>
            <td data-label="@lang('Parent')">{{ MenusList($item->parent,'name'); }}</td>
            <td data-label="@lang('Position')">{{ $item->position }}</td>
            <td data-label="@lang('Link')">{{ $item->link }}</td>
            <td data-label="@lang('Status')">
                @if($item->status == 1)
                    <span class="text--small badge font-weight-normal badge--success">@lang('Active')</span>
                @else
                    <span class="text--small badge font-weight-normal badge--danger">@lang('Disabled')</span>
                @endif
            </td>
            <td data-label="@lang('Action')">
                <a href="#" class="icon-btn  updateBtn" data-id="{{$item->id}}" data-name="{{$item->name}}" data-menu_order="{{$item->order_value}}" data-position="{{$item->position}}" data-parent="{{$item->parent}}" data-link="{{$item->link}}" data-status="{{ $item->status }}"
                    data-toggle="modal" data-target="#updateBtn"
                >
                    <i class="la la-pencil-alt"></i>
                </a>
            </td>
        </tr>
    @empty
        <tr>
            <td class="text-muted text-center" colspan="100%">{{ $empty_message }}</td>
        </tr>
    @endforelse
</tbody>
</table>
</div>
</div>
<div class="card-footer py-4">
{{ $menus->links('admin.partials.paginate') }}
</div>
</div>
</div>
</div>

{{-- Add METHOD MODAL --}}
<div id="addModal" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"> @lang('Add New Menu')</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<form action="{{ route('admin.frontend.manage-menu.add') }}" method="POST">
@csrf
<div class="modal-body">
<div class="form-group">
    <label>@lang('Menu Name')</label>
    <input type="text"class="form-control" placeholder="@lang('Enter Name')" name="name" required>
</div>
<div class="form-group">
    <label>@lang('Menu Order')</label>
    <input type="number"class="form-control" placeholder="@lang('Menu Order')" name="menu_order" required>
</div>
<div class="form-group">
<label>@lang('Menu Position')</label>
<select class="form-control" name="position" required>
    <option value="Top">@lang('Top')</option>
    <option value="Left">@lang('Left')</option>
    <option value="Right">@lang('Right')</option>
    <option value="Bottom">@lang('Bottom')</option>
</select>
</div>
<div class="form-group">
    <label>@lang('Select Parent')</label>
    <select class="form-control" name="parent">
    <option value="0">@lang('Select Parent')</option>
    @if($mainMenus)
        @foreach($mainMenus as $parent)
            <option value="{{ $parent->id }}">{{ $parent->name }}({{ $parent->position }})</option>
        @endforeach
    @endif
</select>
</div>
<div class="form-group">
    <label>@lang('Select Page')</label>
    <select class="form-control get_slug" id="get_slug" name="page">
    <option data-static="0" value="custom">@lang('Custom Link')</option>
    @if($pages)
        @foreach($pages as $page)
            <option data-static="{{$page->is_default}}" value="{{ $page->slug }}">{{ $page->name }}</option>
        @endforeach
    @endif
</select>
</div>
<div class="form-group">
    <label>@lang('Menu Link')</label>
    <input type="text" id="mylink" class="form-control" placeholder="@lang('Enter Link')" name="link" required>
</div>
<div class="form-group">
<label class="font-weight-bold">@lang('Status')</label>
<input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Active')" data-off="@lang('Disable')" name="status" checked>
</div>
</div>
<div class="modal-footer">
<button type="submit" class="btn-block btn btn--primary">@lang('Submit')</button>
</div>
</form>
</div>
</div>
</div>


{{-- Update METHOD MODAL --}}
<div id="updateBtn" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"> @lang('Update Menu')</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<form action="{{ route('admin.frontend.manage-menu.update') }}" class="edit-route" method="POST">
@csrf
<input type="hidden" name="id">
<div class="modal-body">
<div class="form-group">
<label>@lang('Menu Name')</label>
<input type="text"class="form-control" placeholder="@lang('Enter Name')" name="name" required>
</div>
<div class="form-group">
    <label>@lang('Menu Order')</label>
    <input type="number"class="form-control" placeholder="@lang('Menu Order')" name="menu_order" required>
</div>
<div class="form-group">
<label>@lang('Menu Position')</label>
<select class="form-control" name="position" required>
    <option value="Top">@lang('Top')</option>
    <option value="Left">@lang('Left')</option>
    <option value="Right">@lang('Right')</option>
    <option value="Bottom">@lang('Bottom')</option>
</select>
</div>
<div class="form-group">
    <label>@lang('Select Parent')</label>
    <select class="form-control" name="parent">
    <option value="0">@lang('Select Parent')</option>
    @if($mainMenus)
        @foreach($mainMenus as $parent)
            <option value="{{ $parent->id }}">{{ $parent->name }}({{ $parent->position }})</option>
        @endforeach
    @endif
</select>
</div>
<div class="form-group">
    <label>@lang('Select Page')</label>
    <select class="form-control get_slug" id="get_slug2" name="page">
    <option data-static="0" value="custom">@lang('Custom Link')</option>
    @if($pages)
        @foreach($pages as $page)
            <option data-static="{{$page->is_default}}" value="{{ $page->slug }}">{{ $page->name }}</option>
        @endforeach
    @endif
</select>
</div>
<div class="form-group">
    <label>@lang('Menu Link')</label>
    <input type="text" id="mylink2" class="form-control" placeholder="@lang('Enter Link')" name="link" required disabled>
</div>
<div class="form-group">
<label class="font-weight-bold">@lang('Status')</label>
<input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Active')" data-off="@lang('Disable')" name="status" checked>
</div>
</div>
<div class="modal-footer">
<button type="submit" class="btn-block btn btn--primary">@lang('Update')</button>
</div>
</form>
</div>
</div>
</div>

@push('breadcrumb-plugins')
<div class="item">
<a href="javascript:void(0)" class="btn btn-lg btn--success box--shadow1 text--small addBtn"><i class="fa fa-fw fa-plus"></i>@lang('Add New')</a>
</div>
@endpush
@endsection

@push('script')
<script>
(function ($) {
'use strict';
$('.addBtn').on('click', function () {
var modal = $('#addModal');
modal.modal('show');
});

$('.updateBtn').on('click', function () {
var modal = $('#updateBtn');
modal.find('input[name=id]').val($(this).data('id'));
modal.find('input[name=name]').val($(this).data('name'));
modal.find('input[name=menu_order]').val($(this).data('menu_order'));
modal.find('select[name=position]').val($(this).data('position'));
modal.find('select[name=parent]').val($(this).data('parent'));
modal.find('input[name=link]').val($(this).data('link'));
if($(this).data('status') == 1){
modal.find('input[name=status]').bootstrapToggle('on');
}else{
modal.find('input[name=status]').bootstrapToggle('off');
}

});
$(document).on('change', '.get_slug', function(){
        var permalink  = $(this).val();
        $("#mylink2").attr("disabled",false);
        var is_static = $("#get_slug2 option:selected").map(function(){
              return $(this).data("static");
        }).get();
        if(permalink!='custom'){
            if(is_static==1){
                var url = window.location.origin+'/'+permalink;
            }else{
                var url = window.location.origin+'/pages/'+permalink;
            }
            $("#mylink2").attr("readonly",true);
            $("#mylink2").val(url);
        }else{
            $("#mylink2").attr("readonly",false);
            $("#mylink2").val('');
        }
    });
})(jQuery);
</script>
@endpush
