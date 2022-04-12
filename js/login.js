const validateSignup = () =>{
    var username = document.getElementById("username");
    var images = document.getElementById("images");
    var password = document.getElementById("password");
    var cpassword = document.getElementById("cpassword");
    // var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if(username.value.trim() === "" || images.value.trim()==="" || password.value.trim() === "" || cpassword.value.trim() === ""){
        if(username.value.trim() === ""){
            username.style.borderColor = "red";
            document.getElementById("error1").style.display = "block";
            return false;
        }else if(images.value.trim() === ""){
            images.style.borderColor = "red";
            document.getElementById("error2").style.display = "block";
            return false;
        }else if(password.value.trim() === ""){
            password.style.borderColor = "red";
            document.getElementById("error1").style.display = "block";
            return false;
        }else{
            cpassword.style.borderColor = "red";
            document.getElementById("error1").style.display = "block";
            return false;
        }
    }else{
        if(password.value.trim() != cpassword.value.trim()){
            password.style.borderColor = "red";
            cpassword.style.borderColor = "red";
            return false;
        }

    }
}
const removeError = (clicked_id) =>{
    document.getElementById(clicked_id).style.borderColor = "#CDE9F2";
    if(clicked_id === "username"){
        document.getElementById("error1").style.display = "none";
    }else if(clicked_id === "images"){
        document.getElementById("error2").style.display = "none";
    }else if(clicked_id === "password"){
        document.getElementById("error3").style.display = "none";
    }else{
        document.getElementById("error4").style.display = "none";
    }
}