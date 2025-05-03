<?php if(\App\Models\Extension::where('act', 'custom-captcha')->where('status', 1)->first()): ?>
    <div class="row">
        <div class="form-group">
            <div class="col-md-12">
                <?php echo  getCustomCaptcha($height = 46, $width = '100%', $bgcolor = '#003', $textcolor = '#abc') ?>
            </div>
            <div class="col-md-12 mt-4">
                <input type="text" name="captcha" maxlength="6" placeholder="<?php echo app('translator')->get('Enter the code above'); ?>" required class="form-control
                <?php echo e(request()->routeIs('contact') ? 'form--control' : 'form--control-2'); ?>"
                >
            </div>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH /home/ki11859513/stakeavante.com/core/resources/views/templates/basic/partials/custom-captcha.blade.php ENDPATH**/ ?>