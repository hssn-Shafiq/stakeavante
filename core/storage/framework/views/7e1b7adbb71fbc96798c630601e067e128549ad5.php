<?php $__env->startPush('style'); ?>
<style type="text/css">
    @import  url(http://fonts.googleapis.com/css?family=Lato:100,400);
.mb20{
    margin-bottom:20px;
}
section {
    padding: 40px 0;
}
#timer .countdown-wrapper {
    margin: 0 auto;
}
#timer #countdown {
    font-family: 'Lato', sans-serif;
    text-align: center;
    color: #eee;
    text-shadow: 1px 1px 5px black;
    padding: 40px 0;
}
#timer .countdown-wrapper #countdown .timer {
    margin: 10px;
    padding: 20px;
    font-size: 90px;
    border-radius: 50%;
    cursor: pointer;
}
#timer .col-md-4.countdown-wrapper #countdown .timer {
    margin: 10px;
    padding: 20px;
    font-size: 35px;
    border-radius: 50%;
    cursor: pointer;
}
#timer .countdown-wrapper #countdown #hour {
    -webkit-box-shadow: 0 0 0 5px rgba(92, 184, 92, .5);
    -moz-box-shadow: 0 0 0 5px rgba(92, 184, 92, .5);
    box-shadow: 0 0 0 5px rgba(92, 184, 92, .5);
}
#timer .countdown-wrapper #countdown #hour:hover {
    -webkit-box-shadow: 0px 0px 15px 1px rgba(92, 184, 92, 1);
    -moz-box-shadow: 0px 0px 15px 1px rgba(92, 184, 92, 1);
    box-shadow: 0px 0px 15px 1px rgba(92, 184, 92, 1);
}
#timer .countdown-wrapper #countdown #min {
    -webkit-box-shadow: 0 0 0 5px rgba(91, 192, 222, .5);
    -moz-box-shadow: 0 0 0 5px rgba(91, 192, 222, .5);
    box-shadow: 0 0 0 5px rgba(91, 192, 222, .5);
}
#timer .countdown-wrapper #countdown #min:hover {
    -webkit-box-shadow: 0px 0px 15px 1px rgb(91, 192, 222);
    -moz-box-shadow: 0px 0px 15px 1px rgb(91, 192, 222);
    box-shadow: 0px 0px 15px 1px rgb(91, 192, 222);
}
#timer .countdown-wrapper #countdown #sec {
    -webkit-box-shadow: 0 0 0 5px rgba(2, 117, 216, .5);
    -moz-box-shadow: 0 0 0 5px rgba(2, 117, 216, .5);
    box-shadow: 0 0 0 5px rgba(2, 117, 216, .5)
}
#timer .countdown-wrapper #countdown #sec:hover {
    -webkit-box-shadow: 0px 0px 15px 1px rgba(2, 117, 216, 1);
    -moz-box-shadow: 0px 0px 15px 1px rgba(2, 117, 216, 1);
    box-shadow: 0px 0px 15px 1px rgba(2, 117, 216, 1);
}
#timer .countdown-wrapper .card .card-footer .btn {
    margin: 2px 0;
}
@media (min-width: 992px) and (max-width: 1199px) {
    #timer .countdown-wrapper #countdown .timer {
        margin: 10px;
        padding: 20px;
        font-size: 65px;
        border-radius: 50%;
        cursor: pointer;
    }
}
@media (min-width: 768px) and (max-width: 991px) {
     #timer .countdown-wrapper #countdown .timer {
        margin: 10px;
        padding: 20px;
        font-size: 72px;
        border-radius: 50%;
        cursor: pointer;
    }
}
@media (max-width: 768px) {
    #timer .countdown-wrapper #countdown .timer {
        margin: 10px;
        padding: 20px;
        font-size: 73px;
        border-radius: 50%;
        cursor: pointer;
    }
}
@media (max-width: 767px) {
    #timer .countdown-wrapper #countdown #hour,
    #timer .countdown-wrapper #countdown #min,
    #timer .countdown-wrapper #countdown #sec {
        font-size: 60px;
        border-radius: 4%;
    }
}
@media (max-width: 576px){
    #timer .countdown-wrapper #countdown #hour,
    #timer .countdown-wrapper #countdown #min,
    #timer .countdown-wrapper #countdown #sec {
        font-size: 25px;
        border-radius: 4%;
    }
    #timer .countdown-wrapper #countdown .timer {
        padding: 13px;
    }
}
</style>
<?php $__env->stopPush(); ?>
<div class="container">
    <section id="timer">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 countdown-wrapper text-center mb20">
                <div class="card">
                    <div class="card-header">
                        Your Free AXT are
                    </div>
                    <div class="card-block">
                        <div id="countdown">
                            <div class="well">
                                <span id="freeaxt" class="timer bg-warning"><?php echo e(auth()->user()->free_coins); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <h4>To withdraw free AXT</h4>
                        <p><span class="fa fa-arrow-right"></span> You must have <?php echo e($general->coin_limit); ?> AXT.</p>
                        <p><span class="fa fa-arrow-right"></span> You must have followed all social links in the popup.</p>
                        <p><span class="fa fa-arrow-right"></span> You can increase daily reward as below.</br><span  class="badge rounded-pill bg-success">Day 1st <?php echo e(($general->coin_daily+(0*$general->coin_multiple))); ?> AXT</span><span  class="badge rounded-pill bg-primary">Day 2nd <?php echo e(($general->coin_daily+(1*$general->coin_multiple))); ?> AXT</span><span  class="badge rounded-pill bg-info">Day 3rd <?php echo e(($general->coin_daily+(2*$general->coin_multiple))); ?> AXT</span><span  class="badge rounded-pill bg-success">Day 4th <?php echo e(($general->coin_daily+(3*$general->coin_multiple))); ?> AXT</span><span  class="badge rounded-pill bg-primary">Day 5th <?php echo e(($general->coin_daily+(4*$general->coin_multiple))); ?> AXT</span><span  class="badge rounded-pill bg-info">Day 6th <?php echo e(($general->coin_daily+(5*$general->coin_multiple))); ?> AXT</span><span  class="badge rounded-pill bg-danger">Day 7th <?php echo e(($general->coin_daily+(6*$general->coin_multiple))); ?> AXT</span>
                        </p>
                        <?php if(auth()->user()->free_coins>=$general->coin_limit): ?>
                        <a href="#" class="btn btn-success">Process With Draw</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 countdown-wrapper text-center mb20">
                <div class="card">
                    <?php if($coins_date_diff < 1): ?>
                    <div class="card-header">
                        Claim your next Free AXT in
                    </div>
                    <div class="card-block">
                        <div id="countdown">
                            <div class="well">
                                <span id="hour" class="timer bg-success"></span>
                                <span id="min" class="timer bg-info"></span>
                                <span id="sec" class="timer bg-primary"></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                       <div class="col-md-12">
                        <!-- Facebook -->
                        <a href="https://www.facebook.com/profile.php?id=61556327376772&mibextid=ZbWKwL" target="_blank" class="btn social_count"><i class="fab fa-facebook-f fa-2x" style="color: #3b5998;"></i></a>
                        <!-- Twitter -->
                        <a href="https://x.com/Avante_axt?t=goH6lLaT25E9J2dtGIaOoQ&s=09" target="_blank" class="btn social_count"><i class="fab fa-twitter fa-2x" style="color: #55acee;"></i></a>
                        <!-- telegram -->
                        <a href="https://t.me/AXTMATIC" target="_blank" class="btn social_count"><i class="fab fa-telegram fa-2x" style="color: #ac2bac;"></i></a>
                        <!-- Youtube -->
                        <a href="https://www.youtube.com/@AVANTEAXTCURRENCY" target="_blank" class="btn social_count"><i class="fab fa-youtube fa-2x" style="color: #ed302f;"></i></a>
                        <a href="<?php echo e(asset('assets/documents/presentation_01.pdf')); ?>" class="btn btn--primary">Presentation</a>
                    </div>
                    </div>
                    <?php else: ?>
                    <div class="card-header">
                        Claim your Free AXT
                    </div>
                    <div class="card-block">
                         <a href="<?php echo e(route('user.free-coins')); ?>" class="btn btn-info">Claim Free AXT Now</a>
                    </div>
                    <div class="card-footer">
                       <div class="col-md-12">
                        <!-- Facebook -->
                        <a href="https://www.facebook.com/profile.php?id=61556327376772&mibextid=ZbWKwL" target="_blank" class="btn social_count"><i class="fab fa-facebook-f fa-2x" style="color: #3b5998;"></i></a>
                        <!-- Twitter -->
                        <a href="https://x.com/Avante_axt?t=goH6lLaT25E9J2dtGIaOoQ&s=09" target="_blank" class="btn social_count"><i class="fab fa-twitter fa-2x" style="color: #55acee;"></i></a>
                        <!-- telegram -->
                        <a href="https://t.me/AXTMATIC" target="_blank" class="btn social_count"><i class="fab fa-telegram fa-2x" style="color: #ac2bac;"></i></a>
                        <!-- Youtube -->
                        <a href="https://www.youtube.com/@AVANTEAXTCURRENCY" target="_blank" class="btn social_count"><i class="fab fa-youtube fa-2x" style="color: #ed302f;"></i></a>
                    <a href="<?php echo e(asset('assets/documents/presentation_01.pdf')); ?>" class="btn btn--primary">Presentation</a>
                    </div></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $__env->startPush('script'); ?>
<script type="text/javascript">
$( document ).ready(function() {
  setInterval(function time(){
  var d = new Date();
  var hours = 24 - d.getHours();
  if((hours + '').length == 1){
    hours = '0' + hours;
  }
  var min = 60 - d.getMinutes();
  if((min + '').length == 1){
    min = '0' + min;
  }
  var sec = 60 - d.getSeconds();
  if((sec + '').length == 1){
        sec = '0' + sec;
  }
  jQuery('#countdown #hour').html(hours);
  jQuery('#countdown #min').html(min);
  jQuery('#countdown #sec').html(sec);
}, 1000); });
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\stakeavante\core\resources\views/templates/basic/user/partials/countdown.blade.php ENDPATH**/ ?>