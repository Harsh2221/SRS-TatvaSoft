<?php
class Helperland_model{

    // Database connection created 
    public function __constructor()
    {
        try{
            $dsn = 'mysql:dbname=helperland;host=localhost';
            $username = 'root';
            $password = '';
 
            $this->conn = new PDO($dsn, $username, $password);
        }catch(PDOException $e){
            echo $e->getMessage();
            die();
   }
}

    public function contact_us($array){
        $sql = "INSERT INTO contactus(Name , Email , Subject , PhoneNumber , Message , CreatedOn )
        VALUES (:name , :email , :subject , :mobile , :message , :createdon)";
        $stmt = $this->conn->prepare($sql);
        $result = $stmt->execute($array);
        if($result){
            $_SESSION['status_msg']="sent successfully";
        }else{
            $_SESSION['status_msg']="Not sent successfully";
        }

        return array($_SESSION['status_msg']);
    }

}
?>