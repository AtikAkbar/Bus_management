<?php
session_start();
include 'connectDB.php';

if (!isset($_SESSION['user_id']) || !isset($_GET['bus_id'])) {
    header("Location: index.php");
    exit();
}

$busId = $_GET['bus_id'];

// Fetch seat data for the selected bus
$query = "SELECT seat_number, is_booked AS booked FROM seat WHERE bus_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $busId);
$stmt->execute();
$result = $stmt->get_result();

$seats = [];
while ($row = $result->fetch_assoc()) {
    $seats[] = [
        'seat_number' => $row['seat_number'],
        'booked' => $row['booked'] == 1 // Convert to boolean
    ];
}

// Fetch distance and fare per kilometer using the new query structure
$queryFare = "
    SELECT rb.distance, b.fare_pkm 
    FROM bus b
    JOIN bus_schedule bs ON b.bus_id = bs.bus_id
    JOIN routeb rb ON bs.route_id = rb.route_id
    WHERE b.bus_id = ?";
$stmtFare = $conn->prepare($queryFare);
$stmtFare->bind_param("i", $busId);
$stmtFare->execute();
$resultFare = $stmtFare->get_result();
$farePerSeat = 0;

if ($rowFare = $resultFare->fetch_assoc()) {
    $distance = $rowFare['distance'];
    $farePerKm = $rowFare['fare_pkm'];
    $farePerSeat = $distance * $farePerKm; // Calculate fare per seat
}

$totalFare = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Seats</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <style>
        .booked {
            background-color: red;
            color: white;
        }
        .available {
            background-color: white; /* Change to white for available seats */
            cursor: pointer;
        }
        .selected {
            background-color: green; /* Change to green for selected seats */
        }
    </style>
    <script>
        let selectedSeats = [];
        let farePerSeat = <?php echo $farePerSeat; ?>;

        function toggleSeat(seatNumber) {
            const seatIndex = selectedSeats.indexOf(seatNumber);
            const seatElement = document.getElementById(seatNumber);

            if (seatIndex > -1) {
                // If the seat is already selected, remove it
                selectedSeats.splice(seatIndex, 1);
                seatElement.classList.remove('selected');
            } else {
                // If the seat is not selected, add it
                selectedSeats.push(seatNumber);
                seatElement.classList.add('selected');
            }
            updateFare();
        }

        function updateFare() {
            const totalFare = selectedSeats.length * farePerSeat;
            document.getElementById('totalFare').innerText = 'Total Fare: ' + totalFare + ' BDT';
        }
    </script>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-lg-3">
        <div class="container-fluid">
          <a class="navbar-brand text-white fw-bold" href="#">Bus Ticket Booking</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-lg-auto">
              <li class="nav-item">
                <a class="nav-link text-white" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="signup.php">Signup</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="logout.php">Logout</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

    <main class="min-vh-100">
        <section class="my-lg-5">
 <div class="container">
                <h1 class="text-center">Select Your Seats</h1>
                <div class="row">
                    <?php foreach ($seats as $seat): ?>
                        <div class="col-2">
                            <div id="<?php echo $seat['seat_number']; ?>" class="seat <?php echo $seat['booked'] ? 'booked' : 'available'; ?>" 
                                 onclick="<?php echo !$seat['booked'] ? 'toggleSeat(\'' . $seat['seat_number'] . '\')' : ''; ?>">
                                <?php echo $seat['seat_number']; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <h3 id="totalFare" class="text-center">Total Fare: 0 BDT</h3>
                <div class="text-center">
                    <button class="btn btn-primary" onclick="alert('Seats booked: ' + selectedSeats.join(', '))">Confirm Booking</button>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-dark text-white text-center">
        <p class="mb-0">&copy; Atik Akbar</p>
    </footer>
    <script src="bootstrap.bundle.min.js"></script>
</body>
</html>