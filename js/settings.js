const resetpasswords = () =>{
    var passs1 = document.getElementById("passwords");
    var passs2 = document.getElementById("cpasswords");
    if(passs1.value.trim() === "" || passs2.value.trim() === ""){
         if(passs1.value.trim() === ""){
             passs1.style.borderColor = "red";
             return false;
         }else{
            passs2.style.borderColor = "red";
            return false;
         }
    }else{
        if(passs2.value.trim() === passs1.value.trim()){

        }else{
            document.getElementById("errores").style.display = "block";
            document.getElementById("errores").innerText = "Passwords dont match please confiurm and try again";
            return false;
        }
    }
}
const removeError = (clicked_id) =>{
   document.getElementById(clicked_id).style.borderColor = "#C4E3F3";
   document.getElementById("errores").style.display = "none";
}
const logout = () =>{
    window.location.replace("login.php");
}