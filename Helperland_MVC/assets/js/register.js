function validate(){
    let f_name=document.forms["regi_form"]["firstName"].value;
    if(f_name==""){
        document.getElementById("msg1").style.visibility = "visible";
        return false;
    }

    let l_name=document.forms["regi_form"]["lastName"].value;
    if(l_name==""){
        document.getElementById("msg2").style.visibility = "visible";
        return false;
    }

    let email=document.forms["regi_form"]["email"].value;
    if(email==""){
        document.getElementById("msg3").style.visibility = "visible";
        return false;
    }

    let number=document.forms["regi_form"]["number"].value;
    if(number==""){
        document.getElementById("msg4").style.visibility = "visible";
        return false;
    }

    let password=document.forms["regi_form"]["password"].value;
    if(password==""){
        document.getElementById("msg5").style.visibility = "visible";
        return false;
    }

    let c_password=document.forms["regi_form"]["confirmPassword"].value;
    if(c_password==""){
        document.getElementById("msg6").style.visibility = "visible";
        return false;
    }

    if (password!==c_password){
        alert("Password is not matching, please Check !");
        return false;
    }

}