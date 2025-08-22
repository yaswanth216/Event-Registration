<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "db1";

    $con = mysqli_connect($host, $user, $pass, $db);
    if ($con) {
        echo "Database connected successfully <br>";

        $name = $_POST['fullName'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $sql = "INSERT INTO i4c (name, phone, email) VALUES ('$name', '$phone', '$email')";
        $query = mysqli_query($con, $sql);

        if ($query) {
            $id = mysqli_insert_id($con); 

            $mail = new PHPMailer(true);

            try {
                // SMTP configuration
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'yaswanthvardhan216@gmail.com';
                $mail->Password   = 'fqmrnpbhtgvzkybr'; 
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;

                
                $mail->setFrom('yaswanthvardhan216@gmail.com', 'IEEE I4C 2025');
                $mail->addAddress($email, $name);
                $mail->isHTML(true);
                $mail->Subject = "I4C 2025 Registration Confirmation";

                
                $mail->Body = "
                Dear $name,<br><br>

                Thank you for registering for the <b>IEEE IES Industrial Innovation Conclave (I4C) 2025</b>!<br><br>

                <b>🎟️ Your Registration ID: I4C2025-$id</b><br><br>

                Please keep this ID for future reference. Below are the event details:<br><br>

                <hr>
                📅 <b>Dates:</b> 06–07 August 2025 <br>
                📍 <b>Venue:</b> Vivanta by Taj, Begumpet, Hyderabad, India <br>
                🎯 <b>Theme:</b> AI Frontiers – Pioneering Intelligent Solutions in Industry
                <hr><br>

                <b>✨ Event Highlights:</b><br>
                🔹 Keynote Sessions by Global Leaders <br>
                🔹 Expert Talks on AI Applications across Industries <br>
                🔹 Hands-on Workshops (MATLAB & EDGE Devices) <br>
                🔹 AI Design Contest (priority for student participants) <br>
                🔹 Speed Mentoring – 1-on-1 expert guidance <br>
                🔹 Networking with Industry Leaders <br>
                🔹 Industry Exhibitions & Visits <br><br>

                <b>👤 Featured Speakers:</b><br>
                • Prof. Milos Manic – President, IEEE IES | Fellow IEEE <br>
                • Anuradha Vattem – Smart City Architect, IIIT-H <br>
                • Dr. Balakrishna Pamulaparthy – GE, Hyderabad <br>
                • Sharat Manikonda – Director, Innodatatics <br>
                • Guruprasad Padmanabhan – CEO, Asthra AI <br>
                • Kavinga Upul Ekanayaka – ACCELR, Sri Lanka <br><br>

                <b>🛠️ Workshops:</b><br>
                • MATLAB Hands-on by MathWorks Team <br>
                • Product Demo by Divya Chilukoti, Silicon Labs <br><br>

                <b>🏆 AI Design Contest:</b><br>
                Showcase your innovative AI solutions!<br><br>

                📬 For any queries, reply to this email.<br><br>

                Looking forward to seeing you at I4C 2025!<br><br>

                Warm regards,<br>
                IEEE I4C 2025 Team <br>
                yaswanthvardhan216@gmail.com
                ";

                $mail->send(); // ✅ Send the email
                header("Location: thankyou.html");
                exit();

            } catch (Exception $e) {
                echo "Mail could not be sent. Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "Error inserting data: " . mysqli_error($con);
        }

        mysqli_close($con);
    } else {
        echo "Database connection failed!";
    }
}
?>
