// function validate(){
//     let f_name=document.forms["regi_form"]["firstName"].value;
//     if(f_name==""){
       
//         document.getElementById("msg1").style.visibility = "visible";
//         return false;
        
//     }
    

//     let l_name=document.forms["regi_form"]["lastName"].value;
//     if(l_name==""){
//         document.getElementById("msg2").style.visibility = "visible";
//         return false;
//     }

//     let email=document.forms["regi_form"]["email"].value;
//     if(email==""){
//         document.getElementById("msg3").style.visibility = "visible";
//         return false;
//     }

//     let number=document.forms["regi_form"]["number"].value;
//     if(number==""){
//         document.getElementById("msg4").style.visibility = "visible";
//         return false;
//     }

//     let password=document.forms["regi_form"]["password"].value;
//     if(password==""){
//         document.getElementById("msg5").style.visibility = "visible";
//         return false;
//     }

//     let c_password=document.forms["regi_form"]["confirmPassword"].value;
//     if(c_password==""){
//         document.getElementById("msg6").style.visibility = "visible";
//         return false;
//     }

//     if (password!==c_password){
//         alert("Password is not matching, please Check !");
//         return false;
//     }

// } 

function validate(){
    var firstname=$('#firstName').val();
    var lastname=$('#lastName').val();
    var email=$('#email').val();
    var phone=$('#number').val();
    var password=$('#password').val();
    var confirmPassword=$('#c_password').val();
    

    if(firstname.length==0)
    {
        $('#msg1').text("Please enter FirstName");
        return false;
    }else{
        $('#msg1').empty();
    }

    if(lastname.length==0)
    {
        $('#msg2').text("Please enter LastName");
        return false;
    }else{
        $('#msg2').empty();
    }

    if(email.length==0)
    {
        $('#msg3').text("Please enter Valid Email");
        return false;
    }else{
        $('#msg3').empty();
    }

    if(phone.length==0)
    {
        $('#msg4').text("Please enter Phonenumber");
        return false;
    }else{
        $('#msg4').empty();
    }

    if(password.length==0)
    {
        $('#msg5').text("Please enter password");
        return false;
    }else{
        $('#msg5').empty();
    }

    if(confirmPassword.length==0)
    {
        $('#msg6').text("Please confirm password");
        return false;
    }else{
        $('#msg6').empty();
    }

    if(password!=confirmPassword)
    {
        alert("Please check confirm password");
        return false;
    }
    
    if($("#agreecheck").is(':checked')){
        $('#msg7').empty();
    }else{
        $('#msg7').text("* Please agree and check the checkbox");
        
        return false;
    }
    
        
        
   

};