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
  header("Location: logincusto.php");
}
?>