<?php
class inquiryController{

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
    
  }
}
?>