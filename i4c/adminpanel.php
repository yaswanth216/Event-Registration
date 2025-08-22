<?php
session_start();

if (!isset($_SESSION['admin_name'])) {
    header("Location: http://localhost:80/php/i4c/admin.php"); 
    exit;
}


$adminName = $_SESSION['admin_name'];
$host = "localhost";
$user = "root";
$pass = "";
$db = "db1";

$con = new mysqli($host, $user, $pass, $db);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}


$sql = "SELECT COUNT(*) AS total FROM i4c";
$count = mysqli_query($con,$sql);
$count = mysqli_fetch_assoc($count);
 $count = $count['total'];

$sql = "SELECT * FROM i4c ORDER BY id DESC";
$result = mysqli_query($con,$sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        th { background-color: #f4f4f4; }
        h2, h3 { margin-bottom: 10px; }
    body {
        font-family: Arial;
        padding: 20px;
        margin: 0;
    }
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .logout-btn {
        background-color: #f44336;
        color: white;
        border: none;
        padding: 8px 16px;
        font-size: 14px;
        cursor: pointer;
        border-radius: 5px;
        text-decoration: none;
    }
    .logout-btn:hover {
        background-color: #d32f2f;
    }
    table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 15px;
    }
    th, td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: center;
    }
    th {
        background-color: #f4f4f4;
    }
</style>

    
</head>
<body>
    <div class="header">
    <h2>Welcome Mr. <?php echo htmlspecialchars($adminName); ?>!</h2>
    <form action="http://localhost:80/php/i4c/logout.php" method="post">
        <button type="submit" class="logout-btn">Logout</button>
    </form>
</div>
    <h3>Total Registrations: <?php echo $count; ?></h3>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Payment ID</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['Id']; ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['phone']); ?></td>
                    <td><?php echo htmlspecialchars($row['payment_id']); ?></td>
                </tr>
             <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No registrations found.</p>
    <?php endif; ?>

</body>
</html>

<?php
$con->close();
?>
