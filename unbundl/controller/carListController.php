<?php
class carListController{
    public function index(){
        require_once '../model/inqueryModel.php';
        $model = new inqueryModel();
        $success = $model->getAllCars();
        return $success;
    }

    private function showLogin(){
      header("Location:http://localhost/unbundl/view/viewAdminPanel.php");
    }

}
?>