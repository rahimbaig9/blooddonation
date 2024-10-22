<?php 
//include header file
include ('include/header.php');

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lifelink";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize error message
$error_msg = "";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['SignIn'])) {
    // Get user input
    $email_phone = $_POST['email_phone'];
    $password = $_POST['password'];

    // Query the database
    $sql = "SELECT * FROM donors WHERE (email = '$email_phone' OR contact_no = '$email_phone') AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows >=0) {
        // User exists and credentials match
        // Redirect to dashboard or desired page
        header("Location: index.php");
        exit();
    } else {
        // No matching user found
        $error_msg = "Invalid email/phone or password. Please try again.";
    }
}
?>

<style>
    /* Your existing CSS styles */
</style>

<div class="container-fluid red-background size">
    <!-- Your existing HTML content -->
</div>

<div class="container size">
    <div class="row">
        <div class="col-md-6 offset-md-3 form-container">
            <h3>SignIn</h3>
            <hr class="red-bar">
            <!-- Error Messages -->
            <?php if (!empty($error_msg)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error_msg; ?>
                </div>
            <?php endif; ?>
            
            <!-- Sign-in Form -->
            <form action="" method="post">
                <div class="form-group">
                    <label for="email">Email/Phone no.</label>
                    <input type="text" name="email_phone" class="form-control" placeholder="Email Or Phone" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Password" required class="form-control">
                </div>
                <div class="form-group">
                    <button class="btn btn-danger btn-lg center-aligned" type="submit" name="SignIn">SignIn</button> <br>
					<p class="text-center">Do you need to register?</p>
                    <a href="donate.php" class="btn btn-success btn-lg center-aligned">SignUp</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'include/footer.php' ?>
