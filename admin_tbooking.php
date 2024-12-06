<?php
include 'connectDB.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup_id'], $_POST['schedule_id'], $_POST['seat'])) {
    $signup_id = $_POST['signup_id'];
    $schedule_id = $_POST['schedule_id'];
    $seat = $_POST['seat'];

    // Insert booking into the database
    $query = "INSERT INTO booked_tickets (signup_id, schedule_id, seat_number) 
              VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iis", $signup_id, $schedule_id, $seat);

    if ($stmt->execute()) {
        echo "<script>alert('Ticket booked successfully!');</script>";
    } else {
        echo "<script>alert('Seat already booked or an error occurred.');</script>";
    }
}

// Fetch booked seats for a schedule
$bookedSeats = [];
if (isset($_GET['schedule_id'])) {
    $schedule_id = $_GET['schedule_id'];
    $query = "SELECT seat_number FROM booked_tickets WHERE schedule_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $schedule_id);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $bookedSeats[] = $row['seat_number'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css">
    <title>Ticket Booking</title>
    <style>
        .seat { width: 30px; height: 30px; margin: 5px; text-align: center; cursor: pointer; }
        .available { background-color: green; color: white; }
        .booked { background-color: red; color: white; cursor: not-allowed; }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2>Ticket Booking</h2>
        <form method="POST" class="mb-4">
            <div class="mb-3">
                <label for="signup_id" class="form-label">Signup ID:</label>
                <input type="number" name="signup_id" id="signup_id" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="schedule_id" class="form-label">Schedule ID:</label>
                <input type="number" name="schedule_id" id="schedule_id" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="seat" class="form-label">Select Seat:</label>
                <!-- <div class="d-flex flex-wrap">
                    <?php
                    for ($i = 1; $i <= 40; $i++) { 
                        $seat = sprintf("%02d", $i);
                        $class = in_array($seat, $bookedSeats) ? 'seat booked' : 'seat available';
                        $disabled = in_array($seat, $bookedSeats) ? 'disabled' : '';
                        echo "<button type='submit' name='seat' value='$seat' class='$class' $disabled>$seat</button>";
                    }
                    ?>
                </div> -->
            </div>
        </form>
    </div>
</body>
</html>
