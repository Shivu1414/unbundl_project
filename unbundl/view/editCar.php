<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Car | CarsDekho</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background-color: #f4f6f9; }
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
        .content { padding: 25px; }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark px-4">
    <a class="navbar-brand" href="#">CarsDekho Admin</a>

    <div class="ms-auto">
        <a href="viewHomePage.php" class="btn btn-outline-light me-2">Home</a>
        <a href="carList.php" class="btn btn-outline-warning">Back</a>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">

        <div class="col-md-2 sidebar p-0">
            <a href="viewAdminPanel.php">Dashboard</a>
            <a href="carList.php">Car List</a>
            <a href="#">Support</a>
            <a href="#">Inquiries</a>
            <a href="#" class="active">Update Car</a>
        </div>

        <div class="col-md-10 content">
            <h3 class="mb-4">Update Car Details</h3>

            <div class="card shadow-sm">
                <div class="card-body">

                    <form method="post"
                          action="../controller/carController.php?action=update"
                          enctype="multipart/form-data">

                        <input type="hidden" name="id" value="<?= $car['id']; ?>">
                        <input type="hidden" name="old_image" value="<?= $car['image']; ?>">

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Car Name</label>
                                <input type="text"
                                       name="car_name"
                                       class="form-control"
                                       value="<?= htmlspecialchars($car['car_name']); ?>"
                                       required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Car Type</label>
                                <select name="car_type" class="form-select" required>
                                    <option value="Hatchback" <?= $car['car_type']=='Hatchback'?'selected':'' ?>>Hatchback</option>
                                    <option value="Sedan" <?= $car['car_type']=='Sedan'?'selected':'' ?>>Sedan</option>
                                    <option value="SUV" <?= $car['car_type']=='SUV'?'selected':'' ?>>SUV</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Price (₹)</label>
                                <input type="number"
                                       name="price"
                                       class="form-control"
                                       value="<?= $car['price']; ?>"
                                       required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Fuel Type</label>
                                <select name="fuel_type" class="form-select">
                                    <option <?= $car['fuel_type']=='Petrol'?'selected':'' ?>>Petrol</option>
                                    <option <?= $car['fuel_type']=='Diesel'?'selected':'' ?>>Diesel</option>
                                    <option <?= $car['fuel_type']=='Electric'?'selected':'' ?>>Electric</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Car Image (Optional)</label>
                            <input type="file" name="car_image" class="form-control">
                            <small class="text-muted">Leave empty to keep current image</small>
                        </div>

                        <div class="mb-3">
                            <p><strong>Current Image:</strong></p>
                            <img src="../assets/uploads/<?= $car['image']; ?>"
                                 class="img-thumbnail"
                                 width="200">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description"
                                      class="form-control"
                                      rows="3"><?= htmlspecialchars($car['description']); ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-success">
                            Update Car
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
