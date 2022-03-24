<?php

$to = $spemail;
$subject = "Cancel Service | Helperland";
$body = "
<h5>Service Request Has Cancelled</h5>
    <h5>Service ID : $serviceId | Has been Cancelled And No longer available for accept.</h5>
    <h5>Reason for Cancel : $cancelReason</h5>
    
    Thank you 😊 
    ";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
mail($to, $subject, $body, $headers)
?>