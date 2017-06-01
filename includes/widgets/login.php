<div class="widget">
	<h2>Log in/Register</h2>
	<div class="inner">
		<form method="post" action="/login/">
			<label>Username</label>
			<input name="username" Placeholder="Username">
			
			<label>Password</label>
			<input name="password" Placeholder="Password" type="password">
			
			<input id="submit" name="submit" type="submit" value="Submit"><br>
			
			<a href="/register">Register</a><br>
			Forgotten your <a href="/recover?mode=username">Username</a> or <a href="/recover?mode=password">Password</a>?
		</form>
	</div>
</div>