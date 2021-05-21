		<nav id="leftsidebar">
		
			<ul class="menu">
		
				<li><a href="index.php">Home Page</a></li>
				<li><a href="login.php">Login</a></li>
				<li><a href="user.php">User</a></li>

				<?php 

					if ( isset($_SESSION['username']) ) { ?>
					<li><a href="logout.php">Logout</a></li>

				<?php } ?>
			
			</ul>
		
		</nav>