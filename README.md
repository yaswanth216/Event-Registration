I4C 2025 – IEEE IES Industrial Innovation Conclave (Website)

A responsive event website for I4C 2025 with registration, Razorpay checkout, and automatic confirmation email (PHPMailer).



✨ Features

Modern, responsive UI (mobile-first, hamburger menu).



Sections: Home, About, Speakers, Schedule, Venue, Register.



Registration form with client-side validation.



Payment via Razorpay checkout.



Post-payment email confirmation via PHPMailer (SMTP).



“Add to Google Calendar” button inside the email.



Basic Admin login page (placeholder).



i4c/

├─ assets/

│  ├─ css/

│  │  └─ style.css                # Main styles (desktop + responsive)

│  ├─ images/

│  │  ├─ i4c.jpg                  # Hero background

│  │  ├─ vivanta.jpg              # Venue image

│  │  ├─           #your images

│  └─ js/

│     └─ main.js                  # Smooth scroll + active section + menu toggles

│

├─ PHPMailer/                      # (Only if installing PHPMailer manually)

│  └─ src/

│     ├─ PHPMailer.php

│     ├─ SMTP.php

│     └─ Exception.php

│

│

├─ index.html                      # Landing page (Hero, About, Speakers, Schedule, Venue, Register)

├─ register.html                   # Registration form -> calls startpayment.php

├─ thankyou.html                   # Shown after successful payment \& email

├─ admin.php                       # Admin login page (placeholder)

├─ logout.php                      # Session/logout redirect to index.html

│

├─ startpayment.php                # Creates Razorpay order; stores form data in session; launches checkout

├─ paymentSuccess.php              # Verifies payment; writes to DB; sends email via PHPMailer; returns JSON

├─ register.php                    # (Optional earlier flow) Direct form handler if not using Razorpay





###### **Download PHPMailer(for local host running)**



STEP 1

•  Go to: https://github.com/PHPMailer/PHPMailer

•  Click "Code" → "Download ZIP"

•  Extract it into your project folder 



STEP 2: Enable SMTP on Gmail

If you're using Gmail:

1\.	Enable 2-Step Verification on your Gmail.

2\.	Generate App Password

3\.	enter ‘Mail’, then copy the 16-character app password.

4\.	Use this app password in your code instead of your Gmail password.



###### **Automatic mail in case of hosting:**



Step 1: Create a Brevo Account

1\.	Go to https://www.brevo.com/

2\.	Sign up for a free account.

3\.	Verify your email address and complete your profile.

Step 2: Set Up SMTP in Brevo

1\.	Once logged in, go to SMTP \& API from the top-right menu (under your name).

2\.	Click SMTP tab.

3\.	You’ll find:

o	SMTP server: smtp-relay.brevo.com

o	Port: 587 (or 465 for SSL)

o	Your SMTP login (usually your Brevo email)

o	Generate an SMTP password by clicking Create a new SMTP key.

Copy the login and password for later use.

Update Your PHP Code

$mail->Host       = 'smtp-relay.brevo.com';

&nbsp;   $mail->SMTPAuth   = true;

&nbsp;   $mail->Username   = 'your-brevo-email@example.com'; // your Brevo email

&nbsp;   $mail->Password   = 'your-generated-smtp-password'; // SMTP password

&nbsp;   $mail->SMTPSecure = PHPMailer::ENCRYPTION\_STARTTLS;

&nbsp;   $mail->Port       = 587;

###### 

###### **🛠️ Database Setup**



We use two databases:



i4c → stores participant registration details



admin → stores administrator login details

**📌 Features**
---

Event information pages (Home, About, Speakers)



Registration form



Payment integration



Stores user details into MySQL



Sends confirmation email with registration ID





**For any further assistance, please contact: yaswanthvardhan216@gmail.com**



