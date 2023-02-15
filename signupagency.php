<?php
// Connect to the database
$db = mysqli_connect("localhost:3306", "root", "", "test");
// Car rental agency registration
if (isset($_POST['email'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    // Hash the password
    $password = password_hash($password, PASSWORD_DEFAULT);
    
    // Insert the car rental agency information into the database
    $query = "INSERT INTO signupagency (name, email,phone, password) VALUES ('$name', '$email', '$phone','$password')";
    mysqli_query($db, $query);
    
    // Send confirmation email
    // ...
    header("Location: loginagency.php");
  }
