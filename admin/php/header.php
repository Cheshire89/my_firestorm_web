<?php

$page = str_replace("/dev/mfs/admin/", "", strtok($_SERVER["REQUEST_URI"],'?'));

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
					<li <?php if($page == "about.php") { print('class="active"'); } ?>>
						<a href="about.php" title="">About</a>
					</li>
					<li <?php if($page == "chapters.php" || $page == "createChapter.php") { print('class="active"'); } ?>>
						<a href="chapters.php" title="">Chapters</a>
					</li>
					<li <?php if($page == "events.php" || $page == "createEvent.php") { print('class="active"'); } ?>>
						<a href="events.php" title="">Events</a>
					</li>
					<li <?php if($page == "education.php" || $page == "createArticle.php") { print('class="active"'); } ?>>
						<a href="education.php" title="">Education</a>
					</li>
					<li <?php if($page == "videos.php") { print('class="active"'); } ?>>
						<a href="videos.php" title="">Videos</a>
					</li>
					<li <?php if($page == "users-authenticated.php" || $page == "users-prospects.php" || $page == "prospectInfo.php" || $page == "profile.php" || $page == "profile-edit.php" || $page == "profile-billing.php" || $page == "profile-referals.php") { print('class="active"'); } ?>>
						<a href="users-authenticated.php" title="">Members</a>
					</li>
					<!-- <li>
						<a href="membership-agreement.php" title="">Docs</a>
					</li> -->
					<li <?php if($page == "general-settings.php") { print('class="active"'); } ?>>
						<a href="general-settings.php" title="">General</a>
					</li>
				</ul>
				<a href="logout.php" class="btn btn-md btn-default navbar-btn pull-right fs-btn-orange logoutBtn">Log Out</a>
	    </nav>
	</div>
</header>