<?php
class Helperland_model{

    // Database connection created 
    public function __construct()
    {
        try {
            
            $db_sn = 'mysql:dbname=helperland;host=localhost';
            $user = 'root';
            $password = '';
            $this->conn = new PDO($db_sn, $user, $password);
        } catch (PDOException $e) {
            print $e->getMessage();
            die();
        }
    }
 
    public function Contactus($array)
    {
        $sql = "INSERT INTO contactus (Name , Email , Subject , PhoneNumber , Message , CreatedOn )
        VALUES (:name ,  :email , :subject , :mobile , :message , :creationdt )";
        $stmt =  $this->conn->prepare($sql);
        $result = $stmt->execute($array);
        
        if($result){
            $_SESSION['msg']="Data sent !";
            $_SESSION['icon']="success";
            
        }else{
            $_SESSION['msg']="Error !";
            $_SESSION['icon']="error";
        }
        
    }

    public function Register($data){
        $sql = "INSERT INTO user (FirstName,LastName, Email , Mobile , Password , UserTypeId , RoleId , ResetKey , CreatedDate , Status , IsRegisteredUser , IsActive)
        VALUES (:firstName , :lastName , :email , :number , :password , :usertypeid , :roleid , :resetkey , :creationdt , :status , :isregistered , :isactive)";
        $stmt =  $this->conn->prepare($sql);
        $result = $stmt->execute($data);
        return $result;
    }

    public function is_mailExist($email){
        $sql = "select * from user where Email = '$email'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $email_count = $stmt->rowCount();
        return $email_count;
    }

    public function Login($email,$pass){
        $sql="select * from user where Email = '$email'";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $count=$stmt->rowCount();
        $usertypeid = $row['UserTypeId'];
        // echo $count;
        // echo $usertypeid;
        // echo $row['Password'];
        // echo $pass;
        $customer = "http://localhost/tatvasoft/Helperland_MVC/customerActivity";
        $service_provider = "http://localhost/tatvasoft/Helperland_MVC/serviceProviderScreens";
        $base_url = "http://localhost/tatvasoft/Helperland_MVC";

        if($count==1){
            if ($pass == $row['Password']){
                if ($usertypeid == 0) {
                    $_SESSION['username'] = $email;
                    $_SESSION['usertypeCustomer'] = $usertypeid;

                    header('Location:' . $customer);
                } 
                if ($usertypeid == 1) {
                    $_SESSION['username'] = $email;
                    $_SESSION['usertypeSp'] = $usertypeid;
                    header('Location:' . $service_provider);
                }
            }else{
                $_SESSION['msg']="Invalid password !";
                $_SESSION['icon']="error";
                header('Location:' . $base_url);
            }
        }else{
            $_SESSION['msg']="User not Exist !";
            $_SESSION['icon']="error";
            header('Location:' . $base_url);
        }
    }

    public function forgotPassword($email){
        $sql="select * from user where Email = '$email'";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $username=$row['FirstName'];
        $firstName=$row['FirstName'];
        $resetkey=$row['ResetKey'];
        $userType=$row['UserTypeId'];
        $userid=$row['UserId'];
        $count=$stmt->rowCount();

        return array($username, $resetkey, $count, $userid,$userType);
        
    }

    public function resetpassword($data){
        $sql = "UPDATE user SET Password = :password , ModifiedDate = :updatedate , ModifiedBy = :modifiedby WHERE ResetKey = :resetkey";
        $stmt =  $this->conn->prepare($sql);
        $result = $stmt->execute($data);
        $count=$stmt->rowCount();

        if($result){
            $_SESSION['msg']="New Password set !";
            $_SESSION['icon']="success";
            
        }else{
            $_SESSION['msg']="Password Not set !";
            $_SESSION['icon']="error";
        }
        return array($count);
    }

    public function postalcodeCheck($postalcode){
        $sql = "SELECT * FROM zipcode WHERE ZipcodeValue = '$postalcode'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $count=$stmt->rowCount();

        return $count;
        
    }

    public function getCity($postalcode){
        $sql = "SELECT zipcode.ZipcodeValue, city.CityName, state.StateName FROM zipcode JOIN city ON zipcode.CityId = city.Id AND ZipcodeValue = $postalcode JOIN state ON state.Id = city.StateId";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();

        $row=$stmt->fetch(PDO::FETCH_ASSOC);

        $zipcode = $row['ZipcodeValue'];
        $city = $row['CityName'];
        $state = $row['StateName'];

        return array($city, $state);

    }

    
    public function add_address($data){

        $sql = "INSERT INTO useraddress (UserId , AddressLine1 , AddressLine2 , City , State , PostalCode , Mobile , Email , Type)
        VALUES (:userid , :streetname ,  :housenumber  , :city , :state , :postalcode , :phonenumber , :email , :type)";
        $stmt =  $this->conn->prepare($sql);
        $result = $stmt->execute($data);
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }

    }

    public function get_address($email){
        $sql =  "SELECT * FROM useraddress WHERE Email = '$email'  ORDER BY AddressId ASC";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

   
    public function add_service($data){
        $sql = "INSERT INTO servicerequest ( `UserId`, `ServiceStartDate`, `ServiceTime`, `ZipCode`,  `ServiceHourlyRate`, `ServiceHours`, `ExtraHours`, `TotalHours`, `TotalCost`, `ExtraServices`, `Comments`, `AddressId`, `PaymentDue`, `HasPets`, `Status`, `CreatedDate`,  `PaymentDone`, `RecordVersion`)
     VALUES (:userId ,:servicedate ,:servicetime, :postalcode,:serviceRate ,:servicehours, :extrahour , :totalhours, :total_payment , :extra_service, :comments, :address_id, :payment_due , :pets, :status, :current_date, :payment_done, :recordvirson)
     ";
           $stmt = $this->conn->prepare($sql);
           $stmt->execute($data);
           $service_id = $this->conn->lastInsertId();
   
           return $service_id;
    }

    public function get_SP(){
        $sql='SELECT * FROM user WHERE UserTypeId = 1';
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    public function getCustomerDetail($userId){
        $sql = "SELECT * FROM `servicerequest` WHERE `UserId` = $userId ORDER BY `ServiceRequestId` DESC";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getServicedata($serviceId){
          $sql="SELECT * FROM `servicerequest` WHERE `ServiceRequestId` = $serviceId";
          $stmt = $this->conn->prepare($sql);
          $stmt->execute();
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return $result;
    }
    public function getUserId($Id){
        $sql = "SELECT * FROM `user` WHERE UserId = $Id";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    

    public function getspId($serviceproviderid){
        $sql = "SELECT * FROM user WHERE UserId = $serviceproviderid";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    public function rescheduleService($data){
        $sql = "UPDATE `servicerequest` SET `ServiceStartDate`= :newDate,`ServiceTime`= :newTime ,`ModifiedBy`= :modifiedBy , `ModifiedDate`= :modifiedDate , `RecordVersion`= :recordversion,`Status`= :status WHERE `ServiceRequestId` = :serviceId";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute($data);
        $count = $stmt->rowCount();
        return array($count);
    }
    public function cancelServiceRequest($data){
        $sql = "UPDATE `servicerequest` SET `HasIssue` = :cancelReason ,`ModifiedDate`= :modifiedDate ,`ModifiedBy`= :modifiedBy , `RecordVersion`= :recordversion , `Status` = :status WHERE `ServiceRequestId` = :serviceId";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute($data);
        $count = $stmt->rowCount();
        return array($count);
    }
    public function getspData($serviceproviderid)
    {
        $sql = "SELECT * FROM `user` WHERE UserId = $serviceproviderid";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getUserDetails($email){
        $sql="SELECT * FROM user WHERE Email = '$email'";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }
    public function saveCustDetails($data){
        $sql="UPDATE user SET FirstName=:firstName, LastName=:lastName, Mobile=:phone, DateOfBirth=:dateOfBirth, LanguageId=:language, ModifiedDate=:modifiedDate, ModifiedBy=:modifiedBy WHERE Email=:email";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute($data);
        $count=$stmt->rowCount();
        return array($count);

    }
    public function getAddress($email){
        $sql="SELECT * FROM useraddress WHERE Email='$email'";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }
    public function getAddresstab($addressId){
        $sql="SELECT * FROM useraddress WHERE AddressId = '$addressId'";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }
    public function editaddress($data){
        $sql = "UPDATE `useraddress` SET `AddressLine1`= :streetname ,`AddressLine2`= :housenumber, `PostalCode`= :postalcode , `City`=:city,`State`= :state ,`Mobile`=:phonenumber WHERE `AddressId` = :addressId ";
        $stmt =  $this->conn->prepare($sql);
       $stmt->execute($data);
       $count = $stmt->rowCount();
       return array($count);
    }
    public function deleteAdd($addressId){
        $sql = "UPDATE `useraddress` SET `IsDeleted`= 1 WHERE `AddressId` = $addressId ";
        $stmt =  $this->conn->prepare($sql);
       $stmt->execute();
       $count = $stmt->rowCount();
       return array($count);
    }

    public function checkDefAdd($checkDef){
        
        $sql="UPDATE useraddress SET IsDefault = 1 WHERE AddressId = $checkDef";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();
        $sql="UPDATE useraddress SET IsDefault = 0 WHERE AddressId != $checkDef";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();
        $count=$stmt->rowCount();
        return array($count);

    }
    public function getRating($serviceProviderId){
        $sql = "SELECT * FROM `rating` WHERE `RatingTo` = $serviceProviderId";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array($result, $count);

    }
    public function countRate($Id){
        $sql = "SELECT * FROM `rating` WHERE `ServiceRequestId` = $Id";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array($result, $count);
    }
    public function addrating($data){
        $sql = "INSERT INTO `rating`( `ServiceRequestId`, `RatingFrom`, `RatingTo`, `Ratings`, `Comments`, `RatingDate`, `IsApproved`, `OnTimeArrival`, `Friendly`, `QualityOfService`) 
        VALUES (:serviceId,:ratefrom,:rateto,:avgrating,:feedback,:ratedate,:isapproved,:onTimeRate,:friedlyRate,:qualityRate)";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute($data);
        $count = $stmt->rowCount();
        return $count;
    }
    public function getSAddress($addressid){
        $sql =   "SELECT * FROM `useraddress` WHERE `AddressId` = $addressid";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getNewServices(){
        $sql = "SELECT * FROM `servicerequest`  JOIN user ON servicerequest.`UserId`= user.UserId JOIN useraddress ON useraddress.AddressId = servicerequest.`AddressId`  WHERE `servicerequest`.`Status` = 'Panding' ORDER BY `servicerequest`.`ServiceRequestId` DESC";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }
    public function isConflict($serviceproviderid, $servicestartdate, $totaltime){
        $sql = "SELECT *,COUNT(*) FROM `servicerequest` WHERE `ServiceProviderId` = $serviceproviderid AND `ServiceStartDate` = '$servicestartdate' AND `ServiceTime` <=  '$totaltime'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // $count = $stmt->rowCount();
        if (count($result)) {
            foreach ($result as $row) {
                $serviceid = $row['ServiceRequestId'];
                $count = $row['COUNT(*)'];
                // $serviceid = $result['ServiceRequestId'];   
            }
        }
        return array($count, $serviceid);

    }

    public function aproveSReq($data){
        $sql = "UPDATE `servicerequest` SET `ModifiedDate`= :modifiedDate,`modifiedBy`= :modifiedBy,`RecordVersion`=:recordversion,`Status`=:status, `ServiceProviderId`=:serviceProviderId WHERE `ServiceRequestId`=:serviceId";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute($data);
        $count = $stmt->rowCount();
        return array($count);

    }
    public function getallSp($usertypeId, $spId){
        $sql = "SELECT * FROM `user` WHERE `UserTypeId` = $usertypeId && `UserId` != $spId";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }
    public function getupcomeservice($userId){
        $sql = "SELECT * FROM `servicerequest`  JOIN user ON servicerequest.`UserId`= user.UserId JOIN useraddress ON useraddress.AddressId = servicerequest.`AddressId`  WHERE `servicerequest`.`ServiceProviderId` = $userId && `servicerequest`.`Status`='Approoved'";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }
    public function completeServiceRequest($data){
        $sql = "UPDATE `servicerequest` SET `ModifiedDate`= :modifiedDate ,`ModifiedBy`= :modifiedBy , `RecordVersion`= :recordversion , `Status` = :status WHERE `ServiceRequestId` = :serviceId";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute($data);
        $count = $stmt->rowCount();
        return array($count);

    }

    public function getSpServiceHistory($userId){
        $sql = "SELECT * FROM `servicerequest` WHERE `ServiceProviderId` = $userId ORDER BY `ServiceRequestId` DESC";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
        
    }
    public function custDataHistory($serviceId){
        $sql = "SELECT * FROM `servicerequest` JOIN user ON user.UserId = servicerequest.UserId JOIN useraddress ON useraddress.AddressId = servicerequest.AddressId WHERE `ServiceRequestId` = $serviceId";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getRatingsp($Id){
        $sql = "SELECT * FROM `rating` WHERE `RatingTo` = $Id";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result1  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result2  = $stmt->rowCount();

        return array($result1,$result2);

    }
    public function customerData($userId){
        $sql = 'SELECT DISTINCT  servicerequest.`UserId`,user.FirstName,user.LastName FROM `servicerequest` JOIN user ON user.UserId = servicerequest.UserId WHERE servicerequest.`ServiceProviderId` = '.$userId.' && servicerequest.`Status` = "Completed"';
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }
    public function checkBlocked($userId, $custId){
        $sql = "SELECT * FROM `favoriteandblocked` WHERE `UserId` = $userId AND `TargetUserId`=$custId;
        ";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
        $block = "";
    
        if ($count == 1) {
        $result  = $stmt->fetch(PDO::FETCH_ASSOC);
        $block = $result['IsBlocked'];
        
        }

        return array($count, $block);
    }

    public function addBlock($data){
        $sql = "INSERT INTO `favoriteandblocked`( `UserId`, `TargetUserId`, `IsBlocked`) 
            VALUES (:userId,:target,:blocked)";

        $stmt =  $this->conn->prepare($sql);
        $stmt->execute($data);
        $count = $stmt->rowCount();
        return array($count);

    }
    public function updateBlockdb($data){
        $sql = "
         UPDATE `favoriteandblocked` SET `IsBlocked`=:blocked  WHERE `UserId` = :userId AND `TargetUserId`=:target";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute($data);
        $count = $stmt->rowCount();
        return array($count);

    }
    public function addSPadress($addAddress){
        $sql = "INSERT INTO useraddress (UserId , AddressLine1	 , AddressLine2 , City ,State,  PostalCode , Mobile , Email ,Type)
        VALUES (:userId , :street ,  :houseno  , :city ,:state , :postalcode , :phone , :email , :userType)";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute($addAddress);
        $count = $stmt->rowCount();
        return array($count);

    }
    public function updateSPadress($updateAddress){
        $sql = "UPDATE `useraddress` SET `AddressLine1`= :street ,`AddressLine2`= :houseno,`City`=:city,`State`= :state ,`PostalCode`= :postalcode ,`Mobile`=:phone WHERE `Email` = :email ";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute($updateAddress);
        $count = $stmt->rowCount();
        return array($count);
    }
    public function updateSPdata($data){
        $sql = "UPDATE `user` SET `FirstName`= :fistName,`LastName`=:lastName,`Mobile`=:phone,`UserProfilePicture`= :avatarimg,`Gender`= :gender,`ZipCode`= :postalcode,`NationalityId` = :nationality,`DateOfBirth`= :birthdate,`ModifiedDate`=:modifiedDate,`ModifiedBy`=:modifiedBy WHERE `Email`=:email";
        $stmt =  $this->conn->prepare($sql);
        $stmt->execute($data);
        $count = $stmt->rowCount();
        return array($count);

    }
}
?>