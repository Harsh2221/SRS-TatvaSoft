<script>
// alert("got it");
$(document).ready(function(){
    username="<?php echo $_SESSION['username'] ?>";
    ispet=0;
    $('#pet').on('click', function(){
        if($('#pet').is(':checked'))
        {
            ispet=1;
            // alert (ispet)
        }else{
            ispet=0;
            // alert (ispet)
        }
        $('#newServiceTable').DataTable().ajax.reload();
    })
    table=$("#newServiceTable").DataTable({
                "bFilter": false,
                "bInfo": false,
                "dom": '<"top"i>rt<"bottom"flp><"clear">',
                
                "zeroRecords": "No Data Found",
                
                "ajax": {
                    'type': 'POST',
                    'url': 'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=getNewServiceReq',
                    'data': function (data) {
                            data.username = username;
                            data.pet = ispet;
                        }, 
                },
                'columns': [
                    { "data": 'serviceId' },
                    {"data": 'serviceDate'},
                    {"data": 'customerDetails'},
                    { "data": 'payment' },
                    { "data": 'timeConflict' },
                    {"data": 'actions'},
                ],
    }).ajax.reload();

    $('#newServiceTable').on('click', '.modaldata', function(){
        serviceId = $(this).attr('name');
        userId = $(this).attr('id');
        // alert(serviceid);
        // alert(userid);
        $.ajax({
            type:'POST',
            url:'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=getServiceData',
            data:{
                'serviceId':serviceId,
                'userId':userId,
            },
            dataType: 'json',
            success: function(data)
            {
                $('.bookDate').html(data[13]);
                $('.sTime').html(data[14]);
                $('.eTime').html(data[15]);
                $('.duration').html(data[1]);
                $('.serviceId').html(data[0]);
                $('.extraS').html(data[16]);
                $('.paymentTotal').html(data[2]);
                $('.custName').html(data[17]);
                $('.addressData').html(data[18]);
                $('.phoneNo').html(data[19]);
                $('.commentPet').html(data[20]);
                $('.acceptmodalBtn').html(data[21]);
                $('.mapModal').html(data[23]);

            }
        })

    })

    $('#serviceDetail').on('click', '.acceptBtnModal', function(){
        serviceid=$('.acceptBtnModal').attr('id');
        // alert(serviceid);
        $.ajax({
            type: 'POST',
            url: 'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=acceptServiceReq',
            data:{
                'username': username,
                'serviceid': serviceid,
            },
            success: function(data)
            {
                if(data==1)
                {
                    $('#newServiceTable').DataTable().ajax.reload();
                    alert('Service Request Accepted');
                }
                if(data==0)
                {
                    alert("Service Not Accepted");
                }
                if(data==2)
                {
                    alert("service already accepted by other service provider");
                }
                $('#newServiceTable').DataTable().ajax.reload();
            }
        })

    })

});

$(document).ready(function(){
    username="<?php echo $_SESSION['username'] ?>";

    table=$("#upcomingServiceTable").DataTable({
                "bFilter": false,
                "bInfo": false,
                "dom": '<"top"i>rt<"bottom"flp><"clear">',
                
                "zeroRecords": "No Data Found",
                
                "ajax": {
                    'type': 'POST',
                    'url': 'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=getUpcomingService',
                    'data':{
                            'username' : username,
                            
                        }, 
                },
                'columns': [
                    { "data": 'serviceId' },
                    {"data": 'serviceDate'},
                    {"data": 'customerDetails'},
                    { "data": 'distance' },
                    {"data": 'actions'},
                ],
    }).ajax.reload();

    $('#upcomingServiceTable').on('click', '.detailModal', function(){
        serviceId=$(this).attr('name');
        userId=$(this).attr('id');
        // alert(serviceId)
        // alert(userId)
        $.ajax({
            type:'POST',
            url:'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=getServiceData',
            data:{
                'serviceId':serviceId,
                
            },
            dataType: 'json',
            success: function(data)
            {
                $('.upcomeDate').html(data[13]);
                $('.UsTime').html(data[14]);
                $('.UeTime').html(data[15]);
                $('.upcomeDuration').html(data[1]);
                $('.upcomeSId').html(data[0]);
                $('.upcomeExtraS').html(data[16]);
                $('.upcomePayment').html(data[2]);
                $('.upcomeCustName').html(data[17]);
                $('.upcomeAddr').html(data[18]);
                $('.upcomephone').html(data[19]);
                $('.upcomepets').html(data[20]);
                $('.upcomeactionbtn').html(data[22]);
                $('.mapModal').html(data[23]);

            }
        })


    });

    $('#upcomingServiceTable').on('click', '.cancle-btn', function(){
        serviceId=$(this).attr('id');
        // alert(serviceId);
        $.ajax({
            type:'POST',
            url:'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=getServiceData',
            data:{
                'serviceId':serviceId,
            },
            dataType: 'json',
            success: function(data){
                $('.cancelButton').html(data[9]);
                $('.cancel_reason').html(data[11]);

            }
        })
    });

    $('#cancel_modal').on('click', '.cancel', function(){
        // alert("+")
        serviceId=$(this).attr('id');
        canclereason=$('.cancle_reason').val();
        // alert(serviceId)
        // alert(cancle_reason)
        $.ajax({
            type: 'POST',
            url: 'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=SPRequestCancel',
            data: {
                'serviceId': serviceId,
                'canclereason': canclereason,
            },
            success: function(data)
            {
                if(data==1)
                {
                    alert("Service Request cancelled successfully");
                }
                if(data==0)
                {
                    alert("Service Request Not cancelled");
                }
                $("#upcomingServiceTable").DataTable().ajax.reload();
            }
        })
    })

    $('#upcomingModal').on('click', '.completeBtnModal', function(){
        serviceId=$(this).attr('id');
        // alert(serviceId)
        $.ajax({
            type:'POST',
            url:'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=completeService',
            data:{
                'serviceId': serviceId,
            },
            dataType:'json',
            success: function(data)
            {
                if(data==1){
                    alert("Service Has Completed Successfully");
                }
                if(data==0)
                {
                    alert("Service Has Not Completed Successfully");
                }
                $("#upcomingServiceTable").DataTable().ajax.reload();
            }
        })

    })

});

$(document).ready(function(){

    username="<?php echo $_SESSION['username'] ?>";

    // alert(username);

    $('#Sstatus').on('change', function(){
        $('#serviceHistoryTableSP').DataTable().ajax.reload();
    });
    // $('#serviceHistoryTableSP').on('click', function(){
    //     alert("table")
    // })
    // serviceHistory();

    // function serviceHistory(){

        table=$("#serviceHistoryTableSP").DataTable({

                "bFilter": false,
                "bInfo": false,
                "dom": '<"top"i>rt<"bottom"flp><"clear">',
                
                "zeroRecords": "No Data Found",
                
                "ajax": {
                    'type': 'POST',
                    'url': 'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=ServiceHistorySp',
                    'data': function(data){
                            data.username = username;
                            data.Sstatus = $('#Sstatus option:selected').val();
                            
                        }, 
                },
                'columns': [
                    { "data": 'serviceId' },
                    {"data": 'serviceDate'},
                    {"data": 'customerDetails'},
                    { "data": 'status' },
                    
                ],
    }).ajax.reload();

    $('#serviceHistoryTableSP').on('click', '.modalData', function(){
        serviceId=$(this).attr('name');
        userId=$(this).attr('id');
        // alert(serviceId)
        // alert(userId)
        $.ajax({
            type:'POST',
            url:'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=getServiceData',
            data:{
                'serviceId':serviceId,
                
            },
            dataType: 'json',
            success: function(data)
            {
                $('.upcomeDate').html(data[13]);
                $('.UsTime').html(data[14]);
                $('.UeTime').html(data[15]);
                $('.upcomeDuration').html(data[1]);
                $('.upcomeSId').html(data[0]);
                $('.upcomeExtraS').html(data[16]);
                $('.upcomePayment').html(data[2]);
                $('.upcomeCustName').html(data[17]);
                $('.upcomeAddr').html(data[18]);
                $('.upcomephone').html(data[19]);
                $('.upcomepets').html(data[20]);
                $('.upcomeactionbtn').html(data[22]);
                $('.mapModal').html(data[23]);

            }
        })

    })
    
    

});

$(document).ready(function(){
    username = "<?php echo $_SESSION['username'] ?>";

    selectRating = $('#selectbtn option:selected').val();
    $('#selectbtn ').on('change', function() {
        $('#spRatings').DataTable().ajax.reload();
    });

    table=$("#spRatings").DataTable({

            "bFilter": false,
            "bInfo": false,
            "dom": '<"top"i>rt<"bottom"flp><"clear">',

            "zeroRecords": "No Data Found",

            "ajax": {
                'type': 'POST',
                'url': 'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=getRatingsforsp',
                'data': {
            'username' : username,
            'selectRating' : selectRating,
            
        }, 
            },
            'columns': [
                { "data": 'Ratings' },
                { "data": 'date' },
                { "data": 'rate' },
        
            ],
}).ajax.reload(); 

});

$(document).ready(function(){
    username = "<?php echo $_SESSION['username'] ?>";


table=$("#blockTable").DataTable({

        "bFilter": false,
        "bInfo": false,
        "dom": '<"top"i>rt<"bottom"flp><"clear">',

        "zeroRecords": "No Data Found",

        "ajax": {
            'type': 'POST',
            'url': 'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=getcustomerList',
            'data': {
        'username' : username,
               
    }, 
        },
        'columns': [
            { "data": 'customer' },
           
    
        ],
}).ajax.reload();

    $('#blockTable').on('click', '.block_unblock', function(){
        spId=$(this).attr('id');
        // alert(spId)
        if($(this).text()=="Block")
        {
            blockmsg=1;
            $(this).text("UnBlock");
            // alert("+")
        }else{
            blockmsg=0;
            $(this).text("Block");
            // alert("-")
        }

        $.ajax({
            type: 'POST',
            url: 'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=blockUnblockCust',
            data: {
                'username':username,
                'spId': spId,
                'blockmsg':blockmsg,

            },
            success: function(data)
            {
                $('#blockTable').DataTable().ajax.reload();
            }
        })

    });
    
});


</script>
