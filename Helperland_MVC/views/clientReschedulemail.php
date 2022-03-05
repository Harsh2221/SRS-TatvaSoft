<?php

$to = $customerEmail;
$subject = "Rescheduled Service | Helperland";
$body = "
    <h5>New Date and Time : $newDate | $newTime</h5>
    <h5>For More Details Visite Helperland !</h5>
    ";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
mail($to, $subject, $body, $headers)

?>