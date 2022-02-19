<?php
class main_controller
{
    function __construct()
    {
        include('models/Helperland_model.php');
        $this->model = new Helperland_model();
        session_start();
        
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

    public function register_user(){
        $base_url_signup="http://localhost/tatvasoft/Helperland_MVC/registration_page";
        $base_url="http://localhost/tatvasoft/Helperland_MVC/#login_modal";

        if(isset($_POST)){
            $email=$_POST['email'];
            $resetkey = bin2hex(random_bytes(15));
            $email_count=$this->model->is_mailExist($email);

            if($email_count==0){
                $data=[
                    'firstName'=>$_POST['firstName'],
                    'lastName'=>$_POST['lastName'],
                    'email'=>$_POST['email'],
                    'number'=>$_POST['number'],
                    'password'=>$_POST['password'],
                    'usertypeid'=>0,
                    'roleid'=>'Customer',
                    'resetkey'=>$resetkey,
                    'creationdt'=>date('Y-m-d'),
                    'status'=>'New',
                    'isregistered'=>'yes',
                    'isactive'=>'No',
                    
                    ];
  
                    $result=$this->model->Register($data);

                    if($result){
                        $_SESSION['msg']="Successfully Registered !";
                        $_SESSION['icon']="success";
                        
                    }else{
                        $_SESSION['msg']="Failure !";
                        $_SESSION['icon']="error";
                    }
                    header('Location:' . $base_url);
                                                        
            }else{
                $_SESSION['msg']="User Already Exist !";
                 $_SESSION['icon']="error";
                header('Location:' . $base_url_signup);
               
            }
        }
    }

    public function register_SP(){
        $base_url_SP="http://localhost/tatvasoft/Helperland_MVC/service_provider_become_pro";
        $base_url="http://localhost/tatvasoft/Helperland_MVC";

        if(isset($_POST)){
            $email=$_POST['email'];
            $resetkey = bin2hex(random_bytes(15));
            $email_count=$this->model->is_mailExist($email);

            if($email_count==0){
                $data=[
                    'firstName'=>$_POST['firstName'],
                    'lastName'=>$_POST['lastName'],
                    'email'=>$email,
                    'number'=>$_POST['number'],
                    'password'=>$_POST['password'],
                    'usertypeid'=>1,
                    'roleid'=>'Customer',
                    'resetkey'=>$resetkey,
                    'creationdt'=>date('Y-m-d'),
                    'status'=>'panding',
                    'isregistered'=>'yes',
                    'isactive'=>'No',
                                        
                ];
  
                    $result=$this->model->Register($data);

                    header('Location:' . $base_url);
                
            }else{
                $_SESSION['msg']="User Already Exist !";
                $_SESSION['icon']="error";
                header('Location:' . $base_url_SP);
            }
        }
    }

    public function login(){
        $base_url = "http://localhost/tatvasoft/Helperland_MVC/#login_modal";
        $customer = "http://localhost/tatvasoft/Helperland_MVC/service_history";
                
        if (isset($_POST)) {
            $email = $_POST['user_email'];
            $pass = $_POST['pass'];
            if (isset($_POST['remember'])) {
                setcookie('email_cookie', $email, time() + 86400, '/');
                setcookie('password_cookie', $pass, time() + 86400, '/');
            }
            $count = $this->model->Login($email, $pass);
           
        }
    }

    public function forgotPassword(){
        if (isset($_POST)){
            $base_url="https://localhost/tatvasoft/Helperland_MVC";
            $email=$_POST['email'];
            $result=$this->model->forgotPassword($email);
            $username=$result[0];
            $resetkey=$result[1];
            $count=$result[2];

            if($count==1){
                $sender_email = $email;
                $subject="Forget your Password ? Here is Your Reset Password link - Helperland";
                $body="Greetings from helperland, $username<br>
                Find Link Below to Reset your Password
                <br> <a href='http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=Redirect_ForgotPassword&parameter=$resetkey'>Reset your password by click here</a>";


                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                
                            
                if(mail($sender_email, $subject, $body, $headers)){
                    
                        $_SESSION['msg']="Email Send Successfully !";
                        $_SESSION['icon']="success";
                                                             
                }else{
                    $_SESSION['msg']="Unable to send Email !";
                    $_SESSION['icon']="error";
                }
                header('Location:' . $base_url);
                
            }else{
                $_SESSION['msg']="Email not Exist !";
                $_SESSION['icon']="error";
            }
        }
    }

    public function Redirect_ForgotPassword()
    {
        $resetkey = $_GET['parameter'];
        include('./views/passwordRecovery.php');
    }

    public function resetPassword(){
        if (isset($_POST)) {
            $base_url = "http://localhost/tatvasoft/Helperland_MVC";
            $resetkey = $_POST['reset'];
            $new_password = $_POST['new_password'];
            $c_password = $_POST['c_password'];
            $update_date = date('Y-m-d H:i:s');
            
            if ($new_password == $c_password) {
                $data = [
                    'password' => $new_password,
                    'updatedate' => $update_date,
                    'modifiedby' => 0,
                    'resetkey' => $resetkey,
                ];
                
                $result = $this->model->resetpassword($data);
                header('Location:' . $base_url);

            } else {
                $_SESSION['msg']="Password not matching !";
                $_SESSION['icon']="error";
            }
        }
    }

    public function postalCheck(){
        $base_url="http://localhost/tatvasoft/Helperland_MVC/book_services";
       $next_url="http://localhost/tatvasoft/Helperland_MVC";
        if(isset($_POST['postalcode'])){
            $postalcode = $_POST['postalcode'];

            // echo $postalcode;
            $result = $this->model->postalcodeCheck($postalcode);
            
            if($result > 0){
                echo 1;
            }else{
                echo 0;
            }
        }

    }

    public function cityCheck(){
        if(isset($_POST)){
            $postalcode=$_POST['postalcode'];
            $result=$this->model->getCity($postalcode);

            $city = $result[0];
            $state = $result[1];
            $return = [$city, $state];
            echo json_encode($return);

        }

    }

    public function add_Address(){
        if(isset($_POST))
        {
            $streetname = $_POST['streetname'];
            $housenumber = $_POST['housenumber'];
            $postalcode = $_POST['postalcode'];
            $city = $_POST['city'];
            $phonenumber = $_POST['phonenumber'];
            $email = $_POST['username'];
            
            
            $result = $this->model->forgotPassword($email);
            // echo $result;
            $userid=$result[3];
            $type = 0;
            $get_state = $this->model->getCity($postalcode);
            $state = $get_state[1];

            $data = [
                'userid' => $userid,
                'streetname' => $streetname,
                'housenumber' => $housenumber,
                'city' => $city,
                'state' => $state,
                'postalcode' => $postalcode,
                'phonenumber' => $phonenumber,
                'email' => $email,
                'type' => $type,

            ];
            $result = $this->model->add_address($data);
        }

    }

    public function get_Address(){
        if(isset($_POST))
        {
            $email=$_POST['username'];
            $result=$this->model->get_address($email);
            if(count($result))
            {
                foreach($result as $row)
                {
                    $streetname=$row['AddressLine1'];
                    $housenumber=$row['AddressLine2'];
                    $city=$row['City'];
                    $postalcode=$row['PostalCode'];
                    $phonenumber=$row['Mobile'];
                    $default=$row['IsDefault'];
                    $deleted=$row['IsDeleted'];
                    $address_id=$row['AddressId'];

                    if($default==0)
                    {
                        $default='';
                        
                    }else{
                        $default='checked';
                    }
                    if($deleted==0)
                    {
                        $address_tab='<div class="address">
                        
                        <input type="radio" id="address' . $address_id . '" name="addressRadio" value="' . $address_id . '" class="address-radio" ' . $default . '>
                        <label>
                        <p class="address_detail"> Address : <span>' . $streetname . '  ' . $housenumber . ' , ' . $city . ' ' . $postalcode . ' <br> Phone Number: <span> ' . $phonenumber . '</span></p>
                        </label>
                        </div>';

                        echo $address_tab;
                    }
                }
            }
        }

    }

public function service_request(){
    if(isset($_POST))
    {
        $email = $_POST['username'];
        
        $s_date = $_POST['date'];
        
        $time=$_POST['time'];
        
        $postalcode=$_POST['postalcode'];
        $serviceRate=$_POST['hourlyrate'];
        
        $servicehours=$_POST['servicehours'];
        $totalhours=$_POST['totalhours'];
        $extrahour=$_POST['extrahour'];
        $total_payment=$_POST['total_payment'];
        $extra_service=$_POST['extraService'];
        $comment=$_POST['comments'];
        $address_id=$_POST['address_id'];
        $payment_due=$_POST['payment_due'];
        $pets=$_POST['pet'];
        $status='panding';
        $current_date=date('Y-m-d H:i:s');
        $payment_done=1;
        $recordversion=1;
        // echo ($date);
       

        $result = $this->model->forgotPassword($email);
        $customer_mail=$email;
        $customerName=$result[0];
        $userId=$result[3];

        
        $data = [
            'userId'=>$userId,
            'servicedate'=>$s_date,
            'servicetime'=>$time,
            'postalcode'=>$postalcode,
            'serviceRate'=>$serviceRate,
            'servicehours'=>$servicehours,
            'extrahour'=>$extrahour,
            'totalhours'=>$totalhours,
            'total_payment'=>$total_payment,
            'extra_service'=>$extra_service,
            'comments'=>$comment,
            'address_id'=>$address_id,
            'payment_due'=>$payment_due,
            'pets'=>$pets,
            'status'=>$status,
            'current_date'=>$current_date,
            'payment_done'=>$payment_done,
            'recordvirson'=>$recordversion,
        ];

        $result=$this->model->add_service($data);
        $service_provider=$this->model->get_SP();
        if($result){
            $service_id=$result;
            //sending confirmation mail to customer---------------------------->
            include('booking_confirm_mail.php');
            
            
            if(count($service_provider)){
                foreach($service_provider as $row){
                    $service_id=$result;
                    $SP_email=$row['Email'];
                    // echo $service_id;
                    include('bookingmail_to_SP.php');
                          
                }
            }

            echo $service_id;
            
        }else{
            echo 0;
        }

    }

}
            
}
