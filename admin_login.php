<?php
session_start(); // Start the session
include 'connectDB.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate input
    if (empty($username) || empty($password)) {
        $error = "Email and password are required.";
    } else {
        // Prepare and execute the query
        $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if a user was found
        if ($result->num_rows > 0) {
            // Fetch user details
            $user = $result->fetch_assoc();

            // Store user details in session variables
            // $_SESSION['user_id'] = $user['signup_id']; // Assuming signup_id is the primary key
            // $_SESSION['first_name'] = $user['first_name'];
            // $_SESSION['last_name'] = $user['last_name'];
            // $_SESSION['email'] = $user['email'];
            // $_SESSION['phone'] = $user['phone'];

            // User is valid, redirect to booking.php
            header("Location: admin_dashbord.php");
            exit();
        } else {
            $error = "Invalid username or password.";
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
  <title>Login Page</title>
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
            <a class="nav-link active text-white" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="signup.php">Signup</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="login.php">Admin</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- nav end -->
  <main>
    <section class="text-center my-lg-5">
      <h1 class="display-4">Book Your Bus Ticket Online</h1>
      <p class="lead">Easy and convenient way to book your bus ticket</p>
    </section>
    <!-- login form -->
    <div class="container p-lg-5">
      <div class="row justify-content-center ">
        <div class="col-md-6">

          <div class="card-body p-4 mx-auto my-auto shadow" style="max-width: 400px;">
            <div class="signup-form">
              <h2 class="text-center">Admin Login</h2>
              <br>
              <form method="POST">
                <div class="mb-3">
                  <label for="username" class="form-label">Usernae</label>
                  <input type="username" class="form-control" id="username" name="username" placeholder="username">
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <br>
                <button type="submit" class="btn btn-primary btn-block d-block mx-auto w-100">Login</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- login form end -->
  </main>


  <footer class="bg-dark text-white text-center">
    <p class="mb-0">&copy; Atik Akbar</p>
  </footer>
  <script src="bootstrap.bundle.min.js"></script>
</body>

</html>