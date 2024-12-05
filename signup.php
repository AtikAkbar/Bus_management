<?php
include 'connectDB.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    // Validate input (you can add more validation as needed)
    if (empty($firstName) || empty($lastName) || empty($email) || empty($phone) || empty($password)) {
        echo "All fields are required.";
    } else {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO sign_up (first_name, last_name, email, phone, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $firstName, $lastName, $email, $phone, $password);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Signup successful!";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>

    <!-- nav start -->
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
                <a class="nav-link active text-white" aria-current="page" href="signup.php">Signup</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="login.php">Login</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- nav end -->
    <main>
        <!-- signup form -->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card p-4 mx-auto my-5 shadow" style="max-width: 400px;">
                        <div class="signup-form">
                            <h2 class="text-center">Signup</h2>
                            <br>
                            <form method="POST" action="">
                                <div class="mb-3">
                                    <label for="firstName" class="form-label">First Name</label>
                                    <input type="text" name="firstName" class="form-control" id="firstName" placeholder="John" required>
                                </div>
                                <div class="mb-3">
                                    <label for="lastName" class="form-label">Last Name</label>
                                    <input type="text" name="lastName" class="form-control" id="lastName" placeholder="Doe" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="tel" name="phone" class="form-control" id="phone" placeholder="Phone" required>
                                </div>
                                < <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                                    <input type="password" name="confirmPassword" class="form-control" id="confirmPassword" placeholder="Confirm Password" required>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary btn-block d-block mx-auto w-100">Signup</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- signup form end -->
    </main>

    <footer class="bg-dark text-white text-center">
        <p class="mb-0">&copy; Atik Akbar</p>
    </footer>
    <script src="bootstrap.bundle.min.js"></script>
</body>
</html>