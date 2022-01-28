<?php
class main_controller
{
    function __construct()
    {
        include('models/Helperland_model.php');
        $this->model = new Helperland_model();
        
    }
 
    public function Homepage()
    {
       
        include("./views/homepage.php");
        
    }

    public function contactus(){
        if(isset($_POST)){

        
        $base_url="https://localhost/php-mvc/helperland_MVC/contact";
        $name=$_POST['f_name'] . " " . $_POST['l_name'];
        
        $email=$_POST['email'];
        $subject=$_POST['subject'];
        $mobile=$_POST['number'];
        $message=$_POST['message'];

        $array=[
            'name'=>$name,
            
            'email'=>$email,
            'subject'=>$subject,
            'mobile'=>$mobile,
            'message'=>$message,
            'createdon'=>date('Y-m-d'),
        ];
        $result=$this->model->contact_us($array);
        $_SESSION['status_msg']=$result;
        
        header('Location:' .$base_url);
    }

    }

     
    
}
