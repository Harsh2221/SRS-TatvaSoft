<?php

$to = $custmail;
$subject = "Cancel Service | Helperland";
$body = "
<h5>Your Service Request Has Cancelled Successfully</h5>
    <h5>Service ID : $serviceId | Has been Cancelled </h5>
    <h5>Reason for Cancel : $cancelReason</h5>
    
    Thank you 😊 
    ";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
mail($to, $subject, $body, $headers)
?>