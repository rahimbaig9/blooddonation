<?php
include('include/header.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Catalog</title>
</head>
<style>
    .size {
        min-height: 0px;
        padding: 60px 0 40px 0;
    }
    .loader {
        display: none;
        width: 69px;
        height: 89px;
        position: absolute;
        top: 25%;
        left: 50%;
        padding: 2px;
        z-index: 1;
    }
    .loader .fa {
        color: #e74c3c;
        font-size: 52px !important;
    }
    .form-group {
        text-align: left;
    }
    h1 {
        color: white;
    }
    h3 {
        color: #e74c3c;
        text-align: center;
    }
    .red-bar {
        width: 25%;
    }
    span {
        display: block;
    }
    .name {
        color: #e74c3c;
        font-size: 22px;
        font-weight: 700;
    }
    .donors_data {
        background-color: white;
        border-radius: 5px;
        margin: 25px;
        -webkit-box-shadow: 0px 2px 5px -2px rgba(89,89,89,0.95);
        -moz-box-shadow: 0px 2px 5px -2px rgba(89,89,89,0.95);
        box-shadow: 0px 2px 5px -2px rgba(89,89,89,0.95);
        padding: 20px 10px 20px 30px;
    }
</style>
<body>
<div class="container-fluid red-background size">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h1 class="text-center">Search Donors</h1>
            <hr class="white-bar">
            <br>
            <form method="post" class="form-inline text-center" style="padding: 40px 0px 0px 5px;">
    <div class="form-group text-center center-aligned">
        <select style="width: 220px; height: 45px;" name="city" id="city" class="form-control demo-default" required>
            <option value="">-- Select City --</option>
            <!-- Andhra Pradesh -->
            <optgroup label="Andhra Pradesh">
            <optgroup title="Andhra Pradesh" label="&raquo; Andhra Pradesh"></optgroup>
            <option value="Anantapur">Anantapur</option>
            <option value="Chittoor">Chittoor</option>
            <option value="East Godavari">East Godavari</option>
            <option value="Guntur">Guntur</option>
            <option value="Krishna">Krishna</option>
            <option value="Kurnool">Kurnool</option>
            <option value="Prakasam">Prakasam</option>
            <option value="Nandyal">Nandyal</option>
            <option value="Srikakulam">Srikakulam</option>
            <option value="Visakhapatnam">Visakhapatnam</option>
            <option value="Vizianagaram">Vizianagaram</option>
            <option value="West Godavari">West Godavari</option>
            <option value="YSR Kadapa">YSR Kadapa</option>
            <optgroup title="Telangana" label="&raquo; Telangana"></optgroup>
            <option value="Adilabad">Adilabad</option>
            <option value="Bhadradri Kothagudem">Bhadradri Kothagudem</option>
            <option value="Hyderabad">Hyderabad</option>
            <option value="Jagtial">Jagtial</option>
            <option value="Jangaon">Jangaon</option>
            <option value="Jayashankar Bhupalpally">Jayashankar Bhupalpally</option>
            <option value="Jogulamba Gadwal">Jogulamba Gadwal</option>
            <option value="Kamareddy">Kamareddy</option>
            <option value="Karimnagar">Karimnagar</option>
            <option value="Khammam">Khammam</option>
            <option value="Komaram Bheem">Komaram Bheem</option>
            <option value="Mahabubabad">Mahabubabad</option>
            <option value="Mahabubnagar">Mahabubnagar</option>
            <option value="Mancherial">Mancherial</option>
            <option value="Medak">Medak</option>
            <option value="Medchal-Malkajgiri">Medchal-Malkajgiri</option>
            <option value="Nagarkurnool">Nagarkurnool</option>
            <option value="Nalgonda">Nalgonda</option>
            <option value="Nirmal">Nirmal</option>
            <option value="Nizamabad">Nizamabad</option>
            <option value="Peddapalli">Peddapalli</option>
            <option value="Rajanna Sircilla">Rajanna Sircilla</option>
            <option value="Rangareddy">Rangareddy</option>
            <option value="Sangareddy">Sangareddy</option>
            <option value="Siddipet">Siddipet</option>
            <option value="Suryapet">Suryapet</option>
            <option value="Vikarabad">Vikarabad</option>
            <option value="Wanaparthy">Wanaparthy</option>
            <option value="Warangal Rural">Warangal Rural</option>
            <option value="Warangal Urban">Warangal Urban</option>
            <option value="Yadadri Bhuvanagiri">Yadadri Bhuvanagiri</option>
           
            
        </select>
    </div>
    <div class="form-group text-center center-aligned">
        <select style="width: 220px; height: 45px;" name="blood_group" id="blood_group" class="form-control demo-default" required>
            <option value="">-- Select Blood Group --</option>
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
        </select> <br>
    </div>
    <br>
    <div class="form-group center-aligned">
        <button type="submit" class="btn btn-lg btn-default" id="searchBtn">Search</button>
    </div>
</form>

        </div>
    </div>
</div>

<div class="container" style="padding: 60px 0 60px 0;">
    <div class="row" id="searchResults">
        <!-- Display The Search Result -->
    </div>
</div>

<div class="loader" id="wait">
    <i class="fa fa-circle-o-notch fa-spin" aria-hidden="true"></i>
</div>

<?php

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lifelink";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    include ('include/header.php');
    include ('connection.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $city = $_POST['city'];
        $blood_group = $_POST['blood_group'];
        $query = "SELECT * FROM donors WHERE city = '$city' AND blood_group = '$blood_group'";

        // Execute the query
        $result = $conn->query($query);

        // Check if there are any results
        if ($result->num_rows > 0) {
            // Display the search results
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col-md-4 donors_data">';
                echo '<span class="name">' . $row['full_name'] . '</span>';
                echo '<span>Blood Group: ' . $row['blood_group'] . '</span>';
                echo '<span>Email: ' . $row['email'] . '</span>';
                echo '<span>Contact No: ' . $row['contact_no'] . '</span>';
                echo '<span>City: ' . $row['city'] . '</span>';
                echo '</div>';
            }
        } else {
            echo '<div class="col-md-12 text-center">';
            echo '<p>No donors found matching the criteria.</p>';
            echo '</div>';
        }
    }
    $conn->close();
    ?>

<?php 
    //include footer file
    include ('include/footer.php');
?>

</body>
</html>
