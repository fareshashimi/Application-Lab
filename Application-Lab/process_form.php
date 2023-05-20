<?php
// Validate and process the form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate the form data
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $gender = $_POST["gender"];
    
    $errors = array();
    
    // Validate full name
    if (empty($full_name)) {
        $errors[] = "Full name is required";
    }
    
    // Validate email address
    if (empty($email)) {
        $errors[] = "Email address is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address";
    }
    
    // If there are errors, display them
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>Error: $error</p>";
        }
    } else {
        // Connect to the MySQL database
        $servername = "localhost";
        $username = "your_username";
        $password = "your_password";
        $database = "your_database";
        
        $conn = new mysqli($servername, $username, $password, $database);
        
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        // Insert data into the database
        $sql = "INSERT INTO students (full_name, email, gender) VALUES ('$full_name', '$email', '$gender')";
        
        if ($conn->query($sql) === TRUE) {
            echo "<p>Registration successful!</p>";
        } else {
            echo "<p>Error: " . $conn->error . "</p>";
        }
        
        // Close the database connection
        $conn->close();
    }
}
?>
