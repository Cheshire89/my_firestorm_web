<?php

$page = str_replace("/dev/mfs/", "", strtok($_SERVER["REQUEST_URI"],'?'));

?><header class="navbar navbar-default" role="navigation">
	<div class="container">
		 <div class="navbar-header">
	        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainNav">
	            <div id="nav-icon">
				  <span></span>
				  <span></span>
				  <span></span>
				</div>
	        </button>
	        <a href="index.php" class="navbar-brand"><img class="img-responsive center-block" style="max-width:130px; margin-top: -12px;" src="img/fs-logo-header.png"></a>
	    </div>
	    <nav class="navbar-collapse collapse" id="mainNav">
				<ul class="nav navbar-nav center-nav">
					<li <?php if($page == "" || $page == "index.php") { print('class="active"'); } ?>>
						<a href="index.php" title="">Home</a>
					</li>
					<li <?php if( $page == "about.php") { print('class="active"'); } ?>>
						<a href="about.php" title="">About</a>
					</li>
					<li <?php if($page == "chapters.php" || $page == "chapter.php" || $page == "chapter-photos.php" || $page == "chapter-members.php") { print('class="active"'); } ?>>
						<a href="chapters.php" title="">Chapters</a>
					</li>
					<li <?php if($page == "events.php" || $page == "event.php") { print('class="active"'); } ?>>
						<a href="events.php" title="">Events</a>
					</li>
					<li <?php if($page == "article.php" || $page == "education.php") { print('class="active"'); } ?>>
						<a href="education.php" title="">Education</a>
					</li>
					<li <?php if($page == "videos.php") { print('class="active"'); } ?>>
						<a href="videos.php" title="">Videos</a>
					</li>
                    <li <?php if($page == "members.php" || $page == "member.php" || $page == "profile.php") { print('class="active"'); } ?>>
						<a href="members.php" title="">Members</a>
					</li>
                    <?php if(!isset($_SESSION['userID']) || $_SESSION['userID'] == "") { ?>
					<li <?php if($page == "sign-login.php" || $page == "new-account.php" || $page == "reset-password.php") { print('class="active"'); } ?>>
						<a href="sign-login.php" title="">Sign Up | Log In</a>
					</li>
                    <?php } else {
                        
                        switch ($_SESSION['userLevel']) {
        					case 'admin':
        							$redirectPage = './admin';
        						break;
        					case 'chapter_admin':
        							$redirectPage = './chapter_admin';
        						break;
        					case 'member':
        							$redirectPage = './member_admin';
        						break;
        					case 'incompleteMember':
        							$redirectPage = './new-account.php';
        						break;
        					case 'guest':
        							$redirectPage = './new-account.php';
        						break;
        					default:
        							$redirectPage = './sign-login.php?error=level';
        						break;
        				}
                        
                    ?>
                    <li <?php if($page == "sign-login.php" || $page == "new-account.php" || $page == "reset-password.php") { print('class="active"'); } ?>>
						<a href="<?php print($redirectPage); ?>" title="">My Account</a>
					</li>
                    <?php } ?>
				</ul>

				<?php 
					if(isset($_SESSION["userLevel"])){
						print('<a href="logout.php" class="btn btn-md btn-default navbar-btn pull-right fs-btn-orange">Logout</a>');
					}else{
						print('<button type="button" class="btn btn-md btn-default navbar-btn pull-right fs-btn-orange" id="refer" data-toggle="modal" data-target="#referWindow">Refer</a>');
					}
				?>
				
	    </nav>
	</div>
</header>