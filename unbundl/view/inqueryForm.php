<?php
session_start();
    require_once '../helper/helperDb.php';
    $database=new dataBase();
    $conn=$database->adminDbConn();
    if (isset($_SESSION['flag']) && $_SESSION['flag'] == 1) {
        $result = $_SESSION['inquery_data'];
    }

    function unsetInqueryData() {
        unset($_SESSION['inquery_data']);
        unset($_SESSION['flag']);
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clear_session'])) {
        unsetInqueryData();
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Inquiry Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="./../assets/css/inqueryForm.css">
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

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">CarsDekho</a>
    </div>

    <div class="ms-auto">
        <a href="viewHomePage.php" class="btn btn-outline-light">Home Page</a>
        <a href="viewAdminPanel.php" class="btn btn-outline-light ms-2">Admin Panel</a>
    </div>
</nav>

<?php if (isset($_SESSION['flag']) && $_SESSION['flag'] == 1): ?>
    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
        ✅ <strong>Success!</strong> Your inquiry has been submitted successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>

    <?php unset($_SESSION['flag']); ?>
<?php endif; ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="car-form-card">
                <h3 class="text-center mb-2">Select Your Preferred Car Type</h3>
                <p class="text-center text-muted mb-4">
                    Please fill out the form below
                </p>

                <form method="post" action="../controller/formController.php">
                    <label class="form-label fw-bold mb-3">Choose Car Type(s):</label>
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="car-option">
                                <input type="checkbox" name="car_types[]" value="Hatchback">
                                <div class="car-card">
                                    <img src="../assets/image/hatchback.jpg" class="hatchback_img" alt="Hatchback">
                                    <span>Hatchback</span>
                                </div>
                            </label>
                        </div>
                    
                        <div class="col-md-4">
                            <label class="car-option">
                                <input type="checkbox" name="car_types[]" value="Sedan">
                                <div class="car-card">
                                    <img src="../assets/image/sedan.jpg" class="sedan_img" alt="Sedan">
                                    <span>Sedan</span>
                                </div>
                            </label>
                        </div>
                    
                        <div class="col-md-4">
                            <label class="car-option">
                                <input type="checkbox" name="car_types[]" value="SUV">
                                <div class="car-card">
                                    <img src="../assets/image/suv.jpg" class="suv_img" alt="SUV">
                                    <span>SUV</span>
                                </div>
                            </label>
                        </div>
                    </div>
                
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control" placeholder="Enter phone number" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email ID</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control" rows="3" placeholder="Enter address"></textarea>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">
                            Submit Inquiry
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
