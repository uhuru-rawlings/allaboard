const validateLogin = () =>{
    let username = document.getElementById("username");
    let password = document.getElementById("password");
    if(username.value.trim() === "" || password.value.trim() === ""){
        if(username.value.trim() === "" ){
            username.style.borderColor = "red";
            return false;
        }else{
            password.borderColor = "red";
            return false;
        }
    }
}
const removeError = (clicked_id) =>{
    document.getElementById(clicked_id).style.borderColor = "#CED4DA";
    document.getElementById("error").style.display = "none"
}
const validateSignup = () =>{
    let username = document.getElementById("usernames");
    let password = document.getElementById("passwords");
    let cpassword = document.getElementById("cpasswords");
    if(username === "" || password === "" || cpassword === ""){
        if(username.value.trim() === ""){
            username.style.borderColor = "red";
            return false;
        }else if(password.value.trim() === ""){
           password.style.borderColor = "red";
           return false;
        }else{
            cpassword.style.borderColor = "red";
            return false;
        }
    }else{
        if(password.value.trim() !== cpassword.value.trim()){
            document.getElementById("error").style.display = "block"
            password.style.borderColor = "red";
            cpassword.style.borderColor = "red";
            return false;
        }
    }
}