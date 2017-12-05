<div class="fs-modal modal fade" id="referWindow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <!-- <h4 class="fs-header" id="myModalLabel">Invite Friends to <strong>Firestorm</strong></h4> -->
      </div>
      <div class="modal-body">
        <?php if($page == "profile.php") { ?>
        <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center">  
                <h2 class="fs-header">Send a Referral About</h2>
                <h3 class="fs-header"><?php print($profInfo["fName"]); ?> <strong><?php print($profInfo["lName"]); ?></strong></h3>
                <div class="wrapper featured-member profile-img">
                    <img class="img-responsive img-circle center-block" src="<?php print($profInfo["profPic"]);?>" alt="Profile Picture" />
                </div>
                <h4 class="fs-header">And we'll get them connected!</h4>
            </div>
        </div>
        <?php } ?>
        <div class="row">
        <!--
          <div class="col-md-4 text-center">
             <div class="wrapper featured-member profile-img">
                  <img class="img-responsive img-circle center-block" src="img/mem1.jpg" alt="Profile Picture">
              </div>
              <h3 class="fs-header">Adam <strong>Smith</strong></h3>
          </div>
        -->
          <div class="col-md-12">
            <h2 class="text-center">Coming Soon!</h2>
            <!--
              <form class="form-horizontal fs-form-gen referForm" id="referForm" name="referForm" method="POST">
                <input type="hidden" name="refer_page" id="refer_page" value="<?php print($_SERVER['PHP_SELF']); ?>" />
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="col-xs-12">
                         <label for="">Referral From</label>
                         <input type="text" name="refer_name" id="refer_name" class="form-control" placeholder="Full Name" value="<?php print($_SESSION['fName'] . " " . $_SESSION['lName']); ?>" />
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-xs-12">
                         <label for="">Email</label>
                         <input type="text" name="refer_email" id="refer_email" class="form-control" value="<?php print($_SESSION['email']); ?>" />
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-xs-12">
                         <label for="">Phone</label>
                         <input type="text" name="refer_phone" id="refer_phone" class="form-control" value="<?php print($_SESSION['phone']); ?>" />
                        </div>
                      </div>
                  </div>
                  <div class="col-md-6">
                  
                    <div class="form-group">
                      <div class="col-xs-12">
                         <label for="">Refer To</label>
                         <input type="text" name="their_name" id="their_name" class="form-control" placeholder="Their Name" />
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-xs-12">
                         <label for="">Email</label>
                         <input type="text" name="their_email" id="their_email" class="form-control" placeholder="Their Email" />
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-xs-12">
                         <label for="">Phone</label>
                         <input type="text" name="their_phone" id="their_phone" class="form-control" placeholder="Their Phone" />
                        </div>
                      </div>
                  
                   </div>
                </div>
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label for="">Refer Message</label>
                            <textarea class="form-control" id="refMessage" name="refMessage"></textarea>
                        </div>
                    </div>
                    <?php if($page == "profile.php") { ?>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label for="">Message to <?php print($name); ?></label>
                            <textarea class="form-control" id="refereeMessage" name="refereeMessage"></textarea>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="btn-group pull-right">
                                <button class="btn fs-btn-orange" id="sendReferal"><i class="fa fa-paper-plane" aria-hidden="true"></i> Refer</button>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
                
              </form>
              -->
          </div>
        </div>
         
      </div>
      <div class="modal-footer">
        <div class="row">
          <div class="col-xs-12">

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<footer class="navbar navbar-default" role="navigation">
	<div class="container">
		 <div class="navbar-header">
        <a href="index.php" class="navbar-brand"><img class="img-responsive center-block" style="max-width:130px; margin-top: -12px;" src="img/fs-logo-footer.png"></a>
    </div>
    <nav class="navbar-collapse">
			<ul class="nav navbar-nav center-nav">
				<li>
					<a href="link-to-us.php" title="Add Our Banner To Your Website">Link to Us</a>
				</li>
				<li>
					<a href="membership-agreement.php" title="">Membership Agreement</a>
				</li>
				<li>
					<a href="privacy-policy.php" title="">Privacy Policy</a>
				</li>
				<li>
					<a href="terms-of-use.php" title="">Terms of Use</a>
				</li>
			</ul>
     <nav class="navbar pull-right social">
			<ul class="nav navbar-nav">
				<li>
					<a href="https://www.facebook.com/myfirestorm" target="_blank" title="Follow Firestrom on Facebook"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
				</li>
				<li>
					<a href="https://twitter.com/myfirestorm" target="_blank" title="Follow Firestrom on Twitter"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
				</li>
				<li>
					<a href="https://www.linkedin.com/groups/60614/profile" target="_blank" title="Follow Firestrom on Linkedin"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
				</li>
				<li>
					<a href="https://www.youtube.com/channel/UCZbaVkj_lXrMrQEmcVA4-5g" target="_blank" title="Follow Firestrom on Youtube"><i class="fa fa-youtube-square" aria-hidden="true"></i></a>
				</li>
				<li>
					<a href="https://www.instagram.com/firestormnetworking/" target="_blank" title="Follow Firestrom on Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
				</li>
			</ul>
    </nav>
    </nav>
	</div>
</footer>
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '559649070884601', {
em: 'insert_email_variable'
});
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=559649070884601&ev=PageView&noscript=1"
/></noscript>
<!-- DO NOT MODIFY -->
<!-- End Facebook Pixel Code -->
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-75212305-1', 'auto');
ga('send', 'pageview');

</script>