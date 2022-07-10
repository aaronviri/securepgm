<?php 


include 'config.php';
require 'csrf-token.php';


error_reporting(0);

if (isset($_SESSION['username'])) {
    header("Location: welcome.php");
}

if (isset($_POST['submit'])) {
	$email = mysqli_real_escape_string($conn,$_POST['email']);
	if(filter_var($email, FILTER_VALIDATE_EMAIL)){
	}
	else{echo("$email is not a valid email address");
	}
	$password = hash("sha256",mysqli_real_escape_string($conn,$_POST['password']));
	

	$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['username'] = $row['username'];
		header("Location: feedback.php");
	} else 
	{
		echo "<script>alert('Woops! Email or Password is Wrong.')</script>";
	}
	mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="style.css">

	<title>damn secure app</title>
</head>
<body>
	<div class="container">
		<form action="" method="POST" class="login-email">
			<input type="hidden" name="csrf_token" value="<?php echo $token;?>">
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
			<div class="input-group">
				<input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" > 
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>"action="/foo" novalidate>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Login</button>
			</div>
			<p class="login-register-text">Don't have an account? <a href="register.php">Register Here</a>.</p>

		</form>
	</div>
</body>
</html>