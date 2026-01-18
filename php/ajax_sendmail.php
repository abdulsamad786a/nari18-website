<?php
/**
 * Contact Form Email Handler
 * Sends email and saves to database as backup
 */

session_start();
include('../includes/config.php');

// Set headers for JSON response
header('Content-Type: application/json');

// Recipient email
$to_email = "richa@nari18.com";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data and sanitize
    $name = isset($_POST['name']) ? htmlspecialchars(strip_tags(trim($_POST['name']))) : '';
    $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
    $phone = isset($_POST['phone']) ? htmlspecialchars(strip_tags(trim($_POST['phone']))) : '';
    $subject = isset($_POST['subject']) ? htmlspecialchars(strip_tags(trim($_POST['subject']))) : 'Contact Form Inquiry';
    $message = isset($_POST['message']) ? htmlspecialchars(strip_tags(trim($_POST['message']))) : '';

    // Validation
    $errors = [];

    if (empty($name)) {
        $errors['name'] = 'Please enter your name.';
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address.';
    }

    if (empty($subject)) {
        $errors['subject'] = 'Please enter a subject.';
    }

    if (empty($message)) {
        $errors['message'] = 'Please enter your message.';
    }

    // If there are validation errors, return them
    if (!empty($errors)) {
        echo json_encode([
            'success' => false,
            'errors' => $errors
        ]);
        exit;
    }

    // Create contact_messages table if not exists
    $createTable = "CREATE TABLE IF NOT EXISTS contact_messages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        phone VARCHAR(50),
        subject VARCHAR(255) NOT NULL,
        message TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        is_read TINYINT(1) DEFAULT 0
    )";
    mysqli_query($con, $createTable);

    // Save to database
    $stmt = $con->prepare("INSERT INTO contact_messages (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $phone, $subject, $message);
    $db_saved = $stmt->execute();
    $stmt->close();

    // Prepare email headers
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: " . $name . " <" . $email . ">" . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";

    // Prepare email subject
    $email_subject = "Nari18 Contact Form: " . $subject;

    // Prepare email body
    $email_body = '
    <!DOCTYPE html>
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background-color: #800020; color: white; padding: 20px; text-align: center; }
            .content { background-color: #f9f9f9; padding: 20px; border: 1px solid #ddd; }
            .field { margin-bottom: 15px; }
            .label { font-weight: bold; color: #800020; }
            .footer { text-align: center; padding: 20px; font-size: 12px; color: #666; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1 style="margin:0;">New Contact Form Submission</h1>
                <p style="margin:5px 0 0 0;">Nari18 Website</p>
            </div>
            <div class="content">
                <div class="field">
                    <span class="label">Name:</span><br>
                    ' . $name . '
                </div>
                <div class="field">
                    <span class="label">Email:</span><br>
                    <a href="mailto:' . $email . '">' . $email . '</a>
                </div>
                <div class="field">
                    <span class="label">Phone:</span><br>
                    ' . ($phone ? $phone : 'Not provided') . '
                </div>
                <div class="field">
                    <span class="label">Subject:</span><br>
                    ' . $subject . '
                </div>
                <div class="field">
                    <span class="label">Message:</span><br>
                    ' . nl2br($message) . '
                </div>
            </div>
            <div class="footer">
                <p>This email was sent from the Nari18 contact form.</p>
                <p>Date: ' . date('F j, Y, g:i a') . '</p>
            </div>
        </div>
    </body>
    </html>';

    // Try to send email
    $mail_sent = @mail($to_email, $email_subject, $email_body, $headers);

    // If saved to database, show success regardless of email status
    if ($db_saved) {
        echo json_encode([
            'success' => true,
            'message' => 'Thank you for contacting us! We have received your message and will get back to you soon.'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Sorry, there was an error saving your message. Please try again or email us directly at richa@nari18.com'
        ]);
    }

} else {
    // If not POST request
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method.'
    ]);
}
?>