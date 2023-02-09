<?php
// Connect to the database
$db = mysqli_connect("localhost:3306", "root", "", "test");

// Customer registration
if (isset($_POST['custname'])) {
  $name = $_POST['custname'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $password = $_POST['password'];
  // Hash the password
  $password = password_hash($password, PASSWORD_DEFAULT);
  
  // Insert the customer information into the database
  $query = "INSERT INTO signupcustomer (name, email,phone, password) VALUES ('$name', '$email', '$phone','$password')";
  mysqli_query($db, $query);
  
  // Send confirmation email
  // ...

}
// Car rental agency registration
if (isset($_POST['name'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $password = $_POST['password'];
  echo "hello";
  // Hash the password
  $password = password_hash($password, PASSWORD_DEFAULT);
  
  // Insert the car rental agency information into the database
  $query = "INSERT INTO signupagency (name, email,phone, password) VALUES ('$name', '$email', '$phone','$password')";
  mysqli_query($db, $query);
  
  // Send confirmation email
  // ...
}

// Customer login
if (isset($_POST['custemail'])) {
  $email = $_POST['custemail'];
  $password = $_POST['password'];
  
  // Retrieve the customer information from the database
  $query = "SELECT * FROM signupcustomer WHERE email='$email'";
  $result = mysqli_query($db, $query);
  $customer = mysqli_fetch_assoc($result);
  
  // Verify the password
  if (password_verify($password, $customer['password'])) {
    // Start the customer session
    session_start();
    $_SESSION['customer_logged_in'] = true;
    
    // Redirect the customer to a protected area
    header("Location: customer_area.php");
  } else {
    // Show an error message
    echo "Incorrect email or password";
  }
}

// Car rental agency login
if (isset($_POST['email'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  
  // Retrieve the car rental agency information from the database
  $query = "SELECT * FROM signupagency WHERE email='$email'";
  $result = mysqli_query($db, $query);
  $agency = mysqli_fetch_assoc($result);
  
  // Verify the password
  if (password_verify($password, $agency['password'])) {
    // Start the car rental agency session
    session_start();
    header("Location: agency_area.php");
    $_SESSION['agency_logged_in'] = true;

  } else {
    // Show an error message
    echo "Incorrect email or password";
  }
}

// 
session_start();
if(!isset($_SESSION['username']))
{
header("Location: login.php");
}