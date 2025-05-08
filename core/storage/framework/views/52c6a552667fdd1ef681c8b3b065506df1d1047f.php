<?php $__env->startSection('panel'); ?>

<div class="row">
<div class="col-lg-12 col-md-12 mb-30">
<div class="card">
<div class="card-body p-0">
<div class="table-responsive--md table-responsive">
<table class="table table--light style--two">
<thead>
    <tr>
        <th scope="col"><?php echo app('translator')->get('SL'); ?></th>
        <th scope="col"><?php echo app('translator')->get('Name'); ?></th>
        <th scope="col"><?php echo app('translator')->get('Parent'); ?></th>
        <th scope="col"><?php echo app('translator')->get('Position'); ?></th>
        <th scope="col"><?php echo app('translator')->get('Link'); ?></th>
        <th scope="col"><?php echo app('translator')->get('Status'); ?></th>
        <th scope="col"><?php echo app('translator')->get('Action'); ?></th>
    </tr>
</thead>
<tbody class="list">
    <?php $__empty_1 = true; $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td data-label="<?php echo app('translator')->get('SL'); ?>"><?php echo e($key+1); ?></td>
            <td data-label="<?php echo app('translator')->get('Name'); ?>"><?php echo e($item->name); ?></td>
            <td data-label="<?php echo app('translator')->get('Parent'); ?>"><?php echo e(MenusList($item->parent,'name')); ?></td>
            <td data-label="<?php echo app('translator')->get('Position'); ?>"><?php echo e($item->position); ?></td>
            <td data-label="<?php echo app('translator')->get('Link'); ?>"><?php echo e($item->link); ?></td>
            <td data-label="<?php echo app('translator')->get('Status'); ?>">
                <?php if($item->status == 1): ?>
                    <span class="text--small badge font-weight-normal badge--success"><?php echo app('translator')->get('Active'); ?></span>
                <?php else: ?>
                    <span class="text--small badge font-weight-normal badge--danger"><?php echo app('translator')->get('Disabled'); ?></span>
                <?php endif; ?>
            </td>
            <td data-label="<?php echo app('translator')->get('Action'); ?>">
                <a href="#" class="icon-btn  updateBtn" data-id="<?php echo e($item->id); ?>" data-name="<?php echo e($item->name); ?>" data-menu_order="<?php echo e($item->order_value); ?>" data-position="<?php echo e($item->position); ?>" data-parent="<?php echo e($item->parent); ?>" data-link="<?php echo e($item->link); ?>" data-status="<?php echo e($item->status); ?>"
                    data-toggle="modal" data-target="#updateBtn"
                >
                    <i class="la la-pencil-alt"></i>
                </a>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td class="text-muted text-center" colspan="100%"><?php echo e($empty_message); ?></td>
        </tr>
    <?php endif; ?>
</tbody>
</table>
</div>
</div>
<div class="card-footer py-4">
<?php echo e($menus->links('admin.partials.paginate')); ?>

</div>
</div>
</div>
</div>


<div id="addModal" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"> <?php echo app('translator')->get('Add New Menu'); ?></h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<form action="<?php echo e(route('admin.frontend.manage-menu.add')); ?>" method="POST">
<?php echo csrf_field(); ?>
<div class="modal-body">
<div class="form-group">
    <label><?php echo app('translator')->get('Menu Name'); ?></label>
    <input type="text"class="form-control" placeholder="<?php echo app('translator')->get('Enter Name'); ?>" name="name" required>
</div>
<div class="form-group">
    <label><?php echo app('translator')->get('Menu Order'); ?></label>
    <input type="number"class="form-control" placeholder="<?php echo app('translator')->get('Menu Order'); ?>" name="menu_order" required>
</div>
<div class="form-group">
<label><?php echo app('translator')->get('Menu Position'); ?></label>
<select class="form-control" name="position" required>
    <option value="Top"><?php echo app('translator')->get('Top'); ?></option>
    <option value="Left"><?php echo app('translator')->get('Left'); ?></option>
    <option value="Right"><?php echo app('translator')->get('Right'); ?></option>
    <option value="Bottom"><?php echo app('translator')->get('Bottom'); ?></option>
</select>
</div>
<div class="form-group">
    <label><?php echo app('translator')->get('Select Parent'); ?></label>
    <select class="form-control" name="parent">
    <option value="0"><?php echo app('translator')->get('Select Parent'); ?></option>
    <?php if($mainMenus): ?>
        <?php $__currentLoopData = $mainMenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($parent->id); ?>"><?php echo e($parent->name); ?>(<?php echo e($parent->position); ?>)</option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</select>
</div>
<div class="form-group">
    <label><?php echo app('translator')->get('Select Page'); ?></label>
    <select class="form-control get_slug" id="get_slug" name="page">
    <option data-static="0" value="custom"><?php echo app('translator')->get('Custom Link'); ?></option>
    <?php if($pages): ?>
        <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option data-static="<?php echo e($page->is_default); ?>" value="<?php echo e($page->slug); ?>"><?php echo e($page->name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</select>
</div>
<div class="form-group">
    <label><?php echo app('translator')->get('Menu Link'); ?></label>
    <input type="text" id="mylink" class="form-control" placeholder="<?php echo app('translator')->get('Enter Link'); ?>" name="link" required>
</div>
<div class="form-group">
<label class="font-weight-bold"><?php echo app('translator')->get('Status'); ?></label>
<input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="<?php echo app('translator')->get('Active'); ?>" data-off="<?php echo app('translator')->get('Disable'); ?>" name="status" checked>
</div>
</div>
<div class="modal-footer">
<button type="submit" class="btn-block btn btn--primary"><?php echo app('translator')->get('Submit'); ?></button>
</div>
</form>
</div>
</div>
</div>



<div id="updateBtn" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"> <?php echo app('translator')->get('Update Menu'); ?></h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<form action="<?php echo e(route('admin.frontend.manage-menu.update')); ?>" class="edit-route" method="POST">
<?php echo csrf_field(); ?>
<input type="hidden" name="id">
<div class="modal-body">
<div class="form-group">
<label><?php echo app('translator')->get('Menu Name'); ?></label>
<input type="text"class="form-control" placeholder="<?php echo app('translator')->get('Enter Name'); ?>" name="name" required>
</div>
<div class="form-group">
    <label><?php echo app('translator')->get('Menu Order'); ?></label>
    <input type="number"class="form-control" placeholder="<?php echo app('translator')->get('Menu Order'); ?>" name="menu_order" required>
</div>
<div class="form-group">
<label><?php echo app('translator')->get('Menu Position'); ?></label>
<select class="form-control" name="position" required>
    <option value="Top"><?php echo app('translator')->get('Top'); ?></option>
    <option value="Left"><?php echo app('translator')->get('Left'); ?></option>
    <option value="Right"><?php echo app('translator')->get('Right'); ?></option>
    <option value="Bottom"><?php echo app('translator')->get('Bottom'); ?></option>
</select>
</div>
<div class="form-group">
    <label><?php echo app('translator')->get('Select Parent'); ?></label>
    <select class="form-control" name="parent">
    <option value="0"><?php echo app('translator')->get('Select Parent'); ?></option>
    <?php if($mainMenus): ?>
        <?php $__currentLoopData = $mainMenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($parent->id); ?>"><?php echo e($parent->name); ?>(<?php echo e($parent->position); ?>)</option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</select>
</div>
<div class="form-group">
    <label><?php echo app('translator')->get('Select Page'); ?></label>
    <select class="form-control get_slug" id="get_slug2" name="page">
    <option data-static="0" value="custom"><?php echo app('translator')->get('Custom Link'); ?></option>
    <?php if($pages): ?>
        <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option data-static="<?php echo e($page->is_default); ?>" value="<?php echo e($page->slug); ?>"><?php echo e($page->name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</select>
</div>
<div class="form-group">
    <label><?php echo app('translator')->get('Menu Link'); ?></label>
    <input type="text" id="mylink2" class="form-control" placeholder="<?php echo app('translator')->get('Enter Link'); ?>" name="link" required disabled>
</div>
<div class="form-group">
<label class="font-weight-bold"><?php echo app('translator')->get('Status'); ?></label>
<input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="<?php echo app('translator')->get('Active'); ?>" data-off="<?php echo app('translator')->get('Disable'); ?>" name="status" checked>
</div>
</div>
<div class="modal-footer">
<button type="submit" class="btn-block btn btn--primary"><?php echo app('translator')->get('Update'); ?></button>
</div>
</form>
</div>
</div>
</div>

<?php $__env->startPush('breadcrumb-plugins'); ?>
<div class="item">
<a href="javascript:void(0)" class="btn btn-lg btn--success box--shadow1 text--small addBtn"><i class="fa fa-fw fa-plus"></i><?php echo app('translator')->get('Add New'); ?></a>
</div>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\stakeavante\core\resources\views/admin/frontend/builder/menu.blade.php ENDPATH**/ ?>