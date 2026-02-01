<?php
session_start();
require_once '../model/inqueryModel.php';

$model = new inqueryModel();
$cars = $model->getAllCars();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CarsDekho | Find Your Dream Car</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f7fb;
            font-family: 'Segoe UI', sans-serif;
        }

        /* NAVBAR */
        .navbar-brand {
            font-weight: 600;
        }

        /* HERO */
        .hero {
            background: linear-gradient(120deg, #2563eb, #7c3aed);
            color: #fff;
            padding: 80px 0;
            text-align: center;
        }

        .hero h1 {
            font-weight: 700;
            font-size: 42px;
        }

        .hero p {
            opacity: 0.9;
            font-size: 18px;
        }

        /* SEARCH */
        .search-box {
            margin-top: -35px;
        }

        .search-card {
            background: #fff;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,.08);
        }

        /* CAR CARD */
        .car-card {
            border-radius: 18px;
            overflow: hidden;
            transition: all .3s ease;
        }

        .car-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(0,0,0,.12);
        }

        .car-card img {
            height: 220px;
            object-fit: cover;
        }

        .price {
            color: #2563eb;
            font-size: 20px;
            font-weight: 700;
        }

        footer {
            background: #111827;
            color: #9ca3af;
            padding: 20px;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-dark bg-dark px-4">
    <a class="navbar-brand" href="#">CarsDekho</a>
    <div class="ms-auto">
        <a href="inqueryForm.php" class="btn btn-outline-light me-2">Inquiry</a>
        <a href="viewAdminPanel.php" class="btn btn-outline-warning">Admin</a>
    </div>
</nav>

<!-- HERO -->
<section class="hero">
    <div class="container">
        <h1>Find the Perfect Car for You</h1>
        <p>Compare prices, fuel type & car categories</p>
    </div>
</section>

<div class="container search-box">
    <div class="search-card">
        <form class="row g-3">
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Search by car name" required>
            </div>
            <div class="col-md-3">
                <select class="form-select" required>
                    <option value="">Car Type</option>
                    <option>SUV</option>
                    <option>Sedan</option>
                    <option>Hatchback</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select" required>
                    <option value="">Fuel Type</option>
                    <option>Petrol</option>
                    <option>Diesel</option>
                    <option>Electric</option>
                </select>
            </div>
            <div class="col-md-2 d-grid">
                <button class="btn btn-primary">Search</button>
            </div>
        </form>
    </div>
</div>

<div class="container my-5">
    <div class="row g-4">
        <?php foreach ($cars as $car) { ?>
            <div class="col-md-4">
                <div class="card car-card shadow-sm h-100">

                    <img src="../assets/uploads/<?php echo $car['image']; ?>" class="card-img-top">

                    <div class="card-body">
                        <h5 class="fw-bold"><?php echo $car['car_name']; ?></h5>
                        <p class="mb-1">Type: <?php echo $car['car_type']; ?></p>
                        <p class="mb-2">Fuel: <?php echo $car['fuel_type']; ?></p>
                        <div class="price">₹<?php echo number_format($car['price']); ?></div>
                    </div>

                    <div class="card-footer bg-white text-center">
                        <a href="inqueryForm.php?car_id=<?php echo $car['id']; ?>"
                           class="btn btn-outline-primary w-100">
                            Get Best Deal
                        </a>
                    </div>

                </div>
            </div>
        <?php } ?>
    </div>
</div>

<footer class="text-center">
    © <?php echo date('Y'); ?> CarsDekho. All rights reserved.
</footer>

</body>
</html>
