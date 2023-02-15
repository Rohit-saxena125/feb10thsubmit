<?php
session_start();

// check if user is logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

// check if user is a customer
if ($_SESSION['user_type'] !== 'customer') {
  echo "Sorry, only customers are allowed to book a car.";
  exit;
}

// get input values from the form
$vehicle_model = $_POST['vehicle_model'];
$vehicle_number = $_POST['vehicle_number'];
$seating_capacity = $_POST['seating_capacity'];
$rent_per_day = $_POST['rent_per_day'];
$start_date = $_POST['start_date'];
$number_of_days = $_POST['number_of_days'];

// check if all inputs are valid
if (empty($vehicle_model) || empty($vehicle_number) || empty($seating_capacity) || empty($rent_per_day) || empty($start_date) || empty($number_of_days)) {
  echo "Error: All fields are required.";
  exit;
}

// validate start date
$start_date = strtotime($start_date);
if ($start_date === false) {
  echo "Error: Invalid start date.";
  exit;
}

// calculate total cost
$total_cost = $rent_per_day * $number_of_days;

// connect to database and insert booking details
$conn = mysqli_connect('localhost:3306', 'root', '', 'test');
$sql = "INSERT INTO bookings (vehiclemodel, vehiclenumber, seatingcapacity, rent, start_date, number_of_days, total_cost, customer_id) VALUES ('$vehicle_model', '$vehicle_number', '$seating_capacity', '$rent_per_day', '$start_date', '$number_of_days', '$total_cost', '" . $_SESSION['user_id'] . "')";
if (!mysqli_query($conn, $sql)) {
  echo "Error: " . mysqli_error($conn);
  exit;
}

// redirect to confirmation page
header("Location: confirmation.php");
exit;
