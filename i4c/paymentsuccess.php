<?php
// Show errors (for debugging – remove on production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
header('Content-Type: application/json');

// Import PHPMailer classes
require('PHPMailer/src/PHPMailer.php');
require('PHPMailer/src/SMTP.php');
require('PHPMailer/src/Exception.php');
use PHPMailer\PHPMailer\PHPMailer;

// Get payment details from frontend
$data = json_decode(file_get_contents('php://input'), true);
$payment_id = $data['payment_id'] ?? null;

if (!$payment_id) {
    echo json_encode(['success' => false, 'message' => 'Invalid payment ID']);
    exit;
}

// Get session details (from registration form)
$name = $_SESSION['fullName'] ?? '';
$email = $_SESSION['email'] ?? '';
$phone = $_SESSION['phone'] ?? '';
$order_id = $_SESSION['order_id'] ?? '';

if (!$name || !$email || !$phone) {
    echo json_encode(['success' => false, 'message' => 'Session data missing']);
    exit;
}

// Connect to Database
$con = new mysqli("localhost", "root", "", "db1");

if ($con->connect_error) {
    echo json_encode(['success' => false, 'message' => 'DB Connection Failed']);
    exit;
}

// Insert data into DB
$stmt = $con->prepare("INSERT INTO i4c (name, email, phone, payment_id) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $phone, $payment_id);
$stmt->execute();
$Id = $stmt->insert_id;
$stmt->close();
$con->close();

// Setup PHPMailer
$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; 
    $mail->SMTPAuth = true;
    $mail->Username = 'yourgmail@gmail.com'; // 👉 Your Gmail
    $mail->Password = 'your_app_password';   // 👉 Gmail App Password
    $mail->SMTPSecure = 'tls'; 
    $mail->Port = 587;

    $mail->setFrom('yourgmail@gmail.com', 'IEEE I4C 2025');
    $mail->addAddress($email, $name);
    $mail->isHTML(true);
    $mail->Subject = "I4C 2025 Registration Confirmation";

    $mail->Body = "
    Dear $name,<br><br>

    ✅ Thank you for registering for <strong>IEEE IES Industrial Innovation Conclave (I4C) 2025</strong>!<br><br>

    <strong>Your Registration ID:</strong> I4C2025-$Id<br><br>

    📅 <strong>Dates:</strong> 06–07 August 2025<br>
    📍 <strong>Venue:</strong> Vivanta by Taj, Begumpet, Hyderabad, India<br>
    🎯 <strong>Theme:</strong> AI Frontiers – Pioneering Intelligent Solutions in Industry<br><br>

    <strong>Event Highlights:</strong><br>
    • Keynote Sessions by Global Leaders<br>
    • Expert Talks on AI Applications across Industries<br>
    • Hands-on Workshops (MATLAB & EDGE Devices)<br>
    • AI Design Contest (priority for students)<br>
    • Speed Mentoring with Experts<br>
    • Networking with Industry Leaders<br><br>

    <a href='https://www.google.com/calendar/render?action=TEMPLATE&text=IEEE+I4C+2025&dates=20250805T130000Z/20250806T190000Z&details=Join+us+for+I4C+2025+at+Vivanta+by+Taj%2C+Begumpet.&location=Vivanta+by+Taj%2C+Begumpet&sf=true&output=xml' 
    style='display:inline-block;padding:10px 20px;background:#007bff;color:#fff;text-decoration:none;border-radius:5px;'>
     📌 Add to Google Calendar
    </a><br><br>

    For queries, reply to this email.<br><br>

    Warm regards,<br>
    <strong>IEEE I4C 2025 Team</strong>
    ";

    $mail->send();

    echo json_encode(['success' => true, 'message' => 'Registration successful, email sent!']);

} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Mail Error: ' . $mail->ErrorInfo]);
}
?>
