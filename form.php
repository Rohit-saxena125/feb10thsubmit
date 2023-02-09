<?php
// Connect to the database
$db = mysqli_connect("localhost", "username", "password", "database_name");

// Customer registration
if (isset($_POST['customer_register'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  
  // Hash the password
  $password = password_hash($password, PASSWORD_DEFAULT);
  
  // Insert the customer information into the database
  $query = "INSERT INTO customers (name, email, password) VALUES ('$name', '$email', '$password')";
  mysqli_query($db, $query);
  
  // Send confirmation email
  // ...
}

// Car rental agency registration
if (isset($_POST['agency_register'])) {
  $company_name = $_POST['company_name'];
  $tax_id = $_POST['tax_id'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  
  // Hash the password
  $password = password_hash($password, PASSWORD_DEFAULT);
  
  // Insert the car rental agency information into the database
  $query = "INSERT INTO agencies (company_name, tax_id, email, password) VALUES ('$company_name', '$tax_id', '$email', '$password')";
  mysqli_query($db, $query);
  
  // Send confirmation email
  // ...
}

// Customer login
if (isset($_POST['customer_login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  
  // Retrieve the customer information from the database
  $query = "SELECT * FROM customers WHERE email='$email'";
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
if (isset($_POST['agency_login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  
  // Retrieve the car rental agency information from the database
  $query = "SELECT * FROM agencies WHERE email='$email'";
  $result = mysqli_query($db, $query);
  $agency = mysqli_fetch_assoc($result);
  
  // Verify the password
  if (password_verify($password, $agency['password'])) {
    // Start the car rental agency session
    session_start();
    $_SESSION['agency_logged_in'] = true;

  } else {
    // Show an error message
    echo "Incorrect email or password";
  }
}

