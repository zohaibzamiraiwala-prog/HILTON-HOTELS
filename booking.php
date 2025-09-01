<?php
require 'db.php';
$hotel_id = isset($_GET['hotel_id']) ? (int)$_GET['hotel_id'] : 0;
$checkin = isset($_GET['checkin']) ? $_GET['checkin'] : '';
$checkout = isset($_GET['checkout']) ? $_GET['checkout'] : '';
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $stmt = $conn->prepare("INSERT INTO bookings (hotel_id, checkin, checkout, name, email) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $hotel_id, $checkin, $checkout, $name, $email);
    if ($stmt->execute()) {
        header("Location: confirmation.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
 
$stmt = $conn->prepare("SELECT * FROM hotels WHERE id = ?");
$stmt->bind_param("i", $hotel_id);
$stmt->execute();
$hotel = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hilton Hotels - Book Room</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }
        header {
            background: linear සිට linear-gradient(90deg, #1a3c6e, #2a5d9f);
            color: white;
            padding: 20px;
            text-align: center;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        input, button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 1em;
        }
        input {
            border: 1px solid #ccc;
        }
        button {
            background: #2a5d9f;
            color: white;
            cursor: pointer;
            transition: background 0.3s;
        }
        button:hover {
            background: #1a3c6e;
        }
        @media (max-width: 768px) {
            .container {
                margin: 10px;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Book Your Stay</h1>
    </header>
    <div class="container">
        <h2><?php echo htmlspecialchars($hotel['name']); ?></h2>
        <p>Location: <?php echo htmlspecialchars($hotel['location']); ?></p>
        <p>Price: $<?php echo $hotel['price']; ?>/night</p>
        <form method="POST">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="hidden" name="hotel_id" value="<?php echo $hotel_id; ?>">
            <input type="date" name="checkin" value="<?php echo $checkin; ?>" readonly>
            <input type="date" name="checkout" value="<?php echo $checkout; ?>" readonly>
            <button type="submit">Confirmಸිට Confirm Booking</button>
        </form>
    </div>
</body>
</html>
