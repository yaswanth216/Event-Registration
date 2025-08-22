<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login | IEEE I4C 2025</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f0f4f8;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-container {
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 400px;
    }

    h2 {
      text-align: center;
      margin-bottom: 24px;
      color: #333;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      margin-bottom: 16px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
    }

    button {
      width: 100%;
      padding: 12px;
      background: #0056b3;
      border: none;
      border-radius: 6px;
      color: white;
      font-size: 16px;
      cursor: pointer;
    }

    button:hover {
      background: #004299;
    }

    .note {
      text-align: center;
      margin-top: 12px;
      font-size: 14px;
      color: #666;
    }

  </style>
</head>
<body>

  <div class="login-container">
    <h2>IEEE I4C 2025 Admin Login</h2>
    <em>(Only for Admins)</em>
    <form  method="POST">
      <input type="text" name="email" placeholder="Enter your Email or username" required>
      <input type="password" name="pwd" placeholder="Enter your Password" required>
      <button type="submit" name="submit">Login</button>
</form>
  </div>

</body>
</html>
<?php
if (isset($_POST['submit'])) {
  
$host="localhost";
$user="root";
$pass="";
$db="db1";
$con=mysqli_connect($host,$user,$pass,$db);
if($con)
 echo "database connected successfully <br>";
    $name=$_POST['email'];
    $password=$_POST['pwd'];

    $sql="SELECT uname, name, email, pwd FROM admin WHERE email = '$name' OR uname = '$name'";
    $query=mysqli_query($con,$sql);
    if($query){
  $row = mysqli_fetch_assoc($query);
  $pwd=$row['pwd'];
  if($pwd==$password){
     session_start();
$_SESSION['admin'] = $row['uname'];
$_SESSION['admin_name'] = $row['name'];
header("Location: http://localhost:80/php/i4c/adminpanel.php");
exit;
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "User not found.";
    }
  } ?>
