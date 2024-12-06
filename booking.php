<?php
session_start(); // Start the session
include 'connectDB.php'; // Include your database connection file

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Fetch routes from the database
$query = "SELECT DISTINCT `from`, `destination` FROM `routeb`";
$result = mysqli_query($conn, $query);

$routes = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $routes[] = $row;
    }
}

// Initialize variables for search results
$buses = [];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $from = $_POST['from'];
    $to = $_POST['to'];
    $date = $_POST['date'];

    // Query to get bus details for the selected route and date
    $query = "
        SELECT b.bus_number, b.manufacturer, bs.departure_time, 
               (rb.distance * b.fare_pkm) AS total_fare, b.bus_id
        FROM bus b
        JOIN bus_schedule bs ON b.bus_id = bs.bus_id
        JOIN routeb rb ON bs.route_id = rb.route_id
        WHERE rb.from = ? AND rb.destination = ? AND bs.Date = ?
    ";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sss", $from, $to, $date);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $buses[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Page</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <script>
        function bookBus(busId) {
            window.location.href = 'seat_selection.php?bus_id=' + busId;
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
              <li class="nav -item">
                <a class="nav-link text-white" href="logout.php">Logout</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    
    <main class="min-vh-100">
        <section class="my-lg-5">
            <div class="row justify-content-center">
              <div class="col-md-6 col-lg-4">
                <div class="card">
                  <div class="card-body">
                    <h1 class="text-center">Book Your Bus Ticket</h1>
                    <br>    
                    <form method="POST">
                      <div class="form-group mb-2">
                        <label for="from">From:</label>
                        <select class="form-control" id="from" name="from">
                          <option value=""></option>
                          <?php
                          foreach ($routes as $route) {
                              echo '<option value="' . htmlspecialchars($route['from']) . '">' . htmlspecialchars($route['from']) . '</option>';
                          }
                          ?>
                        </select>
                      </div>
                      <div class="form-group mb-2">
                        <label for="to">To:</label>
                        <select class="form-control" id="to" name="to">
                            <option value=""></option>
                            <?php
                            foreach ($routes as $route) {
                                echo '<option value="' . htmlspecialchars($route['destination']) . '">' . htmlspecialchars($route['destination']) . '</option>';
                            }
                            ?>
                          </select>
                      </div>
                      <div class="form-group mb-2">
                        <label for="date">Date:</label>
                        <input type="date" class="form-control" id="date" name="date" />
                      </div>
                      <br> 
                      <button type="submit" class="btn btn-primary btn-block d-block mx-auto w-100">Find Buses</button>
                    </form>
                    <br>
                    <?php if (!empty($buses)): ?>
                      <h2 class="text-center">Available Buses</h2>
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>Bus Number</th>
                            <th>Manufacturer</th>
                            <th>Departure Time</th>
                            <th>Total Fare (per ticket)</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($buses as $bus): ?>
                            <tr>
                              <td><?php echo htmlspecialchars($bus['bus_number']); ?></td>
                              <td><?php echo htmlspecialchars($bus['manufacturer']); ?></td>
                              <td><?php echo htmlspecialchars($bus['departure_time']); ?></td>
                              <td><?php echo htmlspecialchars($bus['total_fare']); ?> BDT</td>
                              <td>
                                <button class="btn btn-success" onclick="bookBus(<?php echo $bus['bus_id']; ?>)">Book</button>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
                      <p class="text-danger text-center">No buses available for the selected route and date.</p>
                    <?php endif; ?>
                  </div>
                </div>
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