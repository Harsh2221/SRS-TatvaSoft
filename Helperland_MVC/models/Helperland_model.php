<?php
class Helperland_model{

    // Database connection created 
    public function __construct()
    {
        try {
            
            $dsn = 'mysql:dbname=helperland;host=localhost';
            $user = 'root';
            $password = '';
            $this->conn = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "";
            die();
        }
    }
 
    public function Contactus($array)
    {
        $sql = "INSERT INTO contactus (Name , Email , Subject , PhoneNumber , Message , CreatedOn )
        VALUES (:name ,  :email , :subject , :mobile , :message , :creationdt )";
        $stmt =  $this->conn->prepare($sql);
        $result = $stmt->execute($array);
        return $result;
       
    }

}
?>