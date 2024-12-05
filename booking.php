<?php
session_start(); // Start the session

// Check if the user is logged in by checking if the session variable is set
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to the login page
    header("Location: index.php");
    exit();
}

// Access session data
$userId = $_SESSION['user_id'];
$firstName = $_SESSION['first_name'];
$lastName = $_SESSION['last_name'];
$email = $_SESSION['email'];
$phone = $_SESSION['phone'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Page</title>
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
                <a class="nav-link text-white" href="signup.php">Signup</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="logout.php">Logout</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- nav end -->
    
    <main class="min-vh-100">
        <!-- signup form -->
        
        <section class="my-lg-5">
            <div class="row justify-content-center">
              <div class="col-md-6 col-lg-4">
                <div class="card">
                  <div class="card-body">
                    <h1 class="text-center">Book Your Bus Ticket</h1>
                    <br>    
                    <form>
                      <div class="form-group mb-2">
                        <label for="from">From:</label>
                        <select class="form-control" id="from">
                          <option value=""></option>
                          <option value="Dhaka">Dhaka</option>
                          <option value="Chittagong">Chittagong</option>
                          <option value="Khula">Khula</option>
                          <option value="Sylhet">Sylhet</option>
                        </select>
                      </div>
                      <div class="form-group mb-2">
                        <label for="to">To:</label>
                        <select class="form-control" id="to">
                            <option value=""></option>
                            <option value="Dhaka">Dhaka</option>
                            <option value="Chittagong">Chittagong</option>
                            <option value="Khula">Khula</option>
                            <option value="Sylhet">Sylhet</option>
                          </select>
                      </div>
                      <div class="form-group mb-2">
                        <label for="date">Date:</label>
                        <input type="date" class="form-control" id="date" />
                      </div>
                      <br> 
                      <button type="submit" class="btn btn-primary btn-block d-block mx-auto w-100">Find Buses</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </section>
        <!-- signup form end -->
    </main>

    <footer class="bg-dark text-white text-center">
        <p class="mb-0">&copy; Atik Akbar</p>
    </footer>
    <script src="bootstrap.bundle.min.js"></script>
</body>
</html>

