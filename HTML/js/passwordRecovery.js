function validate(){
    let pass1=document.forms["form"]["password"].value;
    if(pass1==""){
        document.getElementById("msg1").style.visibility = "visible";
        
    }

    let pass2=document.forms["form"]["c_password"].value;
    if(pass2==""){
        document.getElementById("msg2").style.visibility = "visible";
       return false;
    }

    if (pass1!==pass2){
        alert("Password is not matching, please Check !");
        return false;
    }
}

