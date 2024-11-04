<?php
// Initialize variables to hold form data
$name = $email = $phone = $subject = $message = '';
$errors = [];

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $name = trim($_POST['name']);
    if (empty($name)) {
        $errors[] = 'Name is required.';
    }

    $email = trim($_POST['email']);
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'A valid email is required.';
    }

    $phone = trim($_POST['phone']);
    if (empty($phone)) {
        $errors[] = 'Phone number is required.';
    } else {
        // Validate phone format (you can adjust the regex as needed)
        if (!preg_match('/^(\(\d{3}\)\s?|\d{3}[-.\s]?)(\d{3}[-.\s]?)\d{4}$/', $phone)) {
            $errors[] = 'Please enter a valid phone number (e.g., 123-456-7890, (123) 456-7890).';
        }
    }

    $subject = trim($_POST['subject']);
    if (empty($subject)) {
        $errors[] = 'Reason for contact is required.';
    }

    $message = trim($_POST['message']);
    if (empty($message)) {
        $errors[] = 'Message is required.';
    }

    // If there are no errors, proceed to send the email
    if (empty($errors)) {
        // Prepare the email
        $to = 'izak15xv@gmail.com'; // Replace with your email address
        $email_subject = "Contact Form Submission: $subject";
        $email_body = "Name: $name\nEmail: $email\nPhone: $phone\n\nMessage:\n$message";

        // Set headers
        $headers = "From: $name <$email>\r\n";
        $headers .= "Reply-To: $email\r\n";

        // Send email
        if (mail($to, $email_subject, $email_body, $headers)) {
            // Redirect or show a success message
            echo "Thank you for your message, $name! We will get back to you shortly.";
        } else {
            echo "There was a problem sending your message. Please try again later.";
        }
    } else {
        // Display errors
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>";
    }
} else {
    // If not a POST request, redirect or show an error
    echo "Invalid request.";
}
?>
