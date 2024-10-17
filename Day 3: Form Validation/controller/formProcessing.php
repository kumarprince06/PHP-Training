<?php
// Start session
session_start();

// include dbconfig file

require_once "../config/dbConfig.php";

// Initialize database connection
$dbConfig = new DatabaseConfiguration();
$conn = $dbConfig->databaseConnection();


// Array for storing errors
$errorArray = array();

// Array for storing form data
$formData = array();

// Checking if submit button is pressed or not
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // Validating username
    if (empty($_POST['userName'])) {
        $errorArray['userNameError'] = "Username is required..!";
    } else {
        $formData['userName'] = $_POST['userName'];
        if (!preg_match("/^[a-zA-Z0-9_]*$/", $_POST['userName'])) {
            $errorArray['userNameError'] = "Only alphabets, numbers, and underscore are allowed for username..!";
        }
    }

    // Validating email
    if (empty($_POST['email'])) {
        $errorArray['emailError'] = "Email is required..!";
    } else {
        $formData['email'] = $_POST['email'];
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errorArray['emailError'] = "Invalid email format..!";
        }
    }

    // Validating contact number
    if (empty($_POST['contact'])) {
        $errorArray['contactError'] = "Contact number is required..!";
    } else {
        $formData['contact'] = $_POST['contact'];
        if (!preg_match("/^[0-9]{10}$/", $_POST['contact'])) {
            $errorArray['contactError'] = "Contact number must be 10 digits..!";
        }
    }

    // Validating gender
    if (empty($_POST['gender'])) {
        $errorArray['genderError'] = "Gender is required..!";
    } else {
        $formData['gender'] = $_POST['gender'];
        if (!in_array($_POST['gender'], ['male', 'female', 'other'])) {
            $errorArray['genderError'] = "Invalid gender selection..!";
        }
    }

    // Validating website URL
    if (empty($_POST['website'])) {
        $errorArray['websiteError'] = "Website is required..!";
    } else {
        $formData['website'] = $_POST['website'];
        if (!filter_var($_POST['website'], FILTER_VALIDATE_URL)) {
            $errorArray['websiteError'] = "Invalid URL format..!";
        }
    }

    // Validating terms and conditions
    if (!isset($_POST['tc'])) {
        $errorArray['tcError'] = "You must accept the terms and conditions..!";
    }

    // Store errors in session if they exist
    if (!empty($errorArray)) {
        $_SESSION['errors'] = $errorArray;
        // Storing form data for re-population
        $_SESSION['formData'] = $formData;
        // Redirect back to the form
        header("Location:../index.php");
        exit();
    } else {

        // Prepare the SQL statement to insert data into the `users` table
        $stmt = $conn->prepare("INSERT INTO users (username, email, contact, gender, website) VALUES (:username, :email, :contact, :gender, :website)");

        // Bind the form data to the SQL statement
        $stmt->bindParam(':username', $formData['userName']);
        $stmt->bindParam(':email', $formData['email']);
        $stmt->bindParam(':contact', $formData['contact']);
        $stmt->bindParam(':gender', $formData['gender']);
        $stmt->bindParam(':website', $formData['website']);

        // Execute the statement
        if ($stmt->execute()) {
            // On success, clear session and redirect with success message
            session_unset();
            header('Location: ../index.php?success=Form submitted successfully');
            exit();
        } else {
            // Handle any errors during the insert operation
            die("Error inserting data");
        }
    }
}
