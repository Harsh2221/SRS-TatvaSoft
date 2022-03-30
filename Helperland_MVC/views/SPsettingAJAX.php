<script>
    $(document).ready(function(){
             
$('.savePass').on("click", function() {
    username="<?php echo $_SESSION['username'] ?>";
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
    //    alert(firstName);
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
                //    alert("Old password is incorrect");
                   swal({
                         title: "Incorrect",
                         text: "Old password is incorrect",
                         icon: "error",
                        });

               }
               if(data==1){
                oldPassword=$('#old_pass').val("");
                newPassword=$('#new_pass').val("");
                confirmPassword=$('#confirm_pass').val("");
                // alert('New password set successfully')
                swal({
                         title: "Successfull",
                         text: "New password set successfully",
                         icon: "success",
                        });

               }
               if(data==2){
                //    alert('Password not set successfully');
                   swal({
                         title: "Fail",
                         text: "New password Not seted",
                         icon: "error",
                        });
               }
            //    if(data==3){
            //        alert('count is 0');

            //    }
           }

       });
   }

});
});

$(document).ready(function(){
    $('.avatarimg').on('click', function(){
        $('.avatarimg').removeClass("active");  
        $(this).addClass("active");  
    });

    $('#save').on('click', function(){
        var nationality=$('#nationality').val();
                
        if(nationality.length==0){
           $('.errmsg1').text("Please select nationality")
           }else{
           $('.errmsg1').empty();
        }
        if($('input[name=gender]:checked').length == 0)
        {
            $('.errmsg2').text("Please select gender")
           }else{
           $('.errmsg2').empty();
        }
        if($('.avatarimg').hasClass('active') == false)
        {
            $('.errmsg3').text("Please select your avatar")
           }else{
           $('.errmsg3').empty();
        }

        var street=$('#street_detail').val();
        var house=$('#house').val();
        var postalcode=$('#postal').val();
        var city=$('#city').val();
                
        if(street.length==0){
           $('.errmsg4').text("Please enter street name")
           }else{
           $('.errmsg4').empty();
        }
        if(house.length==0){
           $('.errmsg5').text("Please enter house number")
           }else{
           $('.errmsg5').empty();
        }
        if(postalcode.length==0 || postalcode.length<5){
           $('.errmsg6').text("Please enter valid postalcode")
           }else{
           $('.errmsg6').empty();
        }
        if(city.length==0){
           $('.errmsg7').text("Please enter city")
           }else{
           $('.errmsg7').empty();
        }


        
        
        
        if($('#nationality').val()=="" || $('input[name=gender]:checked').length == 0 || $('.avatarimg').hasClass('active') == false || $('#street_detail').val()=="" || $('#house').val()=="" || $('#postal').val()=="" || $('#city').val()=="")
        {
        
        alert("Please Check and enter All the Details");

        }else{
            username = "<?php echo $_SESSION['username']; ?>";
            firstName=$('#first_name').val();
            lastName=$('#last_name').val();
            email=$('#email_detail').val();
            phone=$('#phone_detail').val();
            DOB_date=$('#birthdate').val();
            DOB_month=$('#birthmonth').val();
            DOB_year=$('#birthyear').val();
            dateOfBirth=DOB_year + "-" + DOB_month + "-" + DOB_date;
            nationality=$('#nationality').val();
            gender = $('input[name=gender]:checked').val();
            DPimg = $('.avtarimages .active').attr('src');
            DPimg = DPimg.slice(2)
            avatarimg = "http://localhost/Tatvasoft/Helperland_MVC/"+DPimg;
            // alert(avatarimg);
            streetName=$('#street_detail').val();
            houseNo=$('#house').val();
            postalCode=$('#postal').val();
            city=$('#city').val();

            $.ajax({
                type:'POST',
                url:'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=addSPdetails',
                data:{
                    'firstName': firstName,
                    'lastName': lastName,
                    'email': email,
                    'phone': phone,
                    'dateOfBirth': dateOfBirth,
                    'avatarimg': avatarimg,
                    'gender':gender,
                    'nationality':nationality,
                    'streetName': streetName,
                    'houseNo': houseNo,
                    'postalCode': postalCode,
                    'city': city,
                    

                },
                dataType:'json',
                success: function(data){
                    if(data==1)
                    {
                        // alert("details updated successfully");
                        swal({
                         title: "Successfull",
                         text: "Details update successfully",
                         icon: "success",
                        });
                    }
                    if(data==0)
                    {
                        // alert("details not updated succesfully");
                        swal({
                         title: "Fail to Update",
                         text: "details not upadated, try again",
                         icon: "error",
                        });
                    }
                }

            })
            location.reload();
        }
        
    });

    getServiceProviderData();

    function getServiceProviderData(){
        username = "<?php echo $_SESSION['username']; ?>";
        $.ajax({
            type:'POST',
            url:'http://localhost/tatvasoft/Helperland_MVC/?controller=main_&function=custDetails',
            data:{
                'username':username,
            },
            dataType:'json',
            success: function(data){
            $('#first_name').val(data[0]);
            $('#last_name').val(data[1]);
            $('#email_detail').val(data[2]);
            $('#phone_detail').val(data[3]);
            $('#birthdate').val(data[4]);
            $('#birthmonth').val(data[5]);
            $('#birthyear').val(data[6]);
            $('.avatarimgdp').attr('src',data[10]);
            $('#nationality').val(data[9]);
            $('input[name=gender]').val([data[8]]);
            $('.avatarimg').removeClass('active');
            for(i=0;i<6;i++){
            if(document.querySelectorAll('.avatarimg')[i].src == data[10]) {
                document.querySelectorAll('.avatarimg')[i].setAttribute("class","avatarimg active");
               } 
            }
            
            $('#street_detail').val(data[11]);
            $('#house').val(data[12]);
            $('#postal').val(data[13]);
            $('#city').val(data[14]);

            }
        })
    }
})

</script>