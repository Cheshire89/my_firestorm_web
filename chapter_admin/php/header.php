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
					<li> <?php if($page == "" || $page == "index.php") { print('class="active"'); } ?>
						<a href="index.php" title="">Chapters</a>
					</li>
					<li <?php if($page == "events.php" || $page == "event.php") { print('class="active"'); } ?>>
						<a href="events.php" title="">Events</a>
					</li>
					<li <?php if($page == "users-authenticated.php" || $page == "users-prospects.php" || $page == "prospectInfo.php") { print('class="active"'); } ?>>
						<a href="users-authenticated.php" title="">Members</a>
					</li>
					<li <?php if($page == "" || $page == "users-prospects.php" || $page == "prospectInfo.php") { print('class="active"'); } ?>>
						<a href="../member_admin" title="">My Profile</a>
					</li>
				</ul>
				<a href="logout.php" class="btn btn-md btn-default navbar-btn pull-right fs-btn-orange" id="logout">Log Out</a>
	    </nav>
	</div>
</header>