<?php
session_start();
class carController{
    public function index(){
      if($_SERVER['REQUEST_METHOD']==='POST' && !isset($_GET['action'])){
        $this->handle();
      } elseif(isset($_GET['action']) && $_GET['action'] === 'delete'){
        $this->delete();
      } elseif(isset($_GET['action']) && $_GET['action'] === 'edit'){
        $this->edit();
      } elseif(isset($_GET['action']) && $_GET['action'] === 'update'){
        $this->update();
      } else{
        $this->showLogin();
      }
    }

    private function showLogin(){
      header("Location:http://localhost/unbundl/view/viewAdminPanel.php");
    }

    private function update()
    {
        require_once '../model/inqueryModel.php';
    
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: ../view/carList.php");
            exit();
        }
    
        $id          = $_POST['id'] ?? '';
        $carName     = trim($_POST['car_name'] ?? '');
        $carType     = trim($_POST['car_type'] ?? '');
        $price       = trim($_POST['price'] ?? '');
        $fuelType    = trim($_POST['fuel_type'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $oldImage    = $_POST['old_image'] ?? '';
    
        if ($id === '' || $carName === '' || $price === '') {
            $_SESSION['error'] = "Required fields missing";
            header("Location: ../view/editCar.php?id=" . $id);
            exit();
        }
    
        $imageName = $oldImage;
    
        if (!empty($_FILES['car_image']['name'])) {
    
            $uploadDir = '../assets/uploads/';
            $ext = pathinfo($_FILES['car_image']['name'], PATHINFO_EXTENSION);
            $imageName = time() . '_' . uniqid() . '.' . $ext;
            $uploadPath = $uploadDir . $imageName;
    
            if (move_uploaded_file($_FILES['car_image']['tmp_name'], $uploadPath)) {
    
                if (!empty($oldImage) && file_exists($uploadDir . $oldImage)) {
                    unlink($uploadDir . $oldImage);
                }
    
            } else {
                $_SESSION['error'] = "Image upload failed";
                header("Location: ../view/editCar.php?id=" . $id);
                exit();
            }
        }
    
        $model = new inqueryModel();
        $success = $model->updateCar( $id, $carName, $carType, $price, $fuelType, $imageName, $description);
    
        if ($success) {
            $_SESSION['update'] = 1;
            header("Location: ../view/carList.php");
            exit();
        }
    }

    private function edit()
    {
        require_once '../model/inqueryModel.php';
        $id = trim($_GET['id'] ?? '');
        $model = new inqueryModel();
        $car = $model->getCarById($id);

        if (!$car) {
            die("Car not found");
        }
        require_once '../view/editCar.php';
    }

    private function delete()
    {
        require_once '../model/inqueryModel.php';
        $id = trim($_GET['id'] ?? '');

        $model = new inqueryModel();
        $success = $model->deleteCar($id);
        if ($success) {
            $_SESSION['delete'] = 1;
            header("Location: ../view/carList.php");
            exit();
        } else {
            echo "No results found.";
        }
    }

    private function handle()
    {
        require_once '../model/inqueryModel.php';
    
        $carName     = trim($_POST['car_name'] ?? '');
        $carType     = trim($_POST['car_type'] ?? '');
        $price       = trim($_POST['price'] ?? '');
        $fuelType    = trim($_POST['fuel_type'] ?? '');
        $description = trim($_POST['description'] ?? '');
    
        if ($carName === '' || $carType === '' || $price === '') {
            $_SESSION['error'] = "Required fields missing";
            header("Location: ../view/viewAdminPanel.php");
            exit();
        }
    
        $imageName = '';
        if (!empty($_FILES['car_image']['name'])) {
            $imageName = time() . '_' . $_FILES['car_image']['name'];
            $uploadPath = '../assets/uploads/' . $imageName;
    
            if (!move_uploaded_file($_FILES['car_image']['tmp_name'], $uploadPath)) {
                $_SESSION['error'] = "Image upload failed";
                header("Location: ../view/viewAdminPanel.php");
                exit();
            }
        }
    
        $model = new inqueryModel();
        $success = $model->saveCar(
            $carName,
            $carType,
            $price,
            $fuelType,
            $imageName,
            $description
        );
        if ($success) {
            $_SESSION['flag'] = 1;
            header("Location: ../view/viewAdminPanel.php");
            exit();
        } else {
            echo "No results found.";
        }
    }
}
$car = new carController();
$car->index();
?>