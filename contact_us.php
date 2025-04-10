<?php
    $db_hostname = "localhost";
    $db_username = "root";
    $db_password = "admin";
    $db_name = "toursandtravels";
    $db_port = 3306; // Default MySQL port

    $conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);
    if (!$conn) {
        echo "Connection Failed: ", mysqli_connect_error();
        exit;
    }

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Use prepared statements to prevent SQL injection
    $sql = "INSERT INTO contact (Name, Email, Phone, Subject, Message) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $phone, $subject, $message);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo "We will contact you soon";
        } else {
            echo "Error: ", mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: ", mysqli_error($conn);
    }

    mysqli_close($conn);
?>