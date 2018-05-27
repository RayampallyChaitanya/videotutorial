<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '123sudhakar', 'mydb');

  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['user_name']);
  $email = mysqli_real_escape_string($db, $_POST['email_id']);
  $fullname = mysqli_real_escape_string($db, $_POST['full_name']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  
  // echo ("$username");

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE user_name='$username' OR email_id='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['user_name'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email_id'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password);//encrypt the password before saving in the database
    echo "Entered here";
  	$query = "INSERT INTO users (user_name, email_id, password, full_name)
     			  VALUES('$username', '$email', '$password','$fullname')";
  	mysqli_query($db, $query);

  	
  }

?>