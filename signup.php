<?php
// Database connection details
$servername = "localhost:5222";
$db_username = "root";
$db_password = "";
$dbname = "Bus_management";

// Initialize variables
$first_Name = "";
$last_Name = "";
$form_username = "";
$password1 = "";
$Confirm_Password = "";
$email = "";
$phone = "";
$errorMessage = "";
$succesMessage = "";

// Create a connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_Name = $_POST["first_Name"] ?? '';
    $last_Name = $_POST["last_Name"] ?? '';
    $form_username = $_POST["username"] ?? '';
    $password1 = $_POST["password1"] ?? '';
    $Confirm_Password = $_POST["Confirm_Password"] ?? '';
    $email = $_POST["email"] ?? '';
    $phone = $_POST["phone"] ?? '';

    do {
        // Validation
        if (
            empty($first_Name) || empty($last_Name) || empty($form_username)
            || empty($password1) || empty($Confirm_Password) || empty($email) || empty($phone)
        ) {
            $errorMessage = "All fields are required.";
            break;
        }

        if ($password1 !== $Confirm_Password) {
            $errorMessage = "Passwords do not match!";
            break;
        }

        // Hash the password before storing
        $hashed_password = password_hash($password1, PASSWORD_DEFAULT);

        // SQL query to insert data into signup table
        $sql = "INSERT INTO signup (first_name, last_name, user_name, password2, email, phone) 
                VALUES (?, ?, ?, ?, ?, ?)";

        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $first_Name, $last_Name, $form_username, $hashed_password, $email, $phone);

        // Execute the statement
        if ($stmt->execute()) {
            $succesMessage = "User registered successfully!";

            // Clear input fields after successful submission
            $first_Name = "";
            $last_Name = "";
            $form_username = "";
            $password1 = "";
            $Confirm_Password = "";
            $email = "";
            $phone = "";
        } else {
            $errorMessage = "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();

    } while (false);
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
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card p-4 mx-auto my-5 shadow" style="max-width: 400px;">
                        <h2 class="text-center">Signup</h2>
                        <?php
                        if (!empty($errorMessage)) {
                            echo "
                            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                <strong>$errorMessage</strong>
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>
                            ";
                        }
                        if (!empty($succesMessage)) {
                            echo "
                            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>$succesMessage</strong>
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>
                            ";
                        }
                        ?>
                        <form method="post">
                            <!-- Input fields -->
                            <div class="mb-3">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName" name="first_Name" value="<?php echo htmlspecialchars($first_Name); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" name="last_Name" value="<?php echo htmlspecialchars($last_Name); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($form_username); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password1">
                            </div>
                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirmPassword" name="Confirm_Password">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block d-block mx-auto w-100">Signup</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="bootstrap.bundle.min.js"></script>
</body>

</html>
