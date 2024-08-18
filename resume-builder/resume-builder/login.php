<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        label,h3{
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }
        .card{
            background: linear-gradient(to right, #f8cdda, #1d2b64);
            border: 1px solid green;
        }
        .card:hover{
            background-color: lightblue;
            background-size: contain;
            height: 800px;
        }
        body{
            background: linear-gradient(to right, #ff6e7f, #bfe9ff);
        }
    </style>
</head>
<body>
    <br><br><br>
    <div class="container" style="margin-left: 500px">
        <div class="card text-center" style=" height: 600px; width: 450px;" data-aos="zoom-in-up" data-aos-duration="2000">
            <div class="class-body">
                <div class="row">
                    <div class="">
                        <br>
                        <h2 style="color:brown;">USER LOGIN</h2>
                        <hr>
                        <div>
                            <img src="assets/images/login.png" alt="" height="150px" width="150px">
                            <form name="f1" action="" method="POST">
                                <fieldset>
                                    <legend style="color: white;"><br>Login your account</legend>
                                    <p style="color:aliceblue;">Please enter your name and password to log in.</p>
                                    <div class="form-group">
                                        <label for="user">Enter Name:</label>
                                        <input type="text" placeholder="Enter Username" id="user" name="username">
                                    </div>
                                    <div class="form-group form-actions mt-2">
                                        <label for="pass"> Password : &nbsp;</label>
                                        <input type="password" name="password" placeholder="Password" id="pass">
                                        <br><br>
                                    </div>
                                    <div class="form-actions mt-3">
                                        <button type="submit" class="btn btn-primary" name="submit">Login <i class="fa fa-arrow-circle-right"></i></button>
                                    </div>
                                    <br>
                                    <div>
                                        Don't have an account yet?
                                        <a href="registration.php">Create an account</a>
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
    // Database connection
    $servername = "localhost:3308";
    $username = "root";
    $password = "";
    $dbname = "login";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve the username and password from the POST data
        $username = $_POST['username'];
        $password_input = $_POST['password'];
    
        // Sanitize user input to prevent SQL injection
        $username = mysqli_real_escape_string($conn, $username);
    
        // Query to fetch user from database
        $query = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $query);
    
        if ($result) {
            // Check if a user with the given username exists
            if (mysqli_num_rows($result) == 1) {
                // Fetch user data from the result set
                $row = mysqli_fetch_assoc($result);
                $hashed_password = $row['password'];
    
                // Verify the hashed password with the password provided by the user
                if (password_verify($password_input, $hashed_password)) {
                    // Start session
                    session_start();
                    $_SESSION['username'] = $username; // Store username in session variable
                    header("Location: resume.php"); // Redirect to dashboard or profile page
                    exit;
                } else {
                    echo '<script>alert("Invalid username or password");</script>';
                }
            } else {
                echo '<script>alert("Invalid username or password");</script>';
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        mysqli_free_result($result);
    }
    // Close connection
    mysqli_close($conn);
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();

        function validation() {
            var id = document.f1.user.value;
            var ps = document.f1.pass.value;
            if (id.length == "" && ps.length == "") {
                alert("User Name and Password fields are empty");
                return false;
            } else {
                if (id.length == "") {
                    alert("User Name is empty");
                    return false;
                }
                if (ps.length == "") {
                    alert("Password field is empty");
                    return false;
                }
            }
        }
    </script>
</body>
</html>
