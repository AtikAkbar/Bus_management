<?php
include 'connectDB.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="bootstrap.min.css" />
  <title>Dashboard</title>
</head>

<body>
  <div class="d-flex" id="wrapper">
    <!-- sidebar -->
    <div
      class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark min-vh-100"
      style="width: 280px">
      <a
        href="/"
        class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <svg class="bi pe-none me-2" width="40" height="32">
          <use xlink:href="#bootstrap"></use>
        </svg>
        <span class="fs-4">Dashboard</span>
      </a>
      <hr />
      <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
          <a href="admin_dashbord.html" class="nav-link text-white"> Home </a>
        </li>
        <li>
          <a href="admin_passenger.html" class="nav-link active text-white" aria-current="page"> Passenger </a>
        </li>
        <li>
          <a href="admin_driver.html" class="nav-link text-white"> Driver </a>
        </li>
        <li>
          <a href="admin_bus.html" class="nav-link text-white"> Bus </a>
        </li>
        <li>
          <a href="#" class="nav-link text-white"> Schedule </a>
        </li>
        <li>
          <a href="#" class="nav-link text-white"> Route </a>
        </li>
      </ul>
      <li>
        <a href="admin_tbooking.php" class="nav-link text-white"> Ticket Booking </a>
      </li>
      <li>
        <a href="logout.php" class="nav-link text-white"> Logout </a>
      </li>
      <hr />
    </div>
    <!-- sidebar ends -->

    <!-- dashboard content -->
    <div id="content-wrapper" class="d-flex flex-column flex-grow-1">
      <div class="container-fluid">
        <h1 class="mt-4">Passenger</h1>
        <table class="table table-striped table-bordered" id="passengers-table">
          <thead>
            <tr>
              <th scope="col">Passenger ID</th>
              <th scope="col">Username</th>
              <th scope="col">Email</th>
              <th scope="col">Phone Number</th>
              <th scope="col">Travel Date</th>
              <th scope="col">Route</th>
              <th scope="col">Bus Number</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <!-- table data will be populated here -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>