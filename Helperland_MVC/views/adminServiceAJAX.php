<script>
$(document).ready(function () {
  
  $("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
  $("#datepicker2").datepicker({ dateFormat: 'yy-mm-dd' });

  $("#reDate").datepicker();
  $('#sidebarCollapse').on('click', function () {
  $('#sidebar').toggleClass('active');
  });

});



$(document).ready(function(){
  
    serviceId="";
    selectUser="";
    selectSp="";
    postalcode="";
    phone="";
    status="";
    startDate="";
    endDate="";
    // alert(serviceId);
    
    table=$('#serviceReqTable').dataTable({
        "bFilter": false,
        "bInfo": false,
        "dom": '<"top"i>rt<"bottom"flp><"clear">',
        "searchPanes": {
            viewTotal: true
        },
        "language": {
          "paginate": {
            "previous": '<i class="fa fa-caret-left"></i>',
            "next": '<i class="fa fa-caret-right"></i>',

          },
          
        },
        
        "ajax":{
            'type':'POST',
            'url':'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=getServiceReqAdmin',
            'data':{
                'serviceId': serviceId,
                'selectUser': selectUser,
                'selectSp': selectSp,
                'status': status,
                'endDate': endDate,
                'startDate': startDate,
                'phone': phone,
                'postalcode': postalcode,

            },
        },
        'columns':[
            {"data":"serviceId"},
            {"data":"serviceDate"},
            {"data":"customer"},
            {"data":"serviceProvider"},
            {"data":"status"},
            {"data":"action"},
            
        ],
    }).ajax.reload();

    
})

 
 



// Detail Modal ----------------------------------------------------------------------------------------->
$('#serviceReqTable').on('click', '.modalData', function(){
  serviceId=$(this).attr('name');
  // alert(serviceId);
  $.ajax({
    type:"POST",
    url:'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=getServiceData',
    data:{
      'serviceId':serviceId,
    },
    dataType:'json',
    success: function(data)
    {
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
      $('.mapModal').html(data[23]);

    }
  })
})


// edit modal ------------------------------------------------------------------------------------------->

$('#editmodal').on('change', '.#time', function(){
  totaltime=parseFloat($(this).attr("name"));
  // alert(totaltime)
  selectedTime=parseFloat($('#time option:selected').val());
  totaltimef=totaltime+selectedTime;
  if(totaltimef>=21)
  {
    $('.hrErr').text("Please select less than 21 hours to complete the service")
  }else{
    $('.hrErr').text('');
  }
  
})
// form validation of edit modal

$('#editmodal').on('change', '#reDate', function(){
  var date=$("#reDate").val();
  if(date.length==0)
  {
    $('.dErr').text("please select date !");

  }else{
  $('.dErr').text("");
 }
});

$('#editmodal').on('change', '#street', function(){
  var street=$("#street").val();
  if(street.length==0)
  {
  $('.streetErr').text("please enter street name");

  }else{
  $('.streetErr').text("");
  }
});

$('#editmodal').on('change', '#houseno', function(){
  var houseno=$("#houseno").val();
  if(houseno.length==0)
  {
  $('.houseErr').text("please enter house number");
  }else{
  $('.houseErr').text("");
  }
});

$('#editmodal').on('change', '#postal', function(){
  var pin=$('#postal').val();
  if(pin.length<5)
  {
    $('.pincodeErr').text("Please enter valid postalcode");
  }else{
    $('.pincodeErr').text("");
  }
});

$('#editmodal').on('change', '#whyreschedule', function(){
  var whyreschedule=$('#whyreschedule').val();
  if(whyreschedule.length<5)
  {
    $('.whyErr').text("Please enter valid Reason to Reschedule");
  }else{
    $('.whyErr').text("");
  }
});

$('#editmodal').on('change', '#callcenteremp', function(){
  var callcenteremp=$('#callcenteremp').val();
  if(callcenteremp.length<5)
  {
    $('.empErr').text("Please enter valid EMP Note");

  }else{
    $('.empErr').text("");
  }
});


  $('#serviceReqTable').on('click', '.editoption', function(){
    serviceId=$(this).attr('id');
    // alert(serviceId);
    $.ajax({
      type:'POST',
      url:'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=geteditmodalData',
      data:{
        'serviceId':serviceId,
      },
      success: function(data)
      {
        $('.editservice').html(data);
        
        $('#reDate').datepicker({ dateFormat: 'yy-mm-dd' });
      }
    })
  })

  
  $('#editmodal').on('input', '#postal', function(){
    pincode=$(this).val();
    $.ajax({
      type:'POST',
      url:'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=cityCheck',
      data:{
        'postalcode':pincode,
      },
      success: function(data)
      {
        $('#city').html(data);
      }
    })

  });

  $('#editmodal').on('input', '#postal2', function(){
    pincode=$(this).val();
    $.ajax({
      type:'POST',
      url:'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=cityCheck',
      data:{
        'postalcode':pincode,
      },
      success: function(data)
      {
        $('#city2').html(data);
      }
    })

  });

  
  $('#editmodal').on('click', '.btnReschedule', function(){
 
     
      date = $("#reDate").val();
      time = $("#time option:selected").val();
      street = $("#street").val();
      postal = $("#postal").val();
      houseno = $("#houseno").val();
      city = $("#city").val();
      serviceId = $('.btnReschedule').attr("id");
      addressId = $(".serAdd").attr('id');
      $("#whyreschedule").text("");
      $("#callcenteremp").text("");

      $.ajax({
        type:'POST',
        url:'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=adminReschedule',
        data:{
          'reDate':date,
          'reTime':time,
          'reStreet':street,
          'rePostal':postal,
          'reHouse':houseno,
          'reCity':city,
          'reServiceId':serviceId,
          'reAddId':addressId,
        },
        success: function(data)
        {
          if(data==1)
          {
            // alert("Reschedule has been Updated Successfully")
                    swal({
                         title: "Successfull",
                         text: "Reschedule has been Updated Successfully",
                         icon: "success",
                        });
          }
          if(data==0)
          {
            // alert("Reschedule has Not been Updated")
                    swal({
                         title: "fail",
                         text: "Reschedule has Not Updated Successfully",
                         icon: "error",
                        });
          }
          $("#serviceReqTable").DataTable().ajax.reload();
        }
      })



  })

  getCustselect();
  getSpselect();
  function getCustselect(){
    $.ajax({
        type: 'POST',
        url: 'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=getAllUser',
        
        success: function(data)
        {
            $('#selectCust').append(data);
        }
    })
  }
  function getSpselect(){
    $.ajax({
        type: 'POST',
        url: 'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=getAllSp',
        success: function(data)
        {
            $('#selectSp').append(data);
        }
    })
  }

  $('#datepicker').on('change', function(){
    startDate=$('#datepicker').val();
     endDate=$('#datepicker2').val();
    if(endDate=='')
    {
      $('#errmsg').text("Please Enter End date to filter records");
       myTimeout = setTimeout(err, 5000);

         function err() {
         document.getElementById("errmsg").innerHTML = "";
        }
    }
    
  });
  $('#datepicker2').on('change', function(){
    startDate=$('#datepicker').val();
     endDate=$('#datepicker2').val();
    if(startDate=='')
    {
      $('#errmsg').text("Please Enter From date to filter records");
       myTimeout = setTimeout(err, 5000);

         function err() {
         document.getElementById("errmsg").innerHTML = "";
        }
    }
    
  });

  $('#searchRec').on('click', function(){
   
   if ($('#serviceId').val()!="" || $('#selectCust').text()!="Customer" || $('#selectSp').text()!="Serviceprovider" || $('#selectStatus').val()!=0 || $('#datepicker').val()!="" || $('#datepicker2').val()!=""){
       
     serviceId=$('#serviceId').val();
     if($('#selectCust option:selected').val()!="Customer")
     {
       selectUser=$('#selectCust option:selected').val();
     }
     if($('#selectSp option:selected').val()!="Serviceprovider")
     {
       selectSp=$('#selectSp option:selected').val();
     }
     if($('#selectStatus option:selected').val()!=0)
     {
       status=$('#selectStatus option:selected').text();
     }
     startDate=$('#datepicker').val();
     endDate=$('#datepicker2').val();
    //  alert(selectSp)

     $('#serviceReqTable').dataTable().fnClearTable();
     $('#serviceReqTable').dataTable().fnDestroy();  
     table=$('#serviceReqTable').dataTable({
        "bFilter": false,
        "bInfo": false,
        "dom": '<"top"i>rt<"bottom"flp><"clear">',
        "searchPanes": {
            viewTotal: true
        },
        "language": {
          "paginate": {
            "previous": '<i class="fa fa-caret-left"></i>',
            "next": '<i class="fa fa-caret-right"></i>',

          },
          
        },
        
        "ajax":{
            'type':'POST',
            'url':'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=getServiceReqAdmin',
            'data':{
                'serviceId': serviceId,
                'selectUser': selectUser,
                'selectSp': selectSp,
                'status': status,
                'endDate': endDate,
                'startDate': startDate,
                // 'phone': phone,
                // 'postalcode': postalcode,

            },
        },
        'columns':[
            {"data":"serviceId"},
            {"data":"serviceDate"},
            {"data":"customer"},
            {"data":"serviceProvider"},
            {"data":"status"},
            {"data":"action"},
            
        ],
    }).ajax.reload(); 
    
  } 
  
   
 }); 

 $('#clearBtn').on("click", function(){
    serviceId=$('#serviceId').val("");
    startDate=$('#datepicker').val("");
    endDate=$('#datepicker2').val("");
    serviceId="";
    selectUser="";
    selectSp="";
    postalcode="";
    phone="";
    status="";
    startDate="";
    endDate="";
   
    $('#selectStatus').val("0").trigger("change");
    $('#selectCust').val("Customer").trigger("change");
    $('#selectSp').val("Serviceprovider").trigger("change");

    $('#serviceReqTable').dataTable().fnClearTable();
     $('#serviceReqTable').dataTable().fnDestroy();
    table=$('#serviceReqTable').dataTable({
        "bFilter": false,
        "bInfo": false,
        "dom": '<"top"i>rt<"bottom"flp><"clear">',
        "searchPanes": {
            viewTotal: true
        },
        "language": {
          "paginate": {
            "previous": '<i class="fa fa-caret-left"></i>',
            "next": '<i class="fa fa-caret-right"></i>',

          },
          
        },
        
        "ajax":{
            'type':'POST',
            'url':'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=getServiceReqAdmin',
            'data':{
                'serviceId': serviceId,
                'selectUser': selectUser,
                'selectSp': selectSp,
                'status': status,
                'endDate': endDate,
                'startDate': startDate,
                'phone': phone,
                'postalcode': postalcode,

            },
        },
        'columns':[
            {"data":"serviceId"},
            {"data":"serviceDate"},
            {"data":"customer"},
            {"data":"serviceProvider"},
            {"data":"status"},
            {"data":"action"},
            
        ],
    }).ajax.reload();
 })

</script>