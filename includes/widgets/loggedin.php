<div class="widget">
	<h2>
		Hello, <?php echo $user_data['forename']; ?>!
	</h2>
	<div class="inner">
		<div class="profile">
			<?php echo '<img src="', $user_data['profile'], '" alt="', $user_data['forename'], '\'s profile picture">';?>
		</div>
		<ul>
			<li>
				<a href="/logout.php">Log Out</a>
			</li>
			<li>
				<a href="<?php echo'/profile/' . $user_data['username']?>">Profile</a>
			</li>
			<li>
				<a href="/changepassword">Change Password</a>
			</li>
			<li>
				<a href="/settings">Settings</a>
			</li>
		</ul>
	</div>
</div>