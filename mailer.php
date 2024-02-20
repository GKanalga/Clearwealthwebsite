<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $number = $_POST['number'];
    $message = $_POST['message'];

    // Basic validation, you may want to add more robust validation
    if (empty($name) || empty($number) || empty($message)) {
        die("All fields must be filled out");
    }

    // Anti-spam: Check if the form was submitted from the same domain
    if (strpos($_SERVER['HTTP_REFERER'], $_SERVER['SERVER_NAME']) === false) {
        die("Error: Invalid form submission");
    }

    // Replace 'your_email@example.com' with the actual email address where you want to receive messages
    $to = 'info@clearwealth.ch';
    $subject = 'New Contact Form Submission';

    // Additional headers for sender info
    $headers = "From: mailer@clearwealth.ch\r\n"; // Replace with your desired sender address
    $headers .= "Reply-To: $number\r\n";

    // Email content
    $emailContent = "Name: $name\nNumber: $number\nMessage: $message";

    // Send the email
    $success = mail($to, $subject, $emailContent, $headers);

    if ($success) {
        // You can add more logic here, e.g., redirect the user to a thank you page
        echo "Thank you! Your message has been sent.";
    } else {
        echo "Error: Unable to send the email.";
    }
} else {
    // Redirect or show an error if the form was not submitted
    die("Error: Form not submitted");
}
?>
