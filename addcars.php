<!-- Add new cars’ page - A Car rental agency once logged in, should be able to
add details of new cars available for rental. Details to add
o Vehicle model, Vehicle number, seating capacity, rent per day
Access to this page should be restricted only to the car rental agency. Car
rental agencies should also be able to edit the details of a particular car -->

<?php
if (isset($_POST['submit'])) {
  $vehicle_model = $_POST['vehicle_model'];
  $vehicle_number = $_POST['vehicle_number'];
  $seating_capacity = $_POST['seating_capacity'];
  $rent_per_day = $_POST['rent_per_day'];

  $servername = "localhost:3306";
  $username = "root";
  $password = "";
  $dbname = "test";

  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $sql = "INSERT INTO cars (vehicle_model, vehicle_number, seating_capacity, rent_per_day)
  VALUES ('$vehicle_model', '$vehicle_number', '$seating_capacity', '$rent_per_day')";

  if (mysqli_query($conn, $sql)) {
    echo "New car added successfully";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

  mysqli_close($conn);
}
?>