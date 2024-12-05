<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bus_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Add and Delete Actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'delete') {
            $driver_id = intval($_POST['driver_id']);
            $sql = "DELETE FROM driver WHERE driver_id = {$driver_id}";
            if ($conn->query($sql) === TRUE) {
                $message = "<div class='alert alert-success' role='alert'>Driver deleted successfully</div>";
            } else {
                $message = "<div class='alert alert-danger' role='alert'>Error deleting driver: " . $conn->error . "</div>";
            }
        } elseif ($_POST['action'] == 'add') {
            $username = $conn->real_escape_string($_POST['username']);
            $licence = $conn->real_escape_string($_POST['licence']);
            $phone = $conn->real_escape_string($_POST['phone']);
            $sql = "INSERT INTO driver (name, Licence, contact) VALUES ('{$username}', '{$licence}', '{$phone}')";
            if ($conn->query($sql) === TRUE) {
                $message = "<div class='alert alert-success' role='alert'>New driver added successfully</div>";
            } else {
                $message = "<div class='alert alert-danger' role='alert'>Error: " . $sql . "<br>" . $conn->error . "</div>";
            }
        }
    }
}

// Fetch Drivers Data
$drivers = [];
$sql = "SELECT * FROM driver";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $drivers[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="bootstrap.min.css" />
    <script src="bootstrap.bundle.min.js"></script>
    <title>Driver Management</title>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark min-vh-100" style="width: 280px;">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span class="fs-4">Dashboard</span>
            </a>
            <hr />
            <ul class="nav nav-pills flex-column mb-auto">
                <li><a href="admin_dashbord.html" class="nav-link text-white">Home</a></li>
                <li><a href="admin_passenger.html" class="nav-link text-white">Passenger</a></li>
                <li><a href="admin_driver.php" class="nav-link active text-white" aria-current="page">Driver</a></li>
                <li><a href="admin_bus.html" class="nav-link text-white">Bus</a></li>
                <li><a href="#" class="nav-link text-white">Schedule</a></li>
                <li><a href="#" class="nav-link text-white">Route</a></li>
            </ul>
            <hr />
        </div>
        <!-- Sidebar ends -->

        <!-- Main content -->
        <div id="content-wrapper" class="d-flex flex-column flex-grow-1">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <h1>Driver Management</h1>
                    <button class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#addDriverModal">Add Driver</button>
                </div>

                <?php if (isset($message)) echo $message; ?>

                <table class="table table-striped table-bordered mt-4">
                    <thead>
                        <tr>
                            <th scope="col">Driver ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Licence Number</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($drivers as $driver): ?>
                            <tr>
                                <td><?php echo $driver['driver_id']; ?></td>
                                <td><?php echo htmlspecialchars($driver['name']); ?></td>
                                <td><?php echo htmlspecialchars($driver['Licence']); ?></td>
                                <td><?php echo htmlspecialchars($driver['contact']); ?></td>
                                <td>
                                    <form method="POST" action="admin_driver.php" style="display:inline;">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="driver_id" value="<?php echo $driver['driver_id']; ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    <button class="btn btn-warning btn-sm">Edit</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal for Adding Driver -->
    <div class="modal fade" id="addDriverModal" tabindex="-1" aria-labelledby="addDriverModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDriverModalLabel">Add Driver</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="admin_driver.php">
                        <input type="hidden" name="action" value="add">
                        <div class="mb-3">
                            <label for="username" class="form-label">Name</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="licence" class="form-label">Licence</label>
                            <input type="text" class="form-control" id="licence" name="licence" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Driver</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
