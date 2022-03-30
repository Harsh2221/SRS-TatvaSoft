<script>
$(document).ready(function () {
    //   $("#myTable").dataTable({
    //     "bFilter": false,
    //     "bInfo": false,
    //     "dom": '<"top"i>rt<"bottom"flp><"clear">'
    //   });
    
      $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
      });
      
});

$(document).ready(function(){
    selectUser="";
    role="";
    phone="";
    postalcode="";

    table=$('#myTable').dataTable({
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
        
        "ajax":{
            'type':'POST',
            'url':'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=getDataUserMng',
            'data':{
                'selectUser': selectUser,
                'role': role,
                'phone': phone,
                'postalcode': postalcode,

            },
        },
        'columns':[
            {"data":"username"},
            {"data":"role"},
            {"data":"regiDate"},
            {"data":"userType"},
            {"data":"phone"},
            {"data":"postalcode"},
            {"data":"status"},
            {"data":"action"},
            
        ],
        
  }).ajax.reload();

    
})

var options = {
    "separator": ",",
    "filename": "UserHistoryAdmin.csv",
  }
  $(".expBtn").on('click', function () {
    // alert("+");
    $('#myTable').table2csv(options);
  });
  
  
  $('#myTable').on('click', '.deAct', function(){
    username="<?php echo $_SESSION['username']; ?>";
    userId=$(this).attr('id');
    // alert(username)
    status="No";
    actDeact();
   
  })
  $('#myTable').on('click', '.act', function(){
    username="<?php echo $_SESSION['username']; ?>";
    userId=$(this).attr('id');
    // alert(username)
    status="Yes";
    actDeact();
   
  })

  function actDeact(){
    $.ajax({
        type: 'POST',
        url: 'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=activeDeactive',
        data:{
            'username': username,
            'status': status,
            'userId': userId,
        },
        success: function(data)
        {
            if(data==1)
            {
                // alert("User Status Updated Successfully");
                    swal({
                         title: "Successfull",
                         text: "User Status Updated Successfully",
                         icon: "success",
                        });
            }
            if(data==0)
            {
                // alert("User Status Not Updated");
                    swal({
                         title: "fail",
                         text: "User Status Not Updated",
                         icon: "error",
                        });
            }
            $("#myTable").DataTable().ajax.reload();
        }
    })
  }

  userAndRole();

  function userAndRole(){
    $.ajax({
        type: 'POST',
        url: 'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=getUserAndRole',
        
        success: function(data)
        {
            $('#selUser').append(data);
        }
    })

  }
 
$('#searchbtn').on('click', function(){
    if ($('#selUser option:selected').text() != "Username"|| $("#userRole option:selected").text() != "User role" || $("#phonenum").val() != "" || $("#postal").val() != "") {

        if($('#selUser option:selected').text() != "Username"){
        selectUser = $('#selUser option:selected').text();}else{
            selectUser = '';
        }

        if($("#userRole option:selected").text() != "User role" ){
        selectrole = $("#userRole option:selected").val();}else{
          selectrole = '';
        }
        phonenum = $("#phonenum").val();
        postal = $("#postal").val();
        // alert(postal);

        $('#myTable').dataTable().fnClearTable();
        $('#myTable').dataTable().fnDestroy();

      table=$('#myTable').dataTable({
        "bFilter": false,
        "bInfo": false,
        "dom": '<"top"i>rt<"bottom"flp><"clear">',
        
        "language": {
          "paginate": {
            "previous": '<i class="fa fa-caret-left"></i>',
            "next": '<i class="fa fa-caret-right"></i>',

          },
          
        },
        
        "ajax":{
            'type':'POST',
            'url':'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=searchUMadmin',
            'data':{
                'selectUser': selectUser,
                'selectrole': selectrole,
                'phonenum': phonenum,
                'postal': postal,

            },
        },
        'columns':[
            {"data":"username"},
            {"data":"role"},
            {"data":"regiDate"},
            {"data":"userType"},
            {"data":"phone"},
            {"data":"postalcode"},
            {"data":"status"},
            {"data":"action"},
            
        ],
        
  }).ajax.reload();
        

    }
})

$('#resetbtn').on('click', function(){

  phone=$('#phonenum').val("");
  postalcode=$('#postal').val("");
   
    selectUser="";
    role="";
    phone="";
    postalcode="";
    $('#selUser').val("Username").trigger("change");
    $('#userRole').val("User role").trigger("change");

    $('#myTable').dataTable().fnClearTable();
    $('#myTable').dataTable().fnDestroy();

    table=$('#myTable').dataTable({
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
            'url':'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=getDataUserMng',
            'data':{
                'selectUser': selectUser,
                'role': role,
                'phone': phone,
                'postalcode': postalcode,

            },
        },
        'columns':[
            {"data":"username"},
            {"data":"role"},
            {"data":"regiDate"},
            {"data":"userType"},
            {"data":"phone"},
            {"data":"postalcode"},
            {"data":"status"},
            {"data":"action"},
            
        ],
        
  }).ajax.reload();
})
     
// $(document).ready(function () {
    
// });


</script>