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
                    <a href="admin.html" class="nav-link text-white"> Home </a>
                </li>
                <li>
                    <a href="passenger.html" class="nav-link active text-white" aria-current="page"> Passenger </a>
                </li>
                <li>
                    <a href="driver.html" class="nav-link text-white"> Driver </a>
                </li>
                <li>
                    <a href="bus.html" class="nav-link text-white"> Bus </a>
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
                        <?php
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $db = "Bus_management";

                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $db);

                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $sql = "SELECT b.bus_number,p.travel_date, u.user_id,u.phone, u.email, u.name, r.route_name
                            FROM Bus b
                            JOIN Bus_Schedule bs ON b.bus_id = bs.bus_id  
                            JOIN RouteB r ON r.route_id = bs.route_id
                            JOIN Bus_User u ON u.bus_id = b.bus_id
                            JOIN Passenger p ON p.user_id = u.user_id";

                        $result = $conn->query($sql);

                        // Check for query errors
                        if (!$result) {
                            die("Invalid query: " . $conn->error);
                        }

                        while ($row = $result->fetch_assoc()) {
                            echo "
                            <tr>
                                <td>{$row['user_id']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['phone']}</td>
                                <td>{$row['travel_date']}</td>
                                <td>{$row['route_name']}</td>
                                <td>{$row['bus_number']}</td>
                                 <td>
                                    <a class='btn btn-primary btn-sm' href='/bus_management/edit.php'>Edit</a>
                                    <a class='btn btn-primary btn-sm' href='/bus_management/delete.php'>Delete</a>
                                </td>
                               
                            </tr>
                            ";
                        
                        }
                        ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>