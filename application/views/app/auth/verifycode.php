<link rel="stylesheet" href="<?php echo base_url(); ?>resource/app/css/login.css">

<section class="home-page-gategory-section" style="background:url('<?php echo base_url() ?>resource/app/icon/bg.png');min-height: 100vh;">
    <div class="container">
        <br><br><br>
        <?php $this->load->helper('form'); ?>
        <div class="row">
            <div class="col-md-12">
                <?php if($otp == 'failed'){ ?>
                    <p class="text-center">Code Doesn't match</p>
                <?php } ?>
                
<?php if(($otp == 'ncotp') || ($otp == 'failed')){ ?>
                <img style="margin: 0px auto;height: 80px;" class="login-register-image" src="<?php echo base_url(); ?>drives/logo/app/verify.png"/>
                <div class="countDown">
                <h1>You will get verification code within</h1>
                    <ul>
                        <!--<li><span id="days">0</span>days</li>-->
                        <!--<li><span id="hours">0</span>Hours</li>-->
                        <li><span id="minutes">0</span>Minutes</li>
                        <li><span id="seconds">0</span>Seconds</li>
                    </ul>
                </div>
<?php } ?>
            </div>
        </div>
                
        <div class="row">   
            <div class="col-md-12">

            <form id="verifyForm" autocomplete="off"method="GET" action="<?php echo base_url() ?>app/verifyCode">

                <div style="background: #FFFFFF;padding: 30px 10px 10px 10px;;border-radius: 10px;margin-bottom: 35px;">
                    
                    <input  type="hidden" name="user_id" id="user_id" required value="<?php echo $user_id; ?>" >
                    <input  type="hidden" name="fullname" id="fullname" required value="<?php echo $fullname; ?>" >
                    <input  type="hidden" name="mobile" id="mobile" required value="<?php echo $mobile; ?>" >
                    
                    <div class="group">      
                        <input type="text" placeholder="Code" name="code" id="code" value="<?php if(($otp != 'ncotp') && ($otp != 'failed')){echo $otp; } ?>" required  >
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label></label>
                    </div>
                
                    <input  type="hidden" name="verified" id="area" required value="verify" >
                    
                </div>
                <button id="submit_btn" type="submit" style="max-width: 70%;border-radius: 29px;margin-bottom:10px;font-size:18px;">Verify</button>
                
                <p class="registerLink"><a href="regcode" class="">Resend Code</a></p>

            </form>
            <br>
        </div>
    </div>
</section>

<!-- Modal HTML -->
<div id="errorModal" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-body text-center">
				<h4>Ooops!</h4>	
				<p class="md_error_text"></p>
				<button class="btn btn-success close_modal_btn" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url(); ?>resource/user/js/loginRegister.js" type="text/javascript"></script>

<?php if(($otp == 'ncotp') || ($otp == 'failed')){ ?>
<script>
    
$(document).ready(function(){
    !function(t,o){"function"==typeof define&&define.amd?define([],function(){return o(t)}):"object"==typeof exports?module.exports=o(t):t.ysCountDown=o(t)}("undefined"!=typeof global?global:"undefined"!=typeof window?window:this,function(u){"use strict";return function(t,o){var n={},r=null,a=null,e=null,l=null,i=!1;n.init=function(t,o){if(!("addEventListener"in u))throw"ysCountDown: This browser does not support the required JavaScript methods.";if(n.destroy(),r="string"==typeof t?new Date(t):t,!((e=r)instanceof Date)||isNaN(e))throw new TypeError("ysCountDown: Please enter a valid date.");var e;if("function"!=typeof o)throw new TypeError("ysCountDown: Please enter a callback function.");a=o,s()},n.destroy=function(){a=r=null,f(),l=null,i=!1};var s=function(){e||(e=setInterval(function(){var t,o;t=new Date,(o=Math.ceil((r.getTime()-t.getTime())/1e3))<=0&&(i=!0,f()),l={seconds:o%60,minutes:Math.floor(o/60)%60,hours:Math.floor(o/60/60)%24,days:Math.floor(o/60/60/24)%7,daysToWeek:Math.floor(o/60/60/24)%7,daysToMonth:Math.floor(o/60/60/24%30.4368),weeks:Math.floor(o/60/60/24/7),weeksToMonth:Math.floor(o/60/60/24/7)%4,months:Math.floor(o/60/60/24/30.4368),monthsToYear:Math.floor(o/60/60/24/30.4368)%12,years:Math.abs(r.getFullYear()-t.getFullYear()),totalDays:Math.floor(o/60/60/24),totalHours:Math.floor(o/60/60),totalMinutes:Math.floor(o/60),totalSeconds:o},a(l,i)},100))},f=function(){e&&(clearInterval(e),e=null)};return n.init(t,o),n}});
    
    // var daysElement = document.querySelector("#days");
    // var hoursElement = document.querySelector("#hours");
    var minutesElement = document.querySelector("#minutes");
    var secondsElement = document.querySelector("#seconds");
    var containerElement = document.querySelector(".countDown");
    var d = new Date(); d.setMinutes(d.getMinutes() + 5);
    var endDate = d;

    var myCountDown = new ysCountDown(endDate, function (remaining, finished) {

      if (finished) {
        containerElement.textContent = "Wait here or Register Again";
      }

    //   daysElement.textContent = remaining.totalDays;
    //   hoursElement.textContent = remaining.hours;
      minutesElement.textContent = remaining.minutes;
      secondsElement.textContent = remaining.seconds;

    });
    
});
</script>
<?php } ?>
