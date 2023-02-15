<?php
// Connect to the database
$db = mysqli_connect("localhost:3306", "root", "", "test");

// Check if the database connection was successful
if (!$db) {
  exit("Failed to connect to the database: " . mysqli_connect_error());
}

// Customer login
if (isset($_POST['email'])) {
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Retrieve the customer information from the database
    $query = "SELECT * FROM signupagency WHERE email='$email'";
    $result = mysqli_query($db, $query);
    
    // Check if the query was successful
    if (!$result) {
      exit("SQL query failed: " . mysqli_error($db));
    }
    
    $customer = mysqli_fetch_assoc($result);
    
    // Check if the email was found in the database
    if (!$customer) {
      exit("Incorrect email");
    }
    // Verify the password
    if (password_verify($password, $customer['password'])) {
      // Start the customer session
      session_start();
      $_SESSION['customer_logged_in'] = true;
      
      // Redirect the customer to a protected area
      header("Location: addcars.php");
    } else {
      // Show an error message
      exit("Incorrect password");
    }
}