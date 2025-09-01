<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hilton Hotels - Home</title>
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
        header h1 {
            margin: 0;
            font-size: 2.5em;
        }
        .search-bar {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin: 20px auto;
            max-width: 800px;
            display: flex;
            gap: 10px;
        }
        .search-bar input, .search-bar button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 1em;
        }
        .search-bar input {
            flex: 1;
            border: 1px solid #ccc;
        }
        .search-bar button {
            background: #2a5d9f;
            color: white;
            cursor: pointer;
            transition: background 0.3s;
        }
        .search-bar button:hover {
            background: #1a3c6e;
        }
        .featured {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }
        .hotel-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            display: flex;
        }
        .hotel-card img {
            width: 200px;
            height: 150px;
            object-fit: cover;
        }
        .hotel-card div {
            padding: 15px;
            flex: 1;
        }
        .hotel-card h3 {
            margin: 0;
            color: #2a5d9f;
        }
        .filters {
            margin: 20px auto;
            max-width: 800px;
            display: flex;
            gap: 10px;
        }
        .filters select {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid # RCT;
        }
        @media (max-width: 768px) {
            .search-bar {
                flex-direction: column;
            }
            .hotel-card {
                flex-direction: column;
            }
            .hotel-card img {
                width: 100%;
                height: 200px;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Hilton Hotels</h1>
        <p>Find Your Perfect Stay</p>
    </header>
    <div class="search-bar">
        <input type="text" id="destination" placeholder="Destination">
        <input type="date" id="checkin">
        <input type="date" id="checkout">
        <button onclick="searchHotels()">Search</button>
    </div>
    <div class="filters">
        <select id="price">
            <option value="">Price Range</option>
            <option value="low">Low to High</option>
            <option value="high">High to Low</option>
        </select>
        <select id="rating">
            <option value="">Rating</option>
            <option value="5">5 Stars</option>
            <option value="4">4 Stars</option>
        </select>
        <select id="amenities">
            <option value="">Amenities</option>
            <option value="wifi">Wi-Fi</option>
            <option value="pool">Pool</option>
        </select>
    </div>
    <div class="featured">
        <h2>Featured Hotels</h2>
        <div class="hotel-card">
            <img src="https://via.placeholder.com/200x150" alt="Hotel Image">
            <div>
                <h3>Hilton Paradise</h3>
                <p>Price: $150/night | Rating: 4.8</p>
                <p>Enjoy luxury with Wi-Fi, pool, and spa.</p>
            </div>
        </div>
        <div class="hotel-card">
            <img src="https://via.placeholder.com/200x150" alt="Hotel Image">
            <div>
                <h3>Hilton Oasis</h3>
                <p>Price: $200/night | Rating: 4.9</p>
                <p>Premium stay with all amenities.</p>
            </div>
        </div>
    </div>
    <script>
        function searchHotels() {
            const destination = document.getElementById('destination').value;
            const checkin = document.getElementById('checkin').value;
            const checkout = document.getElementById('checkout').value;
            const price = document.getElementById('price').value;
            const rating = document.getElementById('rating').value;
            const amenities = document.getElementById('amenities').value;
            const query = `destination=${destination}&checkin=${checkin}&checkout=${checkout}&price=${price}&rating=${rating}&amenities=${amenities}`;
            window.location.href = `hotels.php?${query}`;
        }
    </script>
</body>
</html>
