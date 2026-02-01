<?php
session_start();
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

    <script>
        setTimeout(() => {
            const alert = document.querySelector('.alert');
            if (alert) {
                alert.classList.remove('show');
            }
        }, 3000);
    </script>
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
            <a href="#" class="active">Dashboard</a>
            <a href="carList.php">Car List</a>
            <a href="#">Support</a>
            <a href="#">Inquiries</a>
        </div>

        <div class="col-md-10 content">
            <h3 class="mb-4">Add Car Details</h3>
             <?php if (isset($_SESSION['flag']) && $_SESSION['flag'] == 1): ?>
                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                    ✅ <strong>Success!</strong> Your inquiry has been submitted successfully.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['flag']); ?>
            <?php endif; ?>

            <div class="card shadow-sm">
                <div class="card-body">

                    <form method="post" action="../controller/carController.php" enctype="multipart/form-data">

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Car Name</label>
                                <input type="text" name="car_name" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Car Type</label>
                                <select name="car_type" class="form-select" required>
                                    <option value="">Select</option>
                                    <option value="Hatchback">Hatchback</option>
                                    <option value="Sedan">Sedan</option>
                                    <option value="SUV">SUV</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Price (₹)</label>
                                <input type="number" name="price" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Fuel Type</label>
                                <select name="fuel_type" class="form-select">
                                    <option>Petrol</option>
                                    <option>Diesel</option>
                                    <option>Electric</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Car Image</label>
                            <input type="file" name="car_image" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Add Car
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
