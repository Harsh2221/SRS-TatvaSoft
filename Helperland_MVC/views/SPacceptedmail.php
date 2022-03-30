<?php

$to = $spmail;
$subject = "Service Request Accepted | Helperland";
$body = "
    <h5>Service ID : $serviceId | 
    Accepted By Service Provider, And It's No Longer Available to accept for you</h5>
    
    <h5>For More Information Visit your Dashboard</h5>
    Thank you 😊 
    ";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
mail($to, $subject, $body, $headers)
?>