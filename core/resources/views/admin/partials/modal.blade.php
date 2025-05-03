<!-- Delete Modal -->
<div class="modal fade" id="delete_modal" aria-hidden="true" role="dialog">
<div class="modal-dialog modal-dialog-centered" role="document" >
<div class="modal-content">
<div class="modal-body text-center">
    <div class="form-content p-2">
        <h4 class="modal-title">@lang('Delete')</h4>
        <p class="mb-4">@lang('Are you sure to delete')</p>
        <form method="post" name="delete_form" id="delete_form" action="">
            @csrf
            <input type="hidden" name="delete" id="delete" value="">
            <button type="submit" class="btn btn-primary" >@lang('Confirm')</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('Cancel')</button>
     </form>
    </div>
</div>
</div>
</div>
</div>