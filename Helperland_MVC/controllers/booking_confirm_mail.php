<?php
    
     $to = $customer_mail;
     $subject = "Service for helperland Helper is Booked Successfully !";
     $body = "<h5>Dear $customerName, your booking has been confirmed !</h5>
     <br> <h6>Please Find Details of your service below.</h6>
     <h6>Your service ID : $service_id<h6> 
     <h6>Email : $customer_mail</h6>
     <h6>Service Date : $s_date</h6>
     <h6>Service Time : $time</h6>
     <h6>Total service Time : $totalhours</h6>
     <h6>Extra Services you took : $extra_service</h6>
     <h6>Extra Service Time : $extrahour</h6>
     <h6>Total Payable Amount : $total_payment</h6>
     <h6>Payment status : $payment_done</h6>
     <br><h5>Thank you for taking our services, We assure you the best Service !</h5>
        ";
     $headers = "MIME-Version: 1.0" . "\r\n";
     $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
     mail($to, $subject, $body, $headers)
?>