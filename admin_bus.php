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
        <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark min-vh-100" style="width: 280px">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
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
                    <a href="admin_passenger.html" class="nav-link text-white"> Passenger </a>
                </li>
                <li>
                    <a href="admin_driver.html" class="nav-link text-white"> Driver </a>
                </li>
                <li>
                    <a href="admin_bus.html" class="nav-link text-white active" aria-current="page"> Bus </a>
                </li>
                <li>
                    <a href="#" class="nav-link text-white"> Schedule </a>
                </li>
                <li>
                    <a href="#" class="nav-link text-white"> Route </a>
                </li>
            </ul>
            <hr />
        </div>
        <!-- sidebar ends -->

        <!-- dashboard content -->
        <div id="content-wrapper" class="d-flex flex-column flex-grow-1">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="mt-4">Bus</h1>
                    <button class="btn btn-primary ms-auto">Add Bus</button>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table table-striped table-bordered table-hover" id="passengers-table">
                        <thead>
                            <tr>
                                <th scope="col">Bus NO</th>
                                <th scope="col">Manufatureer</th>
                                <th scope="col">Type</th>
                                <th scope="col">Seat</th>
                                <th scope="col">Status</th>
                                <th scope="col">Route</th>
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
    </div>

    <!-- Bootstrap JS (optional, for dropdowns, modals, etc.) -->
    <script src="bootstrap.bundle.min.js"></script>
</body>
</html>
