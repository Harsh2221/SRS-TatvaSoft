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
                    'isactive'=>'Yes',
                    
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
                    'status'=>'New',
                    'isregistered'=>'yes',
                    'isactive'=>'Yes',
                                        
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
            $result = $this->model->forgotPassword($email);
            $_SESSION['firstname']=$result[0];
        }
    }

    public function Logout(){
        // echo "got it";
        if (isset($_POST)) {
            $base_url = "http://localhost/tatvasoft/Helperland_MVC";

            unset($_SESSION['username']);
            $_SESSION['msg']="Logout Successfully !";
            $_SESSION['icon']="success";

            header('Location:' . $base_url);

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
        if(isset($_POST)){
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
            $output='<option value="' . $city . '" selected>
            ' . $city . '
        </option>';
            // echo json_encode($return);
            echo $output;

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
            // include('booking_confirm_mail.php');
            
            
            if(count($service_provider)){
                foreach($service_provider as $row){
                    $spId=$row['UserId'];
                    $block=$this->model->checkBlocked($spId, $userId);
                    $blockornot=$block[1];
                    if($blockornot != 1){
                        $service_id=$result;
                        $SP_email=$row['Email'];
                        // echo $service_id;
                        // include('bookingmail_to_SP.php'); 
                    }
                               
                }
            }

            echo $service_id;
            
        }else{
            echo 0;
        }

    }

}

public function customerDetails(){
 // echo "success";
    if(isset($_POST))
    {
        $email=$_POST['username'];
        $result=$this->model->forgotPassword($email);
        $userId=$result[3];

        $result=$this->model->getCustomerDetail($userId);
        $json['data']=array();

        if(count($result)){
            foreach ($result as $row)
            {
                $serviceId=$row['ServiceRequestId'];
                $payment = $row['TotalCost'];
                $serviceDate = $row['ServiceStartDate'];
                $status = $row['Status'];
                $serviceTime = $row['ServiceTime'];
                $totalHour = $row['TotalHours'];
                
                
            if ($status != "Cancelled" && $status != "Completed") {

                    $stratTime = $serviceTime;
                    $endTime = $serviceTime + $totalHour;
                    $sTime='';
                    $eTime='';
                    if(strpos($stratTime, ".5")){
                        $sTime=str_replace(".5",":30",$stratTime);
                    }else{
                        $sTime=$stratTime.':00';
                    }

                    if(strpos($endTime, ".5")){
                        $eTime=str_replace(".5",":30",$endTime);
                    }else{
                        $eTime=$endTime.':00';
                    }


                $serviceidcol='<td class="serviceid"> <div class="serviceDetailModel" data-bs-toggle="modal"
                data-bs-target="#ServiceData_modal" name="' . $serviceId . '">' . $serviceId . '</div></td>';
                $servicedatecol=' <td>
                <div class="serviceDetailModel" data-bs-toggle="modal"
                data-bs-target="#ServiceData_modal" name="' . $serviceId . '">
                <span><img src="./assets/assets/calendar2.png" alt="#" />' . $serviceDate . '</span>
                <br />
                <span><img src="./assets/assets/layer-14.png" alt="#" /> ' . $sTime . ' - ' . $eTime . '</span>
                </div>

              </td>';

              $serviceProvidercol = '';

                    if ($status == 'Panding') {
                        $serviceProvidercol = '<td>Service provider will accept your request soon.<td>';
                    }
                    if ($status == 'Approoved' || $status == 'Reschedule'){
                        
                        //get service provider here
                        $serviceproviderid = intval($row['ServiceProviderId']);
                        // $serviceProvidercol='<td> ' . $serviceproviderid . ' </td>';
                          
                        $spDetails = $this->model->getspData($serviceproviderid);

                        if (count($spDetails)) {
                            foreach ($spDetails as $sp) {
                                $spfirstname = $sp['FirstName'];
                                $splastname = $sp['LastName'];
                                $imgdp = $sp['UserProfilePicture'];
                                $star='';
                                $spRating="";
                                $spRate=$this->model->getRating($serviceproviderid);
                                if(count($spRate[0]))
                                {
                                    $spRating=0;
    
                                    foreach($spRate[0] as $row){
                                        $spRating=($spRating+$row['Ratings']);
                                    }
    
                                    $spRating=round(($spRating / $spRate[1]), 2);
                                    $finalavgrating=round($spRating);
                                    $star='<i class = "fa fa-star" aria-hidden = "true" id = "st"></i>';
                                    if($finalavgrating==1)
                                    {
                                        $star='<i class = "fa fa-star" aria-hidden = "true" id = "st"></i>';
                                    }
                                    if($finalavgrating==2)
                                    {
                                        $star='<i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                        <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>';
                                    }
                                     if($finalavgrating==3)
                                    {
                                        $star='<i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                        <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                        <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>';
                                    }
                                    if($finalavgrating==4)
                                    {
                                        $star='<i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                        <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                        <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                        <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>';
                                    }
                                    if($finalavgrating==5)
                                    {
                                        $star='<i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                        <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                        <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                        <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                        <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>';
                                    }
                                }
                                if (strlen($imgdp) != 0) {
                                    
                                    $image = str_replace("http://localhost/Tatvasoft/Helperland_MVC/", "./", $imgdp);
                                    $img = '<img  src="' . $image . '" class="SPimg">';
                                } else {
                                    
                                    $img = '<img src="./assets/assets/cap.png" alt="" id="cap" />';
                                }
                            $serviceProvidercol = ' <td>
                            <div class="serviceDetailModel" data-bs-toggle="modal"
                            data-bs-target="#ServiceData_modal" name="' . $serviceId . '">
                            ' . $img . '
                             ' . $spfirstname . '' . $splastname . '
                            <br />
                            <span id="star">
                            ' . $star . '
                              <span>' . $spRating . '</span>
                            </span>
                            </div>
                          </td>';
                            }
                        }
                        
                    } 

                $actioncol ="";

            if ($status == 'Reschedule') {
                $actioncol  = '<p>Requested for Reschedule</p>';
               
            }

            
            $paymentcol='<td class="payment">
            <div class="serviceDetailModel" data-bs-toggle="modal"
            data-bs-target="#ServiceData_modal" name="' . $serviceId . '">
                <h5><span>€</span>' . $payment . '</h5>
                </div>
                </td>';

            if($status != 'Reschedule') {

                $actioncol=' <td>
                <button type="button" class="reschedule-btn" id=' . $serviceId . ' data-bs-toggle="modal"
                  data-bs-target="#reschedule_modal">Reschedule</button>
                <button class="cancel-btn" id="' . $serviceId . '" type="button" data-bs-toggle="modal"
                  data-bs-target="#cancel_modal">Cancel</button>
              </td>';

                }
                $results=array();
                $results['serviceId'] = $serviceidcol;
                $results['payment'] = $paymentcol;
                $results['serviceDate'] = $servicedatecol;
                $results['actions'] = $actioncol;
                $results['serviceProvider'] = $serviceProvidercol;
                array_push($json['data'], $results);
            
            } 
                

            }
            echo json_encode($json);
        }else{
            $json=0;
            echo json_encode($json);
        }
        
        
    }
    
}

public function getServiceData(){
    // echo "+";
    if(isset($_POST))
    {
        if (isset($_POST['userId'])) {
            $spId = $_POST['userId'];
        }
        $serviceId = $_POST['serviceId'];
        $result = $this->model->getServicedata($serviceId);
        $json = array();
        if(count($result)){
            foreach ($result as $row)
            {
                $serviceId=$row['ServiceRequestId'];
                $stratTime=$row['ServiceTime'];
                $totalTime=$row['TotalHours'];
                $payment=$row['TotalCost'];
                $status=$row['Status'];
                $userId=$row['UserId'];
                $serviceproviderId=$row['ServiceProviderId'];
                $date = $row['ServiceStartDate'];
                $extraservices = $row['ExtraServices'];
                $comments = $row['Comments'];
                $haspets = $row['HasPets'];
                $addressid = $row['AddressId'];

                $getAddress=$this->model->getSAddress($addressid);
                if($getAddress)
                {
                    foreach($getAddress as $row)
                    {
                        $add1=$row['AddressLine1'];
                        $add2=$row['AddressLine2'];
                        $city=$row['City'];
                        $postalcode=$row['PostalCode'];
                        $serviceAddress=$add1 . ' ' . $add2 . ' , ' . $postalcode . ' ' . $city;
                        $phone=$row['Mobile'];
                        $email=$row['Email'];


                    }
                }
                if ($haspets == 0) {
                    $pets =  '❌ I haven\'t pets at home';
                }
                if ($haspets == 1) {
                    $pets =  '✔ I have pets at home';
                }

                $serviceProvider='';
                if(empty($serviceProvider))
                {
                    $serviceProvider='';
                    if($status == "Cancelled"){
                        $serviceProvider='<p>Service has been Cancelled<p>';
                    }
                }
                if(!empty($serviceProvider))
                {
                    // service provider details fetch from here
                    $SPDetails=$this->model->getUserId($serviceproviderId);

                    if ($status == 'Approoved' || $status == 'Completed' || $status == "Cancelled") {
                        if(count($SPDetails))
                        {
                            foreach($SPDetails as $SP)
                            {
                                $spfirstname = $SP['FirstName'];
                                $splastname = $SP['LastName'];
                                $imgdp = $SP['UserProfilePicture'];
                                $spRate=$this->model->getRating($serviceproviderId);
                                if(count($spRate[0]))
                                {
                                    $spRating=0;
    
                                    foreach($spRate[0] as $row){
                                        $spRating=($spRating+$row['Ratings']);
                                    }
    
                                    $spRating=round(($spRating / $spRate[1]), 2);
                                    $finalavgrating=round($spRating);
                                    $star='<i class = "fa fa-star" aria-hidden = "true" id = "st"></i>';
                                    if($finalavgrating==1)
                                    {
                                        $star='<i class = "fa fa-star" aria-hidden = "true" id = "st"></i>';
                                    }
                                    if($finalavgrating==2)
                                    {
                                        $star='<i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                        <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>';
                                    }
                                     if($finalavgrating==3)
                                    {
                                        $star='<i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                        <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                        <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>';
                                    }
                                    if($finalavgrating==4)
                                    {
                                        $star='<i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                        <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                        <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                        <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>';
                                    }
                                    if($finalavgrating==5)
                                    {
                                        $star='<i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                        <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                        <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                        <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                        <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>';
                                    }
                                }
                                if (strlen($imgdp) != 0) {
                                    
                                    $image = str_replace("http://localhost/Tatvasoft/Helperland_MVC/", "./", $imgdp);
                                    $img = '<img  src="' . $image . '" class="SPimg">';
                                } else {
                                    
                                    $img = '<img src="./assets/assets/cap.png" alt="" id="cap" />';
                                }
                            $serviceProvider = ' <td>
                            ' . $img . '
                             ' . $spfirstname . '' . $splastname . '
                            <br />
                            <span id="star">
                            ' . $star . '
                              <span>' . $spRating . '</span>
                            </span>
                          </td>';
                            }
                        }
                        
                    }else{
                        $serviceProvider='<p>You have rescheduled service request. SP will accept request very soon.</p>';
                    }
                }
                if($status=='Reschedule'){
                    $serviceProvider='<p>You have rescheduled service request. SP will accept request very soon.</p>';
                }

                $reschedule='<button type="submit" class="rescheduleCon_btn" id=' . $serviceId . ' data-bs-toggle="modal"
                data-bs-target="#reschedule_modal">Reschedule</button>';
                $cancel='<button class="cancelCon_btn" id="' . $serviceId . '" type="button" data-bs-toggle="modal"
                data-bs-target="#cancel_modal">Cancel</button>';
                $update_btn='<button type="submit" class="update" id=' . $serviceId . ' data-bs-dismiss="modal">Update</button>';
                $cancel_btn=' <button type="submit" class="cancel" id=' . $serviceId . ' data-bs-dismiss="modal">Cancel Now</button>';
                $selectNewtime='<select id="select_time" class="form-select select_time">
                <option value="8">8:00 </option>
                <option value="8.5">8:30 </option>
                <option value="9">9:00 </option>
                <option value="9.5">9:30 </option>
                <option value="10">10:00</option>
                <option value="10.5">10:30</option>
                <option value="11">11:00</option>
                <option value="11.5">11:30</option>
                <option value="12">12:00</option>
                <option value="12.5">12:30</option>
                <option value="13">13:00</option>
                <option value="13.5">13:30</option>
                <option value="14">14:00</option>
                <option value="14.5">14:30</option>
                <option value="15">15:00</option>
                <option value="15.5">15:30</option>
                <option value="16">16:00</option>
                <option value="16.5">16:30</option>
                <option value="17">17:00</option>
                <option value="17.5">17:30</option>
                <option value="18">18:00</option>
              </select>';
              $cancelReason='<textarea name="cancel_reason" class="cancle_reason" id="" cols="37" rows="3"></textarea>';
              $updateTime='<p id="' . $totalTime . '">Select New Date & Time</p>';

              $customerData=$this->model->getUserId($userId);
              if (count($customerData)) {
                foreach ($customerData as $row) {
                    $custfname = $row['FirstName'];
                    $custlname = $row['LastName'];
                }
            }
            
            $customerName=$custfname . '  ' . $custlname;
            $startTime=$date;
            $endTime=floatval($stratTime+$totalTime);
            $endTime=$endTime;

                    $stratTime = $stratTime;
                    $entime = $stratTime + $totalTime;
                    $sTime='';
                    $eTime='';
                    if(strpos($stratTime, ".5")){
                        $sTime=str_replace(".5",":30",$stratTime);
                    }else{
                        $sTime=$stratTime.':00';
                    }

                    if(strpos($entime, ".5")){
                        $eTime=str_replace(".5",":30",$entime);
                    }else{
                        $eTime=$entime.':00';
                    }

            if(isset($spId)){

                

                $isconflict=$this->model->isConflict($spId, $startTime, $stratTime);
                $count=$isconflict[0];

                if ($count >= 1) {
                    $servicerequestid = $isconflict[1];
                    if($serviceId != $servicerequestid)
                    {
                        $acceptbtn = '
                            <button type="submit" class="acceptBtnModal" id=' . $serviceId . ' data-bs-dismiss="modal" disabled="disabled" style="cursor:not-allowed;">✔ Accept</button>
                            ';
                    }else{
                        $acceptbtn = '
                        <button type="submit" class="acceptBtnModal" id=' . $serviceId . ' data-bs-dismiss="modal">✔ Accept</button>
                        ';
                    }
                   
                } else {
                    $acceptbtn = '
                    <button type="submit" class="acceptBtnModal" id=' . $serviceId . ' data-bs-dismiss="modal">✔ Accept</button>
                    ';
                }
            }else {
                $acceptbtn = '
                <button type="submit" class="acceptBtnModal" id=' . $serviceId . ' data-bs-dismiss="modal">✔ Accept</button>
            ';

            }

            
            $mapcol='<iframe width="100%" height="400" src="https://maps.google.com/maps?q=' . $postalcode . '&output=embed"></iframe>';

            date_default_timezone_set('Asia/Kolkata');
                    $todaydate = date("Y/m/d");
                    $todaydate = strtotime($todaydate);

                    $strDate = strtotime($date);

                    $currenttime = date("H:i");
                    // $currenttime = strtotime($currenttime);
                    $time = $endTime;

                    if($todaydate>=$strDate)
                    {
                        if($todaydate == $strDate)
                        {
                            if ($currenttime >= $time)
                            {
                                $upcomingbtns='<button type="submit"  id="' . $serviceId . '"   name="' . $serviceId . '" class="completeBtnModal" data-bs-dismiss="modal">✔ Complete</button> ';
                                
                            }else{
                                $upcomingbtns='<button type="submit" id="' . $serviceId . '" data-bs-toggle="modal" data-bs-target="#cancel_modal" class="cancelBtnModal">❌ Cancel</button>';
                            }
                        }else{
                            $upcomingbtns=' <button type="submit"  id="' . $serviceId . '"   name="' . $serviceId . '" class="completeBtnModal" data-bs-dismiss="modal">✔ Complete</button> ';
                        }
                    }else{
                        $upcomingbtns='<button type="submit" id="' . $serviceId . '" data-bs-toggle="modal" data-bs-target="#cancel_modal" class="cancelBtnModal">❌ Cancel</button>';
                    }



              $output = [$serviceId, $totalTime, $payment, $status, $userId, $serviceProvider, $reschedule, $cancel, $update_btn, $cancel_btn, $selectNewtime, $cancelReason, $updateTime, $date, $sTime, $eTime, $extraservices, $customerName, $serviceAddress, $phone, $pets, $acceptbtn, $upcomingbtns, $mapcol];

            }
        }
        echo json_encode($output);

    }
 
}

public function rescheduleService(){
    if(isset($_POST))
    {
        $serviceId=$_POST['serviceId'];
        $newDate=$_POST['newDate'];
        $newTime=$_POST['newTime'];
        $result=$this->model->getServicedata($serviceId);
        if(count($result))
        {
            foreach($result as $row)
            {
                $userId=$row['UserId'];
                $serviceProviderId=$row['ServiceProviderId'];
                $recordversion=$row['RecordVersion'];

            }
        }
        $recordversion=$recordversion+1;
        $usermail=$this->model->getUserId($userId);
        if (count($usermail)) {
            foreach ($usermail as $email) {
                $modifiedBy  = $email['Email'];
            }
        }
        $modifiedDate=date('Y-m-d');
        $status="Panding";
        if (!empty($serviceProviderId)) {
            $status = "Reschedule";
        }
        $data=[
            
            'newDate'=>$newDate,
            'newTime'=>$newTime,
            'modifiedBy'=>$modifiedBy,
            'modifiedDate'=>$modifiedDate,
            'recordversion'=>$recordversion,
            'status'=>$status,
            
            'serviceId'=>$serviceId,

        ];

        $update = $this->model->rescheduleService($data);
        if(!empty($serviceProviderId))
        {
            $spmail=$this->model->getUserId($serviceProviderId);
            if(count($spmail))
            {
                foreach($spmail as $spemail){
                    $email=$spemail['Email'];
                }
            }
        }
        $count=$update[0];
        if($count==1)
        {
            //sending email to client for reschedule successful
            $customerEmail=$modifiedBy;
            // include("views/clientReschedulemail.php");

            if(!empty($serviceProviderId))
            {
                $serviceproEmail=$email;
                $serviceId=$serviceId;
                // include("views/SP_Reschedulemail.php");
            }
            //sending email to all the service providers for rescheduling of the service
            
            if(empty($serviceProviderId))
            {
                $serviceproviders = $this->model->GetAllServiceProvider();
                if (count($serviceproviders)) {
                    foreach ($serviceproviders as $row) {
                        $spemail = $row['Email'];
                        // include("views/SPallRescheduleMail.php");
                    }
                }
            }

            echo 1;
        }else{
            echo 0;
        }

    }

}
  
public function cancelService(){
    // echo 0;
    if(isset($_POST))
    {
        $serviceId=$_POST['serviceId'];
        $cancelReason=$_POST['cancelReason'];

        $result=$this->model->getServicedata($serviceId);
        if(count($result))
        {
            foreach($result as $row)
            {
                $userId=$row['UserId'];
                $serviceProviderId=$row['ServiceProviderId'];
                $recordversion=$row['RecordVersion'];
                $spId = $row['ServiceProviderId'];
            }
        }
        $modifiedDate=date('Y-m-d');

        $customerEmail=$this->model->getUserId($userId);
        if(count($customerEmail))
        {
            foreach($customerEmail as $email)
            {
                $modifiedBy=$email['Email'];
            }
        }

        $status="Cancelled";
        $data=[
            'cancelReason'=>$cancelReason,
            'modifiedDate'=>$modifiedDate,
            'modifiedBy'=>$modifiedBy,
            'recordversion'=>$recordversion,
            'status'=>$status,
            'spid'=>$spId,
            'serviceId'=>$serviceId,

        ];
        $cancelService=$this->model->cancelServiceRequest($data);
        if(!empty($serviceProviderId))
        {
            $spmail=$this->model->getUserId($serviceProviderId);
            if(count($spmail))
            {
                foreach($spmail as $spemail){
                    $email=$spemail['Email'];
                }
            }
        }
        $count=$cancelService[0];
        if($count==1)
        {
            //email sending to customer for cancellation of service request
            $custmail=$modifiedBy;
            $serviceId=$serviceId;
            // include("views/cust_cancelEmail.php");
            //email sending to service providers for cancelation of the service request
            if(!empty($serviceProviderId)){
               $spemail=$email;
            //    include("views/Sp_cancelEmail.php");
            }
            if(empty($serviceProviderId)){
                $serviceproviders = $this->model->GetAllServiceProvider();
                if (count($serviceproviders)) {
                    foreach ($serviceproviders as $row) {
                        $spemail = $row['Email'];
                        // include("views/Sp_cancelEmail.php");
                    }
                }

            }
            echo 1;
        }else{
            echo 0;
        }
    }
}

public function customerServiceHistory(){
    if(isset($_POST))
    {
        $email=$_POST['username'];
        $result=$this->model->forgotPassword($email);
        $userId=$result[3];

        $result=$this->model->getCustomerDetail($userId);
        $json['data']=array();

        if(count($result))
        {
            foreach($result as $row)
            {
                $serviceId=$row['ServiceRequestId'];
                $payment = $row['TotalCost'];
                $serviceDate = $row['ServiceStartDate'];
                $status = $row['Status'];
                $serviceTime = $row['ServiceTime'];
                $totalHour = $row['TotalHours'];
                $status = $row['Status'];
                $serviceProviderId=$row['ServiceProviderId'];

                if ($status != "Panding" && $status != "Approoved" && $status != "Reschedule"){
                    $stratTime = $serviceTime;
                    $endTime = $serviceTime + $totalHour;
                    $sTime='';
                    $eTime='';
                    if(strpos($stratTime, ".5")){
                        $sTime=str_replace(".5",":30",$stratTime);
                    }else{
                        $sTime=$stratTime.':00';
                    }

                    if(strpos($endTime, ".5")){
                        $eTime=str_replace(".5",":30",$endTime);
                    }else{
                        $eTime=$endTime.':00';
                    }

                $serviceidcol='<td class="serviceid"> <div class="serviceDetailModel" data-bs-toggle="modal"
                data-bs-target="#ServiceHistory_modal" name="' . $serviceId . '">' . $serviceId . '</div></td>';
                $servicedatecol=' <td>
                <div class="serviceDetailModel" data-bs-toggle="modal"
                data-bs-target="#ServiceHistory_modal" name="' . $serviceId . '">
                <span><img src="./assets/assets/calendar2.png" alt="#" />' . $serviceDate . '</span>
                <br />
                <span><img src="./assets/assets/layer-14.png" alt="#" /> ' . $sTime . ' - ' . $eTime . '</span>
                </div>
              </td>';

              $serviceProvidercol = '';
              if(!empty($serviceProviderId)){
                $serviceproviderid = intval($row['ServiceProviderId']);
                // $serviceProvidercol='<td> ' . $serviceproviderid . ' </td>';
                  
                $spDetails = $this->model->getspData($serviceproviderid);

                if (count($spDetails)) {
                    foreach ($spDetails as $sp) {
                        $spfirstname = $sp['FirstName'];
                        $splastname = $sp['LastName'];
                        $imgdp = $sp['UserProfilePicture'];
                        $star='';
                        $spRating='';

                        $spRate=$this->model->getRating($serviceProviderId);
                            if(count($spRate[0]))
                            {
                                $spRating=0;

                                foreach($spRate[0] as $row){
                                    $spRating=($spRating+$row['Ratings']);
                                }

                                $spRating=round(($spRating / $spRate[1]), 2);
                                $finalavgrating=round($spRating);
                                $star='<i class = "fa fa-star" aria-hidden = "true" id = "st"></i>';
                                if($finalavgrating==1)
                                {
                                    $star='<i class = "fa fa-star" aria-hidden = "true" id = "st"></i>';
                                }
                                if($finalavgrating==2)
                                {
                                    $star='<i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                    <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>';
                                }
                                 if($finalavgrating==3)
                                {
                                    $star='<i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                    <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                    <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>';
                                }
                                if($finalavgrating==4)
                                {
                                    $star='<i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                    <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                    <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                    <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>';
                                }
                                if($finalavgrating==5)
                                {
                                    $star='<i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                    <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                    <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                    <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                    <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>';
                                }
                            }
                            if (strlen($imgdp) != 0) {
                                    
                                $image = str_replace("http://localhost/Tatvasoft/Helperland_MVC/", "./", $imgdp);
                                $img = '<img  src="' . $image . '" class="SPimg">';
                            } else {
                                
                                $img = '<img src="./assets/assets/cap.png" alt="" id="cap" />';
                            }
                        $serviceProvidercol = ' <td>
                        <div class="serviceDetailModel" data-bs-toggle="modal"
                        data-bs-target="#ServiceHistory_modal" name="' . $serviceId . '">
                        ' . $img . ' 
                        ' . $spfirstname . '' . $splastname . '
                        <br />
                        <span id="star">
                        ' . $star . '
                          <span>' . $spRating . '</span>
                        </span>

                        </div>
                      </td>';
                    }
                }

              }
              $paymentcol='<td class="payment">
              <div class="serviceDetailModel" data-bs-toggle="modal"
              data-bs-target="#ServiceHistory_modal" name="' . $serviceId . '">
                <h5><span>€</span>' . $payment . '</h5>
                </div>
                </td>';
                $statuscol='';
                $ratecol='';
              if($status=="Completed"){
                $statuscol='<td><span id="pay-status">' . $status . '</span></td>';
              }
              if($status=="Cancelled"){
                $statuscol='<td><span id="cancle-status">' . $status . '</span></td>';
            }
            if($status=="Cancelled"){
                $ratecol='<td><button class="rate-btn" id="' . $serviceId . '" disabled="disabled">Rate SP</button></td>';
            }
            if($status=="Completed"){
                $ratecol='<td><button class="rate-btn" id="' . $serviceId . '" type="button" data-bs-toggle="modal"
                data-bs-target="#rate_sp" name="' . $serviceId . '">Rate SP</button></td>';
            }
            

            $results = array();
            $results['serviceId'] = $serviceidcol;
            $results['serviceDate'] = $servicedatecol;
            $results['serviceProvider'] = $serviceProvidercol;
            $results['payment'] = $paymentcol;
            $results['status'] = $statuscol;
            $results['rateSP'] = $ratecol;

            array_push($json['data'], $results);

            }
            }
            echo json_encode($json);
        }else{
            $json=0;
            echo json_encode($json);
        }
    }
 
}

public function custDetails(){
    if(isset($_POST))
    {
        $email=$_POST['username'];
        $userdetail=$this->model->getUserDetails($email);
        $street="";
        $house="";
        $postalcode="";
        $city="";
        if(count($userdetail))
        {
            foreach($userdetail as $row)
            {
                $firstName=$row['FirstName'];
                $lastName=$row['LastName'];
                $email=$row['Email'];
                $phone=$row['Mobile'];
                $dateOfBirth=$row['DateOfBirth'];
                $language=$row['LanguageId'];
                $gender=$row['Gender'];
                $nationality=$row['NationalityId'];
                $avatarimg=$row['UserProfilePicture'];
               

                if (!empty($dateOfBirth)) {

                    list($year, $month, $day) = explode("-", $dateOfBirth);
                } else {
                    $year = "00";
                    $month = "00";
                    $day = "00";
                }

                $getAddress=$this->model->get_address($email);
                if($getAddress)
                {
                    foreach($getAddress as $row)
                    {
                        $street=$row['AddressLine1'];
                        $house=$row['AddressLine2'];
                        $postalcode=$row['PostalCode'];
                        $city=$row['City'];
                        
                    }
                }


                $data=[$firstName, $lastName, $email, $phone, $day, $month, $year,  $language, $gender, $nationality, $avatarimg, $street, $house, $postalcode, $city];

                echo json_encode($data);
            }
            

        }
    }
    

}

public function savecustDetails(){
    if(isset($_POST))
    {
        $firstName=$_POST['firstName'];
        $lastName=$_POST['lastName'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $dateOfBirth=$_POST['dateOfBirth'];
        $language=$_POST['language'];
        $modifiedDate=date('Y-m-d');
        $modifiedBy=$firstName;

        $data=[
            'firstName'=>$firstName,
            'lastName'=>$lastName,
            
            'phone'=>$phone,
            'dateOfBirth'=>$dateOfBirth,
            'language'=>$language,
            'modifiedDate'=>$modifiedDate,
            'modifiedBy'=>$modifiedBy,

            'email'=>$email,
        ];
        $result=$this->model->saveCustDetails($data);
        $count=$result[0];
        if($count==1)
        {
            echo 1;
        }else{
            echo 0;
        }
    }
}

public function getAddressTable(){
    if(isset($_POST))
    {
        $email=$_POST['username'];
        $result=$this->model->getAddress($email);
        $json['data']=array();
        if(count($result))
        {
            foreach($result as $row)
            {
                $streetname=$row['AddressLine1'];
                $housenumber=$row['AddressLine2'];
                $city=$row['City'];
                $postalcode=$row['PostalCode'];
                $phonenumber=$row['Mobile'];
                $isDefault=$row['IsDefault'];
                $isDeleted=$row['IsDeleted'];
                $address_id=$row['AddressId'];

                if($isDefault==1){
                    $isDefault='checked';
                }else{
                    $isDefault='';
                }
                if($isDeleted==0)
                {
                    $defaultCol='<td scope="row" class="defaultAddress">
                    <input type="radio" id=" ' . $address_id . ' " value=" ' . $address_id . ' " name="addressDef" ' . $isDefault . '>
                  </td>';
                    $addressCol=' <td>
                    <div class="address">
                    <b>Address :</b> ' . $streetname . ' ' . $housenumber . ', ' . $postalcode . ' ' . $city . ' <br>
                    <b>Phone number :</b> ' . $phonenumber . '
                    </div>
                    </td>';
                    $actionCol='<td>
                    <button style="margin-right: 10px; border: none" data-bs-toggle="modal" data-bs-target="#edit_address" class="editBtn" id="' . $address_id . '"><img src="./assets/assets/edit.png" alt="" style="height: 20px; width: 20px;"></button>

                    <button style="border: none" data-bs-toggle="modal" data-bs-target="#deleteModal" class="DeleteBtn" id="' . $address_id . '"><img src="./assets/assets/delete.png" alt="" style="height: 22px; width: 25px;"></button>

                  </td>';

                    $result=array();
                    $result['default']=$defaultCol;
                    $result['address']=$addressCol;
                    $result['action']=$actionCol;
                    array_push($json['data'],$result);
                }
            }

        }
        echo json_encode($json);
    }

}

public function getAddressData(){
    if(isset($_POST))
    {
        $addressId=$_POST['addressId'];
        $result=$this->model->getAddresstab($addressId);
        if(count($result))
        {
            foreach($result as $row)
            {
                $streetname=$row['AddressLine1'];
                $housenumber=$row['AddressLine2'];
                $city=$row['City'];
                $postalcode=$row['PostalCode'];
                $phonenumber=$row['Mobile'];
                $citySelect='<option value="' . $city . '" selected>' . $city . '</option>';

                $data=[$streetname, $housenumber, $citySelect, $postalcode, $phonenumber, $addressId];

            }
        }
        echo json_encode($data);
    }
}

public function editAddress(){
    if(isset($_POST))
    {
        $streetname=$_POST['streetname'];
        $housenumber=$_POST['housenumber'];
        $postalcode=$_POST['postalcode'];
        $city=$_POST['city'];
        $phonenumber=$_POST['phone'];
        $addressId=$_POST['addressId'];

        $state1=$this->model->getCity($postalcode);
        $state=$state1[1];
        
        $data=[
            'streetname'=>$streetname,
            'housenumber'=>$housenumber,
            'postalcode'=>$postalcode,
            'city'=>$city,
            'state' => $state,
            'phonenumber'=>$phonenumber,
            'addressId'=>$addressId,
        ];
            $result = $this->model->editaddress($data);

            $count = $result[0];
            if ($count == 1) {
                echo 1;
            } else {
                echo 0;
            }
        

    }

}

public function deleteAddress(){
    if(isset($_POST))
    {
        $addressId=$_POST['addressId'];
        // echo $addressId;
        $result=$this->model->deleteAdd($addressId);
        $count=$result[0];

        if($count==1)
        {
            echo 1;
        }else{
            echo 0;
        }
    }
}

public function changePassword(){
    if(isset($_POST))
    {
        $email=$_POST['username'];
        $oldPassword=$_POST['oldPassword'];
        $newPassword=$_POST['newPassword'];
        $confirmPassword=$_POST['confirmPassword'];
        $modifiedBy=$_POST['modifiedBy'];

        $getPassword=$this->model->getUserDetails($email);
        if(count($getPassword))
        {
            foreach($getPassword as $row)
            {
                $orignalPass=$row['Password'];
                $resetKey=$row['ResetKey'];

                if($oldPassword == $orignalPass)
                {
                    $modifiedDate=date('Y-m-s');
                    $data=[
                        'password'=>$newPassword,
                        'updatedate'=>$modifiedDate,
                        'modifiedby'=>$modifiedBy,
                        'resetkey'=>$resetKey,
                    ];
                    $result=$this->model->resetpassword($data);
                    $count=$result[0];
                    
                    if($count==1)
                    {
                        echo 1;
                    }else{
                        echo 2;
                    }
                }else{
                    echo 0;
                }
            }
        }

    }
}

public function DefaultAddress(){
    if(isset($_POST))
    {
        $checkDef=$_POST['checkDef'];
        $result=$this->model->checkDefAdd($checkDef);
        $count=$result[0];
        if($count==1)
        {
            echo 1;
        }
        else{
            echo 0;
        }


    }

}

public function getRateModalData(){
    if(isset($_POST))
    {
        $serviceId=$_POST['serviceId'];
        $result=$this->model->getServicedata($serviceId);

        if(count($result))
        {
            foreach($result as $row)
            {
                $serviceProviderId=$row['ServiceProviderId'];
                if(!empty($serviceProviderId)){
                    $serviceProviderData=$this->model->getUserId($serviceProviderId);

                    if(count($serviceProviderData)){
                        foreach($serviceProviderData as $row)
                        {

                            $firstnameSp=$row['FirstName'];
                            $lastnameSp=$row['LastName'];
                            $serviceproviderid=$serviceProviderId;
                            $star='';
                            $spRating='';
                            //get avarage rating here
                            $spRate=$this->model->getRating($serviceProviderId);
                            if(count($spRate[0]))
                            {
                                $spRating=0;

                                foreach($spRate[0] as $row){
                                    $spRating=($spRating+$row['Ratings']);
                                }

                                $spRating=round(($spRating / $spRate[1]), 2);
                                $finalavgrating=round($spRating);
                                $star='<i class = "fa fa-star" aria-hidden = "true" id = "st"></i>';
                                if($finalavgrating==1)
                                {
                                    $star='<i class = "fa fa-star" aria-hidden = "true" id = "st"></i>';
                                }
                                if($finalavgrating==2)
                                {
                                    $star='<i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                    <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>';
                                }
                                 if($finalavgrating==3)
                                {
                                    $star='<i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                    <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                    <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>';
                                }
                                if($finalavgrating==4)
                                {
                                    $star='<i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                    <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                    <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                    <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>';
                                }
                                if($finalavgrating==5)
                                {
                                    $star='<i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                    <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                    <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                    <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                    <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>';
                                }
                                $serviceprovidercol='<h6 class="modal-title" id="header_modal" ><img src="./assets/assets/cap.png" alt="" id="cap" />
                                <div id="' . $serviceproviderid . '" name="' . $serviceId . '" class="spData">' . $firstnameSp . ' ' . $lastnameSp . '</div>
                                
                                <span class="Rate">
                                ' . $star . '
                                </span>
                                <span class="avgrate">' . $spRating . '</span>
          
                              </h6>';

                            }else{
                                $serviceprovidercol='<h6 class="modal-title" id="header_modal" ><img src="./assets/assets/cap.png" alt="" id="cap" />
                                <div id="' . $serviceproviderid . '" name="' . $serviceId . '" class="spData">' . $firstnameSp . ' ' . $lastnameSp . '</div>
                                
                                <span class="Rate">
                                <i class = "fa fa-star" aria-hidden = "true" id = "st1"></i> 
                                <i class = "fa fa-star" aria-hidden = "true" id = "st2"></i> 
                                <i class = "fa fa-star" aria-hidden = "true" id = "st3"></i> 
                                <i class = "fa fa-star" aria-hidden = "true" id = "st4"></i> 
                                <i class = "fa fa-star" aria-hidden = "true" id = "st5"></i> 
                                </span>
                                <span class="avgrate">0</span>
          
                              </h6>';
                            }
                        }
                    }
                }
                 
            }
            $onTimeRate='<i class = "fa fa-star" aria-hidden = "true" id = "tst1"></i> 
            <i class = "fa fa-star" aria-hidden = "true" id = "tst2"></i> 
            <i class = "fa fa-star" aria-hidden = "true" id = "tst3"></i> 
            <i class = "fa fa-star" aria-hidden = "true" id = "tst4"></i> 
            <i class = "fa fa-star" aria-hidden = "true" id = "tst5"></i> 
            <span class="rateTime"></span>';

            $friendlyRate=' <i class = "fa fa-star" aria-hidden = "true" id = "fst1"></i> 
            <i class = "fa fa-star" aria-hidden = "true" id = "fst2"></i> 
            <i class = "fa fa-star" aria-hidden = "true" id = "fst3"></i> 
            <i class = "fa fa-star" aria-hidden = "true" id = "fst4"></i> 
            <i class = "fa fa-star" aria-hidden = "true" id = "fst5"></i> 
            
            <span class="rateFrnd"></span>';
            $qualityRate='<i class = "fa fa-star" aria-hidden = "true" id = "qst1"></i> 
            <i class = "fa fa-star" aria-hidden = "true" id = "qst2"></i> 
            <i class = "fa fa-star" aria-hidden = "true" id = "qst3"></i> 
            <i class = "fa fa-star" aria-hidden = "true" id = "qst4"></i> 
            <i class = "fa fa-star" aria-hidden = "true" id = "qst5"></i> 
            
            <span class="rateqlt"></span>';
            $feedback=' <h6 style="font-size: 14px; margin-top: 5px;">Feedback on service provider</h6>
                        
            <textarea name="feedback_sp" id="feedback_sp" cols="8" rows="2"></textarea>
          ';

            $data=[$serviceprovidercol, $onTimeRate, $friendlyRate, $qualityRate, $feedback, $serviceId];
        }
        echo json_encode($data);
    }

}

public function addRating(){
    if(isset($_POST))
    {
        $onTimeRate=$_POST['onTimeRate'];
        $friedlyRate=$_POST['friedlyRate'];
        $qualityRate=$_POST['qualityRate'];
        $spId=$_POST['spId'];
        $serviceId=$_POST['serviceId'];
        $username=$_POST['rateFrom'];
        $feedback=$_POST['feedback'];

        $result=$this->model->forgotPassword($username);
        $userId=$result[3];

        $rateCount=$this->model->countRate($serviceId);
        $ratenumber=$rateCount[1];
        

        $avgRating=round(((intval($onTimeRate) + intval($friedlyRate) + intval($qualityRate)) / 3), 2);

        $data=[
            'serviceId'=>$serviceId,
            'ratefrom' => $userId,
            'rateto' => $spId,
            'avgrating' => $avgRating,
            'feedback' => $feedback,
            'ratedate' => date('Y-m-d'),
            'isapproved' => 1,
            'onTimeRate' => $onTimeRate,
            'friedlyRate' => $friedlyRate,
            'qualityRate' => $qualityRate,
        ];
        
        
        if($ratenumber>0)
        {
            echo 2;
        }else{
            $result=$this->model->addrating($data);
            if($result==1)
            {
                echo 1;
            }else{
                echo 0;
            }
        }

    }

}

public function getNewServiceReq(){
    if(isset($_POST))
    {
        $username=$_POST['username'];
        $hpet=intval($_POST['pet']);
        $userId=$this->model->forgotPassword($username);
        $userId=$userId[3];

        $json['data']=array();

        if($hpet==0)
        {
            $result=$this->model->getNewServices();
        }
        if($hpet==1)
        {
            $result=$this->model->getNewServicesWithPet();
        }
                
        if(count($result))
        {
            foreach($result as $row)
            {
                $serviceid=$row['ServiceRequestId'];
                $servicestartdate = $row['ServiceStartDate'];
                $servicestarttime = $row['ServiceTime'];
                $fname = $row['FirstName'];
                $lname = $row['LastName'];
                $street = $row['AddressLine1'];
                $houseno = $row['AddressLine2'];
                $city  = $row['City'];
                $state = $row['State'];
                $postalcode = $row['PostalCode'];
                $payment = $row['TotalCost'];
                $totaltime = $row['TotalHours'];
                $status = $row['Status'];
                $pets = $row['HasPets'];
                $serviceproviderid = $row['ServiceProviderId'];

                $startTime=$servicestartdate;
                $endTime=$servicestarttime+$totaltime;
                                    
                    $entime = $servicestarttime + $totaltime;
                    $sTime='';
                    $eTime='';
                    if(strpos($servicestarttime, ".5")){
                        $sTime=str_replace(".5",":30",$servicestarttime);
                    }else{
                        $sTime=$servicestarttime.':00';
                    }

                    if(strpos($entime, ".5")){
                        $eTime=str_replace(".5",":30",$entime);
                    }else{
                        $eTime=$entime.':00';
                    }

                $isconflict=$this->model->isConflict($userId, $startTime, $servicestarttime);
                $count=$isconflict[0];
                // $timeconflictcol='';
                // $actioncol='';
                if($count>=1)
                {
                    $servicerequestid = $isconflict[1];
                    if($serviceid != $servicerequestid)
                    {
                        $timeconflictcol='<td>Another service request ' . $servicerequestid . ' <br> has already been assigned, You can’t accept!</td>';

                        $actioncol='<button data-bs-toggle="modal" data-bs-target="#serviceDetail" id="' . $serviceid . '" class="acceptBtn modaldata" name="' . $serviceid . '" disabled="disabled">Accept</button>';
                    }else{
                        $timeconflictcol='';
                    $actioncol='<button data-bs-toggle="modal" data-bs-target="#serviceDetail" id="' . $serviceid . '" class="acceptBtn modaldata" name="' . $serviceid . '">Accept</button>';
                    }
                                        
                }else{
                    $timeconflictcol='';
                    $actioncol='<button data-bs-toggle="modal" data-bs-target="#serviceDetail" id="' . $serviceid . '" class="acceptBtn modaldata" name="' . $serviceid . '">Accept</button>';
                }

                $serviceidcol='
                <div class="modaldata" data-bs-toggle="modal" data-bs-target="#serviceDetail" id="' . $userId . '" name="' . $serviceid . '">
                ' . $serviceid . '
                </div>';

              $servicedatecol=' 
              <div class="modaldata" data-bs-toggle="modal" data-bs-target="#serviceDetail" id="' . $userId . '" name="' . $serviceid . '">
              <span><img src="./assets/assets/calendar2.png" alt=""></span>' . $startTime . '<br> <span><img src="./assets/assets/layer-14.png" alt=""></span> ' . $sTime . ' - ' . $eTime . '</div>';

              $userdetailscol='<div class="modaldata" id="' . $userId . '"  name="' . $serviceid . '" data-bs-toggle="modal" data-bs-target="#serviceDetail">
              ' . $fname . ' ' . $lname . ' <br> <span><img src="./assets/assets/layer-15.png" alt=""></span> ' . $street . ' ' . $houseno . ',' . $postalcode . ' ' . $city . '</div>';
              $paymentcol='<div class="payment">
              € ' . $payment . '
          </div>';

            $result = array();
            
            $result['serviceId'] = $serviceidcol;
            $result['serviceDate'] = $servicedatecol;
            $result['customerDetails'] = $userdetailscol;
            $result['payment'] = $paymentcol;
            $result['timeConflict'] = $timeconflictcol;
            $result['actions'] = $actioncol;
                  
       
        array_push($json['data'], $result);

        }
        }
        echo json_encode($json);
    }

}

public function acceptServiceReq(){
    if(isset($_POST))
    {
        $serviceId=$_POST['serviceid'];
        $username=$_POST['username'];
        $result=$this->model->getServicedata($serviceId);
        if(count($result))
        {
            foreach($result as $row)
            {
                $recordversion = $row['RecordVersion'];
                    $customerId = intval($row['UserId']);
                    $status = $row['Status'];
            }
        }
        if($status != 'Approoved')
        {
            $recordversion = $recordversion + 1;
            $spData= $this->model->forgotPassword($username);
            $userEmail = $this->model->getUserId($customerId);
            $spId = $spData[3];
            if(count($userEmail))
            {
                foreach($userEmail as $mail)
                {
                    $custMail=$mail['Email'];
                }
            }
            $status="Approoved";
            $modifiedDate=date('Y-m-d');

            $data=[
                'modifiedDate'=>$modifiedDate,
                'modifiedBy'=>$username,
                'recordversion'=>$recordversion,
                'status'=>$status,
                'serviceProviderId'=>$spId,
                'serviceId'=>$serviceId,
                

            ];
            $result=$this->model->aproveSReq($data);
            $usertypeId=1;
            $allSp=$this->model->getallSp($usertypeId, $spId);
            $count=$result[0];

            if($count==1)
            {
                // After Accept Email Script 
                // To Customer
                $CustMail=$custMail;
                // include('views/AcceptmailToCustomer.php');
                
                //To Service Providers
                if(count($allSp))
                {
                    foreach($allSp as $sp)
                    {
                        $spmail=$sp['Email'];
                        // include('views/SPacceptedmail.php');
                    }
                }
                echo 1;
            }else{
                echo 0;
            }
        }else{
            echo 2;
        }
    }

}

public function getUpcomingService(){
    if(isset($_POST))
    {
        $username = $_POST['username'];
        $userId=$this->model->forgotPassword($username);
        $userId=$userId[3];
        $json['data'] = array();
        $upcomingService=$this->model->getupcomeservice($userId);
        if(count($upcomingService)){
            foreach($upcomingService as $row)
            {
                $serviceId = $row['ServiceRequestId'];
                $servicestartdate = $row['ServiceStartDate'];
                $servicestarttime = $row['ServiceTime'];
                $fname = $row['FirstName'];
                $lname = $row['LastName'];
                $street = $row['AddressLine1'];
                $houseno = $row['AddressLine2'];
                $city  = $row['City'];
                $state = $row['State'];
                $postalcode = $row['PostalCode'];
                $payment = $row['TotalCost'];
                $totaltime = $row['TotalHours'];
                $status = $row['Status'];
                $serviceproviderid = $row['ServiceProviderId'];

                $serviceidcol='<div class="detailModal" data-bs-toggle="modal" data-bs-target="#upcomingModal" id="' . $userId . '" name="' . $serviceId . '">' . $serviceId . '</div>';

                $startTime=$servicestartdate;
                $endTime=floatval($servicestarttime+$totaltime);

                $entime = $servicestarttime + $totaltime;
                    $sTime='';
                    $eTime='';
                    if(strpos($servicestarttime, ".5")){
                        $sTime=str_replace(".5",":30",$servicestarttime);
                    }else{
                        $sTime=$servicestarttime.':00';
                    }

                    if(strpos($entime, ".5")){
                        $eTime=str_replace(".5",":30",$entime);
                    }else{
                        $eTime=$entime.':00';
                    }

                $servicedatecol='<div class="detailModal" data-bs-toggle="modal" data-bs-target="#upcomingModal" id="' . $userId . '" name="' . $serviceId . '">
                      <span><img src="./assets/assets/calendar2.png" alt=""></span> ' . $startTime . ' <br> <span><img src="./assets/assets/layer-14.png" alt=""></span> ' . $sTime . ' - ' . $eTime . ' <div>';

                $servicedetailcol='<div class="detailModal" id="' . $userId . '"  name="' . $serviceId . '" data-bs-toggle="modal" data-bs-target="#upcomingModal">' . $fname . ' ' . $lname . '<br> <span><img src="./assets/assets/layer-15.png" alt=""></span> ' . $street . ' ' . $houseno . ',' . $postalcode . ' ' . $city . '<div>';  

                    date_default_timezone_set('Asia/Kolkata');
                    $todaydate = date("Y/m/d");
                    $todaydate = strtotime($todaydate);

                    $strDate = strtotime($servicestartdate);

                    $currenttime = date("H:i");
                    // $currenttime = strtotime($currenttime);
                    $time = $endTime;

                    if($todaydate>=$strDate)
                    {
                        if($todaydate == $strDate)
                        {
                            if ($currenttime >= $time)
                            {
                                $actioncol=' <button type="submit" class="completeBtnModal detailModal" id="' . $serviceId . '" data-bs-toggle="modal" data-bs-target="#upcomingModal">✔ Complete</button>';
                            }else{
                                $actioncol='<button class="cancle-btn detailModal" id="' . $serviceId . '"  data-bs-toggle="modal" data-bs-target="#cancel_modal">Cancle</button>';
                            }
                        }else{
                            $actioncol=' <button type="submit" class="completeBtnModal detailModal" id="' . $serviceId . '" data-bs-toggle="modal" data-bs-target="#upcomingModal">✔ Complete</button>';
                        }
                    }else{
                        $actioncol='<button class="cancle-btn detailModal" id="' . $serviceId . '"  data-bs-toggle="modal" data-bs-target="#cancel_modal">Cancle</button>';
                    }

                    $result=array();

                    
                    $result['serviceId'] = $serviceidcol;
                    $result['serviceDate'] = $servicedatecol;
                    $result['customerDetails'] =  $servicedetailcol;
                    $result['distance'] = '25km';
                    $result['actions'] = $actioncol;

                    array_push($json['data'], $result);

            }
        }
        echo json_encode($json);

    }

}

public function SPRequestCancel(){
    if(isset($_POST))
    {
        $serviceId=$_POST['serviceId'];
        $cancelreason=$_POST['canclereason'];

        $result=$this->model->getServicedata($serviceId);
        if (count($result)) {
            foreach ($result as $row) {
                $recordversion = $row['RecordVersion'];
                $userId = intval($row['UserId']);
                $spId = intval($row['ServiceProviderId']);
                $servicestartDate = $row['ServiceStartDate'];
            }
        }
        $recordversion = $recordversion + 1;
        $userEmail=$this->model->getUserId($spId);
        if(count($userEmail))
        {
            foreach($userEmail as $row)
            {
                $modifiedBy  = $row['Email'];
            }
        }
        $modifiedDate=date('Y-m-d');
        $todayDate=date('Y-m-d');
        if($servicestartDate >= $todayDate){
            $status="Cancelled";
            $spid=$spId;
        }else{
            $status="Panding";
            $spid=0;
        }
        
        $data=[
            'cancelReason'=>$cancelreason,
            'modifiedDate'=>$modifiedDate,
            'modifiedBy'=>$modifiedBy,
            'recordversion'=>$recordversion,
            'status'=>$status,
            'spid'=>$spid,
            'serviceId'=>$serviceId,
        ];
        $cancelReq=$this->model->cancelServiceRequest($data);
        $count = $cancelReq[0];
            if ($count == 1) {
                echo 1;
            } else {
                echo 0;
            }
    }
   
}

public function completeService(){
    if(isset($_POST))
    {
        $serviceId=$_POST['serviceId'];
       
        $result=$this->model->getServicedata($serviceId);

        if (count($result)) {
            foreach ($result as $row) {
                $recordversion = $row['RecordVersion'];
                $userId = intval($row['UserId']);
                $spId = intval($row['ServiceProviderId']);
            }
        }
        $recordversion = $recordversion + 1;
        $userEmail=$this->model->getUserId($spId);
        if(count($userEmail))
        {
            foreach($userEmail as $row)
            {
                $modifiedBy  = $row['Email'];
            }
        }
        $modifiedDate=date('Y-m-d');
        $status="Completed";
        $data=[
            
            'modifiedDate'=>$modifiedDate,
            'modifiedBy'=>$modifiedBy,
            'recordversion'=>$recordversion,
            'status'=>$status,
            
            'serviceId'=>$serviceId,
        ];
        $completeReq=$this->model->completeServiceRequest($data);
        $count = $completeReq[0];
            if ($count == 1) {
                echo 1;
            } else {
                echo 0;
            }
    }

}

public function ServiceHistorySp(){
    $username = $_POST['username'];
    $payStatus=intval($_POST['Sstatus']);

        $userId=$this->model->forgotPassword($username);
        $userId=$userId[3];
        if($payStatus==1)
        {
            $serviceData = $this->model->getSpServiceHistory($userId);
        }
        if($payStatus==2)
        {
            $serviceStatus = "Completed";
            $serviceData = $this->model->GetCompltSPHistory($userId,$serviceStatus);
        }
        if($payStatus==3)
        {
            $serviceStatus = "Cancelled";
            $serviceData = $this->model->GetCompltSPHistory($userId,$serviceStatus);
        }
                

        $json['data'] = array();

        // $serviceData=$this->model->getSpServiceHistory($userId);
        if(count($serviceData))
        {
            foreach($serviceData as $row)
            {
                    $date = $row['ServiceStartDate'];
                    $starttime = $row['ServiceTime'];
                    $totaltime = $row['TotalHours'];
                    $user = $row['UserId'];
                    $serviceId = $row['ServiceRequestId'];
                    $status = $row['Status'];

                    if ($status != "Panding" && $status != "Approoved" && $status != "Reschedule") {

                
                $endTime=floatval($starttime+$totaltime);

                $entime = $starttime + $totaltime;
                    $sTime='';
                    $eTime='';
                    if(strpos($starttime, ".5")){
                        $sTime=str_replace(".5",":30",$starttime);
                    }else{
                        $sTime=$starttime.':00';
                    }

                    if(strpos($entime, ".5")){
                        $eTime=str_replace(".5",":30",$entime);
                    }else{
                        $eTime=$entime.':00';
                    }

                $serviceIdcol='<td><div class="modalData" data-bs-toggle="modal" data-bs-target="#historyModal" name="' . $serviceId . '">' . $serviceId . '</div></td>';

                $serviceDatecol='<div class="modalData" data-bs-toggle="modal" data-bs-target="#historyModal" id="' . $userId . '" name="' . $serviceId . '">
                      <span><img src="./assets/assets/calendar2.png" alt=""></span> ' . $date . ' <br> <span><img src="./assets/assets/layer-14.png" alt=""></span> ' . $sTime . ' - ' . $eTime . ' <div>';
                $serviceDetailcol='';
                $custData=$this->model-> custDataHistory($serviceId); 
                if(count($custData))    
                {
                    foreach($custData as $row)
                    {
                        $fname = $row['FirstName'];
                        $lname = $row['LastName'];
                         $street = $row['AddressLine1'];
                        $houseno = $row['AddressLine2'];
                        $city = $row['City'];
                        $postalcode = $row['PostalCode'];

                        $serviceDetailcol='<div class="modalData" id="' . $userId . '"  name="' . $serviceId . '" data-bs-toggle="modal" data-bs-target="#historyModal">' . $fname . ' ' . $lname . '<br> <span><img src="./assets/assets/layer-15.png" alt=""></span> ' . $street . ' ' . $houseno . ',' . $postalcode . ' ' . $city . '<div>';
                    }
                }
                $statuscol='';
                if($status == "Cancelled"){
                    $statuscol='<td><span style="background-color: #FF6B6B; border: none; padding: 5px 10px; color: white;" id="cancle-status">' . $status . '</span></td>';
                }
                if($status == "Completed"){
                    $statuscol='<td><span style="background-color: rgb(101, 243, 101); border: none; padding: 5px 10px; color: white;" id="pay-status">' . $status . '</span></td>';
                }

                
                    $result = array();
                           
                    $result['serviceId'] = $serviceIdcol;
                    $result['serviceDate'] = $serviceDatecol;          
                    $result['customerDetails'] = $serviceDetailcol;
                    $result['status'] = $statuscol;

                
               
               
                array_push($json['data'], $result);
            }
                
            }
            echo json_encode($json);

        }
}

public function getRatingsforsp(){
    if(isset($_POST))
    {
        $username=$_POST['username'];
        $selectRating=$_POST['selectRating'];
        $orders=$_POST['orders'];

        $userid=$this->model->forgotPassword($username);
        $userId=$userid[3];

        if($selectRating==1)
        {
            $selectRate="AND rating.RatingTo != '' ";
        }
        if($selectRating==2)
        {
            $selectRate="AND rating.Ratings >= 4 ";
        }
        if($selectRating==3)
        {
            $selectRate="AND rating.Ratings >= 3 AND rating.Ratings < 4";
        }
        if($selectRating==4)
        {
            $selectRate="AND rating.Ratings >= 2 AND  rating.Ratings < 3 ";
        }
        if($selectRating==5)
        {
            $selectRate="AND rating.Ratings < 2 ";
        }
        if($orders==1)
        {
            
            $order="user.FirstName ASC";
        }
        if($orders==2)
        {
            $order="user.FirstName DESC";
        }
        if($orders==3)
        {
            $order="servicerequest.ServiceStartDate DESC";
          
        }
        if($orders==4)
        {
            $order="servicerequest.ServiceStartDate ASC";
        }
        if($orders==5)
        {
            $order="rating.Ratings DESC";
        }
        if($orders==6)
        {
            $order="rating.Ratings ASC";
        }
      
        
        $rating=$this->model->getRatingFilter($userId,$selectRate,$order);
        $json['data'] = array();

        if(count($rating[0]))
        {
            foreach($rating[0] as $row)
            {
                $serviceId = $row['ServiceRequestId'];
                $ratingfrom = $row['RatingFrom'];
                $spRating=$row['Ratings'];
                
                $spcomment  = $row['Comments'];
               
                $custName = $row['FirstName'] . ' ' . $row['LastName'];
                    $date = $row['ServiceStartDate'];
                    $starttime = $row['ServiceTime'];
                    $totaltime = $row['TotalHours'];
                                       
            
                        
                                $finalavgrating=round($spRating);
                                $star='<i class = "fa fa-star" style="color: #FFEA00;" id = "st"></i>';
                                if($finalavgrating==1)
                                {
                                    $star='<i class = "fa fa-star" style="color: #FFEA00;" id = "st"></i>';
                                }
                                if($finalavgrating==2)
                                {
                                    $star='<i class = "fa fa-star" style="color: #FFEA00;" id = "st"></i>
                                    <i class = "fa fa-star" style="color: #FFEA00;" id = "st"></i>';
                                }
                                 if($finalavgrating==3)
                                {
                                    $star='<i class = "fa fa-star" style="color: #FFEA00;" id = "st"></i>
                                    <i class = "fa fa-star" style="color: #FFEA00;" id = "st"></i>
                                    <i class = "fa fa-star" style="color: #FFEA00;" id = "st"></i>';
                                }
                                if($finalavgrating==4)
                                {
                                    $star='<i class = "fa fa-star" style="color: #FFEA00;" id = "st"></i>
                                    <i class = "fa fa-star" style="color: #FFEA00;" id = "st"></i>
                                    <i class = "fa fa-star" style="color: #FFEA00;" id = "st"></i>
                                    <i class = "fa fa-star" style="color: #FFEA00;" id = "st"></i>';
                                }
                                if($finalavgrating==5)
                                {
                                    $star='<i class = "fa fa-star" style="color: #FFEA00;" id = "st"></i>
                                    <i class = "fa fa-star" style="color: #FFEA00;" id = "st"></i>
                                    <i class = "fa fa-star" style="color: #FFEA00;" id = "st"></i>
                                    <i class = "fa fa-star" style="color: #FFEA00;" id = "st"></i>
                                    <i class = "fa fa-star" style="color: #FFEA00;" id = "st"></i>';
                                }

                                if($spRating>=4 && $spRating<=5)
                                {
                                    $msg="Very Good";
                                }else if($spRating>=3 && $spRating<=4)
                                {
                                    $msg="Good";
                                }else if($spRating>=2)
                                {
                                    $msg="Poor";
                                }
                                else if($spRating<2)
                                {
                                    $msg="Very Poor";
                                }

                                
                

                $startTime=$starttime;
                $endTime=floatval($starttime+$totaltime);

                $entime = $starttime + $totaltime;
                $sTime='';
                $eTime='';
                if(strpos($starttime, ".5")){
                    $sTime=str_replace(".5",":30",$starttime);
                }else{
                    $sTime=$starttime.':00';
                }

                if(strpos($entime, ".5")){
                    $eTime=str_replace(".5",":30",$entime);
                }else{
                    $eTime=$entime.':00';
                }
                $cnt = $rating[1];

                $serviceDatecol='<div class="modalData" id="' . $userId . '">
                <span><img src="./assets/assets/calendar2.png" alt=""></span> ' . $date . ' <br> <span><img src="./assets/assets/layer-14.png" alt=""></span>' . $sTime . ' - ' . $eTime . ' <div>';
                               

            
                $firstcol='<td><div>' . $serviceId . '<br><b>' . $custName . '</b></div>
                <hr>
                <b>Comments: </b>' . $spcomment . '
                </td>';
                

                $ratingcol=' <td>
                <b>Ratings</b> <br>
                <span id="star">
                ' . $star . '
                  <span>' . $msg . '</span>
                </span>
              </td>';       

              
                $output=array();
                $output['Ratings'] = $firstcol;
                $output['date']=$serviceDatecol;
                $output['rate']=$ratingcol;
              
                         
              array_push($json['data'], $output);

            }
        }
        echo json_encode($json);
    }

}

public function getcustomerList(){
    if(isset($_POST))
    {
        $username=$_POST['username'];
        $userId=$this->model->forgotPassword($username);
        $userId=$userId[3];

        $json['data'] = array();
        $getCustomer=$this->model->customerData($userId);
        if(count($getCustomer))
        {
            foreach($getCustomer as $cust)
            {
                $custFname =  $cust['FirstName'];
                $custLname =  $cust['LastName'];
                $custId = $cust['UserId'];

                $check=$this->model->checkBlocked($userId, $custId);
                $blocked=$check[1];
                if($check==0)
                {
                    $blockbtn = '<button type="button" class="block_unblock " name = "' . $userId . '" id="' . $custId . '">Block</button>';

                }else{
                    if($blocked==1)
                    {
                        $blockbtn = '<button type="button" class="block_unblock" name = "' . $userId . '" id="' . $custId . '">UnBlock</button>';

                    }else{
                        $blockbtn = '<button type="button" class="block_unblock " name = "' . $userId . '" id="' . $custId . '">Block</button>';

                    }
                }
                $resultCol=' <td>
                <div class="block-customer">
                    <div class="block_card">
                        <div class=" serviceproviderimg"> <img src="./assets/assets/cap.png" alt="" id="cap" />
                        </div>
                        <p class="spnames">' . $custFname . '   ' . $custLname . '</p>
                     
                        <div class="favblockbutton">   
                            ' . $blockbtn . '
                        </div>
                    </div>
      
            </td>';

                $resultBlock=array();
                if($check==0){
                    $resultBlock['customer']="";
                }else{
                    $resultBlock['customer']=$resultCol;
                }
                array_push($json['data'], $resultBlock);
                
            }
        }
        echo json_encode($json);
    }

}

public function blockUnblockCust(){
    if (isset($_POST)) {
        $username = $_POST['username'];
        $spId = $_POST['spId'];
        $blockmsg = $_POST['blockmsg'];
        $userId=$this->model->forgotPassword($username);
        $userId=$userId[3];

        $check=$this->model->checkBlocked($userId, $spId);
        if($check[0]==0)
        {
            $data=[
                'userId'=>$userId,
                'target'=>$spId,
                'blocked'=>$blockmsg,
            ];
            $addBlock=$this->model->addBlock($data);
            if($addBlock[0]==1)
            {
                echo 1;
            }else{
                echo 2;
            }
        }else{
            $data=[
                'userId'=>$userId,
                'target'=>$spId,
                'blocked'=>$blockmsg,
                
            ];
            $update=$this->model->updateBlockdb($data);
            if($update[0]==1)
            {
                echo 1;
            }else{
                echo 2;
            }
        }


    }
}

public function addSPdetails(){
    if(isset($_POST))
    {
            $firstname =   $_POST['firstName'];
            $lastname =   $_POST['lastName'];
            $email =   $_POST['email'];
            $phone =   $_POST['phone'];
            $birthdate =   $_POST['dateOfBirth'];
            $avatarimg = $_POST['avatarimg'];
            $gender = $_POST['gender'];
            $postalcode = $_POST['postalCode'];
            $street = $_POST['streetName'];
            $houseno = $_POST['houseNo'];
            $city = $_POST['city'];
            $nationality = $_POST['nationality'];
            $modifiedBy = $firstname;
            $modifiedDate = date('Y-m-d');
            $address=$this->model->get_address($email);

            $userId=$this->model->forgotPassword($email);
            $userId=$userId[3];

            $userType=1;
            $state=$this->model->getCity($postalcode);
            $state=$state[1];

            $data=[
                'fistName' => $firstname,
                'lastName' => $lastname,
                'phone' => $phone,
                'avatarimg' => $avatarimg,
                'gender' => $gender,
                'postalcode' => $postalcode,
                'nationality' => $nationality,
                'birthdate' => $birthdate,
                'modifiedDate' => $modifiedDate,
                'modifiedBy' => $modifiedBy,
                "email" => $email,
            ];
            $addAddress=[
                'userId' => $userId,
                'street' => $street,
                'houseno' => $houseno,
                'city' => $city,
                'state' => $state,
                'postalcode' => $postalcode,
                'phone' => $phone,
                'email' => $email,
                'userType' => $userType,
            ];
            $updateAddress=[
                'street' => $street,
                'houseno' => $houseno,
                'city' => $city,
                'state' => $state,
                'postalcode' => $postalcode,
                'phone' => $phone,
                'email' => $email,
            ];
            $count1='';
            if(!count($address))
            {
                $result=$this->model->addSPadress($addAddress);
                $count1=$result[0];

            }
            if(count($address))
            {
                $result=$this->model->updateSPadress($updateAddress);
                $count2=$result[0];
            }

            $result=$this->model->updateSPdata($data);
            $count=$result[0];
            if($count1==1)
            {
                echo 1;
            }
            if($count==1)
            {
                echo 1;
            }else{
                echo 0;
            }

    }
}

public function getServiceReqAdmin(){
    if(isset($_POST))
    {
        $serviceId=$_POST['serviceId'];
        $selectUser=$_POST['selectUser'];
        $selectSp=$_POST['selectSp'];
        $status=$_POST['status'];
        $startDate=$_POST['startDate'];
        $endDate=$_POST['endDate'];
        // echo $serviceId;

        // if($status=="New")
        // {
        //     $status=="Panding";
        // }else if($status=="Panding")
        // {
        //     $status=="Approoved";
        // }else{
        //     $status==$status;
        // }
        //getting service requests
        if($selectSp!="")
        {
            $result=$this->model->searchSP($selectSp);
        }
        if($serviceId!="" || $selectUser!="" || $status!="")
        {
            $result=$this->model->searchWserviceId($serviceId,$selectUser,$selectSp,$status,$startDate,$endDate);
        }
        if($startDate!="" && $endDate!="")
        {
            $result=$this->model->searchFromdates($serviceId,$selectUser,$selectSp,$status,$startDate,$endDate);
        }
        //for getting all the serivce request for table
        if($serviceId=="" && $selectUser=="" && $selectSp=="" && $status=="" && $startDate=="" && $endDate=="")
        {
            $result=$this->model->getAllServiceReqadmin();
        }
        $json['data'] = array();

        if(count($result))
        {
            foreach($result as $row)
            {
                $serviceId=$row['ServiceRequestId'];
                $serviceDate = $row['ServiceStartDate'];
                $startTime = $row['ServiceTime'];
                $totaltime = $row['TotalHours'];
                $street = $row['AddressLine1'];
                $houseno = $row['AddressLine2'];
                $postalcode = $row['PostalCode'];
                $firstName = $row['FirstName'];
                $lastName = $row['LastName'];
                $city = $row['City'];
                $userId = $row['UserId'];
                $status = $row['Status'];
                $serviceproviderid = $row['ServiceProviderId'];

                // $endTime=floatval($startTime+$totaltime);
                    
                    $entime = $startTime + $totaltime;
                    $sTime='';
                    $eTime='';
                    if(strpos($startTime, ".5")){
                        $sTime=str_replace(".5",":30",$startTime);
                    }else{
                        $sTime=$startTime.':00';
                    }

                   
                    if(strpos($entime, ".5")){
                        $eTime=str_replace(".5",":30",$entime);
                    }else{
                        $eTime=$entime.':00';
                    }
                    
                    

                $serviceIdcol='<div class="modalData" data-bs-toggle="modal" data-bs-target="#serviceData" id="' . $userId . '"  name="' . $serviceId . '">' . $serviceId . '</div>';

                $serviceDatecol='<div class="modalData" data-bs-toggle="modal" data-bs-target="#serviceData" id="' . $userId . '"  name="' . $serviceId . '"><span><img src="./assets/assets/calendar2.png" alt=""></span>' . $serviceDate . '<br> <span><img src="./assets/assets/layer-14.png"
                alt=""></span> ' . $sTime . ' - ' . $eTime . '</div>';

                $statuscol='';
                if($status=='Panding')
                {
                    $statuscol='<td> <span id="panding-status">Panding</span> </td>';
                }
                if($status=='Approoved')
                {
                    $statuscol=' <td> <span id="new-status">Approoved</span> </td>';
                }
                if($status=='Completed')
                {
                    $statuscol='<td> <span id="complete-status">Completed</span> </td>';
                }
                if($status=='Cancelled')
                {
                    $statuscol='<td> <span id="cancle-status">Cancle</span> </td>';
                }
                if($status=='Reschedule')
                {
                    $statuscol=' <td> <span id="Reschedule-status">Reschedule</span> </td>';
                }

            $serviceProvidercol = '';
            if(!empty($serviceproviderid)){
                $serviceproviderid = intval($row['ServiceProviderId']);
                // $serviceProvidercol='<td> ' . $serviceproviderid . ' </td>';
                  
                $spDetails = $this->model->getspData($serviceproviderid);
                $img="";
                $star="";
                $spRating="";

                if (count($spDetails)) {
                    foreach ($spDetails as $sp) {
                        $spfirstname = $sp['FirstName'];
                        $splastname = $sp['LastName'];
                        $imgdp = $sp['UserProfilePicture'];
                        $spRate=$this->model->getRating($serviceproviderid);
                            if(count($spRate[0]))
                            {
                                $spRating=0;

                                foreach($spRate[0] as $row){
                                    $spRating=($spRating+$row['Ratings']);
                                }

                                $spRating=round(($spRating / $spRate[1]), 2);
                                $finalavgrating=round($spRating);
                                $star='<i class = "fa fa-star" aria-hidden = "true" id = "st"></i>';
                                if($finalavgrating==1)
                                {
                                    $star='<i class = "fa fa-star" aria-hidden = "true" id = "st"></i>';
                                }
                                if($finalavgrating==2)
                                {
                                    $star='<i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                    <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>';
                                }
                                 if($finalavgrating==3)
                                {
                                    $star='<i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                    <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                    <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>';
                                }
                                if($finalavgrating==4)
                                {
                                    $star='<i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                    <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                    <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                    <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>';
                                }
                                if($finalavgrating==5)
                                {
                                    $star='<i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                    <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                    <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                    <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>
                                    <i class = "fa fa-star" aria-hidden = "true" id = "st"></i>';
                                }
                                
                            }
                            if (strlen($imgdp) != 0) {
                                    
                                $image = str_replace("http://localhost/Tatvasoft/Helperland_MVC/", "./", $imgdp);
                                $img = '<img  src="' . $image . '" class="SPimg">';
                            } else {
                                
                                $img = '<img src="./assets/assets/cap.png" alt="" id="cap" />';
                            }
                        $serviceProvidercol = ' <td>
                        ' . $img . '
                        ' . $spfirstname . ' ' . $splastname . '
                        <br />
                        <span id="star">
                        ' . $star . '
                          <span>' . $spRating . '</span>
                        </span>
                      </td>';
                    }
                }

              }
              $actioncol='';
            if($status == 'Completed' || $status == 'Cancelled' || $status == 'Refunded')
            {
                $actioncol='<a class="nav-link dropdown" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <span><img src="./assets/assets/group-38.png" alt="" /></span>
  
              </a>
  
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Refund</a></li>
                <li><a class="dropdown-item" href="#">Escalate</a></li>
                <li><a class="dropdown-item" href="#">History Log</a></li>
                <li><a class="dropdown-item" href="#">Download Invoice</a></li>
                </ul>';
            }
            if($status == 'Panding' || $status == 'Approoved' || $status == 'Reschedule')
            {
                $actioncol='<div>
                <a class="nav-link dropdown" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <span><img src="./assets/assets/group-38.png" alt="" /></span>
  
              </a>
  
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item editoption" id="' . $serviceId . '" data-bs-toggle="modal" data-bs-target="#editmodal"
                  style="cursor: pointer;">Edit & Reschedule</a></li>
              <li><a class="dropdown-item" href="#">Refund</a></li>
              <li><a class="dropdown-item" href="#">Cancle</a></li>
              <li><a class="dropdown-item" href="#">Change SP</a></li>
              <li><a class="dropdown-item" href="#">Escalate</a></li>
              <li><a class="dropdown-item" href="#">History Log</a></li>
              <li><a class="dropdown-item" href="#">Download Invoice</a></li>

             </ul></div>';
            }

               
            $custDetailcol='<div class="modalData" data-bs-toggle="modal" data-bs-target="#serviceData" id="' . $userId . '"  name="' . $serviceId . '">' . $firstName . ' ' . $lastName . ' <br> <span><img src="./assets/assets/layer-15.png" alt=""></span> ' . $street . ' '. $houseno . ',' . $postalcode . ' ' . $city . '</td>
            <div>';


            $result=array();
            $result['serviceId'] = $serviceIdcol;
            $result['serviceDate'] = $serviceDatecol;
            $result['serviceProvider'] = $serviceProvidercol;
            $result['customer'] = $custDetailcol;
            $result['status'] = $statuscol;
            $result['action'] = $actioncol;

            array_push($json['data'], $result);

            }
            
        }
    }
    echo json_encode($json);

}

public function geteditmodalData(){
    if(isset($_POST))
    {
        $serviceId=$_POST['serviceId'];
        $result=$this->model->getServicedata($serviceId);
        if(count($result))
        {
            foreach($result as $row)
            {
                    $date = $row['ServiceStartDate'];
                    $startTime = $row['ServiceTime'];
                    $totalTime = $row['TotalHours'];
                    $payment = $row['TotalCost'];
                    $serviceId = $row['ServiceRequestId'];
                    $extraservices = $row['ExtraServices'];
                    $comment = $row['Comments'];
                    $haspets = $row['HasPets'];
                    $addressId = $row['AddressId'];
                    $status = $row['Status'];
                    $userId = $row['UserId'];
                    $serviceProviderId = $row['ServiceProviderId'];

                    if(strpos($startTime, ".5")){
                        $sTime=str_replace(".5",":30",$startTime);
                    }else{
                        $sTime=$startTime.':00';
                    }
                    

                    $dateTime='<div class="row">
                    <div class="col-md-6">
                      <label for="reDate"><b>Date</b></label>
                      <div class="row">
                        <div class="col-2">
                          <img src="./assets/assets/admin-calendar-blue.png">
                        </div>
                        <div class="col-10">
                          <input type="text" id="reDate" class="form-control " placeholder="Enter Date"
                          value="' . $date . '" />
                        </div>
                        <span class="dErr" style="color: red; font-size: 12px;"></span>
                      </div>
  
                    </div>
  
                    <div class="form-group col-md-6">
                      <label for="time"><b>Time</b></label>
                      <select id="time" name="' . $totalTime . '" class="form-control time">
                      <option value="' . $startTime . '">' . $sTime . '</option>
                      <option value="8">8:00 </option>
                <option value="8.5">8:30 </option>
                <option value="9">9:00 </option>
                <option value="9.5">9:30 </option>
                <option value="10">10:00</option>
                <option value="10.5">10:30</option>
                <option value="11">11:00</option>
                <option value="11.5">11:30</option>
                <option value="12">12:00</option>
                <option value="12.5">12:30</option>
                <option value="13">13:00</option>
                <option value="13.5">13:30</option>
                <option value="14">14:00</option>
                <option value="14.5">14:30</option>
                <option value="15">15:00</option>
                <option value="15.5">15:30</option>
                <option value="16">16:00</option>
                <option value="16.5">16:30</option>
                <option value="17">17:00</option>
                <option value="17.5">17:30</option>
                <option value="18">18:00</option>
                      <option value="19">19:00</option>
                      <option value="19.5">19:30</option>
                      <option value="20">20:00</option>
                      <option value="20.5">20:30</option>
                      <option value="21">21:00</option>
                      <option value="21.5">21:30</option>
                      </select>
                    </div>
                    <span class="hrErr" style="color: red; font-size: 12px;"></span>
                  </div>
                  <label class="serAdd" id="' . $addressId . '"><b>Address</b></label>';

                  $getaddressData=$this->model->getAddresstab($addressId);
                  if(count($getaddressData))
                  {
                      foreach($getaddressData as $row)
                      {
                        $street = $row['AddressLine1'];
                        $houseno = $row['AddressLine2'];
                        $city = $row['City'];
                        $state = $row['State'];
                        $pincode = $row['PostalCode'];

                        $address1=' <div class="serviceaddress">
                        <div class="row">
                          <div class="col-md-6">
                            <label for="street">Street name</label>
                            <input type="text" class="form-control mb-2" id="street" value="' . $street . '" placeholder="Street">
                            <span class="streetErr" style="color: red; font-size: 13px;"></span>
                          </div>
                          
                          <div class="col-md-6">
                            <label for="houseno">House number</label>
                            <input type="number" class="form-control mb-2" id="houseno" value="' . $houseno  . '" placeholder="House number">
                            <span class="houseErr" style="color: red; font-size: 13px;"></span>
                          </div>
                          
                          
                        </div>
                        
      
                        <div class="row">
                          <div class="col-md-6">
                            <label for="postal">Postal Code</label>
                            <input type="text" class="form-control mb-2" id="postal" value="' . $pincode . '" placeholder="Street">
                          </div>
                          <div class="form-group col-md-6">
                            <label class="location">Location</label>
                            <select id="city" class="located form-control">
                            <option value="' . $city . '">' . $city . '</option>
                            </select>
                          </div>
                          <span class="pincodeErr" style="color: red; font-size: 13px;"></span>
                        </div>
                      </div>
                        ';

                        $address2='<label><b>Invoicing Address</b></label>
                        <div class="invoicing">
                          <div class="row">
                            <div class="col-md-6">
                              <label for="streets">Street name</label>
                              <input type="text" class="form-control mb-2" id="streets" value="' . $street . '" placeholder="Street">
                            </div>
                            <div class="col-md-6">
                              <label for="housenos">House number</label>
                              <input type="number" class="form-control mb-2" id="housenos" value="' . $houseno . '" placeholder="House number">
                            </div>
                          </div>
        
                          <div class="row">
                            <div class="col-md-6">
                              <label for="postals">Postal Code</label>
                              <input type="text" class="form-control mb-2" id="postal2" value="' . $pincode . '" placeholder="Street">
                            </div>
                            <div class="form-group col-md-6">
                              <label class="location">Location</label>
                              <select id="city2" class="located form-control">
                              <option value="' . $city . '">' . $city . '</option>
                              </select>
                            </div>
                          </div>
                        </div>';

                        

                      }
                  }

                  $endPart='<div class="form-group">
                        <label for="whyreschedule"><b>Why do you want to reschedule service request?</b></label>
                        <textarea class="form-control" id="whyreschedule"
                          placeholder="Why do you want to reschedule service request?" rows="3"
                          style="height: auto;" required></textarea>
                      </div>
                      <span class="whyErr" style="color: red; font-size: 13px;"></span>

                      <div class="form-group ">
                        <label for="callcenteremp"><b>Call Center EMP Notes</b></label>
                        <textarea class="form-control" id="callcenteremp" placeholder="Enter Notes" rows="3"
                          style="height: auto;" required></textarea>
                      </div>
                      <span class="empErr" style="color: red; font-size: 13px;"></span>
                      <div class="row">
      
                        <button type="submit" class="btnReschedule" id="' . $serviceId . '" data-bs-dismiss="modal">Update</button>
                      </div>';

                      $data=$dateTime . '' . $address1 . '' . $address2 . '' . $endPart;
                      echo $data;
            }
        }
    }

}

public function adminReschedule(){
    if(isset($_POST))
    {
        $reDate=$_POST['reDate'];
        $reTime=$_POST['reTime'];
        $reStreet=$_POST['reStreet'];
        $rePostal=$_POST['rePostal'];
        $reHouse=$_POST['reHouse'];
        $reCity=$_POST['reCity'];
        $serviceId=$_POST['reServiceId'];
        $reAddId=$_POST['reAddId'];

        $getState=$this->model->getCity($rePostal);
        
        $state=$getState[1];

        $result=$this->model->getServicedata($serviceId);
        
        if (count($result)) {
            foreach ($result as $row) {
                $recordversion = $row['RecordVersion'];
                $userId = intval($row['UserId']);
                $spId = intval($row['ServiceProviderId']);
            }
        }

        $userEmail=$this->model->getUserId($userId);
        if(count($userEmail))
        {
            foreach($userEmail as $mail)
            {
                $userEmail=$mail['Email'];
            }
        }
        $status='Panding';
        if(!empty($spId))
        {
            $status='Reschedule';
        }
        $modifiedDate = date('Y-m-d');
        $modifiedBy = "Admin";
        $recordversion = $recordversion + 1;

        $updateAddress=[
            'street' => $reStreet,
            'houseno' => $reHouse,
            'city' => $reCity,
            'state' => $state,
            'postalcode' => $rePostal,
            'addressId' => $reAddId,
        ];
        $data=[
            'newDate'=>$reDate,
            'newTime'=>$reTime,
            'modifiedBy'=>$modifiedBy,
            'modifiedDate'=>$modifiedDate,
            'recordversion'=>$recordversion,
            'status'=>$status,
            'serviceId'=>$serviceId,
        ];
        $updateaddress=$this->model->adminUpAdd($updateAddress);
        $count1=$updateaddress[0];

        $upAdd=$this->model->rescheduleService($data);
        if(!empty($spId))
        {
            $spEmail = $this->model->getUserId($spId);
            if (count($spEmail)) {
                foreach ($spEmail as $spemail) {
                    $email  = $spemail['Email'];
                }
            }
        }

        $count=$upAdd[0];
        if($count==1 || $count1==1)
        {
            echo 1;
        }else{
            echo 0;
        }

    }

}

public function getDataUserMng(){
    if(isset($_POST))
    {
        $getAllUsers=$this->model->getAlluser();
        $json['data'] = array();
        if(count($getAllUsers)){
            foreach($getAllUsers as $user)
            {
                $userId=$user['UserId'];
                $firstname  = $user['FirstName'];
                $lastname  = $user['LastName'];
                $usertype = $user['UserTypeId'];
                $phone = $user['Mobile'];
                $postalcode = $user['ZipCode'];
                $isActive = $user['IsActive'];
                $date = $user['CreatedDate'];
                $Regidate = date("d/m/Y", strtotime($date));

                if($usertype==0)
                {
                    $userrole="Customer";
                }
                if($usertype==1)
                {
                    $userrole="Service Provider";
                }
                if($usertype==2)
                {
                    $userrole="Admin";
                }
                $userTypecol='<div class="userType">' . $userrole . '</div>';
                $regiDate='<div class="regiDate"><img src="./assets/assets/calendar2.png" alt=""> ' . $Regidate . '</div>';

                if($isActive=="Yes"){
                    $statuscol='<td><span id="active-status">Active</span></td>';
                    $actioncol='<td>
                    <a class="nav-link dropdown" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                      aria-expanded="false">
                      <span><img src="./assets/assets/group-38.png" alt="" /></span>
  
                    </a>
  
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li><a class="dropdown-item deAct" id="' . $userId . '">Deactivate</a></li>
                    </ul>
                  </td>';
                }
                if($isActive=="No"){
                    $statuscol=' <td><span id="inactive-status">Inactive</span></td>';
                    $actioncol='<td>
                    <a class="nav-link dropdown" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                      aria-expanded="false">
                      <span><img src="./assets/assets/group-38.png" alt="" /></span>
  
                    </a>
  
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li><a class="dropdown-item act" id="' . $userId . '">Activate</a></li>
                    </ul>
                  </td>';
                }

                $result=array();
                $result['username']=$firstname . ' ' . $lastname;
                $result['role']=$userTypecol;
                $result['regiDate']=$regiDate;
                $result['userType']=$userTypecol;
                $result['phone']=$phone;
                $result['postalcode']=$postalcode;
                $result['status']=$statuscol;
                $result['action']=$actioncol;

                array_push($json['data'], $result);
            }
        }
        echo json_encode($json);
    }

}
public function activeDeactive(){
    if(isset($_POST))
    {
        $userId=$_POST['userId'];
        $username=$_POST['username'];
        $status=$_POST['status'];
        $modifiedDate = date('Y-m-d H:i:s');
        $modifiedBy = $username;

        $data=[
            'isActive'=>$status,
            'modifiedDate'=>$modifiedDate,
            'modifiedBy'=>$modifiedBy,
            'userId'=>$userId,
        ];
        $result=$this->model->activedeactive($data);
        $count=$result[0];
        if($count==1)
        {
            echo 1;
        }else{
            echo 0;
        }
    }

}
public function getAllUser(){
    if (isset($_POST)) {
        $type=0;
        $user = $this->model->userAndSpall($type);

        if (count($user)) {
            foreach ($user as $row) {

                $custName = $row['UserName'];
                $custSelect = '<option >' . $custName . '</option>';
                echo $custSelect;
            }
        }
       
    }

}
public function getAllSp(){
    if (isset($_POST)) {
        $type=1;
        $sp = $this->model->userAndSpall($type);

        if (count($sp)) {
            foreach ($sp as $row) {

                $spName = $row['UserName'];
                $spSelect = '<option >' . $spName . '</option>';
                echo $spSelect;
            }
        }
       
    }

}

public function getUserAndRole(){
    if(isset($_POST)){
        $user=$this->model->getUserSelect();
        if(count($user[0]))
        {
            foreach($user[0] as $sel)
            {
                $username=$sel['UserName'];
                $user='<option>' . $username . '</option>';

                echo $user;
            }
        }
    }

}

public function searchUMadmin(){
    if(isset($_POST))
    {
        $selectUser=$_POST['selectUser'];
        $selectRole=$_POST['selectrole'];
        $phone=$_POST['phonenum'];
        $postalcode=$_POST['postal'];

        
        if($selectUser!='' || $selectRole!='' || $phone!='')
        {
            $result=$this->model->allSearch($selectUser,$selectRole,$phone,$postalcode);
        }
        if($postalcode!='')
        {
            $result=$this->model->pincodeSearch($selectUser,$selectRole,$phone,$postalcode);
        }
             
       
        $json['data'] = array();
        if(count($result)){
            foreach($result as $user)
            {
                $userId=$user['UserId'];
                $firstname  = $user['FirstName'];
                $lastname  = $user['LastName'];
                $usertype = $user['UserTypeId'];
                $phone = $user['Mobile'];
                $postalcode = $user['ZipCode'];
                $isActive = $user['IsActive'];
                $date = $user['CreatedDate'];
                $Regidate = date("d/m/Y", strtotime($date));

                if($usertype==0)
                {
                    $userrole="Customer";
                }
                if($usertype==1)
                {
                    $userrole="Service Provider";
                }
                if($usertype==2)
                {
                    $userrole="Admin";
                }
                $userTypecol='<div class="userType">' . $userrole . '</div>';
                $regiDate='<div class="regiDate"><img src="./assets/assets/calendar2.png" alt=""> ' . $Regidate . '</div>';

                if($isActive=="Yes"){
                    $statuscol='<td><span id="active-status">Active</span></td>';
                    $actioncol='<td>
                    <a class="nav-link dropdown" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                      aria-expanded="false">
                      <span><img src="./assets/assets/group-38.png" alt="" /></span>
  
                    </a>
  
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li><a class="dropdown-item deAct" id="' . $userId . '">Deactivate</a></li>
                    </ul>
                  </td>';
                }
                if($isActive=="No"){
                    $statuscol=' <td><span id="inactive-status">Inactive</span></td>';
                    $actioncol='<td>
                    <a class="nav-link dropdown" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                      aria-expanded="false">
                      <span><img src="./assets/assets/group-38.png" alt="" /></span>
  
                    </a>
  
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li><a class="dropdown-item act" id="' . $userId . '">Activate</a></li>
                    </ul>
                  </td>';
                }

                $result=array();
                $result['username']=$firstname . ' ' . $lastname;
                $result['role']=$userTypecol;
                $result['regiDate']=$regiDate;
                $result['userType']=$userTypecol;
                $result['phone']=$phone;
                $result['postalcode']=$postalcode;
                $result['status']=$statuscol;
                $result['action']=$actioncol;

                array_push($json['data'], $result);
            }
        }
        echo json_encode($json);

    }

}

public function SpDateSched($parameter){
    
        $email = $parameter;
        $userId=$this->model->forgotPassword($email);
        $userId=$userId[3];

        
        $upcomingService=$this->model->getupcomeservice($userId);
        $json['data'] = array();
        if(count($upcomingService)){
            foreach($upcomingService as $row)
            {
                $serviceId = $row['ServiceRequestId'];
                $servicestartdate = $row['ServiceStartDate'];
                $servicestarttime = $row['ServiceTime'];
                $totaltime = $row['TotalHours'];

                $endTime=floatval($servicestarttime+$totaltime);

                $entime = $servicestarttime + $totaltime;
                    $sTime='';
                    $eTime='';
                    if(strpos($servicestarttime, ".5")){
                        $sTime=str_replace(".5",":30",$servicestarttime);
                    }else{
                        $sTime=$servicestarttime.':00';
                    }

                    if(strpos($entime, ".5")){
                        $eTime=str_replace(".5",":30",$entime);
                    }else{
                        $eTime=$entime.':00';
                    }
                    

                    $result[] = array(
                        'title' => $sTime . '-' . $eTime,
                        'start' => $servicestartdate,
                        'id' => $serviceId,
                    );
            }
            
        }
        echo json_encode($result);
        
}

public function SpDateSchedComplete($parameter){
    $email = $parameter;
    $userId=$this->model->forgotPassword($email);
    $userId=$userId[3];
    $result =  $this->model->getScheduleComplete($userId);
        $json['data'] = array();
        if (count($result)) {
            foreach ($result as $row) {
                $serviceId = $row['ServiceRequestId'];
                $servicestartdate = $row['ServiceStartDate'];
                $servicestarttime = $row['ServiceTime'];
                $totaltime = $row['TotalHours'];

                $endTime=floatval($servicestarttime+$totaltime);

                $entime = $servicestarttime + $totaltime;
                    $sTime='';
                    $eTime='';
                    if(strpos($servicestarttime, ".5")){
                        $sTime=str_replace(".5",":30",$servicestarttime);
                    }else{
                        $sTime=$servicestarttime.':00';
                    }

                    if(strpos($entime, ".5")){
                        $eTime=str_replace(".5",":30",$entime);
                    }else{
                        $eTime=$entime.':00';
                    }
                    

                    $result[] = array(
                        'title' => $sTime . '-' . $eTime,
                        'start' => $servicestartdate,
                        'id' => $serviceId,
                    );
            }
        }
        echo  json_encode($result);
}
 
}
