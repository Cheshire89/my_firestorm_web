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
					<li class="active">
						<a href="../index.php" title="">Home</a>
					</li>
					<li>
						<a href="../about.php" title="">About</a>
					</li>
					<li>
						<a href="../chapters.php" title="">Chapters</a>
					</li>
					<li>
						<a href="../events.php" title="">Events</a>
					</li>
					<li>
						<a href="../education.php" title="">Education</a>
					</li>
					<li>
						<a href="../videos.php" title="">Videos</a>
					</li>
					<li>
						<a href="../members.php" title="">Members</a>
					</li>
					<?php if($_SESSION["userLevel"] == 'chapter_admin'){ ?>
						<li>
							<a href="../chapter_admin" title="">Manage Chapters</a>
						</li>
					<?php } ?>
				</ul>
				<a href="logout.php" class="btn btn-md btn-default navbar-btn pull-right fs-btn-orange" >Log Out</a>
	    </nav>
	</div>
</header>