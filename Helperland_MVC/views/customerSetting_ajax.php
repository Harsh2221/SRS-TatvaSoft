<script>

$(document).ready(function () {
    // $("#datepicker").datepicker();
    username="<?php echo $_SESSION['username']; ?>";
    getUserDetail();

});

function getUserDetail()
    {
        // alert(username);
        $.ajax({
            type:'POST',
            url:'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=custDetails',
            data: {
                username: username,
            },
            dataType:"json",
            success: function(data){
                $('#first_name').val(data[0]);
                $('#last_name').val(data[1]);
                $('#email_detail').val(data[2]);
                $('#phone_detail').val(data[3]);
                $('#birthdate').val(data[4]);
                $('#birthmonth').val(data[5]);
                $('#birthyear').val(data[6]);
                $('#lang_detail').val(data[7]);
            }
        });
        
        

}

function saveDetails(){
    // e.preventDefault();
    // alert("+")
   if ( ($('#first_name').val() == "") || ($('#last_name').val()=="") || ($('#email_detail').val()=="") || ($('#phone_detail').val()=="") || ($('#birthdate').val()=="00") || ($('#birthmonth').val()=="00") || ($('#birthyear').val()=="00"))
   {
       alert("Please check and enter all the details")
   }else{
       firstName=$('#first_name').val();
       lastName=$('#last_name').val();
       email=$('#email_detail').val();
       phone=$('#phone_detail').val();
       DOB_date=$('#birthdate').val();
       DOB_month=$('#birthmonth').val();
       DOB_year=$('#birthyear').val();
       dateOfBirth=DOB_year + "-" + DOB_month + "-" + DOB_date;
       language=$('#lang_detail').val();

       $.ajax({
           type:'POST',
           url:'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=savecustDetails',
           data: {
               'firstName':firstName,
               'lastName':lastName,
               'email':email,
               'phone':phone,
               'dateOfBirth':dateOfBirth,
               'language':language,
           },
           dataType:'json',
           success: function(data){
               if(data==1)
               {
                   alert("Details update successfully");
               }
               if(data==0)
               {
                   alert("details not upadated")
               }

        // getting existing details here
            getUserDetail();

           }
       })
       
   }

}

$(document).ready(function () { 
    
    username = "<?php echo $_SESSION['username'] ?>";

    table = $("#addressTable").DataTable({
                "bFilter": false,
                "bInfo": false,
                "dom": '<"top"i>rt<"bottom"flp><"clear">',
                
                "zeroRecords": "No Data Found",
                
                "ajax": {
                    'type': 'POST',
                    'url': 'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=getAddressTable',
                    'data': { 'username' : username }, 
                },
                'columns': [
                    { "data": 'default' },
                    {"data": 'address'},
                    {"data": 'action'},
                    
                ],   
               
    }).ajax.reload();

$('#addressTable').on('click', '.editBtn', function(){
    // alert("+")
    addressId=$(this).attr('id');
    //  alert(addressId);
    $.ajax({
        type: 'POST',
        url: 'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=getAddressData',
        data: {
            'addressId': addressId,
        },
        dataType: 'json',
        success: function(data)
        {
            $('#inputstreet').val(data[0]);
            $('#inputhouse').val(data[1]);
            $('#inputpostal').val(data[3]);
            $('#city').html(data[2]);
            $('#inputphone1').val(data[4]);
            $('.btn_edit').attr("id", data[5]);

        }

    });
});

$('#edit_address').on('change', '#inputpostal', function(){
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
})
$('#addNew_address').on('change', '#inputpostal2', function(){
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
}) 

$('#edit_address').on('click', '.btn_edit', function(){
    // alert("+")
    addressId=$(this).attr('id');
    // alert(addressId)
    streetname=$('#inputstreet').val();
    housenumber=$('#inputhouse').val();
    postalcode=$('#inputpostal').val();
    city=$('#city').val();
    phone=$('#inputphone1').val();
    
    $.ajax({
        type: 'POST',
        url: 'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=editAddress',
        data: {
            "streetname":streetname,
            "housenumber":housenumber,
            "postalcode":postalcode,
            "city":city,
            "phone":phone,
            "addressId":addressId,
        },
        success: function(data)
        {
            if(data==1)
            {
                alert("Address upadated successfully")
            }
            if(data==0)
            {
                alert("Address is Not upadated Successfully")
            }
            $('#addressTable').DataTable().ajax.reload();
        }
    });

});

// new address form validation
$('#addNew_address').on('change', '#inputstreet2', function(){
  var inputstreet2=$('#inputstreet2').val();
  if(inputstreet2.length==0)
  {
    $('.streetErr').text("Please enter street name");

  }else{
    $('.streetErr').text("");
  }
});
$('#addNew_address').on('change', '#inputpostal2', function(){
  var pin=$('#inputpostal2').val();
  if(pin.length<5)
  {
    $('.postalErr').text("Please enter valid postalcode");
  }else{
    $('.postalErr').text("");
  }
});
$('#addNew_address').on('change', '#inputphone2', function(){
  var inputphone2=$('#inputphone2').val();
  if(inputphone2.length<10)
  {
    $('.phoneErr').text("Please enter valid Phone number");
  }else{
    $('.phoneErr').text("");
  }
});

$('#addNew_address').on('click', '#addnewAddress',function(){

if($('#inputstreet2').val()=="" || $('#inputhouse2').val()=="" || $('#inputpostal2').val()=="" || $('#inputphone2').val()=="")
{
    alert("Please Enter all the Details")

}else{
    streetname=$('#inputstreet2').val();
    housenumber=$('#inputhouse2').val();
    postalcode=$('#inputpostal2').val();
    city=$('#city2').val();
    phonenumber=$('#inputphone2').val();
    <?php if (isset($_SESSION['username'])) { ?>
        username = "<?php echo $_SESSION['username']; ?>";
    <?php } ?>

    $.ajax({
        type: 'POST',
        url: 'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=add_Address',
        data: {
            "addresssave": 1,
            "streetname":streetname,
            "housenumber":housenumber,
            "postalcode":postalcode,
            "city":city,
            "phonenumber":phonenumber,
            "username": username,
        },
        success: function(data)
        {
            if(data==1)
            {
                alert("Address Added successfully")
            }
            if(data==0)
            {
                alert("Address is Not Added Successfully")
            }
            $('#addressTable').DataTable().ajax.reload();
        }
    });

}
    
   
  
});

$('#addressTable').on('click', '.DeleteBtn', function(){ 
    // alert("+");
    addressId=$(this).attr('id');
    // alert(addressId)
    $.ajax({
        type: 'POST',
        url: 'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=getAddressData',
        data: {
            'addressId': addressId,
        },
        dataType: 'json',
        success: function(data)
        {
            
            $('.btn_delete').attr("id", data[5]);
            // alert("got it");

        }

    });
});

$('#deleteModal').on('click', '.btn_delete', function(){
    // alert("got it")
    addressId=$(this).attr('id');
    // alert(addressId);
    $.ajax({
        type: 'POST',
        url:'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=deleteAddress',
        data:{
            'addressId': addressId,
        },
        success: function(data)
        {
            if(data==1)
            {
                alert("Address deleted successfully");
            }
            if(data==0)
            {
                alert("Address is Not deleted successfully");
            }
            $('#addressTable').DataTable().ajax.reload();
        }
    })
});

$('.change_pass').on("click", function() {
    
    // alert("submit")
   var old_pass=$('#old_pass').val();
   var new_pass=$('#new_pass').val();
   var conf_pass=$('#confirm_pass').val();
   if(old_pass.length==0){
    $('.errMsg1').text("Please enter Old password")
   }else{
    $('.errMsg1').empty();
   }

   if(new_pass.length==0)
   {
    $('.errMsg2').text("Please enter new password")
   }else{
    $('.errMsg2').empty();
   }

   if(conf_pass.length==0)
   {
    $('.errMsg3').text("Please confirm password")
   }
   else{
    $('.errMsg3').empty();
   }

   if(new_pass!=conf_pass){
    $('.errMsg3').text("Password not matching, please check again")
    return false;
   }else{
    $('.errMsg3').empty();
   }
   

   if ( ($('#old_pass').val() == "") || ($('#new_pass').val()=="") || ($('#confirm_pass').val()==""))
   {
   
       alert("Please check and enter all details");
       return false;
   }else{
       oldPassword=$('#old_pass').val();
       newPassword=$('#new_pass').val();
       confirmPassword=$('#confirm_pass').val();
       firstName=$('#first_name').val();
       modifiedBy=firstName;
    //    alert(username);
       $.ajax({
           type: 'POST',
           url: 'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=changePassword',
           data: {
               'username': username,
               'oldPassword': oldPassword,
               'newPassword': newPassword,
               'confirmPassword': confirmPassword,
               'modifiedBy': modifiedBy,
           },
           success: function(data)
           {
               if(data==0){
                   alert("Old password is incorrect");

               }
               if(data==1){
                oldPassword=$('#old_pass').val("");
                newPassword=$('#new_pass').val("");
                confirmPassword=$('#confirm_pass').val("");
                alert('New password set successfully')

               }
               if(data==2){
                   alert('Password not set successfully');

               }
           }

       });
   }

});

$('#addressTable').on('click', 'input[name=addressDef]', function(){
    checkDef=$('input[name=addressDef]:checked').val();
    // alert(checkDef)
    $.ajax({
        type:'POST',
        url:'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=DefaultAddress',
        data:{
            "checkDef":checkDef,
        },
        success: function(data)
        {
            if(data==0)
            {
                alert("Default Address Not seted")
            }
            if(data==1){
                alert("Default Address Set Successfully!")
                
            }
            $('#addressTable').DataTable().ajax.reload();
        }
    })

});

});


</script> 