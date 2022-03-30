<script>


$(document).ready(function () {
       
      $("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' });

    //   $("#myTable1").dataTable({
        // "bFilter": false,
        // "bInfo": false,
        // "dom": '<"top"i>rt<"bottom"flp><"clear">'
    //   });
    //   $("#myTable2").dataTable({
    //     "bFilter": false,
    //     "bInfo": false,
    //     "dom": '<"top"i>rt<"bottom"flp><"clear">'
    //   });
      

});

//dashboard table--------------------------------------------------------------------------------->

$(document).ready(function () {

    username = "<?php echo $_SESSION['username'] ?>";
    
        // alert("in");
            table = $("#myTable1").DataTable({
                "bFilter": false,
                "bInfo": false,
                "dom": '<"top"i>rt<"bottom"flp><"clear">',
                
                "language": {
                    "paginate": {
                        "previous": '<i class="fa fa-angle-left"></i>',
                        "next": '<i class="fa fa-angle-right"></i>',
                        
                    },
                    "zeroRecords": "No Data Found",
                   },
                
                "ajax": {
                    'type': 'POST',
                    'url': 'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=customerDetails',
                    'data': { 'username' : username }, 
                },
                'columns': [
                    { "data": 'serviceId' },
                    {"data": 'serviceDate'},
                    {"data": 'serviceProvider'},
                    { "data": 'payment' },
                    {"data": 'actions'},
                ],   
               
            }).ajax.reload();
    
    
});

$(document).ready(function () {

    $("#myTable1").on('click', '.serviceDetailModel', function(){
        serviceId = $(this).attr('name');
        ;
        // alert(serviceId);
    
        $.ajax({
        type: 'POST',
        url: 'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=getServiceData',
        data: { 'serviceId' : serviceId, },
        dataType: "json",
        success: function (data){
            // data fetch from controller function
            $('.bookDate').html(data[13]);
            $('.sTime').html(data[14]); 
            $('.eTime').html(data[15]);
            $('.duration').html(data[1]);
            $('.serviceId').html(data[0]);
            $('.extraS').html(data[16]);
            $('.paymentTotal').html(data[2]);
            $('.addressData').html(data[18]);
            $('.phoneNo').html(data[19]);
            
            $('.commentPet').html(data[20]);

            

        }
    });
    })


$(".dashboardTable").on("click", ".reschedule-btn", function() {
    // alert('+');
    serviceId = $(this).attr('id');
    // alert(serviceId);

    $.ajax({
        type: 'POST',
        url: 'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=getServiceData',
        data: { 'serviceId' : serviceId, },
        dataType: "json",
        success: function (data){
            // data fetch from controller function
            $('.updateButton').html(data[8]);
            $('.select_time').html(data[10]); 
            $('.newDateTime').html(data[12]);
            

        }
    });
});

$(".dashboardTable").on("click", ".cancel-btn", function() {
    // alert('+');
    serviceId = $(this).attr('id');
    // alert(serviceId);

    $.ajax({
        type: 'POST',
        url: 'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=getServiceData',
        data: { 'serviceId' : serviceId, },
        dataType: "json",
        success: function (data){
            // data fetch from controller function
            $('.cancelButton').html(data[9]);
            $('.cancel_reason').html(data[11]); 
                        

        }
    });
});

$("#cancel_modal").on('click', function(){
    $('.cancle_reason').on('input', function(){
        if($(".cancle_reason").val().length >= 5)
        {
            $(".cancel").removeAttr("disabled");

        }
        if($(".cancle_reason").val().length < 5)
        {
            $(".cancel").attr("disabled", "disabled");
        }
    })

});

$("#reschedule_modal").on('click', function(){
    var newSeletedTime = parseFloat($('#select_time').val());
    totalTime = parseFloat($(".newDateTime p").attr("id"));
    // alert(totalTime);
    totalRequerTime = newSeletedTime + totalTime;
    if(totalRequerTime>=21){
        // alert("Please select less than 21 hour to complete service!")
        $('.timeError').text("Please select less than 21 hour to complete service!");
    }else{
        $('.timeError').text("");
    }

}); 

$("#reschedule_modal").on('click','.update', function(){
   //    alert("+")
   serviceId = $(this).attr("id");
  //  alert(serviceId)
  newDate = $('#datepicker').val();
  //   alert(newDate);
  newTime = $('#select_time option:selected').val();
  //   alert(newTime);
    $.ajax({
        type: 'POST',
        url: 'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=rescheduleService',
        data: { 
            'serviceId': serviceId, 
            'newDate': newDate, 
            'newTime': newTime, 
        },
    //     beforeSend: function(){
    //       alert("Loading ...");
        
    //    },
        success: function(data){
            if(data==0)
            {
                // alert("Reschedule cancled");
                swal({
                      title: "Cancel !",
                      text: "Reschedule cancled, try again",
                      icon: "error",
                    });
            }
            if(data==1)
            {
            //    alert("Booking Rescheduled successfully");
               swal({
                      title: "Successfull !",
                      text: "Booking Rescheduled successfully",
                      icon: "success",
                    });
            }

            $('#myTable1').DataTable().ajax.reload();
        }
        

    });


});

$("#cancel_modal").on('click','.cancel', function(){
    // alert("+");
    serviceId=$(this).attr('id');
    cancelReason=$('.cancle_reason').val();

    // alert(cancelReason);
    $.ajax({
        type: 'POST',
        url: 'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=cancelService',
        data: {
            'serviceId': serviceId,
            'cancelReason': cancelReason,
        },
    //     beforeSend: function(){
    //       alert("Loading ...");
        
    //    },
        success: function(data)
        {
            if(data==1){
                // alert("Service Request cancel successfully");
                swal({
                      title: "Successfull !",
                      text: "Service Request cancel successfully",
                      icon: "success",
                    });
            }
            if(data==0){
                // alert("Service Request cancel Failed");
                swal({
                      title: "Cancel !",
                      text: "Service Request cancel Failed, Try again",
                      icon: "error",
                    });
            }
            
            $('#myTable1').DataTable().ajax.reload();
        }

    });

});

});

// Customer service history table------------------------------------------------------------------>

$(document).ready(function(){
    username = "<?php echo $_SESSION['username'] ?>";
    
    
        // alert("in");
            table = $("#myTable2").DataTable({
                "bFilter": false,
                "bInfo": false,
                "dom": '<"top"i>rt<"bottom"flp><"clear">',
                
                "language": {
                    "paginate": {
                        "previous": '<i class="fa fa-angle-left"></i>',
                        "next": '<i class="fa fa-angle-right"></i>',
                        
                    },
                    "zeroRecords": "No Data Found",
                   },
                
                "ajax": {
                    'type': 'POST',
                    'url': 'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=customerServiceHistory',
                    'data': { 'username' : username }, 
                },
                'columns': [
                    { "data": 'serviceId' },
                    {"data": 'serviceDate'},
                    {"data": 'serviceProvider'},
                    { "data": 'payment' },
                    {"data": 'status'},
                    {"data": 'rateSP'},
                ],   
               
            }).ajax.reload();
    
    

}); 



// rating service provider -------------------->
$(document).ready(function () {

    $("#myTable2").on('click', '.serviceDetailModel', function(){
        serviceId = $(this).attr('name');
        ;
        // alert(serviceId);
    
        $.ajax({
        type: 'POST',
        url: 'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=getServiceData',
        data: { 'serviceId' : serviceId, },
        dataType: "json",
        success: function (data){
            // data fetch from controller function
            $('.bookDate').html(data[13]);
            $('.sTime').html(data[14]); 
            $('.eTime').html(data[15]);
            $('.duration').html(data[1]);
            $('.serviceId').html(data[0]);
            $('.extraS').html(data[16]);
            $('.paymentTotal').html(data[2]);
            $('.addressData').html(data[18]);
            $('.phoneNo').html(data[19]);
            
            $('.commentPet').html(data[20]);

            

        }
    });
    })
        
 // on time arrival rating--->
    $('.on_time').on('click', function(){
        // alert("+")
        
        $("#tst1").click(function() {
            $("#tst2,#tst3,#tst4,#tst5").css("color", "silver");
            $("#tst1").css("color", "yellow");
            $(".rateTime").text("1");
          });

          $("#tst2").click(function() {
            $("#tst3,#tst4,#tst5").css("color", "silver");
            $("#tst1,#tst2").css("color", "yellow");
            $(".rateTime").text("2");

          });
          $("#tst3").click(function() {
            $("#tst4,#tst5").css("color", "silver");
            $("#tst1,#tst2,#tst3").css("color", "yellow");
            $(".rateTime").text("3");

          });
          $("#tst4").click(function() {
            $("#tst5").css("color", "silver");
            $("#tst1,#tst2,#tst3,#tst4").css("color", "yellow");
            $(".rateTime").text("4");

          });
          $("#tst5").click(function() {
            
            $("#tst1,#tst2,#tst3,#tst4,#tst5").css("color", "yellow");
            $(".rateTime").text("5");

          });
    });

 // friendly rating---->

    $('.friendly').on('click', function(){
        // alert("+")
        $("#fst1").click(function() {
            $("#fst2,#fst3,#fst4,#fst5").css("color", "silver");
            $("#fst1").css("color", "yellow");
            $(".rateFrnd").text("1");
          });

          $("#fst2").click(function() {
            $("#fst3,#fst4,#fst5").css("color", "silver");
            $("#fst1,#fst2").css("color", "yellow");
            $(".rateFrnd").text("2");

          });
          $("#fst3").click(function() {
            $("#fst4,#fst5").css("color", "silver");
            $("#fst1,#fst2,#fst3").css("color", "yellow");
            $(".rateFrnd").text("3");

          });
          $("#fst4").click(function() {
            $("#fst5").css("color", "silver");
            $("#fst1,#fst2,#fst3,#fst4").css("color", "yellow");
            $(".rateFrnd").text("4");

          });
          $("#fst5").click(function() {
            
            $("#fst1,#fst2,#fst3,#fst4,#fst5").css("color", "yellow");
            $(".rateFrnd").text("5");

          });
       
    })

    //quality of service-------->
    $('.qualityofservice').on('click', function(){
        // alert("+")
        $("#qst1").click(function() {
            $("#qst2,#qst3,#qst4,#qst5").css("color", "silver");
            $("#qst1").css("color", "yellow");
            $(".rateqlt").text("1");
          });

          $("#qst2").click(function() {
            $("#qst3,#qst4,#qst5").css("color", "silver");
            $("#qst1,#qst2").css("color", "yellow");
            $(".rateqlt").text("2");

          });
          $("#qst3").click(function() {
            $("#qst4,#qst5").css("color", "silver");
            $("#qst1,#qst2,#qst3").css("color", "yellow");
            $(".rateqlt").text("3");

          });
          $("#qst4").click(function() {
            $("#qst5").css("color", "silver");
            $("#qst1,#qst2,#qst3,#qst4").css("color", "yellow");
            $(".rateqlt").text("4");

          });
          $("#qst5").click(function() {
            
            $("#qst1,#qst2,#qst3,#qst4,#qst5").css("color", "yellow");
            $(".rateqlt").text("5");

          });
       
    })
});


$(document).ready(function () {
   
    $('#myTable2').on('click', '.rate-btn', function(){
        serviceId=$(this).attr('id');
        // alert(serviceId)
        $.ajax({
            type:'POST',
            url:'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=getRateModalData',
            data:{
                'serviceId': serviceId,
            },
            dataType: "json",
            success: function(data)
            {
                $(".serviceProviderData").html(data[0]);
                $(".timeRate").html(data[1]);
                $('.FriendlyRate').html(data[2]);
                $(".qualityRate").html(data[3]);
                
                $(".feedback").html(data[4]);
                $(".rateSPy").attr('id', data[5])

            }
        });

    });
  
  $('#rate_sp').on('click', '.rate_submit', function(){
    //   alert("got it")
    onTimeRate=$('.rateTime').text();
    friedlyRate=$('.rateFrnd').text();
    qualityRate=$('.rateqlt').text();
    feedback=$('#feedback_sp').val();
    spId=$('.spData').attr('id');
    serviceId=$('.spData').attr('name');
    // alert(feedback)
    username="<?php echo $_SESSION['username'] ?>";

    $.ajax({
        type:'POST',
        url:'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=addRating',
        data:{
            'onTimeRate':onTimeRate,
            'friedlyRate':friedlyRate,
            'qualityRate':qualityRate,
            'spId':spId,
            'serviceId':serviceId,
            'rateFrom':username,
            'feedback':feedback,

        },
        success: function(data)
        {
            if(data==1)
            {
                // alert("Rated successfully")
                swal({
                      title: "Successfull",
                      text: "Service Provider Rated successfully",
                      icon: "success",
                    });
            }
            if(data==2)
            {
                // alert("Already Rated")
                swal({
                      title: "Already Rated",
                      text: "Service Provider Already Rated",
                      icon: "success",
                    });
            }
            if(data==0)
            {
                alert("Not Rated successfully")
            }
            $("#myTable2").DataTable().ajax.reload();
        }
    })

  })  
    
}); 

$(document).ready(function () {
    var options = {
    "separator": ",",
    "filename": "CustomerServiceHistory.csv",
  }
$(".exprtBtn").on('click', function () {
    // alert("+");
    $('#myTable2').table2csv(options);
  });
});


</script>