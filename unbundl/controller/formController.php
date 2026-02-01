<?php
session_start();
class formController{

  public function index(){
    if($_SERVER['REQUEST_METHOD']==='POST'){
      $this->handle();
    }
    else{
      $this->showLogin();
    }
  }

  private function showLogin(){
    header("Location:http://localhost/unbundl/view/inqueryForm.php");
  }

  private function handle(){
    require_once '../model/inqueryModel.php';
    $inqueryModel = new inqueryModel();
    $name    = trim($_POST['name'] ?? '');
    $phone   = trim($_POST['phone'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $carTypes = $_POST['car_types'] ?? [];
    $carTypesStr = implode(',', $carTypes);

    if ($name === '' || $phone === '' || $email === '') {
        $_SESSION['error'] = "Required fields missing";
        header("Location: inqueryForm.php");
        exit();
    }

    $model = new inqueryModel();
    $success = $model->saveInquery($name, $phone, $email, $address, $carTypesStr);

    if ($success) {
        $_SESSION['flag'] = 1;
        $_SESSION['inquery_data'] = $rsearchOpt;
        header("Location: ../view/inqueryForm.php");
        exit();
    } else {
        echo "No results found.";
    }
  }
}
$form = new formController();
$form->index();
?>