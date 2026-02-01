<?php
session_start();
require_once '../controller/carListController.php';
$carsController = new carListController();
$cars = $carsController->index();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel | CarsDekho</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
        }
        .sidebar {
            height: 100vh;
            background: #212529;
            color: #fff;
        }
        .sidebar a {
            color: #adb5bd;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
        }
        .sidebar a:hover,
        .sidebar a.active {
            background: #343a40;
            color: #fff;
        }
        .content {
            padding: 25px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark px-4">
    <a class="navbar-brand" href="#">CarsDekho Admin</a>

    <div class="ms-auto">
        <a href="viewHomePage.php" class="btn btn-outline-light me-2">Home</a>
        <a href="viewHomePage.php" class="btn btn-outline-danger">Logout</a>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">

        <div class="col-md-2 sidebar p-0">
            <a href="viewAdminPanel.php" >Dashboard</a>
            <a href="carList.php" class="active">Car List</a>
            <a href="#">Support</a>
            <a href="#">Inquiries</a>
        </div>

        <div class="col-md-10 content">
            <h3 class="mb-4">Car Listings</h3>
        
            <div class="row g-4">
                <?php if (!empty($cars)) { ?>
                    <?php foreach ($cars as $car) { ?>
                        <div class="col-md-4">
                            <div class="card shadow-sm h-100">
        
                                <img src="../assets/uploads/<?php echo $car['image']; ?>"
                                     class="card-img-top"
                                     style="height:200px; padding:10px; object-fit:cover;">
        
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?php echo htmlspecialchars($car['car_name']); ?>
                                    </h5>
        
                                    <p class="mb-1">
                                        <strong>Type:</strong> <?php echo $car['car_type']; ?>
                                    </p>
                                    <p class="mb-1">
                                        <strong>Fuel:</strong> <?php echo $car['fuel_type']; ?>
                                    </p>
                                    <p class="mb-1">
                                        <strong>Price:</strong> ₹<?php echo number_format($car['price']); ?>
                                    </p>
        
                                    <p class="text-muted small">
                                        <?php echo substr($car['description'], 0, 70); ?>...
                                    </p>
                                </div>
        
                                <div class="card-footer bg-white d-flex justify-content-between">
                                    <a href="../controller/carController.php?action=edit&id=<?php echo $car['id']; ?>"
                                       class="btn btn-sm btn-primary">
                                        Edit
                                    </a>
        
                                    <a href="../controller/carController.php?action=delete&id=<?php echo $car['id']; ?>"
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Delete this car?')">
                                        Delete
                                    </a>
                                </div>
        
                            </div>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <p>No cars found.</p>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>
