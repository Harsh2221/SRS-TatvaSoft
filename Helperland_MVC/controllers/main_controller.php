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

    public function ContactUs()
    {
        if (isset($_POST)) {
            $base_url = "http://localhost/tatvasoft/Helperland_MVC/Contact";
            $mobile =  $_POST['number'];
            $email = $_POST['email'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];
            $name = $_POST['f_name'] . " " . $_POST['l_name'];
            $array = [
                'name' => $name,
                'email' => $email,
                'subject' => $subject,
                'mobile' => $_POST['number'],
                'message' => $message,
                'creationdt' => date('Y-m-d H:i:s'),
                
            ];
            $result = $this->model->Contactus($array);
            
            
            header('Location:' . $base_url);
        }
    }

     
    
}
