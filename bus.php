<?php
include 'connectDB.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Your Bus Ticket Online</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <style>
        .container {
            max-width: 800px;
        }
        .table {
            margin-top: 20px;
        }
        .table th {
            text-align: center;
        }
        .table td {
            text-align: center;
        }
    </style>
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
                <a class="nav-link active text-white" aria-current="page" href="index.html">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="signup.html">Signup</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="login.html">Login</a>
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

        <section>
            <div class="container">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Bus</th>
                            <th>Deperture Time</th>
                            <th>Arrival Time</th>
                            <th>Seats Available</th>
                            <th>Price</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Dha-BA-12-0345</td>
                            <td>10:00 AM</td>
                            <td>05:00 PM</td>
                            <td>35</td>
                            <td>700</td>
                            <td><button class="btn btn-primary">View Seats</button></td>
                        </tr>
                        <tr>
                            <td>Dha-BA-37-0595</td>
                            <td>07:30 AM</td>
                            <td>01:00 PM</td>
                            <td>20</td>
                            <td>1000</td>
                            <td><button class="btn btn-primary">View Seats</button></td>
                        <tr>
                            <td>Dha-BA-12-0345</td>
                            <td>10:00 AM</td>
                            <td>05:00 PM</td>
                            <td>35</td>
                            <td>700</td>
                            <td><button class="btn btn-primary">View Seats</button></td>
                        </tr>
                        <tr>
                            <td>Dha-BA-37-0595</td>
                            <td>07:30 AM</td>
                            <td>01:00 PM</td>
                            <td>20</td>
                            <td>1000</td>
                            <td><button class="btn btn-primary">View Seats</button></td>
                        <tr>
                            <td>Dha-BA-12-0345</td>
                            <td>10:00 AM</td>
                            <td>05:00 PM</td>
                            <td>35</td>
                            <td>700</td>
                            <td><button class="btn btn-primary">View Seats</button></td>
                        </tr>
                        <tr>
                            <td>Dha-BA-37-0595</td>
                            <td>07:30 AM</td>
                            <td>01:00 PM</td>
                            <td>20</td>
                            <td>1000</td>
                            <td><button class="btn btn-primary">View Seats</button></td>
                        <tr>
                            <td>Dha-BA-12-0345</td>
                            <td>10:00 AM</td>
                            <td>05:00 PM</td>
                            <td>35</td>
                            <td>700</td>
                            <td><button class="btn btn-primary">View Seats</button></td>
                        </tr>
                        <tr>
                            <td>Dha-BA-37-0595</td>
                            <td>07:30 AM</td>
                            <td>01:00 PM</td>
                            <td>20</td>
                            <td>1000</td>
                            <td><button class="btn btn-primary">View Seats</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <footer class="bg-dark text-white text-center">
        <p class="mb-0">&copy; Atik Akbar</p>
    </footer>
    <script src="bootstrap.bundle.min.js"></script>
</body>
</html>

