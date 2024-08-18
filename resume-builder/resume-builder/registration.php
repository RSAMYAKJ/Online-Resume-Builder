<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        label, h3 {
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }
        .card {
            background-image: linear-gradient(to bottom right, lightblue, beige);
            border: 1px solid green;
        }
        .card:hover {
            background-color: lightblue;
            background-size: contain;
            height: 800px;
        }
        body{
            background: linear-gradient(to right, #f1f2b5, #135058);
        }
    </style>
</head>
<body>
    <br><br><br>
    <div class="container" >
        <div class="card text-center" style="height: 650px; width: 450px;margin-left:auto;margin-right:auto;padding:20px">
            <div class="class-body">
                <div class="row">
                    <div class="">
                        <h2 style="color: blueviolet;">USER REGISTRATION</h2>
                        <hr>
                        <div>
                            <img src="assets/images/login.png" alt="" height="150px" width="150px">
                            <form name="f1" action="" method="POST">
                                <fieldset>
                                    <legend><br>Register your account</legend>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Enter Username" id="username" name="username" required>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Enter Password" id="password" name="password" required>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Confirm Password" id="confirm_password" name="confirm_password" required>
                                    </div>
                                    <br>
                                    <div class="form-actions mt-3">
                                        <button type="submit" class="btn btn-primary" name="submit">Register <i class="fa fa-arrow-circle-right"></i></button>
                                    </div>
                                    <br>
                                    <div>
                                        Already have an account?
                                        <a href="login.php">Login</a>
                                    </div>
                                </fieldset>
                            </form>
                            <br><br><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    $servername = "localhost:3308";
    $username = "root";
    $password = "";
    $dbname = "login";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if ($password != $confirm_password) {
            echo '<script>alert("Passwords do not match");</script>';
        } else {
            $username = mysqli_real_escape_string($conn, $username);
            $password = mysqli_real_escape_string($conn, $password);

            $check_query = "SELECT * FROM users WHERE username='$username'";
            $check_result = mysqli_query($conn, $check_query);
            if (mysqli_num_rows($check_result) > 0) {
                echo '<script>alert("Username already exists. Please choose a different username.");</script>';
            } else {
                $hpassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

                $insert_query = "INSERT INTO users (username, password) VALUES ('$username', '$hpassword')";
                if (mysqli_query($conn, $insert_query)) {
                    echo '<script>alert("Registration successful. You can now login.");</script>';
                } else {
                    echo '<script>alert("Error: ' . mysqli_error($conn) . '");</script>';
                }
            }
        }
    }

    mysqli_close($conn);
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
