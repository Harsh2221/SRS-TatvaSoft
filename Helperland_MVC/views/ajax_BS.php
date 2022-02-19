<script>
<?php if (isset($_SESSION['username'])) { ?>
    // Get UserId
    var username = "<?php echo $_SESSION['username']; ?>";
<?php } ?>
//date picker
$(document).ready(function () {
$("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
});

// AJAX form for check postal code availability

function check(){
  postalcode=$("#postalcode").val();
  if(postalcode == ""){
    $('#msg-box').html('<h6 style="color: red">Enter postal code to check!</h6>');
  }
  if(postalcode.length >= 5){
    $('#msg-box').html('');

  $.ajax({
    url: 'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=postalCheck',
    type: 'POST',
    data: {"postalcode" : postalcode, "postalCheck" : 1},
    success:function(data){

        if(data==1){

          document.getElementById("tab-2").classList.add("active");
          document.getElementById("img1").src="./assets/assets/schedule-white.png";
          document.querySelectorAll('[data-tab-content]');
          document.getElementById("step-2").classList.add('active');
          document.getElementById("step-1").classList.remove('active');
          $(document).scrollTop(500);

            $.ajax({

                type: 'POST',
                url: "http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=cityCheck",
                data: {"getPostalcode": 1, "postalcode": postalcode},
                dataType: 'json',
                success: function(data){
                    optionText=data[0];
                    optionValue=data[0];
                    $('#inputcity').append(`<option value="${optionValue}">${optionText}</option>`);
                }
            });

        }else{
            $('#msg-box').html('<h6 style="color: red">Currently, Service is not available in this area !</h6>');
        }
      
    }
  });
}else{
    $('#msg-box').html('<h6 style="color: red">Please Enter valid pin code!</h6>');
}
}

//ajax form for schedule and plan

function schedule_plan(){
    <?php if (!isset($_SESSION['username'])) { ?>
        $('#login_modal').modal('show');
    <?php  } ?>
    <?php if (isset($_SESSION['username'])) { ?>

        //form inputs--------------------->

        var date = $("#datepicker").val();
        var time = $("#select_time option:selected").text();
        var hour = $("#select_hours option:selected").text();
        // alert(date);
        // alert(hour);
        var extra_service = 0;
        var extra_time = "0.5";
        extra_time = parseFloat(extra_time);

        if($('.extr_1').css("display") == "block"){
          extra_service = extra_service + 0.5;
        }
        if($('.extr_2').css("display") == "block"){
          extra_service = extra_service + 0.5;
        }
        if($('.extr_3').css("display") == "block"){
          extra_service = extra_service + 0.5;
        }
        if($('.extr_4').css("display") == "block"){
          extra_service = extra_service + 0.5;
        }
        if($('.extr_5').css("display") == "block"){
          extra_service = extra_service + 0.5;
        }
        
        // alert(extra_service);

        var basic_time = $('.basic_time').text();
        basic_time = parseFloat(basic_time);
        
        var total_payment = $('#payment').text();
        total_payment=total_payment.substr(1, total_payment.length);
        total_payment=parseFloat(total_payment);
        // alert(total_payment);
        var comments = $("#comment").val();
        // alert(comments);
        if ($("#petcheck").is(":checked")){
            var pet = "yes";
        }else{
            var pet = "no";
        }
        // alert(pet);
  $(document).scrollTop(500);
  document.getElementById("tab-3").classList.add("active");
  document.getElementById("img2").src="./assets/assets/details-white.png";
  document.querySelectorAll('[data-tab-content]');
  document.getElementById("step-3").classList.add('active');
  document.getElementById("step-2").classList.remove('active');

    <?php } ?>   

}


function new_address(){    
  
  var streetname = $.trim($('#inputstreet').val());
  var housenumber = $.trim($('#inputhouse').val());
  var postalcode = $.trim($('#inputpostal').val());
  var city = $.trim($('#inputcity').val());
  var phonenumber = $.trim($('#inputphone').val());

  <?php if(isset($_SESSION['username'])) { ?>
  var username = "<?php echo $_SESSION['username']; ?>";
  <?php } ?>
  // alert(housenumber);
  $.ajax({
  type: 'POST',
  url: "http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=add_Address",
  data: {
    
    "saveaddress": 1,
    "streetname": streetname,
    "housenumber": housenumber,
    "postalcode": postalcode,
    "city": city,
    "phonenumber": phonenumber,
    "username": username,
  },
  
  success: function(data){
    if(data == 1){
      
      get_address();
      
  $("#inputstreet").val("");
  $("#inputhouse").val("");
  $("#inputpostal").val("");
  $("#inputcity").val("");
  $("#inputphone").val("");
  $('#address_form').hide();

      alert("Address saved !");
    }else{
      
      alert("please enter valid address");
    }
  }

  });

}

function get_address(){
  username='';
  <?php if(isset($_SESSION['username'])) { ?>
  username="<?php echo $_SESSION['username']; ?>";
  <?php } ?>

  $.ajax({
  type: 'POST',
  url: "http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=get_Address",
  data: {
    "get_address": 5,
    "username": username,
  },
  success: function(data)
  {
    $(".address-tab").html(data);
  }

  });

}
get_address();

function yourdetails(){
  $(document).scrollTop(500);
  if($("input[name='addressRadio']:checked").length != 0){
    document.getElementById("tab-4").classList.add("active");
    document.getElementById("img3").src="./assets/assets/payment-white.png";
    document.querySelectorAll('[data-tab-content]');
    document.getElementById("step-4").classList.add('active');
    document.getElementById("step-3").classList.remove('active');

  }else{
    alert("Select Address !");
  }
        
}

function complete_booking(){
  if($("#Terms_condition").not(':checked')){
     var err_msg = " * you must have to agree with the term and conditions";
     $('.checkbox_err').text(err_msg);
  }
  if($("#Terms_condition").is(':checked')){
    var err_msg = "";
    $('.checkbox_err').text(err_msg);
    
// alert("clicked");
// swal({
//   title: "Good job!",
//   text: "You clicked the button!",
//   icon: "success",
// });
  
    postalcode=$("#postalcode").val();
    

    hourlyRate=18.00;
    
    date = $.trim($("#datepicker").val());
    
    // alert(date);

    time = $("#select_time option:selected").text();
    hour = $("#select_hours option:selected").text();
    extra_service = 0;
    extra_time = "0.5";
    extra_time = parseFloat(extra_time);
    extr_service_name='';

        if($('.extr_1').css("display") == "block"){
          extra_service = extra_service + 0.5;
          extr_service_name=extr_service_name+['Inside cabinets'];
        }
        if($('.extr_2').css("display") == "block"){
          extra_service = extra_service + 0.5;
          extr_service_name=extr_service_name+['Inside fridge'];
        }
        if($('.extr_3').css("display") == "block"){
          extra_service = extra_service + 0.5;
          extr_service_name=extr_service_name+['Inside oven'];
        }
        if($('.extr_4').css("display") == "block"){
          extra_service = extra_service + 0.5;
          extr_service_name=extr_service_name+['Laundry wash & dry'];
        }
        if($('.extr_5').css("display") == "block"){
          extra_service = extra_service + 0.5;
          extr_service_name=extr_service_name+['Interior windows'];
        }
        Extr_service=extr_service_name;
        Extr_hour=extra_service;
        
        // selected_Sp='';
        basic_time = $('.basic_time').text();
        basic_time = parseFloat(basic_time);
        // alert(basic_time);
        total_payment = $('#payment').text();
        total_payment=total_payment.substr(1, total_payment.length);
        total_payment=parseFloat(total_payment);
        // alert(total_payment);
        duePayment = 0;
        comments = $("#comment").val();
        // alert(comments);
        if ($("#petcheck").is(":checked")){
            pet = 1;
        }else{
            pet = 0;
        }
        // alert(pet);

        address=$('input[name="addressRadio"]:checked').val();
// alert(address);
    

    serviceRequest();
        
  }

}

function serviceRequest(){
  // alert("in function");
  <?php if (isset($_SESSION['username'])) { ?>
    username = "<?php echo $_SESSION['username']; ?>";
  <?php } ?>
// alert(username);

  final_submit = ({
    
      "username": username,
      "date": date,
      "time": time,
      "postalcode": postalcode,
      "hourlyrate": hourlyRate,
      "servicehours": basic_time,
      "totalhours": hour,
      "extrahour": Extr_hour,
      "total_payment": total_payment,
      "extraService": Extr_service,
      "comments": comments,
      "address_id": address,
      "payment_due": duePayment,
      "pet": pet,
  });
 
  $.ajax({
    type: 'POST',
    url: 'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=service_request',
    data: final_submit,

    success: function(data){
      
      if(data==0){
        // alert("data not set");
        swal({
             title: "Service Not Booked !",
             text: "something went wrong, try again",
             icon: "error",
            });
      }else{
        // alert("data set");
        swal({
             title: "Good job! Service Booked",
             text: "Your service request Id - " + data,
             icon: "success",
            }).then(function(){
          location.href="customer_history.php";
        })
      }
    }

  });
}



</script>