<?php

$to = $CustMail;
$subject = "Service Request Accepted | Helperland";
$body = "
    <h5>Service ID : $serviceId | Accepted Successfully By Service Provider </h5>
    
    <h5>For More Information Visit your Dashboard</h5>
    Thank you 😊 
    ";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
mail($to, $subject, $body, $headers)
?>