<?php
include 'connectDB.php';
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
        <!-- signup form -->
        <div class="container p-lg-5">
            <div class="row justify-content-center ">
                <div class="col-md-6">
                    
                    <div class="card-body p-4 mx-auto my-auto shadow" style="max-width: 400px;">
                        <div class="signup-form">
                            <h2 class="text-center">Admin Login</h2>
                            <br>
                            <form>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="abc@xyz.com">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="Password">
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary btn-block d-block mx-auto w-100">Login</button>
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

