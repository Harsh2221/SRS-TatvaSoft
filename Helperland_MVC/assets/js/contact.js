

function validate(){
    let f_name=document.forms["form"]["f_name"].value;
    if(f_name==""){
        document.getElementById("msg1").style.visibility = "visible";
        return false;
    }

    let l_name=document.forms["form"]["l_name"].value;
    if(l_name==""){
        document.getElementById("msg2").style.visibility = "visible";
       return false;
    }

    let email=document.forms["form"]["number"].value;
    if(email==""){
        document.getElementById("msg3").style.visibility = "visible";
        return false;
    }

    let number=document.forms["form"]["email"].value;
    if(number==""){
        document.getElementById("msg4").style.visibility = "visible";
       return false;
    }

    let password=document.forms["form"]["message"].value;
    if(password==""){
        document.getElementById("msg5").style.visibility = "visible";
       return false;
    }

   

}

swal({
    title: "Good job!",
    text: "You clicked the button!",
    icon: "success",
    button: "Aww yiss!",
  });