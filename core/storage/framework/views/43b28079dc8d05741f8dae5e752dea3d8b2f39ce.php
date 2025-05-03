
<div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo app('translator')->get('Social Follow'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 my-2">
                        <p> <?php echo app('translator')->get('To Avoid this popup again and again please follow our social network.'); ?></p>
                    </div>
                    <div class="col-md-12">
                        <!-- Facebook -->
                        <a href="https://www.facebook.com/profile.php?id=61556327376772&mibextid=ZbWKwL" target="_blank" class="btn social_count"><i class="fab fa-facebook-f fa-2x" style="color: #3b5998;"></i></a>
                        <!-- Twitter -->
                        <a href="https://x.com/Avante_axt?t=goH6lLaT25E9J2dtGIaOoQ&s=09" target="_blank" class="btn social_count"><i class="fab fa-twitter fa-2x" style="color: #55acee;"></i></a>
                        <!-- telegram -->
                        <a href="https://t.me/AXTMATIC" target="_blank" class="btn social_count"><i class="fab fa-telegram fa-2x" style="color: #ac2bac;"></i></a>
                        <!-- Youtube -->
                        <a href="https://www.youtube.com/@AVANTEAXTCURRENCY" target="_blank" class="btn social_count"><i class="fab fa-youtube fa-2x" style="color: #ed302f;"></i></a>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('script'); ?>
        <script>
            'use strict';
            (function($){
            $("#myModal").modal('show');
            $(document).on('click', '.social_count', function () {
                var id = parseInt("<?php echo e(Auth::user()->id); ?>");
                var token = "<?php echo e(csrf_token()); ?>";
                if(id){
                    $.ajax({
                        type: "POST",
                        url: "<?php echo e(route('user.social-count')); ?>",
                        data: {
                            'id': id,
                            '_token': token
                        },
                        success: function (data) {
                            if (data.success) {
                                $("#myModal").modal('hide');
                            }else{
                               $("#myModal").modal('show');
                            }
                        }
                    });
                }else{
                    $("#myModal").modal('show');
                }
            });
            })(jQuery)
        </script>
<?php $__env->stopPush(); ?>

<?php /**PATH C:\xampp\htdocs\stakeavante\core\resources\views/templates/basic/user/partials/socialFollowModal.blade.php ENDPATH**/ ?>