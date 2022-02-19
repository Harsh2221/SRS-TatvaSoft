<?php
$to = $SP_email;
$subject = "New Service Request, Please Accept it! | HelperLand |";
$body = "<h5>Dear Service Provider, Please Accept the service request</h5>
<h5>Email for Registered Service Provider Only !<h5>
<br> <h6>Please Accept the Service Request By clicking this link</h6>
<a href='http://localhost/tatvasoft/Helperland_MVC/upcoming_service'>Click here to Accept</a>
";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
mail($to, $subject, $body, $headers)

?>