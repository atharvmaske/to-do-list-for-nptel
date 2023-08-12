	<?php include('server.php') ?>	
	<!DOCTYPE html>
	<html>
	<head>
	<title>Registration system PHP and MySQL</title>
	<link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
	<link rel="icon" type="image/x-icon" href="img/logo.png">
	</head>
	<body>
	<div class="main">
		
	<a href="main.php" class="home">Home</a>
	<div class="head">
		<h2>Login</h2>
	</div>
		
	<form method="post" action="login.php">
		<?php include('errors.php'); ?>
		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" >
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="login_user">Login</button>
		</div>
		<p class="d9"> 
		
			Not yet a member? <a onclick="re()" href="register.php">Sign up</a>
		</p>
	</form>
	</div>
	</body>
	</html>