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
        $customer = "http://localhost/tatvasoft/Helperland_MVC/service_history";
        $service_provider = "http://localhost/tatvasoft/Helperland_MVC/upcoming_service";
        $base_url = "http://localhost/tatvasoft/Helperland_MVC";

        if($count==1){
            if ($pass == $row['Password']){
                if ($usertypeid == 0) {
                    $_SESSION['username'] = $email;

                    header('Location:' . $customer);
                } else if ($usertypeid == 1) {
                    $_SESSION['username'] = $email;
                    
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
        $resetkey=$row['ResetKey'];
        $count=$stmt->rowCount();

        return array($username, $resetkey, $count);
        
    }

    public function resetpassword($data){
        $sql = "UPDATE user SET Password = :password , ModifiedDate = :updatedate , ModifiedBy = :modifiedby WHERE ResetKey = :resetkey";
        $stmt =  $this->conn->prepare($sql);
        $result = $stmt->execute($data);
        
        if($result){
            $_SESSION['msg']="New Password set !";
            $_SESSION['icon']="success";
            
        }else{
            $_SESSION['msg']="Password Not set !";
            $_SESSION['icon']="error";
        }
    }
    
}
?>