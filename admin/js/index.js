const validateLogin = () =>{
    let username =  document.getElementById("username");
    let password =  document.getElementById("passwords");
    let checkboxs =  document.getElementById("autofill");
    if(username.value.trim() === "" || password.value.trim() === ""){
        if(username.value.trim() === ""){
            username.style.borderColor = "red";
            return false;
        }else{
            password.style.borderColor = "red";
            return false;
        }
    }else{
        if(checkboxs.checked){
           localStorage.setItem("username",username.value.trim());
           localStorage.setItem("password",password.value.trim());
        }else{

        }
    }
}

const validateReset = () =>{
    let usernames =  document.getElementById("usernames");
    let passwords =  document.getElementById("password");
    let cpasswords = document.getElementById("cpasswords");
    if(usernames.value.trim() === "" || passwords.value.trim() === "" || cpasswords.value.trim() === ""){
        if(usernames.value.trim() === ""){
            username.style.borderColor = "red";
            return false;
        }else if(passwords.value.trim() === ""){
            password.style.borderColor = "red";
            return false;
        }else{
            cpasswords.style.borderColor = "red";
            return false;
        }
    }else{
        if(passwords.value.trim() != cpasswords.value.trim()){
            password.style.borderColor = "red"
            cpasswords.style.borderColor = "red"
            return false;
        }else{

        }
    }
}

const removeEror = (clicked_id) =>{
    document.getElementById(clicked_id).style.borderColor = "#A3C3EF"
}

const setValues = () =>{
    let usernames = localStorage.getItem("username");
    let passwords = localStorage.getItem("password");
    let username =  document.getElementById("username").value = usernames;
    let password =  document.getElementById("passwords").value = passwords;
}

window.onload = setValues;