<?php
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['user_name']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE user_name='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['user_name'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location:http://localhost/page/main%20page/index.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

?>