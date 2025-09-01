<?php
require 'db.php';
$destination = isset($_GET['destination']) ? $_GET['destination'] : '';
$checkin = isset($_GET['checkin']) ? $_GET['checkin'] : '';
$checkout = isset($_GET['checkout']) ? $_GET['checkout'] : '';
$price = isset($_GET['price']) ? $_GET['price'] : '';
$rating = isset($_GET['rating']) ? $_GET['rating'] : '';
$amenities = isset($_GET['amenities']) ? $_GET['amenities'] : '';
 
$query = "SELECT * FROM hotels WHERE 1=1";
$params = [];
if ($destination) {
    $query .= " AND location LIKE ?";
    $params[] = "%$destination%";
}
if ($rating) {
    $query .= " AND rating >= ?";
    $params[] = $rating;
}
if ($amenities) {
    $query .= " AND amenities LIKE ?";
    $params[] = "%$amenities%";
}
if ($price == 'low') {
    $query .= " ORDER BY price ASC";
} elseif ($price == 'high') {
    $query .= " ORDER BY price DESC";
}
 
$stmt = $conn->prepare($query);
if ($params) {
    $stmt->bind_param(str_repeat('s', count($params)), ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hilton Hotels - Listings</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }
        header {
            background: linear-gradient(90deg, #1a3c6e, #2a5d9f);
            color: white;
            padding: 20px;
            text-align: center;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }
        .hotel-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        .hotel-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .hotel-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .hotel-card div {
            padding: 15px;
        }
        .hotel-card h3 {
            margin: 0;
            color: #2a5d9f;
        }
        .hotel-card button {
            background: #2a5d9f;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            transition: background 0.3s;
        }
        .hotel-card button:hover {
            background: #1a3c6e;
        }
        @media (max-width: 768px) {
            .hotel-list {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Hotel Listings</h1>
    </header>
    <div class="container">
        <h2>Available Hotels</h2>
        <div class="hotel-list">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="hotel-card">
                    <img src="https://via.placeholder.com/300x200" alt="Hotel Image">
                    <div>
                        <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                        <p>Location: <?php echo htmlspecialchars($row['location']); ?></p>
                        <p>Price: $<?php echo $row['price']; ?>/night</p>
                        <p>Rating: <?php echo $row['rating']; ?> Stars</p>
                        <p>Amenities: <?php echo htmlspecialchars($row['amenities']); ?></p>
                        <button onclick="bookHotel(<?php echo $row['id']; ?>, '<?php echo $checkin; ?>', '<?php echo $checkout; ?>')">Book Now</button>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <script>
        function bookHotel(id, checkin, checkout) {
            window.location.href = `booking.php?hotel_id=${id}&checkin=${checkin}&checkout=${checkout}`;
        }
    </script>
</body>
</html>
