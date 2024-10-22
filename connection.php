<?php
// Database connection details (replace with your actual credentials)
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

// Define variables for error and success messages
$error_msg = "";
$success_msg = "";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Check if all required fields are set
  if (!isset($_POST['full_name'], $_POST['blood_group'], $_POST['gender'],
              $_POST['year'], $_POST['month'], $_POST['date'],
              $_POST['email'], $_POST['contact_no'], $_POST['password'])) {
    $error_msg = "Error: Please fill out all required fields.";
  } else {
    // Prepare and bind parameters
    $stmt = $conn->prepare("INSERT INTO donors (full_name, blood_group, gender, date_of_birth, email, contact_no, city, password, agree_to_donate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $full_name, $blood_group, $gender, $date_of_birth, $email, $contact_no, $city, $password, $agree_to_donate);
       // Set parameters and execute
    
    $full_name = $_POST['full_name'];
    $blood_group = $_POST['blood_group'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['year'] . "-" . $_POST['month'] . "-" . $_POST['date']; // Assuming separate fields
    $email = $_POST['email'];
    $contact_no = $_POST['contact_no'];
    $city = $_POST['city'] ?? null; // City may not be required
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $agree_to_donate = isset($_POST['term']) ? 1 : 0; // Checkbox name assumed as 'term'

    if ($stmt->execute() === TRUE) {
        echo "Record inserted successfully.";
        header("Location: signin.php"); 
        echo "<script>
        document.getElementById('show').innerHTML='entered';
        </script>
        ";
        
    } else {
        echo "Error: " . $stmt->error;
    }
    
  }
}

?>
