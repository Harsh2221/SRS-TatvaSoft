<?php

$to = $serviceproEmail;
$subject = "Reschedule Service | Helperland";
$body = "
    <h5>Service ID : $serviceId | Rescheduled at </h5>
    <h5>New Date and Time : </h5>
    <h5>For Accept the Request visit your service provider Dashboard</h5>
    Thank you 😊 
    ";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
mail($to, $subject, $body, $headers)
?>