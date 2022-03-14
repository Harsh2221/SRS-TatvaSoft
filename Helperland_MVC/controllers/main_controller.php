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
                   
                    $endTime = floatval($serviceTime + $totalHour);

                $serviceidcol='<td class="serviceid">' . $serviceId . '</td>';
                $servicedatecol=' <td>
                <div class="serviceDetailModel" data-bs-toggle="modal"
                data-bs-target="#ServiceData_modal">
                <span><img src="./assets/assets/calendar2.png" alt="#" />' . $serviceDate . '</span>
                <br />
                <span><img src="./assets/assets/layer-14.png" alt="#" />' . $stratTime . ':00 - ' . $endTime . '</span>
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
                            $serviceProvidercol = ' <td>
                            <img src="./assets/assets/cap.png" alt="" id="cap" />
                            ' . $spfirstname . '' . $splastname . '
                            <br />
                            <span id="star">
                            ' . $star . '
                              <span>' . $spRating . '</span>
                            </span>
                          </td>';
                            }
                        }
                        
                    } 

                $actioncol ="";

            if ($status == 'Reschedule') {
                $actioncol  = '<p>Requested for Reschedule</p>';
               
            }

            
            $paymentcol='<td class="payment">
                <h5><span>€</span>' . $payment . '</h5>
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
                                $spfirstname = $sp['FirstName'];
                                $splastname = $sp['LastName'];
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
                            $serviceProvider = ' <td>
                            <img src="./assets/assets/cap.png" alt="" id="cap" />
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
                $update_btn='<button type="submit" class="update" id=' . $serviceId . '>Update</button>';
                $cancel_btn=' <button type="submit" class="cancel" id=' . $serviceId . '>Cancel Now</button>';
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
            if(isset($spId)){

                

                $isconflict=$this->model->isConflict($spId, $startTime, $endTime);
                $count=$isconflict[0];

                if ($count >= 1) {
                    $acceptbtn = '
                            <button type="submit" class="acceptBtnModal" id=' . $serviceId . ' data-bs-dismiss="modal" disabled="disabled" style="cursor:not-allowed;">✔ Accept</button>
                            ';
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
                    $currenttime = strtotime($currenttime);
                    $time = strtotime($totalTime);

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



              $output = [$serviceId, $totalTime, $payment, $status, $userId, $serviceProvider, $reschedule, $cancel, $update_btn, $cancel_btn, $selectNewtime, $cancelReason, $updateTime, $date, $stratTime, $endTime, $extraservices, $customerName, $serviceAddress, $phone, $pets, $acceptbtn, $upcomingbtns, $mapcol];

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
            include("views/clientReschedulemail.php");

            if(!empty($serviceProviderId))
            {
                $serviceproEmail=$email;
                $serviceId=$serviceId;
                include("views/SP_Reschedulemail.php");
            }
            //sending email to all the service providers for rescheduling of the service
            
            // if(empty($serviceProviderId))
            // {

            // }

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
            //email sending to service providers for cancelation of the service request
            // if(!empty($serviceProviderId)){
            //    $spemail=$email;
            // //    email script

            // }
            // if(empty($serviceProviderId)){

            // }
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
                   
                    $endTime = floatval($serviceTime + $totalHour);

                $serviceidcol='<td class="serviceid">' . $serviceId . '</td>';
                $servicedatecol=' <td>
                <span><img src="./assets/assets/calendar2.png" alt="#" />' . $serviceDate . '</span>
                <br />
                <span><img src="./assets/assets/layer-14.png" alt="#" />' . $stratTime . ':00 - ' . $endTime . '</span>
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
                        $serviceProvidercol = ' <td>
                        <img src="./assets/assets/cap.png" alt="" id="cap" />
                        ' . $spfirstname . '' . $splastname . '
                        <br />
                        <span id="star">
                        ' . $star . '
                          <span>' . $spRating . '</span>
                        </span>
                      </td>';
                    }
                }

              }
              $paymentcol='<td class="payment">
                <h5><span>€</span>' . $payment . '</h5>
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
        
        $result=$this->model->getNewServices();

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
                $endTime=floatval($servicestarttime+$totaltime);

                $isconflict=$this->model->isConflict($userId, $startTime, $endTime);
                $count=$isconflict[0];
                
                if($count>=1)
                {
                    $servicerequestid = $isconflict[1];
                    $timeconflictcol='<td>Another service request ' . $servicerequestid . ' <br> has already been assigned, You can’t accept!</td>';

                    $actioncol='<button data-bs-toggle="modal" data-bs-target="#serviceDetail" id="' . $serviceid . '" class="acceptBtn modaldata" name="' . $serviceid . '" disabled="disabled">Accept</button>';


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
              <span><img src="./assets/assets/calendar2.png" alt=""></span>' . $servicestartdate . '<br> <span><img src="./assets/assets/layer-14.png" alt=""></span>' . $servicestarttime . ':00 - ' . $endTime . ':00</div>';
              $userdetailscol='<div class="modaldata" id="' . $userId . '"  name="' . $serviceid . '" data-bs-toggle="modal" data-bs-target="#serviceDetail">
              ' . $fname . ' ' . $lname . ' <br> <span><img src="./assets/assets/layer-15.png" alt=""></span> ' . $street . ' ' . $houseno . ',' . $postalcode . ' ' . $city . '</div>';
              $paymentcol='<div class="payment">
              € ' . $payment . '
          </div>';

          $result = array();
          if ($hpet == 1) {
              if ($pets == 1) {
                  $result = array();
                  
                  $result['serviceId'] = $serviceidcol;
                  $result['serviceDate'] = $servicedatecol;
                  $result['customerDetails'] = $userdetailscol;
                  $result['payment'] = $paymentcol;
                  $result['timeConflict'] = $timeconflictcol;
                  $result['actions'] = $actioncol;
              } else{
                  $result = array();
                  
                  $result['serviceId'] = "";
                  $result['serviceDate'] = "";
                  $result['customerDetails'] = "";
                  $result['payment'] = "";
                  $result['timeConflict'] = "";
                  $result['actions'] = "";
              }
          }
          if ($hpet == 0) {

            $result = array();
            
            $result['serviceId'] = $serviceidcol;
            $result['serviceDate'] = $servicedatecol;
            $result['customerDetails'] = $userdetailscol;
            $result['payment'] = $paymentcol;
            $result['timeConflict'] = $timeconflictcol;
            $result['actions'] = $actioncol;
        }
          
       
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

                $servicedatecol='<div class="detailModal" data-bs-toggle="modal" data-bs-target="#upcomingModal" id="' . $userId . '" name="' . $serviceId . '">
                      <span><img src="./assets/assets/calendar2.png" alt=""></span> ' . $servicestartdate . ' <br> <span><img src="./assets/assets/layer-14.png" alt=""></span>' . $servicestarttime . ':00 - ' . $endTime . ':00 <div>';

                $servicedetailcol='<div class="detailModal" id="' . $userId . '"  name="' . $serviceId . '" data-bs-toggle="modal" data-bs-target="#upcomingModal">' . $fname . ' ' . $lname . '<br> <span><img src="./assets/assets/layer-15.png" alt=""></span> ' . $street . ' ' . $houseno . ',' . $postalcode . ' ' . $city . '<div>';  

                    date_default_timezone_set('Asia/Kolkata');
                    $todaydate = date("Y/m/d");
                    $todaydate = strtotime($todaydate);

                    $strDate = strtotime($servicestartdate);

                    $currenttime = date("H:i");
                    $currenttime = strtotime($currenttime);
                    $time = strtotime($totaltime);

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
        $status="Cancelled";
        $data=[
            'cancelReason'=>$cancelreason,
            'modifiedDate'=>$modifiedDate,
            'modifiedBy'=>$modifiedBy,
            'recordversion'=>$recordversion,
            'status'=>$status,
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

        $json['data'] = array();

        $serviceData=$this->model->getSpServiceHistory($userId);
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

                $startTime=$starttime;
                $endTime=floatval($starttime+$totaltime);

                $serviceIdcol='<td><div class="modalData" data-bs-toggle="modal" data-bs-target="#historyModal" name="' . $serviceId . '">' . $serviceId . '</div></td>';

                $serviceDatecol='<div class="modalData" data-bs-toggle="modal" data-bs-target="#historyModal" id="' . $userId . '" name="' . $serviceId . '">
                      <span><img src="./assets/assets/calendar2.png" alt=""></span> ' . $date . ' <br> <span><img src="./assets/assets/layer-14.png" alt=""></span>' . $startTime . ':00 - ' . $endTime . ':00 <div>';

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

                if($status == "Cancelled"){
                    $statuscol='<td><span style="background-color: #FF6B6B; border: none; padding: 5px 10px; color: white;" id="cancle-status">' . $status . '</span></td>';
                }
                if($status == "Completed"){
                    $statuscol='<td><span style="background-color: rgb(101, 243, 101); border: none; padding: 5px 10px; color: white;" id="pay-status">' . $status . '</span></td>';
                }

                if($payStatus==1)
                {
                    $result = array();
                           
                    $result['serviceId'] = $serviceIdcol;
                    $result['serviceDate'] = $serviceDatecol;          
                    $result['customerDetails'] = $serviceDetailcol;
                    $result['status'] = $statuscol;

                }
                if($payStatus==2)
                {
                    if($status == "Completed")
                    {
                        $result = array();
                           
                    $result['serviceId'] = $serviceIdcol;
                    $result['serviceDate'] = $serviceDatecol;          
                    $result['customerDetails'] = $serviceDetailcol;
                    $result['status'] = $statuscol;
                    }else{
                        $result = array();
                           
                    $result['serviceId'] = "";
                    $result['serviceDate'] =  "";          
                    $result['customerDetails'] = "";
                    $result['status'] = "";
                    }

                }
                if($payStatus==3)
                {
                    if($status == "Cancelled")
                    {
                        $result = array();
                           
                    $result['serviceId'] = $serviceIdcol;
                    $result['serviceDate'] = $serviceDatecol;          
                    $result['customerDetails'] = $serviceDetailcol;
                    $result['status'] = $statuscol;
                    }
                    else{
                        $result = array();
                           
                    $result['serviceId'] = "";
                    $result['serviceDate'] =  "";          
                    $result['customerDetails'] = "";
                    $result['status'] = "";
                    }
                    

                }
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

        $userId=$this->model->forgotPassword($username);
        $userId=$userId[3];

        $json['data'] = array();

        $rating=$this->model->getRatingsp($userId);

        if(count($rating[0]))
        {
            foreach($rating[0] as $row)
            {
                $serviceId = $row['ServiceRequestId'];
                $ratingfrom = $row['RatingFrom'];
                $spRating=$row['Ratings'];
                
                $spcomment  = $row['Comments'];
                $result=$this->model->getUserId($ratingfrom);
                if(count($result))
                {
                    foreach($result as $row)
                    {
                        $custName = $row['FirstName'] . ' ' . $row['LastName'];
                    }
                }

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

                                $serviceData=$this->model->getSpServiceHistory($userId);
                                if(count($serviceData))
                                {
                                    foreach($serviceData as $row)
                                    {
                                        $date = $row['ServiceStartDate'];
                    $starttime = $row['ServiceTime'];
                    $totaltime = $row['TotalHours'];
                                       

                $startTime=$starttime;
                $endTime=floatval($starttime+$totaltime);

                $serviceDatecol='<div class="modalData" id="' . $userId . '">
                <span><img src="./assets/assets/calendar2.png" alt=""></span> ' . $date . ' <br> <span><img src="./assets/assets/layer-14.png" alt=""></span>' . $startTime . ':00 - ' . $endTime . ':00 <div>';
                                    }
                                }

                $firstcol='<td><div>' . $serviceId . '<br><b>' . $custName . '</b></div>
                <hr>
                <b>Comments: </b>' . $spcomment . '
                </td>';
                $ratingcol=' <td>
                
                <span id="star">
                ' . $star . '
                  <span>' . $msg . '</span>
                </span>
              </td>';       

              
                $output=array();
                $output['Ratings'] = $firstcol;
                $output['date']=$serviceDatecol;
                $output['rate']=$ratingcol;
              
            //   if($selectRating==2)
            //   {
            //       if($msg=="Very Good")
            //       {
            //         $output=array();
            //         $output['Ratings'] = "";
            //         $output['date']="";
            //         $output['rate']="";
            //       }else{
            //         $output=array();
            //         $output['Ratings'] = "";
            //         $output['date']="";
            //         $output['rate']="";
            //       }
            //   }
              

              
              
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



}
